<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $table = 'skills';
    
    public function applicant()
    {
        return $this->hasOne('App\Applicant');
    }
}
