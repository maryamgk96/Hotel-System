<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\Datatables\Datatables;
use App\User;
use App\Room;
use App\Client;
use Validator;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Session;

class ReservationsController extends Controller
{
    public function index(){
        $client= Auth::guard('client')->user();
        if($client)
        {   
            if($client->is_approved==1)
            {
            return view('reservations.index');
            }
            else
            {
                return view('clients.pending');
            }
        }
        else{
            
            return view('reservations.indexAll');
        }
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
     
        Stripe::setApiKey ('sk_test_nXgbjnbF4AGQIGzDPJFHvwmi');
        Customer::create(array(
            'email' => Auth::guard('client')->user()->email,
            'source'  => $request->stripeToken
        ));
        Charge::create ( array (
            "amount" => $request->paid_price,
            "currency" => "usd",
            "description" => "Test payment.", 
            "source" => "tok_amex"
        ) );

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
               $room->is_reserved=1;
               $room->save();
            return redirect('reservations');
    } 
    
    public function show()
    {
        return view('reservations.show');
    }
   
}
