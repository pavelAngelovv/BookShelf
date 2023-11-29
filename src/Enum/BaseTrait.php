<?php

namespace App\Enum;

trait BaseTrait
{
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
