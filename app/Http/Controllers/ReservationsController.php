<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
use Yajra\Datatables\Datatables;
use App\User;
use App\Room;
use App\Client;
use Validator;



class ReservationsController extends Controller
{
    public function index(){
       
        return view('reservations.index');
    }
    public function data(){
        $reservations = Reservation::query();
        return Datatables::of($reservations) ->make(true); 
    }
    


     public function create($room_id)
    {
        $room=Room::find($room_id);
        $reservations =Reservation::all();
        return view('reservations.create',[
            'reservations' => $reservations,
            'room'=>$room
        ]);

    }
    public function store(Request $request)
    {
        $room=Room::find($request->room_id);
        $room->is_reserved=1;
        $room->save();

        $variable=$request->no_companions<=$room->capacity;
        Validator::make($request->all(), [
            'paid_price' => 'required',
            'no_companions' => 'required|in:'.$variable,
        ], [
            'in' => "The Number Of Companions Must Be less $room->capacity",
        ])->validate();
       Reservation::create([
        'room_id' => $request->room_id,
        'client_id' => 1,
        'paid_price' => $request->paid_price,
        'no_companions'=>$request->no_companions,
       ]);
    
       return redirect('reservations');
    } 
    

    public function show()
    {
        $rooms=Room::all()->where("is_reserved",'0');
        return Datatables::of($rooms) ->addColumn('actions', function ($room) {
            return '<a href="/reservations/create/'.$room->id.'" class="btn btn-xm btn-primary"> Reserve</a>';
        })->rawcolumns(['actions'])->make(true); 
       
    }

    public function showrooms()
    {
        return view('reservations.show');
    }

   
   
}
