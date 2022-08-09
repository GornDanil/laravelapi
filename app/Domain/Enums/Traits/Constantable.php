<?php

namespace App\Domain\Enums\Traits;

use Exception;
use Illuminate\Support\Collection;
use ReflectionClass;

/**
 * Trait Constantable
 * @package App\Domain\Enum
 */
trait Constantable
{
    /**
     * @return Collection
     */
    public static function all(): Collection
    {
        try {
            $reflectionClass = new ReflectionClass(self::class);
        } catch (Exception $e) {
            return collect();
        }
        return collect($reflectionClass->getConstants())->values();
    }

    /**
     * @return Collection
     */
    public static function keys(): Collection
    {
        try {
            $reflectionClass = new ReflectionClass(self::class);
        } catch (Exception $e) {
            return collect();
        }
        return collect($reflectionClass->getConstants())->keys();
    }
}
