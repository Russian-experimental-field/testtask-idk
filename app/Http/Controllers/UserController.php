<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class UserController extends BaseController
{
    public function setUserEmailCookie(Request $request)
    {
        $userEmail = $request->validate([
            'useremail' => 'required|email'
        ]);

        return redirect('/')->cookie(
            'useremail',
            $userEmail['useremail'],
            60 * 24 * 31
        );
    }
}
