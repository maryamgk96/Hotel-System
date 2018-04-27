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
    ];
    

    public function room()
    {
        return $this->hasMany(Room::class,'room_id');
    }
    public function client()
    {
        return $this->belongsTo(Client::class,'client_id');
    }
    
      /**
     *
     * @param  float  $value
     * @return void
     */
    public function setPaidPriceAttribute($value)
    {
        $this->attributes['paid_price'] = $value * 100;
    }

    /**
     *
     * @param  float  $value
     * @return float
     */
    public function getPaidPriceAttribute($value)
    {
        return $value / 100;
    }

}
