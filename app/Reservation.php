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
    public function client()
    {
        return $this->hasOne('Client', 'foreign_key');
    }

    public function room()
    {
        return $this->hasOne('Room', 'foreign_key');
    }
    public function user()
    {
        return $this->belongsTo('User', 'foreign_key');
    }


}
