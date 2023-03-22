<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class AdminController extends Controller
{
    public function showAdmResPage()
    {
        $reservation = Reservation::all();

        return view('adm_res_page', ['reservation' => $reservation]);
    }

    public function showAdmAddCarsPage()
    {
        $car = Car::all();

        return view('adm_cars', ['car' => $car]);
    }

    public function cancelRes(Request $request)
    {
        $id = $request->query('id');
        if ($id === null) {
            abort(404, 'Ur fckn retard!');
        }

        $reservation = Reservation::find($id);

        if ($reservation === null) {
            abort(404, 'Ur fckn retard!');
        }

        $reservation->delete();

        return redirect('/dashboard/reservations');
    }



    public function showCarCreationForm()
    {
        return view("add_cars_form");
    }

    public function doAddCar(Request $request)
    {
        $validated = $request->validate([
            'manuf' => 'required',
            'model' => 'required',
            'engine_vol' => 'required|int',
            'manuf_date' => 'required|date_format:Y m d'
        ]);

        $formatted_time = date_create_from_format("Y m d", $validated['manuf_date'])->format("Y-m-d 00:00:00");

        $validated['manuf_date'] = $formatted_time;

        $car = new Car();

        $car->manufacturer = $validated['manuf'];
        $car->model = $validated['model'];
        $car->engine_volume = $validated['engine_vol'];
        $car->manufactured_at = $validated['manuf_date'];

        $car->save();

        return redirect('/dashboard/cars');
    }

    public function deleteCar(Request $request)
    {
        $id = $request->query('id');
        if ($id === null) {
            abort(404, 'Ur fckn retard!');
        }

        $car = Car::find($id);

        if ($car === null) {
            abort(404, 'Ur fckn retard!');
        }

        $car->delete()->cascade();

        return redirect('/dashboard/cars');
    }
}
