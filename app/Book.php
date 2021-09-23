<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'book_id','book_image','book_name','book_category_id','book_author_id','book_publisher_id','book_edition','book_description','book_price','book_total_qty','book_current_qty','book_status'
      ];

    public function category()
    {
    	return $this->belongsTo('App\Category', 'book_category_id');
    }

    public function author()
    {
    	return $this->belongsTo('App\Author', 'book_author_id');
    }

    public function publisher()
    {
    	return $this->belongsTo('App\Publisher', 'book_publisher_id');
    }
}
