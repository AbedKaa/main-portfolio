<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\Request;

class ProjectImageController extends Controller
{
    public function store(Request $request, Project $project)
    {
        $data = $request->validate([
            'images' => ['required'],
            'images.*' => ['image', 'max:4096'],
        ]);

        foreach ($request->file('images') as $file) {
            $path = $file->store('project-gallery', 'public');

            ProjectImage::create([
                'project_id' => $project->id,
                'image_path' => $path,
                'sort_order' => 0,
            ]);
        }

        return back()->with('success', 'Gallery images uploaded.');
    }

    public function destroy(ProjectImage $projectImage)
    {
        $projectImage->delete();
        return back()->with('success', 'Gallery image removed.');
    }
}
