<?php

namespace App\Services;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;

class SiteSettingsService
{
    public function getAllGrouped(): array
    {
        return SiteSetting::orderBy('group')->orderBy('key')
            ->get()
            ->groupBy('group')
            ->toArray();
    }

    public function updateMany(array $settings): void
    {
        foreach ($settings as $key => $value) {
            SiteSetting::set($key, $value);
        }
        Cache::forget('site_settings.all');
    }
}
