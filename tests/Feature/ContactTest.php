<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactTest extends TestCase
{
    public function test_contact_form_requires_name_email_and_message(): void
    {
        $response = $this->post('/contact', []);

        $response->assertSessionHasErrors(['name', 'email', 'message']);
    }

    public function test_contact_form_rejects_an_invalid_email(): void
    {
        $response = $this->post('/contact', [
            'name' => 'Test User',
            'email' => 'not-an-email',
            'message' => 'A message that is definitely long enough.',
        ]);

        $response->assertSessionHasErrors(['email']);
    }

    public function test_contact_form_submits_successfully(): void
    {
        Mail::fake();

        $response = $this->post('/contact', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'subject' => 'A quick hello',
            'message' => 'A message that is definitely long enough.',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('contact_status');
    }

    public function test_honeypot_submissions_are_silently_accepted(): void
    {
        Mail::fake();

        $response = $this->post('/contact', [
            'company' => 'Spam Co',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('contact_status');
    }
}
