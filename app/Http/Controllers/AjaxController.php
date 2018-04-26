<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\Datatables\Datatables;
use App\Room;
use App\Floor;
use App\Reservation;
use App\User;
use App\Client;
use Auth;

class AjaxController extends Controller
{
    public function managersDataAjax()
    {
        $managers = User::role('manager')->get();
        return Datatables::of($managers) ->addColumn('actions', function ($manager) {
            return view('managers.action',['id'=>$manager->id]);
        })->rawcolumns(['actions'])->make(true);
    }
    

    public function receptionistsDataAjax()
    {              
        $user = Auth::user();
        $receptionists = User::role('receptionist')->with('user')->get();
        if($user->hasRole('admin'))
        {
            return Datatables::of($receptionists) ->addColumn('actions', function ($receptionist) {
                return view('receptionists.action',['id'=>$receptionist->id,'banFlag'=>$receptionist->is_banned]);
            })->rawcolumns(['actions'])->make(true); 
        }
        else
        {
            $receptionists = User::role('receptionist')->with('user')->get();
            return Datatables::of($receptionists) ->addColumn('actions', function ($receptionist) {
                if(Auth::user()->id == $receptionist->created_by)
                {
                  return view('receptionists.action',['id'=>$receptionist->id,'banFlag'=>$receptionist->is_banned]);
                }
                else
                  return 'You Cannot CRUD On This Receptionist';
            })->rawcolumns(['actions'])->make(true); 
        }
    }

    public function roomsDataAjax(){
        $user = Auth::user();
        $rooms = Room::with('user')->with('floor');
        
        if($user->hasRole('admin')){
            return Datatables::of($rooms) ->addColumn('actions', function ($room) {
                return view('rooms.action',[ 'id' => $room -> id ]);
            })->rawcolumns(['actions'])->make(true); 
        }
        else{
            return Datatables::of($rooms) ->addColumn('actions', function ($room) {
                if(Auth::user()->id == $room->created_by){
                    return view('rooms.action',[ 'id' => $room -> id ]);
                }
                else
                  return 'You Cannot CRUD On This Room';
               
            })->rawcolumns(['actions'])->make(true); 
        }
        
    }


    public function floorsDataAjax(){
        $user = Auth::user(); 
        $floors = Floor::with('user');
        
        if($user->hasRole('admin')){
            return Datatables::of($floors) ->addColumn('actions', function ($floor) {
                return view('floors.action',[ 'id' => $floor -> id ]);
            })->rawcolumns(['actions'])->make(true); 
        } 
        else{
            return Datatables::of($floors) ->addColumn('actions', function ($floor) {
                if(Auth::user()->id == $floor->created_by){
                    return view('floors.action',[ 'id' => $floor -> id ]);
                }
                else
                  return 'You Cannot CRUD On This Floor';
               
            })->rawcolumns(['actions'])->make(true); 

        }
        
    }


    public function clientsDataAjax()
    {    
        $user = Auth::user(); 
        if($user->hasAnyRole(['manager','admin']))
        {
        $clients = Client::with('user');
        return Datatables::of($clients)
        ->addColumn('actions', function ($client) {
            return view('clients.action',[ 'id' => $client -> id ,'approvedFlag'=>$client->is_approved]);
        })
        ->addColumn('gender',function($client){
            if($client->gender==0)
            {return "Male";}
            else{return "Female";}})
            
            ->rawcolumns(['actions'])->make(true);    
        }
        else
        {
            
            $clients=Client::where('is_approved',0);
           
            return Datatables::of($clients)
        ->addColumn('actions', function ($client) {
            return view('clients.action',[ 'id' => $client -> id ,'approvedFlag'=>$client->is_approved]);
        })
        ->addColumn('gender',function($client){
            if($client->gender==0)
            {return "Male";}
            else{return "Female";}})
            
            ->rawcolumns(['actions'])->make(true);
        }
    }

    public function approvedClients()
    {    $user = Auth::user(); 
        $clients=Client::where('approved_by',$user->id);
           
            return Datatables::of($clients)
        ->addColumn('gender',function($client){
            if($client->gender==0)
            {return "Male";}
            else{return "Female";}})
            
            ->make(true);
    }
    

    public function reservationDataAjax(){
        $clientid= Auth::guard('client')->user()->id;
        $reservations = Reservation::all();
       foreach ($reservations as $reservation)
    { 
        if($reservation->client_id==$clientid)
        {
            $res=[];
            array_push($res,$reservation);
        }
    }
        return Datatables::of($res) ->make(true); 
    }

    public function showRoomAjaxData()
    {
        $rooms=Room::all()->where("is_reserved",'0');
        return Datatables::of($rooms) ->addColumn('actions', function ($room) {
            return '<a href="/reservations/create/'.$room->id.'" class="btn btn-xm btn-primary"> Reserve</a>';
        })->rawcolumns(['actions'])->make(true);       
    }



}
