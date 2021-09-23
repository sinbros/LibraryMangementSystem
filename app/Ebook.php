<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
{
    protected $fillable = [
        'ebook_image','ebook_pdf','ebook_name','ebook_author','ebook_status'
      ];
}