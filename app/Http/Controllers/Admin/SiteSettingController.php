<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function edit()
    {
        $settings = SiteSetting::findOrFail(1);
        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = SiteSetting::findOrFail(1);

        $data = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'headline' => ['nullable', 'string', 'max:255'],
            'availability_status' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'github_url' => ['nullable', 'url', 'max:255'],
            'linkedin_url' => ['nullable', 'url', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'profile_image' => ['nullable', 'image', 'max:2048'],
            'cv_file' => ['nullable', 'mimes:pdf', 'max:5120'],
            'site_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:255'],
            'og_image' => ['nullable', 'image', 'max:4096'],
            'blog_enabled' => ['nullable', 'boolean'],
        ]);

        $data['blog_enabled'] = $request->boolean('blog_enabled');

        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('profile', 'public');
            $data['profile_image'] = $path;
        }

        if ($request->hasFile('cv_file')) {
            $path = $request->file('cv_file')->store('cv', 'public');
            $data['cv_file'] = $path;
        }

        if ($request->hasFile('og_image')) {
            $data['og_image'] = $request->file('og_image')->store('seo', 'public');
        }

        $settings->update($data);

        return redirect()->route('admin.settings.edit')->with('success', 'Settings updated.');
    }
}