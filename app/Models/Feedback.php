<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    public $timestamps = false;
    protected $table = 'feedback'; // override default pluralization

    protected $fillable = [
        'name',
        'email',
        'feedback_type',
        'rating',
        'message',
        'status',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];
}
