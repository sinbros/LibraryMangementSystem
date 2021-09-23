<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'gallery_image','gallery_name','gallery_category','gallery_status'
      ];
}
