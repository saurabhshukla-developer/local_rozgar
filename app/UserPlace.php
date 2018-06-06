<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPlace extends Model
{
    protected $table = 'user_place';
    protected $fillable = [
        'usersid','stateid','cityid','areaid','pincode'
    ];
    public function users()
    {
        return $this->belongsTo('App\User');
    }
    public function area()
    {
        return $this->hasOne('App\Area');
    }

    public function city()
    {
        return $this->hasOne('App\City');
    }

    public function state()
    {
        return $this->hasOne('App\State');
    }
}
