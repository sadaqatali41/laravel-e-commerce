<?php

namespace App\Enums;

enum PaymentStatus: string
{
    case PENDING     = 'PENDING';
    case SUCCESS     = 'SUCCESS';
    case FAILED      = 'FAILED';

    /**
     * Get all payment statuses as an associative array.
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
            self::PENDING    => 'Pending',
            self::SUCCESS    => 'Success',
            self::FAILED     => 'Failed',
        };
    }

    /**
     * Color associated with the payment status for UI purposes.
     */
    public function color(): string
    {
        return match ($this) {
            self::PENDING => 'label-info',
            self::SUCCESS => 'label-success',
            self::FAILED  => 'label-danger',
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