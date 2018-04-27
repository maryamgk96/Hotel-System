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

       dd(DB::table('reservations')
            ->select(DB::raw('SUM(paid_price) as revenue, MONTH(created_at) as month, YEAR(created_at) as year'))
            ->groupBy(DB::raw('YEAR(created_at) ASC, MONTH(created_at) ASC'))->get());




        return view('statistics.statistics',['male' => $MaleReservations,'female' => $FemaleReservations]);

        

    }
}
