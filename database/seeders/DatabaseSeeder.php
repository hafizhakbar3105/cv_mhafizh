<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed development hanya data pengganti yang jelas dan dapat diganti lewat CMS.
     * Tidak ada akun admin dan tidak ada kredensial di sini.
     */
    public function run(): void
    {
        $this->call(DevelopmentSeeder::class);
    }
}
