<?php

namespace Database\Factories\Admin;

use App\Models\Admin\Admin;
use App\Models\Admin\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin\Slider>
 */
class SliderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $admin = Admin::inRandomOrder()->first()->id;
        
        return [
            'category_id' => Category::factory(),
            'title' => $this->faker->sentence(3),
            'short_title' => $this->faker->word(),
            'description' => $this->faker->text(80),
            'image' => $this->faker->imageUrl(1920, 700),
            'status' => 'A',
            'created_by' => $admin,
            'updated_by' => $admin,
        ];
    }
}
