<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CarsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manufs = collect(["volkswagen", "avtovaz", "zil", "dodge", "tesla"]);
        $models = collect(["volga", "passat", "model x", "landcruizer", "666"]);
        $dates = collect(["01.01.1984", "05.13.2006", "09.18.1999", "02.15.1970", "08.12.1962", "02.02.1991"]);
        $users = User::all();

        for ($i = 0; $i < 20; $i++) {
            $created_at = date('Y-m-d H:i:s', time() - rand(1, 3 * 365 * 24 * 3600));


            DB::table('cars')->insert([
                'model' => $models->random(),
                'manufacturer' => $manufs->random(),
                'engine_volume' => rand(1000, 6000),
                'manufactured_at' => $dates->random(),
                'added_by' => $users->random()->id,
                'created_at' => $created_at,
                'updated_at' => $created_at
            ]);
        }
    }
}
