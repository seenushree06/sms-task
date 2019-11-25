<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name',
        'standard',
        'gender',
        'religion',
        'blood_group',
        'section',
        'photo',
        'email',
        'phone',
        'status',
    ];
}
