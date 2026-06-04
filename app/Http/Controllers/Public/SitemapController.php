<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Company;
use App\Models\Service;
use App\Models\TeamMember;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $urls = collect([
            ['loc' => route('home'), 'priority' => '1.0'],
            ['loc' => route('about'), 'priority' => '0.8'],
            ['loc' => route('services.index'), 'priority' => '0.9'],
            ['loc' => route('team.index'), 'priority' => '0.7'],
            ['loc' => route('articles.index'), 'priority' => '0.8'],
            ['loc' => route('companies.index'), 'priority' => '0.7'],
            ['loc' => route('contact'), 'priority' => '0.8'],
        ]);

        Service::published()->each(fn ($s) => $urls->push(['loc' => route('services.show', $s), 'priority' => '0.8']));
        TeamMember::published()->each(fn ($m) => $urls->push(['loc' => route('team.show', $m), 'priority' => '0.6']));
        Article::published()->each(fn ($a) => $urls->push(['loc' => route('articles.show', $a->slug), 'priority' => '0.7']));
        Company::published()->each(fn ($c) => $urls->push(['loc' => route('companies.show', $c), 'priority' => '0.6']));

        $content = view('public.sitemap', ['urls' => $urls])->render();

        return response($content, 200)->header('Content-Type', 'application/xml');
    }
}
