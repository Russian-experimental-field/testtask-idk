<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class WelcomeController extends BaseController
{
    public function welcome(Request $request)
    {
        $userEmail = $request->cookie('useremail');

        $cars = Car::all();
        $reservation = Reservation::where('user_email', $userEmail)->get();

        if ($userEmail) {
            return view('welcome', ['cars' => $cars, 'reservation' => $reservation, 'userHasEmail' => True]);
        } else {
            return view('welcome', ['cars' => $cars, 'reservation' => [], 'userHasEmail' => False]);
        }
    }
}
