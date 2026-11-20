<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectImageController extends Controller
{
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'images' => ['required', 'array', 'max:10'],
            'images.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        foreach ($request->file('images') as $file) {
            $project->images()->create([
                'image_path' => $file->store('project-gallery', 'public'),
                'sort_order' => 0,
            ]);
        }

        return back()->with('success', 'Gallery images uploaded.');
    }

    public function destroy(ProjectImage $projectImage)
    {
        $path = $projectImage->image_path;

        $projectImage->delete();

        if ($path) {
            Storage::disk('public')->delete($path);
        }

        return back()->with('success', 'Gallery image removed.');
    }
}
