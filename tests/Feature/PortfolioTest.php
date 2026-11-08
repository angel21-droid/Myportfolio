<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class PortfolioTest extends TestCase
{
    public function test_homepage_renders_every_navigation_target(): void
    {
        $response = $this->get('/');

        $response->assertOk();

        foreach (['home', 'about', 'skills', 'projects', 'certificates', 'education', 'experience', 'contact'] as $section) {
            $response->assertSee('id="' . $section . '"', false);
        }

        foreach (['Home', 'About', 'Skills', 'Projects', 'Certificates', 'Education', 'Experience', 'Contact Me'] as $label) {
            $response->assertSee($label, false);
        }
    }

    public function test_homepage_renders_real_profile_data(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Angel Bio', false);
        $response->assertSee('bioangel29@gmail.com', false);
        $response->assertSee('Salnec, Bucay, Abra', false);
        $response->assertSee('github.com/angel21-droid', false);
        $response->assertSee('Do your work with', false);
        $response->assertSee('Currently Studying', false);
    }

    public function test_homepage_shows_projects_education_and_experience(): void
    {
        $response = $this->get('/');

        $response->assertOk();

        foreach (['P.E EMIS', 'Bangued-Ka-Fuel', 'AbraQuest', 'Task Manager'] as $project) {
            $response->assertSee($project, false);
        }

        $response->assertSee('Data Center College of the Philippines', false);
        $response->assertSee('Dugong National High School', false);
        $response->assertSee('Land Registration Authority (LRA)', false);
        $response->assertSee('File Management', false);
        $response->assertSee('Encoding', false);
    }

    public function test_theme_switcher_is_present_and_linkedin_is_removed(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('data-theme="dark"', false);
        $response->assertSee('id="theme-toggle"', false);
        $response->assertSee('portfolio-theme', false);
        $response->assertDontSee('LinkedIn', false);
        $response->assertDontSee('linkedin', false);
    }

    public function test_homepage_links_real_certificates_and_resume(): void
    {
        $response = $this->get('/');

        $response->assertOk();

        foreach ([
            'certificate_CISCO_IntroModernAI',
            'certificate_DICT_StartUp',
            'certificate_DICT_OnlineSafety',
        ] as $certificate) {
            $response->assertSee('certificate/previews/' . $certificate . '.jpg', false);
            $response->assertSee('certificate/' . $certificate . '.pdf', false);
            $this->assertFileExists(public_path('certificate/previews/' . $certificate . '.jpg'));
            $this->assertFileExists(public_path('certificate/' . $certificate . '.pdf'));
        }

        $response->assertSee('resume/AngelBio_resume.pdf', false);
        $response->assertSee('Download My Resume', false);
        $this->assertFileExists(public_path('resume/AngelBio_resume.pdf'));
        $this->assertFileExists(public_path('image/Prof_photo.jpg'));
        $this->assertFileExists(public_path('images/Prof_photo.jpg'));
    }

    public function test_contact_form_requires_name_email_and_message(): void
    {
        $response = $this->from('/')->post('/contact', []);

        $response->assertRedirect('/');
        $response->assertSessionHasErrors(['name', 'email', 'message']);
    }

    public function test_contact_form_sends_a_message(): void
    {
        Mail::fake();

        $response = $this->from('/')->post('/contact', [
            'name' => 'Test Visitor',
            'email' => 'visitor@example.com',
            'subject' => 'Hello',
            'message' => 'This is a valid portfolio enquiry message.',
        ]);

        $response->assertRedirect('/');
        $response->assertSessionHas('contact_status');
    }
}
