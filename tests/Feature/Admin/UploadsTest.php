<?php

namespace Tests\Feature\Admin;

use App\Models\Project;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UploadsTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');
        $this->admin = User::factory()->create();
        $this->admin->forceFill(['is_admin' => true])->save();
    }

    private function projectPayload(array $overrides = []): array
    {
        return array_merge(['title' => 'My Project', 'is_published' => 1], $overrides);
    }

    public function test_replacing_a_cover_deletes_the_old_file(): void
    {
        $this->actingAs($this->admin)->post('/admin/projects', $this->projectPayload([
            'cover_image' => UploadedFile::fake()->image('a.jpg'),
        ]));
        $project = Project::first();
        $old = $project->cover_image;
        Storage::disk('public')->assertExists($old);

        $this->actingAs($this->admin)->put("/admin/projects/{$project->id}", $this->projectPayload([
            'cover_image' => UploadedFile::fake()->image('b.jpg'),
        ]));

        Storage::disk('public')->assertMissing($old);
        Storage::disk('public')->assertExists($project->fresh()->cover_image);
    }

    public function test_deleting_a_project_deletes_cover_and_gallery_files(): void
    {
        $this->actingAs($this->admin)->post('/admin/projects', $this->projectPayload([
            'cover_image' => UploadedFile::fake()->image('a.jpg'),
        ]));
        $project = Project::first();
        $this->actingAs($this->admin)->post("/admin/projects/{$project->id}/images", [
            'images' => [UploadedFile::fake()->image('g1.jpg'), UploadedFile::fake()->image('g2.png')],
        ])->assertSessionHasNoErrors();

        $files = $project->images()->pluck('image_path')->push($project->cover_image);
        $this->assertCount(3, $files);

        $this->actingAs($this->admin)->delete("/admin/projects/{$project->id}");

        foreach ($files as $file) {
            Storage::disk('public')->assertMissing($file);
        }
    }

    public function test_gallery_rejects_non_images_and_non_arrays(): void
    {
        $project = Project::create(['title' => 'P', 'slug' => 'p']);

        $this->actingAs($this->admin)->post("/admin/projects/{$project->id}/images", [
            'images' => [UploadedFile::fake()->create('x.svg', 10, 'image/svg+xml')],
        ])->assertSessionHasErrors('images.0');

        $this->actingAs($this->admin)->post("/admin/projects/{$project->id}/images", [
            'images' => 'not-an-array',
        ])->assertSessionHasErrors('images');
    }

    public function test_slug_stays_the_same_when_title_changes(): void
    {
        $this->actingAs($this->admin)->post('/admin/projects', $this->projectPayload());
        $project = Project::first();
        $this->assertSame('my-project', $project->slug);

        $this->actingAs($this->admin)->put("/admin/projects/{$project->id}", $this->projectPayload(['title' => 'Renamed']));

        $this->assertSame('my-project', $project->fresh()->slug);
    }

    public function test_title_without_sluggable_characters_still_gets_a_slug(): void
    {
        $this->actingAs($this->admin)->post('/admin/projects', $this->projectPayload(['title' => '🚀🚀']));

        $this->assertNotEmpty(Project::first()->slug);
    }

    public function test_javascript_urls_are_rejected(): void
    {
        $this->actingAs($this->admin)->post('/admin/projects', $this->projectPayload([
            'demo_url' => 'javascript://example.com/%0Aalert(1)',
        ]))->assertSessionHasErrors('demo_url');
    }

    public function test_replacing_cv_deletes_the_old_file(): void
    {
        $payload = ['full_name' => 'Abed'];

        $this->actingAs($this->admin)->put('/admin/settings', $payload + [
            'cv_file' => UploadedFile::fake()->create('cv1.pdf', 10, 'application/pdf'),
        ])->assertSessionHasNoErrors();
        $old = SiteSetting::first()->cv_file;

        $this->actingAs($this->admin)->put('/admin/settings', $payload + [
            'cv_file' => UploadedFile::fake()->create('cv2.pdf', 10, 'application/pdf'),
        ])->assertSessionHasNoErrors();

        Storage::disk('public')->assertMissing($old);
        Storage::disk('public')->assertExists(SiteSetting::first()->cv_file);
    }
}
