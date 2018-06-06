<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkType extends Model
{
    protected $table = 'work_type';
    protected $fillable = [
        'worktype'
    ];

    public function work_details()
    {
        return $this->belongsToMany('App\WorkDetail');
    }
}
