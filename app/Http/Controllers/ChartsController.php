<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
use App\Client;
use Auth;
use Illuminate\Support\Facades\DB;


class ChartsController extends Controller
{
    public function index()
    {
        $MaleReservations=DB::table('reservations')
        ->join('clients', function ($join) {
            $join->on('reservations.client_id', '=', 'clients.id')
                 ->where('gender','=',0);
        })
        ->get()->count();
        $FemaleReservations=DB::table('reservations')
        ->join('clients', function ($join) {
            $join->on('reservations.client_id', '=', 'clients.id')
                 ->where('gender','=',1);
        })
        ->get()->count();
        return view('statistics.statistics',['male' => $MaleReservations,'female' => $FemaleReservations]);

        

    }
}
