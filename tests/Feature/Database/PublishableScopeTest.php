<?php

namespace Tests\Feature\Database;

use App\Models\Certificate;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Lab;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Statistic;
use Closure;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class PublishableScopeTest extends TestCase
{
    use RefreshDatabase;

    public static function publishableModels(): array
    {
        return [
            'skill' => [Skill::class, fn (int $n) => ['name' => "Skill {$n}", 'category' => 'Hardware']],
            'project' => [Project::class, fn (int $n) => ['title' => "Project {$n}", 'slug' => "project-{$n}", 'category' => 'Embedded', 'summary' => 'Test']],
            'experience' => [Experience::class, fn (int $n) => ['organization' => "Org {$n}", 'position' => 'Role', 'start_date' => '2024-01-01']],
            'education' => [Education::class, fn (int $n) => ['institution' => "School {$n}", 'study_program' => 'Program']],
            'certificate' => [Certificate::class, fn (int $n) => ['title' => "Certificate {$n}", 'issuer' => 'Issuer']],
            'statistic' => [Statistic::class, fn (int $n) => ['label' => "Stat {$n}", 'value' => $n]],
            'lab' => [Lab::class, fn (int $n) => ['title' => "Lab {$n}", 'slug' => "lab-{$n}", 'category' => 'Sensor', 'summary' => 'Test']],
        ];
    }

    #[DataProvider('publishableModels')]
    public function test_published_scope_hides_drafts_and_orders_by_sort_order(string $model, Closure $attributes): void
    {
        $model::create($attributes(1) + ['is_published' => false, 'sort_order' => 1]);
        $model::create($attributes(2) + ['is_published' => true, 'sort_order' => 3]);
        $model::create($attributes(3) + ['is_published' => true, 'sort_order' => 2]);

        $rows = $model::published()->ordered()->get();

        $this->assertCount(2, $rows);
        $this->assertSame([2, 3], $rows->pluck('sort_order')->all());
    }

    #[DataProvider('publishableModels')]
    public function test_new_rows_are_unpublished_by_default(string $model, Closure $attributes): void
    {
        $row = $model::create($attributes(1));

        $this->assertFalse($row->fresh()->is_published);
    }
}
