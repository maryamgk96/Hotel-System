<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Resources\RoomResource;
use App\Http\Controllers\Controller;
use App\Room;

class RoomsController extends Controller
{
    public function index(){
        $rooms = Room::with('floor')->paginate(1);
       
        return RoomResource::collection($rooms);
        
    }
}
