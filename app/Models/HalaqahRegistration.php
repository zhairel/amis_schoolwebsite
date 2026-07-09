<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HalaqahRegistration extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'ms_teams',
        'level',
        'grade_level',
        'message',
    ];
}
