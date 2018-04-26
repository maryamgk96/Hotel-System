<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use Yajra\Datatables\Datatables;
use App\Room;
use App\Floor;
use App\User;

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(){  
        return view('rooms.index',[
            'error' => ''
             ]);
    }

    public function data(){
        $rooms = Room::with('user')->with('floor');
        
        return Datatables::of($rooms) ->addColumn('actions', function ($room) {
            return '<a href="/rooms/'.$room->id.'/edit" class="btn btn-xm btn-primary"><i class="fa fa-edit"></i> Edit</a>
            <form action="/rooms/'.$room->id.'" 
            onsubmit="return confirm(\'Do you really want to delete this room ?\');" method="post" >'.csrf_field().method_field("Delete").'<input name="_method" value="delete" type="submit" class="btn btn-danger" /></form>';
        })->rawcolumns(['actions'])->make(true); 
    }

    public function create(){
        $floors = Floor::all();
        return view('rooms.create',[
            'floors' => $floors
        ]);
    }

    public function store(StoreRoomRequest $request){
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

    public function update(UpdateRoomRequest $request,$id){
        $room = Room::find($id)->update([
            'number' => $request -> number,
            'capacity' => $request -> capacity,
            'price' => $request -> price,
            'floor_id' => $request -> floor_id,
        ]);
        
       return redirect(route('rooms.index')); 
    }

    public function destroy(Request $request,$id){
        $room = Room::find($id);
        if($room->is_reserved == 0){
            $room->delete();
            return redirect(route('rooms.index'));
        }
        else{
            return view('rooms.index',[
                'error' => 'This room can not be deleted , it is a reserved room '
                 ]);
        }    
    }
}
