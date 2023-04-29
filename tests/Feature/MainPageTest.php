<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MainPageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Main page test
     *
     * @return void
     */
    public function test_that_main_page_is_opening()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_that_greeting_text_is_displaying()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_that_form_is_showing_when_no_email()
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('<form action="/userEmail" id="no_email_form" method="POST">', False);
    }

    public function test_that_reservations_list_is_when_email_is_present()
    {
        $response = $this->withCookie('useremail', 'metalll@vaganych.com')->get('/');

        $response->assertOk();
        $response->assertSee('<table id="reservations_table" class="table">', False);
    }
}
