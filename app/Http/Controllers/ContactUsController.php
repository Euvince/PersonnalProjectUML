<?php

namespace App\Http\Controllers;

use App\Jobs\ContactUsJob;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Requests\Client\ContactUsFormRequest;
use Illuminate\Http\RedirectResponse;

class ContactUsController extends Controller
{
    public function showContactForm() : View
    {
        return view('contact-form');
    }

    public function contactUs(ContactUsFormRequest $request) : RedirectResponse
    {
        ContactUsJob::dispatch($request->validated());
        return
            redirect()
            ->route('contact.us.form')
            ->with('success', 'Votre requête a bien été envoyée.');
    }
}
