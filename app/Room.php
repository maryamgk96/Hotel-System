<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use  App\Floor;
use  App\User;
class Room extends Model
{
    protected $fillable = [
        'name',
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
    public function user()
    {
        return $this->belongsTo(User::class,'created_by');
    }
  


}
