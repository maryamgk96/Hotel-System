<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Floor;

class FloorsController extends Controller
{
    public function index(){
        $floors = Floor::paginate(2);
        
        return view('floors.index',[
            'floors' => $floors
        ]);
    }

}
