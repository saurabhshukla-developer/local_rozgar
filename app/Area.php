<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'area';     
     protected $fillable=[
        'cityid',
        'areaname'
    ];

    public function city(){
        return $this->belongsTo('App\City');
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