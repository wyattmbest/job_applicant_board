<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    protected $table = 'applicants';
    
    public function skills()
    {
        return $this->hasMany('App\Skill');
    }
    
    public function job()
    {
        return $this->hasOne('App\Job');
    }

    // Function used to return a collection of unique skills for the given person.
    public function unique_skills()
    {
        // Calling values on the collection return a new collection with reset keys.
        return $this->skills->unique('name')->values();
    }
}
