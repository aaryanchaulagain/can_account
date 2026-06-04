<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Services\SeoService;
use Illuminate\View\View;

class CompanyController extends Controller
{
    public function __construct(protected SeoService $seo) {}

    public function index(): View
    {
        return view('public.companies.index', [
            'seo' => $this->seo->meta('Our Companies', 'Explore the Canberra Accountants group of companies and affiliated professional services.'),
            'companies' => Company::published()->orderBy('sort_order')->get(),
        ]);
    }

    public function show(Company $company): View
    {
        abort_unless($company->is_published, 404);

        return view('public.companies.show', [
            'seo' => $this->seo->meta($company->name, strip_tags(substr($company->description ?? '', 0, 160))),
            'company' => $company,
        ]);
    }
}
