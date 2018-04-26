<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Cog\Contracts\Ban\Bannable as BannableContract;
use Cog\Laravel\Ban\Traits\Bannable;
class User extends Authenticatable implements BannableContract
{
    use Notifiable;
    use HasRoles;
    use Bannable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'national_id',
        'avatar',
        'created_by',
        'is_banned',
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'created_by');
    }
    public function setAvatarAttribute($value)
    {
        if($value == "")
          $this->attributes['avatar'] = "/storage/default-profile.png";
        else
          $this->attributes['avatar'] = "/storage".str_replace("public", "", $value);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
