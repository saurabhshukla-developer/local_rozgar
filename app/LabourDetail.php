<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LabourDetail extends Model
{
    protected $table = 'labour_details';
    protected $fillable = [
        'adhar',
        'fname', 
        'mname',
        'lname',
        'contact',
        'age',
        'gender',
        'labourtypeid',
        'flag'
        ];
        public function labour_type()
        {
            return $this->hasOne('App\LabourType');
        }
        public function labour_address()
        {
            return $this->hasOne('App\LabourAddress');
        }
}
