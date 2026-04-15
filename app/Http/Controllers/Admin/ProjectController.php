<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status');

        $projects = Project::query()
            ->when($status === 'published', function ($query) {
                $query->where('is_published', true);
            })
            ->when($status === 'draft', function ($query) {
                $query->where('is_published', false);
            })
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('admin.projects.index', compact('projects', 'status'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'short_description' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'tech_stack' => ['nullable', 'string', 'max:255'],
            'github_url' => ['nullable', 'url', 'max:255'],
            'demo_url' => ['nullable', 'url', 'max:255'],
            'cover_image' => ['nullable', 'image', 'max:4096'],
            'is_published' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_featured' => ['nullable', 'boolean'],
        ]);

        $data['is_featured'] = (bool) ($data['is_featured'] ?? false);
        $data['slug'] = Str::slug($data['title']);

        // ensure unique slug
        $baseSlug = $data['slug'];
        $i = 1;
        while (Project::where('slug', $data['slug'])->exists()) {
            $data['slug'] = $baseSlug . '-' . $i;
            $i++;
        }

        $data['is_published'] = (bool) ($data['is_published'] ?? false);
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('projects', 'public');
        }

        Project::create($data);

        return redirect()->route('projects.index')->with('success', 'Project created.');
    }

    public function edit(Project $project)
    {
        $project->load('images');
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'short_description' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'tech_stack' => ['nullable', 'string', 'max:255'],
            'github_url' => ['nullable', 'url', 'max:255'],
            'demo_url' => ['nullable', 'url', 'max:255'],
            'cover_image' => ['nullable', 'image', 'max:4096'],
            'is_published' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_featured' => ['nullable', 'boolean'],
        ]);

        // If title changed, update slug
        if ($data['title'] !== $project->title) {
            $slug = Str::slug($data['title']);
            $baseSlug = $slug;
            $i = 1;
            while (Project::where('slug', $slug)->where('id', '!=', $project->id)->exists()) {
                $slug = $baseSlug . '-' . $i;
                $i++;
            }
            $data['slug'] = $slug;
        }

        $data['is_published'] = (bool) ($data['is_published'] ?? false);
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);
        $data['is_featured'] = (bool) ($data['is_featured'] ?? false);


        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('projects', 'public');
        }
        $project->update($data);

        return redirect()->route('projects.index')->with('success', 'Project updated.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted.');
    }
}
