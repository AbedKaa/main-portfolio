<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 15; $i++) {
            Project::create([
                'title' => 'Test Project ' . $i,
                'slug' => Str::slug('Test Project ' . $i),
                'short_description' => 'This is a short description for test project ' . $i . '.',
                'content' => 'This is the full content for test project ' . $i . '.',
                'tech_stack' => 'Laravel, MySQL, Tailwind',
                'github_url' => 'https://github.com/example/test-project-' . $i,
                'demo_url' => 'https://example.com/test-project-' . $i,
                'is_published' => $i % 2 === 0,
                'sort_order' => $i,
            ]);
        }
    }
}
