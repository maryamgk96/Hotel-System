<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use  App\Floor;
use  App\User;
class Room extends Model
{
    protected $fillable = [
        'number',
        'capacity',
        'price',
        'floor_id',
        'created_by',
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
    
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * Set the room's price.
     *
     * @param  float  $value
     * @return void
     */
    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = $value * 100;
    }

    /**
     * Get the room's price.
     *
     * @param  float  $value
     * @return float
     */
    public function getPriceAttribute($value)
    {
        return $value / 100;
    }
  


}
