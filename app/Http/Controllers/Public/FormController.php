<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusinessFormRequest;
use App\Http\Requests\TaxReturnFormRequest;
use App\Services\ContactService;
use App\Services\SeoService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FormController extends Controller
{
    public function __construct(
        protected SeoService $seo,
        protected ContactService $contactService
    ) {}

    public function taxReturn(): View
    {
        return view('public.forms.tax-return', [
            'seo' => $this->seo->meta('Tax Return Form', 'Submit your tax return information to Canberra Accountants. Our team will review your details and be in touch.'),
        ]);
    }

    public function storeTaxReturn(TaxReturnFormRequest $request): RedirectResponse
    {
        $idPath = $request->file('id_document')->store('tax-return-documents', 'public');

        $fullName = trim($request->validated('first_name').' '.$request->validated('last_name'));

        $this->contactService->submit([
            'form_type' => 'tax_return',
            'name' => $fullName,
            'email' => $request->validated('email'),
            'phone' => $request->validated('phone'),
            'company' => $request->validated('abn'),
            'service_interested' => 'Tax Return Form',
            'message' => 'Tax return form submission',
            'form_data' => [
                'first_name' => $request->validated('first_name'),
                'last_name' => $request->validated('last_name'),
                'gender' => $request->validated('gender'),
                'tfn' => $request->validated('tfn'),
                'date_of_birth' => $request->validated('date_of_birth'),
                'abn' => $request->validated('abn'),
                'bsb' => $request->validated('bsb'),
                'account_number' => $request->validated('account_number'),
                'street_address' => $request->validated('street_address'),
                'suburb' => $request->validated('suburb'),
                'state' => $request->validated('state'),
                'post_code' => $request->validated('post_code'),
                'has_spouse' => $request->validated('has_spouse'),
                'number_of_children' => $request->validated('number_of_children'),
                'id_document' => $idPath,
            ],
        ], $request);

        return back()->with('success', 'Thank you. Your tax return form has been submitted successfully. We will contact you shortly.');
    }

    public function business(): View
    {
        return view('public.forms.business', [
            'seo' => $this->seo->meta('Business Form', 'Register your business enquiry with Canberra Accountants. Tell us about your business and advisory needs.'),
        ]);
    }

    public function storeBusiness(BusinessFormRequest $request): RedirectResponse
    {
        $this->contactService->submit([
            'form_type' => 'business',
            'name' => $request->validated('name'),
            'email' => $request->validated('email'),
            'phone' => $request->validated('phone'),
            'company' => $request->validated('business_name'),
            'service_interested' => $request->validated('service_type'),
            'message' => $request->validated('message'),
            'form_data' => [
                'business_name' => $request->validated('business_name'),
                'abn' => $request->validated('abn'),
                'business_structure' => $request->validated('business_structure'),
                'service_type' => $request->validated('service_type'),
            ],
        ], $request);

        return back()->with('success', 'Thank you. Your business form has been submitted successfully. We will contact you shortly.');
    }
}
