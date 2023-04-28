<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DashboardAddCarsTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        DB::table('users')->insert([
            'name' => "leshan",
            'email' => "xxxleshan@mail.ru",
            'password' => Hash::make('password'),
        ]);

        $this->user = User::query()->where('email', 'xxxleshan@mail.ru')->first();
    }

    /**
     * we need: smoke test, test that felds are fields, test that form is working
     */

    public function test_that_form_is_displaying()
    {
        $response = $this->actingAs($this->user)->get('/dashboard/cars/create');

        $response->assertStatus(200);
        $response->assertSee('<form action="/dashboard/cars/create" method="post">', false);
    }

    // public function test_that_form_is_not_sending_where_there_are_empty_fields()
    // {
    //     $response = $this->actingAs($user)->post('/dashboard/cars/create', ['manuf' => 'qwdeqw', 'model' => 'krutaja', 'engine_vol' => '125', 'manuf_date' => '1999 12 01']);
    //     $response->assertStatus(302);
    //     $response->assertRedirect('/dashboard/cars');
    //     $response = $this->actingAs($user)->post('/dashboard/cars/create', ['manuf' => 'zil', 'model' => '', 'engine_vol' => '131', 'manuf_date' => '1990 01 01']);
    //     $response = $this->actingAs($user)->post('/dashboard/cars/create', ['manuf' => 'zil', 'model' => 'govno vozil', 'engine_vol' => '', 'manuf_date' => '1990 01 01']);
    //     $response = $this->actingAs($user)->post('/dashboard/cars/create', ['manuf' => 'fbi', 'model' => 'partyvan', 'engine_vol' => '1241', 'manuf_date' => '']);
    // }

    public function test_that_car_is_successfully_creating()
    {
        $response = $this->actingAs($this->user)->post('/dashboard/cars/create', ['manuf' => 'qwdeqw', 'model' => 'krutaja', 'engine_vol' => '125', 'manuf_date' => '1999 12 01']);
        $response->assertStatus(302);
        $response->assertRedirect('/dashboard/cars');
        // $response = $this->actingAs($user)->post('/dashboard/cars/create', ['manuf' => 'zil', 'model' => '', 'engine_vol' => '131', 'manuf_date' => '1990 01 01']);
        // $response = $this->actingAs($user)->post('/dashboard/cars/create', ['manuf' => 'zil', 'model' => 'govno vozil', 'engine_vol' => '', 'manuf_date' => '1990 01 01']);
        // $response = $this->actingAs($user)->post('/dashboard/cars/create', ['manuf' => 'fbi', 'model' => 'partyvan', 'engine_vol' => '1241', 'manuf_date' => '']);

    }
}
