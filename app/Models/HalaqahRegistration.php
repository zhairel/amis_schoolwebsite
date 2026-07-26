<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HalaqahRegistration extends Model
{
    protected $fillable = [
        'name',
        'age',
        'sex',
        'status',
        'level',
        'fb_account',
        'mobile',
        'email',
        'type',
        'phone',
        'address',
        'ms_teams',
        'grade_level',
        'message',
    ];
}
