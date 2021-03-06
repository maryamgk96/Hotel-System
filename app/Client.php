<?php

namespace App;

use App\Notifications\ClientResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Maatwebsite\Excel\Concerns\FromCollection;

class Client extends Authenticatable implements FromCollection
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','mobile',
        'country',
        'gender',
        'avatar',
        'is_approved',
        'approved_by',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ClientResetPassword($token));
    }

    public function setAvatarAttribute($value)
    {
        if($value == "")
          $this->attributes['avatar'] = "/storage/default-profile.png";
        else
          $this->attributes['avatar'] = "/storage".str_replace("public", "", $value);
    }


    public function user()
    {
        return $this->belongsTo(User::class,'approved_by');
    }

    public function collection()
    {
        return Client::all();
    }

    
}
