<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * Safe to run in production: it only creates the site settings row.
     * Create your admin account with `php artisan app:create-admin`.
     * For local demo data, run `php artisan db:seed --class=ProjectSeeder`.
     */
    public function run(): void
    {
        $this->call(SiteSettingSeeder::class);
    }
}
