<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
use Auth;
use Yajra\Datatables\Datatables;
use App\User;
use App\Room;
use App\Client;
use Validator;
use Stripe;
use Session;

class ReservationsController extends Controller
{
    public function index(){
       
        return view('reservations.index');
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
    public function store(Request $request,$room_id)
    {
        $room=Room::find($room_id);
        $room->is_reserved=1;
        $room->save();
        \Stripe\Stripe::setApiKey ( 'sk_test_nXgbjnbF4AGQIGzDPJFHvwmi' );
        try {
            \Stripe\Charge::create ( array (
                    "amount" => 300 * 100,
                    "currency" => "usd",
                    "source" => $request->input ( 'stripeToken' ), // obtained with Stripe.js
                    "description" => "Test payment." 
            ) );
            Session::flash ( 'success-message', 'Payment done successfully !' );
            Validator::make($request->all(), [
                'paid_price' => 'required',
                'no_companions' => 'required|numeric|max:'.$room->capacity,
            ], [
                'max' => "The Number Of Companions Must Be less Than Or Equal $room->capacity",
            ])->validate();
            Reservation::create([
                'room_id' =>$room_id,
                'client_id' =>Auth::guard('client')->user()->id,
                'paid_price' =>$request->paid_price,
                'no_companions'=>$request->no_companions,
               ]);
            return redirect('reservations');
        } catch ( \Exception $e ) {
            Session::flash ( 'fail-message', "Error! Please Try again." );
            return Redirect::back ();
        }      
    } 
    
    public function show()
    {
        return view('reservations.show');
    }
   
}
