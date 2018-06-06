<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LabourType extends Model
{
    protected $table = 'labour_type';
    protected $fillable = [
        'labourtype'
    ];
    public function labour_details()
    {
        return $this->belongsToMany('App\LabourDetail');
    }
}
