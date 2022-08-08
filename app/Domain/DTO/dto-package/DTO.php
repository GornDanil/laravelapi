<?php


namespace App\Domain\DTO;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Atwinta\DTO\Exceptions\DtoException;

class DTO extends \Atwinta\DTO\DTO
{
    /** @var array */
    protected array $casts = [];

    /**
     * Заполнить поля DTO из массива и преобразовать в тип поля
     *
     * @param array|DTO|\Atwinta\DTO\DTO $fields
     * @return $this
     * @throws DtoException
     */
    public function fill($fields): self
    {
        if ($fields instanceof \Atwinta\DTO\DTO) {
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
     * @param string|\Closure $cast
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
     * @param array $keys
     * @return array
     */
    public function only(array $keys): array
    {
        return Arr::only($this->initialized(), $keys);
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

}
