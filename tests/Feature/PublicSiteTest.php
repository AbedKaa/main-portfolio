<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\SiteSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicSiteTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_pages_render_on_a_fresh_install(): void
    {
        foreach (['/', '/projects', '/about', '/contact', '/blog'] as $uri) {
            $this->get($uri)->assertOk();
        }

        $this->assertDatabaseHas('site_settings', ['id' => 1]);
    }

    public function test_settings_are_loaded_once_per_request(): void
    {
        $this->get('/');

        \DB::enableQueryLog();
        $this->get('/contact')->assertOk();
        $settingsQueries = collect(\DB::getQueryLog())
            ->filter(fn ($q) => str_contains($q['query'], 'site_settings'));

        $this->assertLessThanOrEqual(1, $settingsQueries->count());
    }

    public function test_robots_txt_uses_app_url(): void
    {
        config(['app.url' => 'https://example.test']);

        $this->get('/robots.txt')
            ->assertOk()
            ->assertSee('Sitemap: https://example.test/sitemap.xml', false)
            ->assertDontSee('127.0.0.1');
    }

    public function test_sitemap_hides_blog_when_disabled(): void
    {
        SiteSetting::current()->update(['blog_enabled' => false]);
        Post::create(['title' => 'Hidden', 'slug' => 'hidden', 'is_published' => true]);

        $this->get('/sitemap.xml')
            ->assertOk()
            ->assertDontSee('/blog')
            ->assertDontSee('/blog/hidden');

        $this->get('/blog')->assertNotFound();
    }
}
