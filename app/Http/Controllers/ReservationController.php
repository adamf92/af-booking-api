<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;

class ReservationController extends Controller
{
    public function getById(Reservation $reservation): Response {
        // TODO
        $data = $reservation;
        
        return response()->json($data, 200);
    }
}
