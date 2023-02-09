<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Reservation;
use Illuminate\Routing\Controller as BaseController;

class WelcomeController extends BaseController
{
    public function welcome()
    {
        $cars = Car::all();
        $reservation = Reservation::all();

        return view('welcome', ['cars' => $cars, 'reservation' => $reservation]);

        /* localhost:8000/reservation?car_id=1488 */
    }
}
