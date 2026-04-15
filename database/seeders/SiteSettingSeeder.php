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
                'github_url' => 'https://github.com/',
                'linkedin_url' => 'https://www.linkedin.com/',
                'email' => 'you@example.com',
            ]
        );
    }
}
