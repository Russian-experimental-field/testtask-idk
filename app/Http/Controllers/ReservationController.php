<?php

namespace App\Http\Controllers;

use App\Models\Car;
use DateTimeInterface;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class ReservationController extends BaseController
{
    public function showReservationPage(Request $request)
    {
        $carId = $request->query('id');
        $car = Car::find($carId);
        if ($car === null) {
            abort(404, 'Ur fckn retard!');
        }
        $reservation = Reservation::all();

        return view('car_reservation', ['car' => $car, 'reservation' => $reservation]);
    }

    public function createReservation(Request $request)
    {
        $validated = $request->validate([
            'starts_at' => 'required|date_format:d.m.Y H:i',
            'duration' => 'required',
            'email' => 'required|email',
            'car_id' => 'required'
        ]);

        $time = [
            1 => 60 * 15,
            2 => 60 * 30,
            3 => 60 * 45,
            4 => 60 * 60
        ];
        $starts_at = strtotime($validated['starts_at']);
        $ends_at = $starts_at + $time[$validated['duration']];
        //dump($validated);

        $reservation = new Reservation();

        $reservation->starts_at = date(DateTimeInterface::ATOM, $starts_at);
        $reservation->ends_at = date(DateTimeInterface::ATOM, $ends_at);
        $reservation->user_email = $validated['email'];
        $reservation->car_id = $validated['car_id'];

        //между резервациями окно 10 минут

        $existingReservations = Reservation::where('car_id', $validated['car_id'])->get();

        foreach ($existingReservations as $existingReservation) {

            $start = strtotime($existingReservation->starts_at);
            $end = strtotime($existingReservation->ends_at);
            $currentResStart = strtotime($reservation->starts_at);
            $currentResEnd = strtotime($reservation->ends_at);

            if (($currentResEnd >= $start && $currentResEnd <= $end) || ($currentResStart >= $start && $currentResStart <= $end)) {
                return redirect()->back()->withInput($validated)->with('error', 'Ошибка: время бронирования пересекается с другим, или не соблюдён интервал 10 минут');
            }
        }

        $reservation->save();

        return redirect('/');
    }
}
