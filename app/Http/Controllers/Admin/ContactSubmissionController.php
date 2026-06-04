<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
use App\Services\ContactSubmissionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactSubmissionController extends Controller
{
    public function __construct(protected ContactSubmissionService $contactSubmissions) {}

    public function index(Request $request): View
    {
        return $this->listing($request, 'contact', 'admin.contacts.index', 'Contact Messages', 'Manage enquiries from the website contact form');
    }

    public function taxReturns(Request $request): View
    {
        return $this->listing($request, 'tax_return', 'admin.tax-returns.index', 'Tax Return Submissions', 'Review and manage tax return form submissions');
    }

    public function businessForms(Request $request): View
    {
        return $this->listing($request, 'business', 'admin.business-forms.index', 'Business Form Submissions', 'Review and manage business engagement form submissions');
    }

    protected function listing(Request $request, string $formType, string $routeName, string $title, string $subtitle): View
    {
        $filter = $request->get('status', 'all');

        $baseQuery = ContactSubmission::formType($formType);

        $submissions = (clone $baseQuery)
            ->filter($filter)
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $stats = [
            'total' => (clone $baseQuery)->count(),
            'new' => (clone $baseQuery)->where('status', 'new')->count(),
            'approved' => (clone $baseQuery)->where('status', 'approved')->count(),
        ];

        return view('admin.contacts.index', compact('submissions', 'filter', 'stats', 'title', 'subtitle', 'routeName', 'formType'));
    }

    public function show(ContactSubmission $contact): View
    {
        $contact->markAsRead();

        return view('admin.contacts.show', ['submission' => $contact->fresh()]);
    }

    public function approve(ContactSubmission $contact): RedirectResponse
    {
        $this->authorize('update', $contact);

        if ($contact->isApproved()) {
            return back()->with('error', 'This submission is already approved.');
        }

        try {
            $this->contactSubmissions->approve($contact);
        } catch (\Throwable $e) {
            report($e);

            $message = 'Could not send the confirmation email. The submission was not marked approved — please check mail settings in .env and try again.';

            if (config('app.debug')) {
                $message .= ' Error: '.$e->getMessage();
            }

            return back()->with('error', $message);
        }

        return back()->with('success', "Approved successfully. A confirmation email was sent to {$contact->email}.");
    }

    public function destroy(ContactSubmission $contact): RedirectResponse
    {
        $this->authorize('delete', $contact);

        $redirectUrl = $contact->adminListUrl();
        $contact->delete();

        return redirect($redirectUrl)->with('success', 'Submission deleted successfully.');
    }
}
