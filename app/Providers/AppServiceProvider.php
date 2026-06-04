<?php

namespace App\Providers;

use App\Events\ContactFormSubmitted;
use App\Listeners\SendContactNotification;
use App\Models\Article;
use App\Models\Company;
use App\Models\ContactSubmission;
use App\Models\Service;
use App\Models\TeamMember;
use App\Policies\ArticlePolicy;
use App\Policies\CompanyPolicy;
use App\Policies\ContactSubmissionPolicy;
use App\Policies\ServicePolicy;
use App\Policies\TeamMemberPolicy;
use App\Repositories\ArticleRepository;
use App\Repositories\Contracts\ArticleRepositoryInterface;
use App\View\Composers\SiteComposer;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ArticleRepositoryInterface::class, ArticleRepository::class);
    }

    public function boot(): void
    {
        Event::listen(ContactFormSubmitted::class, SendContactNotification::class);

        Gate::policy(Article::class, ArticlePolicy::class);
        Gate::policy(TeamMember::class, TeamMemberPolicy::class);
        Gate::policy(Company::class, CompanyPolicy::class);
        Gate::policy(Service::class, ServicePolicy::class);
        Gate::policy(ContactSubmission::class, ContactSubmissionPolicy::class);

        View::composer(['layouts.public', 'components.header', 'components.footer'], SiteComposer::class);

        View::composer('layouts.admin', function ($view) {
            if (request()->routeIs('admin.contacts.show')) {
                $contact = request()->route('contact');
                if ($contact instanceof ContactSubmission) {
                    $view->with('adminNavOverride', match ($contact->form_type) {
                        'tax_return' => 'admin.tax-returns.*',
                        'business' => 'admin.business-forms.*',
                        default => 'admin.contacts.*',
                    });
                }
            }
        });

        RateLimiter::for('contact', function (Request $request) {
            return Limit::perMinute(5)->by($request->ip());
        });

        RateLimiter::for('admin-login', function (Request $request) {
            return Limit::perMinute(10)->by($request->ip());
        });
    }
}
