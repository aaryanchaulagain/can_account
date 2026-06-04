<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use App\Models\TimelineEvent;
use App\Services\SeoService;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function __construct(protected SeoService $seo) {}

    public function index(): View
    {
        return view('public.about', [
            'seo' => $this->seo->meta('About Us', 'Learn about Canberra Accountants — our mission, vision, values, and the leadership team behind our trusted advisory services.'),
            'leadership' => TeamMember::published()->where('is_leadership', true)->orderBy('sort_order')->get(),
            'timeline' => TimelineEvent::published()->orderBy('sort_order')->get(),
        ]);
    }
}
