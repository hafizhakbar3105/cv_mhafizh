<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class DevelopmentSeeder extends Seeder
{
    public function run(): void
    {
        if (app()->isProduction()) {
            return;
        }

        // Idempoten: tidak menimpa data yang sudah diisi pemilik.
        if (Profile::query()->doesntExist()) {
            Profile::create([
                'name' => '[DEV] Nama Pemilik',
                'profession' => '[DEV] Profesi',
            ]);
        }

        foreach ([
            'site.title' => '[DEV] Portfolio',
            'site.description' => '',
        ] as $key => $value) {
            Setting::firstOrCreate(['key' => $key], ['value' => $value, 'group' => 'general']);
        }
    }
}
