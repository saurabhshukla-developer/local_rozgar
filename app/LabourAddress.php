<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LabourAddress extends Model
{
    protected $table = 'labour_address';
    protected $fillable = [
        'labourid',
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

    public function labour_details()
    {
        return $this->belongsTo('App\LabourDetail');
    }
}
