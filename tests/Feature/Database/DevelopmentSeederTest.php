<?php

namespace Tests\Feature\Database;

use App\Models\Profile;
use App\Models\Setting;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DevelopmentSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_seeder_is_idempotent_and_creates_no_admin_account(): void
    {
        $this->seed(DatabaseSeeder::class);
        $this->seed(DatabaseSeeder::class);

        $this->assertSame(1, Profile::count());
        $this->assertSame(2, Setting::count());
        $this->assertSame(0, User::count());
    }

    public function test_seeder_does_not_overwrite_existing_profile(): void
    {
        Profile::create(['name' => 'Nama Asli', 'profession' => 'Profesi Asli']);

        $this->seed(DatabaseSeeder::class);

        $this->assertSame('Nama Asli', Profile::first()->name);
    }
}
