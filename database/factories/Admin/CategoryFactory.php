<?php

namespace Database\Factories\Admin;

use App\Models\Admin\Admin;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->unique()->words(2, true);
        $admin = Admin::inRandomOrder()->first()->id;

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'image' => $this->faker->imageUrl(),
            'is_home' => $this->faker->randomElement([0,1]),
            'created_by' => $admin,
            'updated_by' => $admin
        ];
    }
}
