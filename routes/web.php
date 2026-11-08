<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('portfolio');
})->name('home');

Route::post('/contact', function (Request $request) {
    // Honeypot: silently accept and discard obvious bot submissions.
    if ($request->filled('company')) {
        return back()->with('contact_status', "Thanks! Your message has been sent.");
    }

    $data = $request->validate([
        'name'    => ['required', 'string', 'max:100'],
        'email'   => ['required', 'email', 'max:150'],
        'subject' => ['nullable', 'string', 'max:150'],
        'message' => ['required', 'string', 'min:10', 'max:3000'],
    ], [
        'name.required'    => 'Please enter your name.',
        'email.required'   => 'Please enter your email address.',
        'email.email'      => 'Please enter a valid email address.',
        'message.required' => 'Please write a short message.',
        'message.min'      => 'Your message should be at least 10 characters.',
    ]);

    $portfolio = require resource_path('views/partials/config.php');
    $to = $portfolio['basic']['email'];

    $body = "New message from your portfolio\n\n"
        . "Name: {$data['name']}\n"
        . "Email: {$data['email']}\n"
        . "Subject: " . ($data['subject'] ?? 'Portfolio enquiry') . "\n\n"
        . $data['message'];

    Mail::raw($body, function ($message) use ($to, $data) {
        $message->to($to)->subject('Portfolio message from ' . $data['name']);
    });

    return back()->with('contact_status', "Thanks! Your message has been sent. I'll get back to you soon.");
})->middleware('throttle:6,1')->name('contact.send');
