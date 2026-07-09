<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactSubmission extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'status',
        'created_at',
        'responded_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'responded_at' => 'datetime',
    ];
}
