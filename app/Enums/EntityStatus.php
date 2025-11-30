<?php

namespace App\Enums;

enum EntityStatus: string
{
    case ACTIVE     = 'A';
    case INACTIVE   = 'I';

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
            self::ACTIVE     => 'Active',
            self::INACTIVE => 'Inactive',
        };
    }

    /**
     * Color associated with the status for UI purposes.
     */
    public function color(): string
    {
        return match ($this) {
            self::ACTIVE  => 'badge-success',
            self::INACTIVE  => 'badge-danger',
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