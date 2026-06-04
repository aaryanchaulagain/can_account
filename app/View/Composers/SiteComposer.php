<?php

namespace App\View\Composers;

use App\Models\Service;
use App\Models\SiteSetting;
use Illuminate\View\View;

class SiteComposer
{
    public function compose(View $view): void
    {
        $view->with([
            'siteSettings' => SiteSetting::allCached(),
            'navServices' => Service::published()->inNav()->orderBy('sort_order')->get(),
        ]);
    }
}
