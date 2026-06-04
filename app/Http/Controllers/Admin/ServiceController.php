<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        $services = Service::orderBy('sort_order')->paginate(15);

        return view('admin.services.index', compact('services'));
    }

    public function create(): View
    {
        return view('admin.services.form', ['service' => new Service]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['slug'] = Str::slug($data['slug'] ?? $data['title']);
        if ($request->hasFile('hero_image')) {
            $data['hero_image'] = $request->file('hero_image')->store('services', 'public');
        }
        Service::create($data);

        return redirect()->route('admin.services.index')->with('success', 'Service created.');
    }

    public function edit(Service $service): View
    {
        return view('admin.services.form', compact('service'));
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        $data = $this->validated($request);
        if ($request->hasFile('hero_image')) {
            if ($service->hero_image) {
                Storage::disk('public')->delete($service->hero_image);
            }
            $data['hero_image'] = $request->file('hero_image')->store('services', 'public');
        }
        $service->update($data);

        return redirect()->route('admin.services.index')->with('success', 'Service updated.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        $this->authorize('delete', $service);
        if ($service->hero_image) {
            Storage::disk('public')->delete($service->hero_image);
        }
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service deleted.');
    }

    protected function validated(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string'],
            'short_description' => ['nullable', 'string'],
            'icon' => ['nullable', 'string'],
            'overview' => ['nullable', 'string'],
            'benefits' => ['nullable', 'string'],
            'process_steps' => ['nullable', 'string'],
            'faqs' => ['nullable', 'string'],
            'meta_title' => ['nullable', 'string'],
            'meta_description' => ['nullable', 'string'],
            'sort_order' => ['integer'],
            'is_published' => ['boolean'],
            'show_in_nav' => ['boolean'],
            'hero_image' => ['nullable', 'image', 'max:4096'],
        ]);

        foreach (['benefits', 'process_steps', 'faqs'] as $field) {
            if (! empty($data[$field])) {
                $decoded = json_decode($data[$field], true);
                $data[$field] = json_last_error() === JSON_ERROR_NONE ? $decoded : [];
            } else {
                $data[$field] = [];
            }
        }

        return $data;
    }
}
