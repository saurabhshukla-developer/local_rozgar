<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $fillable = [
        'fname', 'email', 'password','mname','lname','contact','profile','usertypeid','loginflag','statusflag'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function user_type()
    {
        return $this->hasOne('app\UserType');
    }
    public function user_place()
    {
        return $this->hasOne('App\UserPlace');
    }
}
