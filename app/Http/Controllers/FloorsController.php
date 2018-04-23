<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreFloorRequest;
use Yajra\Datatables\Datatables;
use App\Floor;
use App\User;

class FloorsController extends Controller
{
    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function index(){  
        return view('floors.index');
    }
    
    public function data(){
        $floor = Floor::query();
        
        return Datatables::of($floor) ->addColumn('actions', function ($floor) {
            return '<a href="/floors/'.$floor->id.'/edit" class="btn btn-xm btn-primary" ><i class="fa fa-edit"> Edit</a>';
        })->rawcolumns(['actions'])->make(true); 
    }
    
    public function create(){
        return view('floors.create');
    }

    public function store(StoreFloorRequest $request){
        $randomId= $this-> generateFloorNumber();
        Floor::create([
            'number' => $randomId,
            'name' => $request->name,

            'created_by' => 1 //// must be modified to be user logined (admin or manager)
        ]);
        
       return redirect(route('floors.index')); 
    }

    private function generateFloorNumber() {
        $number = mt_rand(0000, 9999); 
    
        // call the same function if the floor number exists already
        if ($this-> FloorNumberExists($number)) {
            return generateFloorNumber();
        }
    
        // otherwise, it's valid and can be used
        return $number;
    }
    
    private function FloorNumberExists($number) {
        return Floor::where('id', $number)->exists();
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
        Floor::find($id)->delete();

        return redirect(route('floors.index')); 
    }
}
