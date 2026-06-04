<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Company;
use App\Models\ContactSubmission;
use App\Models\Service;
use App\Models\TeamMember;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'stats' => [
                'articles' => Article::count(),
                'team_members' => TeamMember::count(),
                'companies' => Company::count(),
                'services' => Service::count(),
                'contacts' => ContactSubmission::formType('contact')->where('status', 'new')->count(),
                'tax_returns' => ContactSubmission::formType('tax_return')->where('status', 'new')->count(),
                'business_forms' => ContactSubmission::formType('business')->where('status', 'new')->count(),
            ],
            'recentContacts' => ContactSubmission::latest()->limit(5)->get(),
        ]);
    }
}
