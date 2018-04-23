<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
use Yajra\Datatables\Datatables;
use App\User;
use App\Room;
use App\Client;

class ReservationsController extends Controller
{
    public function index(){
       
        return view('reservations.index');
    }
    public function data(){
        $reservations = Reservation::query();
       
        return Datatables::of($reservations) ->make(true); 
    }
    


     public function create()
    {
        $rooms=Room::all();
        $clients=Client::all();
        return view('reservations.create',[
            'rooms'=>$rooms,
            'clients'=>$clients
        ]);
    }


    public function store(Request $request)
    {
       Reservation::create($request->all());
       return redirect('reservations');
    } 
    

   
   
}
