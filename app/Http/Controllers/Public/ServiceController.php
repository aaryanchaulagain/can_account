<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Services\SeoService;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function __construct(protected SeoService $seo) {}

    public function index(): View
    {
        return view('public.services.index', [
            'seo' => $this->seo->meta('Our Services', 'Comprehensive accounting, taxation, SMSF, and business advisory services tailored for Australian businesses and individuals.'),
            'services' => Service::published()->orderBy('sort_order')->get(),
        ]);
    }

    public function show(Service $service): View
    {
        abort_unless($service->is_published, 404);

        return view('public.services.show', [
            'seo' => $this->seo->meta(
                $service->meta_title ?? $service->title,
                $service->meta_description ?? $service->short_description
            ),
            'service' => $service,
        ]);
    }
}
