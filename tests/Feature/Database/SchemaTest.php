<?php

namespace Tests\Feature\Database;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class SchemaTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_portfolio_tables_exist(): void
    {
        foreach ([
            'profiles', 'skills', 'projects', 'project_images', 'experiences', 'educations',
            'certificates', 'statistics', 'labs', 'messages', 'settings',
        ] as $table) {
            $this->assertTrue(Schema::hasTable($table), "Tabel {$table} tidak ada");
        }
    }

    public function test_users_table_has_admin_flag(): void
    {
        $this->assertTrue(Schema::hasColumn('users', 'is_admin'));
    }

    public function test_projects_table_has_required_columns(): void
    {
        $this->assertTrue(Schema::hasColumns('projects', [
            'title', 'slug', 'category', 'summary', 'content', 'thumbnail_path', 'tech_stack',
            'status', 'github_url', 'demo_url', 'is_featured', 'is_published', 'sort_order',
        ]));
    }
}
