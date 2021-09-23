<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    protected $fillable = [
        'college_name','college_address','college_contact','college_email','college_status'
      ];
}