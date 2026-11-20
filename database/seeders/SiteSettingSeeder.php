<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::firstOrCreate(
            ['id' => 1],
            [
                'full_name' => 'Abed Karakira',
                'headline' => 'Junior Software Engineer',
                'bio' => 'I build clean Laravel apps and real-world projects.',
                'github_url' => null,
                'linkedin_url' => null,
                'email' => null, // set in Admin > Settings
            ]
        );
    }
}
