<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Support\Slug;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::orderBy('sort_order')->orderByDesc('issue_date')->get();

        return view('admin.certificates.index', compact('certificates'));
    }

    public function create()
    {
        return view('admin.certificates.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'issuer' => ['nullable', 'string', 'max:255'],
            'issue_date' => ['nullable', 'date'],
            'credential_url' => ['nullable', 'url:http,https', 'max:255'],
            'certificate_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_visible' => ['nullable', 'boolean'],
        ]);

        $data['slug'] = Slug::unique(Certificate::class, $data['title']);
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);
        $data['is_visible'] = (bool) ($data['is_visible'] ?? false);

        if ($request->hasFile('certificate_image')) {
            $data['certificate_image'] = $request->file('certificate_image')->store('certificates', 'public');
        }

        Certificate::create($data);

        return redirect()->route('certificates.index')->with('success', 'Certificate created.');
    }

    public function edit(Certificate $certificate)
    {
        return view('admin.certificates.edit', compact('certificate'));
    }

    public function update(Request $request, Certificate $certificate)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'issuer' => ['nullable', 'string', 'max:255'],
            'issue_date' => ['nullable', 'date'],
            'credential_url' => ['nullable', 'url:http,https', 'max:255'],
            'certificate_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_visible' => ['nullable', 'boolean'],
        ]);

        // Slugs are kept stable after creation; only older rows without one get it here.
        if (! $certificate->slug) {
            $data['slug'] = Slug::unique(Certificate::class, $data['title'], $certificate->id);
        }

        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);
        $data['is_visible'] = (bool) ($data['is_visible'] ?? false);

        if ($request->hasFile('certificate_image')) {
            $oldImage = $certificate->certificate_image;
            $data['certificate_image'] = $request->file('certificate_image')->store('certificates', 'public');

            if ($oldImage) {
                Storage::disk('public')->delete($oldImage);
            }
        }

        $certificate->update($data);

        return redirect()->route('certificates.index')->with('success', 'Certificate updated.');
    }

    public function destroy(Certificate $certificate)
    {
        if ($certificate->certificate_image) {
            Storage::disk('public')->delete($certificate->certificate_image);
        }

        $certificate->delete();

        return redirect()->route('certificates.index')->with('success', 'Certificate deleted.');
    }
}
