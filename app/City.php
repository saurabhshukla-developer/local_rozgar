<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'city';
    protected $fillable = [
        'stateid',
        'cityname'
    ];

    public function state()
    {
        return $this->belongsTo('App\State');
    }

    public function area()
    {
        return $this->hasMany('App\Area');
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
