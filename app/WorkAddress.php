<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkAddress extends Model
{
    protected $table = 'work_address';
    protected $fillable = [
        'workid',
        'hno',
        'locality',
        'stateid',
        'cityid',
        'areaid',
        'pincode'
    ];
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

    public function work_details()
    {
        return $this->belongsTo('App\WorkDetail');
    }
}
