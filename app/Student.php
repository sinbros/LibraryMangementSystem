<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'student_id','student_image','student_name','student_gender','student_dob','student_contact','student_email','student_college_id','student_department_id','student_batch_id','student_status'
      ];

    public function college()
    {
    	return $this->belongsTo('App\College', 'student_college_id');
    }
    public function department()
    {
    	return $this->belongsTo('App\Department', 'student_department_id');
    }
    public function batch()
    {
    	return $this->belongsTo('App\Batch', 'student_batch_id');
    }
}
