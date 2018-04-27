<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Room;
use App\Floor;
use App\User;
use Auth;

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
            'created_by' => Auth::user()->id
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
        }
        else{
            return json_encode([
                'error' => 1
                ]);
            
        }    
    }
}
