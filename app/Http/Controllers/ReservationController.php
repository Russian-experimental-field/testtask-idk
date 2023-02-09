<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class ReservationController extends BaseController
{
    public function showReservationPage(Request $request)
    {
        $carId = $request->query('id');
        $car = Car::find($carId);
        $reservation = Reservation::all();

        return view('car_reservation', ['car' => $car, 'reservation' => $reservation]);
    }
}
