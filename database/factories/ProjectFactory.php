<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->unique()->words(3, true);

        return [
            'title' => $title,
            'slug' => Str::slug($title) . '-' . fake()->unique()->numberBetween(1000, 9999),
            'category' => 'Embedded',
            'summary' => fake()->sentence(),
            'status' => 'in_progress',
            'tech_stack' => ['ESP32'],
            'is_featured' => false,
            'is_published' => false,
            'sort_order' => 0,
        ];
    }
}
