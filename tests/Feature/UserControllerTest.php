<?php

namespace Tests\Feature;

//use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function test_that_no_errors_happen_when_cookies_are_created()
    {
        $response = $this->post('/userEmail', ['useremail' => 'varg@molodets.com']);

        $response->assertStatus(302);
    }

    public function test_that_missing_emai_parameter_is_not_accepting()
    {
        $responce = $this->post('/userEmail', []);

        $responce->assertStatus(302);
        $responce->assertCookieMissing('useremail');
    }

    public function test_thet_incorrect_email_is_not_accepting()
    {
        $responce = $this->post('/userEmail', ['useremail' => 'burn local church']);

        $responce->assertStatus(302);
        $responce->assertCookieMissing('useremail');
    }

    public function test_that_cookie_is_setting_when_email_is_correct()
    {
        $responce = $this->post('/userEmail', ['useremail' => 'varg@grishnak.com']);

        $responce->assertStatus(302);
        $responce->assertCookie('useremail', 'varg@grishnak.com');
    }
}
