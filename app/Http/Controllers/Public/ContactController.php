<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactFormRequest;
use App\Models\OfficeLocation;
use App\Models\Service;
use App\Services\ContactService;
use App\Services\SeoService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function __construct(
        protected SeoService $seo,
        protected ContactService $contactService
    ) {}

    public function index(): View
    {
        return view('public.contact', [
            'seo' => $this->seo->meta('Contact Us', 'Get in touch with Canberra Accountants. Offices in ACT, NSW, Tasmania and South Australia.'),
            'locations' => OfficeLocation::published()->orderBy('sort_order')->get(),
            'services' => Service::published()->orderBy('title')->pluck('title', 'title'),
        ]);
    }

    public function store(ContactFormRequest $request): RedirectResponse
    {
        $this->contactService->submit($request->validated(), $request);

        return back()->with('success', 'Thank you! Your consultation request has been submitted successfully.');
    }
}
