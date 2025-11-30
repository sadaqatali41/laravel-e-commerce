<?php

namespace App\Enums;

enum OrderStatus: int
{
    case PLACED     = 1;
    case ON_THE_WAY = 2;
    case DELIVERED  = 3;
    case CANCELLED  = 4;

    /**
     * Get all statuses as an associative array.
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
            self::PLACED     => 'Placed',
            self::ON_THE_WAY => 'On the way',
            self::DELIVERED  => 'Delivered',
            self::CANCELLED  => 'Cancelled',
        };
    }

    /**
     * Color associated with the status for UI purposes.
     */
    public function color(): string
    {
        return match ($this) {
            self::PLACED     => 'label-warning',
            self::ON_THE_WAY => 'label-info',
            self::DELIVERED  => 'label-success',
            self::CANCELLED  => 'label-danger',
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