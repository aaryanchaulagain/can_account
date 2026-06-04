<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Repositories\Contracts\ArticleRepositoryInterface;
use App\Services\SeoService;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(
        protected ArticleRepositoryInterface $articles,
        protected SeoService $seo
    ) {}

    public function index(): View
    {
        return view('public.home', [
            'seo' => $this->seo->meta(
                'Accounting & Taxation Experts',
                'Canberra Accountants delivers premium accounting, taxation, SMSF, and business advisory services across Canberra, Sydney, Hobart, Adelaide and Australia-wide.'
            ),
            'services' => Service::published()->orderBy('sort_order')->get(),
            'companies' => Company::published()->orderBy('sort_order')->limit(6)->get(),
            'articles' => $this->articles->getLatest(3),
            'team' => TeamMember::published()->featured()->orderBy('sort_order')->limit(4)->get(),
            'testimonials' => Testimonial::published()->orderBy('sort_order')->limit(6)->get(),
            'schema' => $this->seo->organizationSchema(),
        ]);
    }
}
