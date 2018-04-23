<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use  App\Room;
use  App\User;

class Floor extends Model
{
    protected $fillable = [

        'name',
        'number',
        'created_by',
    ];
  
    public function user()
    {
        return $this->belongsTo(User::class,'created_by');
    }
    
}
