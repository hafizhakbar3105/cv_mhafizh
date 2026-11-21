<?php

namespace Tests\Feature\Database;

use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_images_are_returned_in_display_order(): void
    {
        $project = Project::factory()->create();
        ProjectImage::factory()->create(['project_id' => $project->id, 'sort_order' => 2]);
        ProjectImage::factory()->create(['project_id' => $project->id, 'sort_order' => 1]);

        $this->assertSame([1, 2], $project->images->pluck('sort_order')->all());
    }

    public function test_deleting_a_project_deletes_its_image_rows(): void
    {
        $project = Project::factory()->create();
        ProjectImage::factory()->count(2)->create(['project_id' => $project->id]);

        $project->delete();

        $this->assertDatabaseCount('project_images', 0);
    }

    public function test_slug_must_be_unique(): void
    {
        Project::factory()->create(['slug' => 'duplicate-slug']);

        $this->expectException(QueryException::class);

        Project::factory()->create(['slug' => 'duplicate-slug']);
    }

    public function test_tech_stack_is_cast_to_array(): void
    {
        $project = Project::factory()->create(['tech_stack' => ['ESP32', 'MQTT']]);

        $this->assertSame(['ESP32', 'MQTT'], $project->fresh()->tech_stack);
    }

    public function test_featured_scope_only_returns_featured_projects(): void
    {
        Project::factory()->create(['is_featured' => true]);
        Project::factory()->create(['is_featured' => false]);

        $this->assertSame(1, Project::featured()->count());
    }

    public function test_new_projects_are_unpublished_by_default(): void
    {
        $project = Project::create([
            'title' => 'Draft',
            'slug' => 'draft',
            'category' => 'Embedded',
            'summary' => 'Draft summary',
        ]);

        $this->assertFalse($project->fresh()->is_published);
    }
}
