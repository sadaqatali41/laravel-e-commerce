<?php

namespace Database\Factories\Admin;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AdminFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'), // or Hash::make()
            'email_verified_at' => now(),
            'remember_token' => Str::random(10)
        ];
    }
}
