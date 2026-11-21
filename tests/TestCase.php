<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use RuntimeException;

abstract class TestCase extends BaseTestCase
{
    /**
     * Pengaman: tes yang menghapus atau membangun ulang tabel hanya boleh berjalan
     * pada database yang namanya berakhiran "_test" (atau SQLite :memory:).
     * Ini mencegah RefreshDatabase menghapus database development.
     */
    protected function setUpTraits()
    {
        $this->assertDestructiveTestsUseIsolatedDatabase();

        return parent::setUpTraits();
    }

    private function assertDestructiveTestsUseIsolatedDatabase(): void
    {
        $destructive = [RefreshDatabase::class, DatabaseMigrations::class, DatabaseTruncation::class];

        if (array_intersect($destructive, array_keys(class_uses_recursive($this))) === []) {
            return;
        }

        $connection = config('database.default');
        $database = (string) config("database.connections.{$connection}.database");

        if ($database !== ':memory:' && ! str_ends_with($database, '_test')) {
            throw new RuntimeException(
                "Tes ini bersifat destruktif tetapi memakai database \"{$database}\". "
                . 'Gunakan database test terpisah (nama berakhiran _test), misalnya lewat .env.testing.'
            );
        }
    }
}
