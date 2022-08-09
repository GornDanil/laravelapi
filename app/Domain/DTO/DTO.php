<?php


namespace App\Domain\DTO;

use Closure;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use JsonSerializable;
use ReflectionClass;
use ReflectionProperty;

class DTO implements Arrayable, Jsonable, JsonSerializable
{
    /** @var array */
    protected array $casts = [];

    /**
     * DTO constructor.
     *
     * @param array| $fields
     */
    public function __construct($fields = [])
    {
        $this->fill($fields);
    }

    /**
     * Заполнить поля DTO из массива и преобразовать в тип поля
     *
     * @param array|DTO| $fields
     * @return $this

     */
    public function fill($fields): self
    {
        if ($fields instanceof DTO) {
            $fields = $fields->toArray();
        }

        $vars = $this->getProperties();
        foreach ($vars as $variable) {
            $var = $variable->getName();
            if (isset($fields[$var])) {
                $value = $fields[$var];

                $value = $this->checkSetterValue($var, $value);

                if (isset($this->casts[$var])) {
                    $cast = $this->casts[$var];
                    $value = $this->prepareCastValue($cast, $value);
                } else if ($variable->getType()) {
                    $type = $variable->getType()->getName();
                    if (class_exists($type)) {
                        if (is_subclass_of($type, DTO::class) && is_array($value)) {
                            $value = new $type($value);
                        }
                    }
                }

                $this->{$var} = $value;
            }
        }
        return $this;
    }

    public function toArray(): array
    {
        $vars = $this->getProperties();
        $array = [];
        foreach ($vars as $var) {
            $key = $var->getName();
            $value = $this->{$key} ?? null;
            $array[$key] = ($value && $value instanceof Arrayable ? $value->toArray() : $value);
        }
        return $array;
    }

    /**
     * Получить все публичные поля объекта
     *
     * @return ReflectionProperty[]
     */
    protected function getProperties(): array
    {
        return $this->reflection()->getProperties(ReflectionProperty::IS_PUBLIC);
    }

    protected function reflection(): ReflectionClass
    {
        return new ReflectionClass(static::class);
    }

    /**
     * @param string $name
     * @param $value
     * @return mixed
     */
    protected function checkSetterValue(string $name, $value)
    {
        $key = Str::studly($name);
        $method = "set{$key}Attribute";
        if (method_exists($this, $method)) {
            return $this->{$method}($value);
        }

        return $value;
    }

    /**
     * @param string|Closure $cast
     * @param mixed $value
     * @return mixed
     */
    protected function prepareCastValue($cast, $value)
    {
        if (is_array($value)) {
            $value = array_map(
                fn($item) => is_callable($cast) ? $cast($value) : new $cast($item),
                $value
            );
        } else if ($value instanceof Collection) {
            $value->transform(
                fn($item) => is_callable($cast) ? $cast($value) : new $cast($item)
            );
        } else {
            $value = is_callable($cast) ? $cast($value) : new $cast($value);
        }
        return $value;
    }

    /**
     * @param array $values
     * @return Collection
     */
    public static function collect(array $values): Collection
    {
        $collection = collect();
        foreach ($values as $value) {
            $obj = new static();
            $collection->add($obj->fill($value));
        }
        return $collection;
    }

    /**
     * @param array $keys
     * @return array
     */
    public function only(array $keys): array
    {
        return Arr::only($this->initialized(), $keys);
    }

    /**
     * Рекурсивно трансформирует инициализированные публичные поля DTO в массив
     *
     * @return array
     */
    public function initialized(): array
    {
        $vars = $this->getProperties();
        $array = [];
        foreach ($vars as $var) {
            if ($var->isInitialized($this)) {
                $key = $var->getName();
                $value = $this->{$key};
                $array[$key] = ($value instanceof Arrayable ? $value->toArray() : $value);
            }
        }
        return $array;
    }

    public function isInitialized(string $field): bool
    {
        foreach ($this->getProperties() as $property) {
            if ($property->getName() === $field) {
                return $property->isInitialized($this);
            }
        }
        return false;
    }

    /**
     * @param int $options
     * @return string
     */
    public function toJson($options = 0): string
    {
        return json_encode(
            $this->toArray(),
            $options
        );
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
