<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreFloorRequest;
use App\Floor;
use App\Room;
use App\User;
use Auth;


class FloorsController extends Controller
{
    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function index(){ 
    
        return view('floors.index',[
            'error' => ''
        ]);
    }
    
    
    public function create(){
        return view('floors.create');
    }

    public function store(StoreFloorRequest $request){
        $randomId= $this-> generateFloorNumber();
        Floor::create([
            'number' => $randomId,
            'name' => $request->name,

            'created_by' =>  Auth::user()->id
        ]);
        
       return redirect(route('floors.index')); 
    }

    private function generateFloorNumber() {
        $number = mt_rand(1000, 9999); 
    
        // call the same function if the floor number exists already
        if (Floor::where('id', $number)->exists()) {
            return generateFloorNumber();
        }
    
        // otherwise, it's valid and can be used
        return $number;
    }
    
   

    public function edit($id){
        $floor=Floor::find($id);

        return view('floors.edit',[
            'floor' => $floor,
        ]);
    }

    public function update(StoreFloorRequest $request,$id){
        $floor=Floor::find($id)->update([
            'name' => $request->name,
        ]);
        
       return redirect(route('floors.index')); 
    }


    public function destroy(Request $request,$id){

        if(!Room::where('floor_id', $id)->exists()){
            Floor::find($id)->delete();
        }
        else{
            return json_encode([
                'error' => 1
                ]);
        }
    }
}
