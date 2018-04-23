<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Room;

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(){  
        return view('rooms.index');
    }

    public function data(){
        $rooms = Room::all();
        
        return Datatables::of($rooms) ->addColumn('actions', function ($room) {
            return '<a href="/rooms/'.$room->id.'/edit" class="btn btn-xs btn-primary"> Edit</a>';
        })->editColumn('created_by', 'created_by: {{$room->user->name}}')->make(true); 
    }
}
