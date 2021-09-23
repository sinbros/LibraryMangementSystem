<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'accession_id','student_id','from_date','to_date','actual_return_date','issued_by','taken_by','status'
      ];

    public function student()
    {
    	return $this->belongsTo('App\Student', 'student_id');
    }

    public function accession()
    {
    	return $this->belongsTo('App\Accession', 'accession_id');
    }
}
