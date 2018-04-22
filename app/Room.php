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
        return $this->hasOne('Floor', 'foreign_key');
    }
    public function user()
    {
        return $this->belongsTo('User', 'foreign_key');
    }
    public function reservation()
    {
        return $this->hasOne('Reservation');
    }


}
