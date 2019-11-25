<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Class extends Model
{
      protected $fillable = [
        'class_number', 'group', 'school_id',
    ];
}
