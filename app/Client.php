<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Reservation;
class Client extends Model
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'country',
        'gender',
        'avatar',
        'is_approved',
        'approved_by',
        
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'approved_by');
    }
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

}
