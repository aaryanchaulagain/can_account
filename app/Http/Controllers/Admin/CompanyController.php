<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CompanyController extends Controller
{
    public function index(): View
    {
        $companies = Company::orderBy('sort_order')->paginate(15);

        return view('admin.companies.index', compact('companies'));
    }

    public function create(): View
    {
        return view('admin.companies.form', ['company' => new Company]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['slug'] = Str::slug($data['slug'] ?? $data['name']);
        $this->handleUploads($request, $data);
        Company::create($data);

        return redirect()->route('admin.companies.index')->with('success', 'Company created.');
    }

    public function edit(Company $company): View
    {
        return view('admin.companies.form', compact('company'));
    }

    public function update(Request $request, Company $company): RedirectResponse
    {
        $data = $this->validated($request);
        $this->handleUploads($request, $data, $company);
        $company->update($data);

        return redirect()->route('admin.companies.index')->with('success', 'Company updated.');
    }

    public function destroy(Company $company): RedirectResponse
    {
        $this->authorize('delete', $company);
        if ($company->logo) {
            Storage::disk('public')->delete($company->logo);
        }
        if ($company->featured_image) {
            Storage::disk('public')->delete($company->featured_image);
        }
        $company->delete();

        return redirect()->route('admin.companies.index')->with('success', 'Company deleted.');
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'services' => ['nullable', 'string'],
            'website_url' => ['nullable', 'url'],
            'sort_order' => ['integer'],
            'is_published' => ['boolean'],
            'logo' => ['nullable', 'image', 'max:2048'],
            'featured_image' => ['nullable', 'image', 'max:4096'],
        ]);
    }

    protected function handleUploads(Request $request, array &$data, ?Company $company = null): void
    {
        if ($request->hasFile('logo')) {
            if ($company?->logo) {
                Storage::disk('public')->delete($company->logo);
            }
            $data['logo'] = $request->file('logo')->store('companies', 'public');
        }
        if ($request->hasFile('featured_image')) {
            if ($company?->featured_image) {
                Storage::disk('public')->delete($company->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('companies', 'public');
        }
    }
}
