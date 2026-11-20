<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Support\Slug;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');

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
        $data = $request->validate($this->rules());

        // The slug is set once, on create, so editing the title later does not
        // break links that have already been shared.
        $data['slug'] = Slug::unique(Project::class, $data['title']);
        $data['is_published'] = (bool) ($data['is_published'] ?? false);
        $data['is_featured'] = (bool) ($data['is_featured'] ?? false);
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
        $data = $request->validate($this->rules());

        if (! $project->slug) {
            $data['slug'] = Slug::unique(Project::class, $data['title'], $project->id);
        }

        $data['is_published'] = (bool) ($data['is_published'] ?? false);
        $data['is_featured'] = (bool) ($data['is_featured'] ?? false);
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        if ($request->hasFile('cover_image')) {
            $oldCover = $project->cover_image;
            $data['cover_image'] = $request->file('cover_image')->store('projects', 'public');

            if ($oldCover) {
                Storage::disk('public')->delete($oldCover);
            }
        }

        $project->update($data);

        return redirect()->route('projects.index')->with('success', 'Project updated.');
    }

    public function destroy(Project $project)
    {
        $files = $project->images()->pluck('image_path')
            ->push($project->cover_image)
            ->filter()
            ->all();

        $project->delete();

        Storage::disk('public')->delete($files);

        return redirect()->route('projects.index')->with('success', 'Project deleted.');
    }

    private function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'short_description' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'tech_stack' => ['nullable', 'string', 'max:255'],
            'github_url' => ['nullable', 'url:http,https', 'max:255'],
            'demo_url' => ['nullable', 'url:http,https', 'max:255'],
            'cover_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'is_published' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_featured' => ['nullable', 'boolean'],
        ];
    }
}
