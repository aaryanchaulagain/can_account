<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SiteSettingsService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiteSettingController extends Controller
{
    public function __construct(protected SiteSettingsService $settings) {}

    public function index(): View
    {
        return view('admin.settings.index', [
            'settings' => $this->settings->getAllGrouped(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $this->settings->updateMany($request->input('settings', []));

        return back()->with('success', 'Settings saved successfully.');
    }
}
