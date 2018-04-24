<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreFloorRequest;
use Yajra\Datatables\Datatables;
use App\Floor;
use App\Room;
use App\User;


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
    
    public function data(){
        $floors = Floor::with('user');  
        return Datatables::of($floors) ->addColumn('actions', function ($floor) {
            return '<a href="/floors/'.$floor->id.'/edit" class="btn btn-xm btn-primary" ><i class="fa fa-edit"></i> Edit</a>
            <form action="floors/'.$floor->id.'" 
            onsubmit="return confirm(\'Do you really want to delete this floor ?\');" method="post" >'.csrf_field().method_field("Delete").'<input name="_method" value="delete" type="submit" class="btn btn-danger" /></form>';
        })->rawcolumns(['actions'])->make(true); 
    }
    
    public function create(){
        return view('floors.create');
    }

    public function store(StoreFloorRequest $request){
        $randojmId= $this-> generateFloorNumber();
        Floor::create([
            'number' => $randomId,
            'name' => $request->name,

            'created_by' => 1 //// must be modified to be user logined (admin or manager)
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
            return redirect(route('floors.index'));
        }
        else{
            return view('floors.index',[
                'error' => 'This floor can not be deleted , it has rooms associated to it'
                 ]);
        }
    }
}
