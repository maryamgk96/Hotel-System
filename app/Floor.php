<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use  App\Room;
use  App\User;
class Floor extends Model
{
    protected $fillable = [
        'name',
        'created_by',
    ];
    public function room()
    {
        return $this->hasMany(Room::class);
    }
    public function user()
    {
        return $this->belongsTo('User', 'foreign_key');
    }
    
}
