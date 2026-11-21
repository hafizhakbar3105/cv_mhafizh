<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProjectImage>
 */
class ProjectImageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'project_id' => Project::factory(),
            'image_path' => 'projects/test-' . fake()->unique()->numberBetween(1, 99999) . '.jpg',
            'alt_text' => fake()->sentence(4),
            'sort_order' => 0,
        ];
    }
}
