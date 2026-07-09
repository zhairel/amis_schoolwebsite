<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'parent_name',
        'student_name',
        'email',
        'phone',
        'grade_level',
        'inquiry_type',
        'message',
        'status',
        'created_at',
        'followed_up_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'followed_up_at' => 'datetime',
    ];
}
