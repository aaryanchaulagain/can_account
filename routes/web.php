<?php

use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\PasswordResetController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CompanyController as AdminCompanyController;
use App\Http\Controllers\Admin\ContactSubmissionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Public\AboutController;
use App\Http\Controllers\Public\ArticleController;
use App\Http\Controllers\Public\CompanyController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\ServiceController;
use App\Http\Controllers\Public\SitemapController;
use App\Http\Controllers\Public\TeamController;
use App\Services\SeoService;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/team', [TeamController::class, 'index'])->name('team.index');
Route::get('/team/{teamMember:slug}', [TeamController::class, 'show'])->name('team.show');
Route::get('/insights', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/insights/{slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');
Route::get('/companies/{company:slug}', [CompanyController::class, 'show'])->name('companies.show');
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{service:slug}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:contact')
    ->name('contact.store');
Route::get('/tax-return-form', function (SeoService $seo) {
    return view('pages.tax-return-form', [
        'seo' => $seo->meta(
            'Tax Return Form',
            'Lodge your Australian tax return online with Canberra Accountants. Secure digital tax return form for individuals and businesses across Australia.'
        ),
    ]);
})->name('forms.tax-return');
Route::get('/business-form', function (SeoService $seo) {
    return view('pages.business-form', [
        'seo' => $seo->meta(
            'Business Form',
            'Complete your business engagement form with Canberra Accountants. Business registration, tax returns, BAS, GST and accounting services across Australia.'
        ),
    ]);
})->name('forms.business');
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('login', [AuthController::class, 'login'])
            ->middleware('throttle:admin-login')
            ->name('login.submit');
        Route::get('forgot-password', [PasswordResetController::class, 'showForgotForm'])->name('password.request');
        Route::post('forgot-password', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
        Route::get('reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
        Route::post('reset-password', [PasswordResetController::class, 'reset'])->name('password.update');
    });

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

        Route::middleware('role:super-admin')->group(function () {
            Route::resource('users', UserController::class)->except(['show']);
        });

        Route::resource('articles', AdminArticleController::class)->except(['show']);
        Route::resource('team', TeamMemberController::class)->except(['show']);
        Route::resource('companies', AdminCompanyController::class)->except(['show']);
        Route::resource('services', AdminServiceController::class)->except(['show']);
        Route::resource('contacts', ContactSubmissionController::class)->only(['index', 'show', 'destroy']);
        Route::post('contacts/{contact}/approve', [ContactSubmissionController::class, 'approve'])->name('contacts.approve');
        Route::get('tax-return-submissions', [ContactSubmissionController::class, 'taxReturns'])->name('tax-returns.index');
        Route::get('business-form-submissions', [ContactSubmissionController::class, 'businessForms'])->name('business-forms.index');

        Route::get('settings', [SiteSettingController::class, 'index'])->name('settings.index');
        Route::put('settings', [SiteSettingController::class, 'update'])
            ->middleware('role:super-admin,admin')
            ->name('settings.update');
    });
});
