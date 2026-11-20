<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Support\Slug;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('sort_order')->orderByDesc('created_at')->get();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'is_published' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        // Set once on create so later title edits don't break shared links.
        $data['slug'] = Slug::unique(Post::class, $data['title']);

        $data['is_published'] = (bool) ($data['is_published'] ?? false);
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);
        $data['published_at'] = $data['is_published'] ? now() : null;

        Post::create($data);

        return redirect()->route('posts.index')->with('success', 'Post created.');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'is_published' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        if (! $post->slug) {
            $data['slug'] = Slug::unique(Post::class, $data['title'], $post->id);
        }

        $wasPublished = (bool) $post->is_published;
        $data['is_published'] = (bool) ($data['is_published'] ?? false);
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        if (!$wasPublished && $data['is_published']) {
            $data['published_at'] = now();
        }
        if ($wasPublished && !$data['is_published']) {
            $data['published_at'] = null;
        }

        $post->update($data);

        return redirect()->route('posts.index')->with('success', 'Post updated.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted.');
    }
}
