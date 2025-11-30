<?php

namespace App\Enums;

enum PaymentType: string
{
    case GT   = 'GT';
    case COD  = 'COD';

    /**
     * Get all payment types as an associative array.
     */
    public static function toArray(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn ($case) => [$case->value => $case->label()])
            ->toArray();
    }

    /**
     * Human readable label for UI.
     */
    public function label(): string
    {
        return match ($this) {
            self::GT   => 'Online',
            self::COD  => 'COD',
        };
    }

    /**
     * Get comments string for enum cases.
     */
    public static function comments(): string
    {
        return collect(self::toArray())
            ->map(fn ($value, $key) => $key . '=' . $value)
            ->join(', ');
    }
}