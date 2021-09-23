<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accession extends Model
{
    protected $fillable = [
        'accession_no','place','book_id','status'
      ];

    public function book()
    {
    	return $this->belongsTo('App\Book', 'book_id');
    }
}
