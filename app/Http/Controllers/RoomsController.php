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
        })->make(true); 
    }

    public function create(){
        return view('rooms.create');
    }

    public function store(Request $request){
        Room::create([
            'number' => $randomId,
            'name' => $request->name,

            'created_by' => 1 //// must be modified to be user logined (admin or manager)
        ]);
        
       return redirect(route('rooms.index')); 
    }
}
