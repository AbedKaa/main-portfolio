<?php

use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ProjectImageController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\ProfileController;
use App\Models\Certificate;
use App\Models\ContactMessage;
use App\Models\Experience;
use App\Models\Post;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $featuredProjects = Project::where('is_published', true)
        ->where('is_featured', true)
        ->orderBy('sort_order')
        ->orderByDesc('created_at')
        ->take(3)
        ->get();

    if ($featuredProjects->count() === 0) {
        $featuredProjects = Project::where('is_published', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->take(3)
            ->get();
    }

    $experienceCount = Experience::where('is_visible', true)->count();

    return view('home', compact('featuredProjects', 'experienceCount'));
})->name('home');

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/projects', function () {
    $projects = Project::where('is_published', true)
        ->orderBy('sort_order')
        ->orderByDesc('created_at')
        ->paginate(10);

    return view('projects.index', compact('projects'));
})->name('projects.public.index');

Route::get('/projects/{slug}', function ($slug) {
    $project = Project::where('slug', $slug)
        ->where('is_published', true)
        ->with('images')
        ->firstOrFail();

    return view('projects.show', compact('project'));
})->name('projects.public.show');

Route::get('/about', function () {
    $skills = Skill::where('is_visible', true)
        ->orderBy('sort_order')
        ->orderBy('name')
        ->get()
        ->groupBy(fn($skill) => $skill->category ?: 'Other');

    $experiences = Experience::where('is_visible', true)
        ->orderBy('sort_order')
        ->orderByDesc('start_date')
        ->get();

    $certificates = Certificate::where('is_visible', true)
        ->orderBy('sort_order')
        ->orderByDesc('issue_date')
        ->get();

    return view('about', compact('skills', 'experiences', 'certificates'));
})->name('about');

Route::get('/certificates/{slug}', function ($slug) {
    $certificate = Certificate::where('slug', $slug)
        ->where('is_visible', true)
        ->firstOrFail();

    return view('certificates.show', compact('certificate'));
})->name('certificates.public.show');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact', [ContactMessageController::class, 'store'])->name('contact.store');

Route::get('/blog', function () {
    $settings = \App\Models\SiteSetting::findOrFail(1);

    abort_unless($settings->blog_enabled, 404);

    $posts = Post::where('is_published', true)
        ->orderBy('sort_order')
        ->orderByDesc('published_at')
        ->get();

    return view('blog.index', compact('posts'));
})->name('blog.index');

Route::get('/blog/{slug}', function ($slug) {
    $settings = \App\Models\SiteSetting::findOrFail(1);

    abort_unless($settings->blog_enabled, 404);

    $post = Post::where('slug', $slug)
        ->where('is_published', true)
        ->firstOrFail();

    return view('blog.show', compact('post'));
})->name('blog.show');

Route::get('/sitemap.xml', function () {
    $projects = \App\Models\Project::where('is_published', true)->get(['slug', 'updated_at']);
    $posts = \App\Models\Post::where('is_published', true)->get(['slug', 'updated_at']);

    $baseUrl = config('app.url') ?: url('/');

    return response()
        ->view('seo.sitemap', compact('projects', 'posts', 'baseUrl'))
        ->header('Content-Type', 'application/xml');
})->name('sitemap');

Route::get('/robots.txt', function () {
    $baseUrl = config('app.url') ?: url('/');
    $content = "User-agent: *\nAllow: /\nSitemap: {$baseUrl}/sitemap.xml\n";

    return response($content, 200)->header('Content-Type', 'text/plain');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard', [
            'stats' => [
                'projects' => Project::count(),
                'posts' => Post::count(),
                'skills' => Skill::count(),
                'experiences' => Experience::count(),
                'certificates' => Certificate::count(),
                'messages' => ContactMessage::count(),
                'unreadMessages' => ContactMessage::where('is_read', false)->count(),
            ],
            'recentMessages' => ContactMessage::latest()->take(5)->get(),
        ]);
    })->name('admin.dashboard');

    Route::get('/settings', [SiteSettingController::class, 'edit'])->name('admin.settings.edit');
    Route::put('/settings', [SiteSettingController::class, 'update'])->name('admin.settings.update');

    Route::resource('projects', ProjectController::class);
    Route::resource('skills', SkillController::class);
    Route::resource('experiences', ExperienceController::class);
    Route::resource('certificates', CertificateController::class);
    Route::resource('posts', PostController::class);

    Route::post('projects/{project}/images', [ProjectImageController::class, 'store'])->name('projects.images.store');
    Route::delete('project-images/{projectImage}', [ProjectImageController::class, 'destroy'])->name('projects.images.destroy');

    Route::get('messages', [ContactMessageController::class, 'index'])->name('messages.index');
    Route::get('messages/{message}', [ContactMessageController::class, 'show'])->name('messages.show');
});

require __DIR__ . '/auth.php';
