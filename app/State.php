<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'state';
    protected $fillable = [
        'statename'
    ];
    public function city()
    {
        return $this->hasMany('App\City');
    }
    public function labour_address(){
        return $this->belongsToMany('App\LabourAddress');
    }
    public function work_address(){
        return $this->belongsToMany('App\WorkAddress');
    }
    public function user_place(){
        return $this->belongsToMany('App\UserPlace');
    }
}
