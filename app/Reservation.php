<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Client;
use App\Room;
use App\User;
class Reservation extends Model
{
    protected $fillable = [
        'room_id',
        'client_id',
        'paid_price',
        'no_companions',
        'created_by',
    ];
    

    public function room()
    {
        return $this->hasMany(Room::class);
    }
    
    
    




}
