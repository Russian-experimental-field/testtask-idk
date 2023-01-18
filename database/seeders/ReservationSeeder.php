<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReservationSeeder extends Seeder
{
    private function randdate(): string
    {
        $starts_at = strtotime('08.12.2000');
        $ends_at = time();
        $random_date = rand($starts_at, $ends_at);

        return date('Y-m-d H:i:s', $random_date);
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cars = Car::all();
        for ($i = 0; $i < 35; $i++) {
            $starts_at = $this->randdate();
            $ends_at = strtotime($starts_at) + rand(1800, 5400);

            DB::table('reservation')->insert([
                'user_email' => Str::random(10) . '@gmail.com',
                'starts_at' => $starts_at,
                'ends_at' => date('Y-m-d H:i:s', $ends_at),
                'car_id' => $cars->random()->id,
                'created_at' => $this->randdate(),
                'updated_at' => $this->randdate()
            ]);
        }
    }
}
