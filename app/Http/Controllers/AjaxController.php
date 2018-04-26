<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\Datatables\Datatables;
use App\Room;
use App\Floor;
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
        $clients = Client::with('user');
        return Datatables::of($clients)->addColumn('actions', function ($client) {
            return '<form action="clients/'.$client->id.'/delete" 
            onsubmit="return confirm(\'Do you really want to delete?\');" method="post" ><a href="/clients/'.$client->id.'/edit" class="btn btn-xm btn-primary" ><i class="fa fa-edit"></i> Edit</a>
            '.csrf_field().method_field("Delete").'<input name="_method" value="delete" type="submit" class="btn btn-danger" /></form>';
        })->addColumn('gender',function($client){
            if($client->gender==0)
            {return "Male";}
            else{return "Female";}})->addColumn('approve',function($client){
              return  '<a href="/clients/'.$client->id.'/approve" class="btn btn-xm btn-primary" ><i class="fa fa-checkmark"></i>Approve</a>';
            })
            
            ->rawcolumns(['actions','approve'])->make(true);    
    }

    public function reservationDataAjax(){
        $client= Auth::guard('client')->user();
        $reservations = Reservation::query()->with('client');
        return Datatables::of($reservations) ->make(true); 
    }

    public function showRoomAjaxData()
    {
        $rooms=Room::all()->where("is_reserved",'0');
        return Datatables::of($rooms) ->addColumn('actions', function ($room) {
            return '<a href="/reservations/create/'.$room->id.'" class="btn btn-xm btn-primary"> Reserve</a>';
        })->rawcolumns(['actions'])->make(true);       
    }



}
