<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Experience;
use App\Models\Post;
use App\Models\Project;
use App\Models\SiteSetting;
use App\Models\Skill;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        $featuredProjects = Project::where('is_published', true)
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->take(3)
            ->get();

        if ($featuredProjects->isEmpty()) {
            $featuredProjects = Project::where('is_published', true)
                ->orderBy('sort_order')
                ->orderByDesc('created_at')
                ->take(3)
                ->get();
        }

        $experienceCount = Experience::where('is_visible', true)->count();

        return view('home', compact('featuredProjects', 'experienceCount'));
    }

    public function projects(): View
    {
        $projects = Project::where('is_published', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('projects.index', compact('projects'));
    }

    public function project(string $slug): View
    {
        $project = Project::where('slug', $slug)
            ->where('is_published', true)
            ->with('images')
            ->firstOrFail();

        return view('projects.show', compact('project'));
    }

    public function about(): View
    {
        $skills = Skill::where('is_visible', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get()
            ->groupBy(fn ($skill) => $skill->category ?: 'Other');

        $experiences = Experience::where('is_visible', true)
            ->orderBy('sort_order')
            ->orderByDesc('start_date')
            ->get();

        $certificates = Certificate::where('is_visible', true)
            ->orderBy('sort_order')
            ->orderByDesc('issue_date')
            ->get();

        return view('about', compact('skills', 'experiences', 'certificates'));
    }

    public function certificate(string $slug): View
    {
        $certificate = Certificate::where('slug', $slug)
            ->where('is_visible', true)
            ->firstOrFail();

        return view('certificates.show', compact('certificate'));
    }

    public function contact(): View
    {
        return view('contact');
    }

    public function blog(): View
    {
        abort_unless(SiteSetting::current()->blog_enabled, 404);

        $posts = Post::where('is_published', true)
            ->orderBy('sort_order')
            ->orderByDesc('published_at')
            ->get();

        return view('blog.index', compact('posts'));
    }

    public function post(string $slug): View
    {
        abort_unless(SiteSetting::current()->blog_enabled, 404);

        $post = Post::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('blog.show', compact('post'));
    }

    public function sitemap(): Response
    {
        $blogEnabled = (bool) SiteSetting::current()->blog_enabled;

        $projects = Project::where('is_published', true)->get(['slug', 'updated_at']);
        $posts = $blogEnabled
            ? Post::where('is_published', true)->get(['slug', 'updated_at'])
            : collect();
        $certificates = Certificate::where('is_visible', true)
            ->whereNotNull('slug')
            ->get(['slug', 'updated_at']);

        $baseUrl = rtrim(config('app.url') ?: url('/'), '/');

        return response()
            ->view('seo.sitemap', compact('projects', 'posts', 'certificates', 'baseUrl', 'blogEnabled'))
            ->header('Content-Type', 'application/xml');
    }

    public function robots(): Response
    {
        $baseUrl = rtrim(config('app.url') ?: url('/'), '/');
        $content = "User-agent: *\nDisallow: /admin\nAllow: /\nSitemap: {$baseUrl}/sitemap.xml\n";

        return response($content, 200)->header('Content-Type', 'text/plain');
    }
}
