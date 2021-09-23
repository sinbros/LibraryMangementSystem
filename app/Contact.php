<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'contact_name','contact_no','contact_email','contact_sub','contact_msg'
      ];
}
