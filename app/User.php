<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name', 'profile_image','email', 'password','phone','fcm_token',
    ];
    
    protected $table = "al_users";

    public function hostedContests(){
        return $this->hasMany('App\Contest');
    }
}
