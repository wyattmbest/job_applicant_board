<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'jobs';
    
    public function applicants()
    {
        return $this->hasMany('App\Applicant');
    }
    
    // Function used to return desired rowspan for a given job
    public function count_unique_applicant_skills()
    {
        $count = 0;
        foreach($this->applicants as $applicant)
        {
            // If the applicant does not have any skills they still require a rowspan of 1 to display other info
            if($applicant->skills->unique('name')->count() > 1)
            {   
                $count = $count + $applicant->skills->unique('name')->count();
            }
            else
            {
                $count++;
            }
        }
        return $count;
    }
}
