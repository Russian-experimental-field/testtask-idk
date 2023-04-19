<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardReservationTest extends TestCase
{
    use RefreshDatabase;

    public function test_that_user_is_redirected_to_login_page_when_unauthorized()
    {
        $response = $this->get('/dashboard/reservations');

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_that_user_sees_content_when_authorized()
    {

        $created_at = date('Y-m-d H:i:s', time() - rand(1, 3 * 365 * 24 * 3600));

        DB::table('users')->insert([
            'name' => "leshan",
            'email' => "xxxleshan@mail.ru",
            'password' => Hash::make('password'),
        ]);

        $user = User::query()->where('email', 'xxxleshan@mail.ru')->first();;

        DB::table('cars')->insert([
            'model' => 'zil 600 sil',
            'manufacturer' => 'zil',
            'engine_volume' => 8000,
            'manufactured_at' => "09.18.1999",
            'added_by' => $user->id,
            'created_at' => $created_at,
            'updated_at' => $created_at
        ]);

        $car = DB::table('cars')->first();

        DB::table('reservation')->insert([
            'user_email' => 'sergey_korolev@run.ru',
            'starts_at' => '1999-12-15 15:15:00',
            'ends_at' => '1999-12-15 15:45:00',
            'car_id' => $car->id,
            'created_at' => $created_at,
            'updated_at' => $created_at
        ]);

        $response = $this->actingAs($user)->get('/dashboard/reservations');

        $response->assertOk();
        $response->assertSee('<table class="table" id="admin_reservations_table">', false);
        $response->assertSeeInOrder(['1999-12-15 15:15:00', '1999-12-15 15:45:00', 'zil zil 600 sil']);
    }
}
