<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteSettingController extends Controller
{
    /** Upload field => folder on the public disk. */
    private const FILE_FIELDS = [
        'profile_image' => 'profile',
        'cv_file' => 'cv',
        'og_image' => 'seo',
    ];

    public function edit()
    {
        $settings = SiteSetting::current();

        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        // Fresh copy from the database, not the cached instance.
        $settings = SiteSetting::findOrFail(SiteSetting::current()->id);

        $data = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'headline' => ['nullable', 'string', 'max:255'],
            'availability_status' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'github_url' => ['nullable', 'url:http,https', 'max:255'],
            'linkedin_url' => ['nullable', 'url:http,https', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],

            'profile_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'cv_file' => ['nullable', 'file', 'mimes:pdf', 'max:5120'],
            'og_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],

            'site_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:255'],
            'blog_enabled' => ['nullable', 'boolean'],
        ]);

        $data['blog_enabled'] = $request->boolean('blog_enabled');

        $replacedFiles = [];

        foreach (self::FILE_FIELDS as $field => $folder) {
            if ($request->hasFile($field)) {
                $replacedFiles[] = $settings->{$field};
                $data[$field] = $request->file($field)->store($folder, 'public');
            }
        }

        $settings->update($data);

        // Remove replaced files so an old CV or photo is no longer public.
        Storage::disk('public')->delete(array_filter($replacedFiles));

        return redirect()->route('admin.settings.edit')->with('success', 'Settings updated.');
    }
}
