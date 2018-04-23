<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use  App\Floor;
use  App\User;
class Room extends Model
{
    protected $fillable = [
        'created_by',
        'capacity',
        'price',
        'floor_id',
        'is_reserved',
    ];
    public function floor()
    {
        return $this->belongsTo(Floor::class,'floor_id');
    }
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
  


}
