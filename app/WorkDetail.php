<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkDetail extends Model
{
    protected $table = 'work_details';
    protected $fillable = [
        'generatedid',
        'fname',
        'mname',
        'lname',
        'contact',
        'worktypeid',
        'description',
        'startdate',
        'enddate',
        'deletedate',
        'hours',
        'paymentperhour',
        'workstatus',
        'flag'
    ];
    public function work_type()
    {
        return $this->hasOne('App\WorkType');
    }
    public function work_address()
    {
        return $this->hasOne('App\WorkAddress');
    }
}
