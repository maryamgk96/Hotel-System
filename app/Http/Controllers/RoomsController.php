<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Room;
use App\Floor;

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
            return '<a href="/rooms/'.$room->id.'/edit" class="btn btn-xm btn-primary"> Edit</a>';
        })->rawcolumns(['actions'])->make(true); 
    }

    public function create(){
        $floors = Floor::all();
        return view('rooms.create',[
            'floors' => $floors
        ]);
    }

    public function store(Request $request){
        Room::create([
            'number' => $request -> number,
            'capacity' => $request -> capacity,
            'price' => $request -> price,
            'floor_id' => $request -> floor_id,
            'created_by' => 1 //// must be modified to be user logined (admin or manager)
        ]);
        
       return redirect(route('rooms.index')); 
    }

    public function edit($id){
        $room = Room::find($id);
        $floors = Floor::all();
        return view('rooms.edit',[
            'room' => $room,
            'floors' => $floors
        ]);
    }

    public function update(Request $request,$id){
        $room = Room::find($id)->update([
            'number' => $request -> number,
            'capacity' => $request -> capacity,
            'price' => $request -> price,
            'floor_id' => $request -> floor_id,
        ]);
        
       return redirect(route('floors.index')); 
    }
}
