<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsletterSubscriber extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'email',
        'name',
        'subscribed_at',
        'is_active',
        'unsubscribed_at',
    ];

    protected $casts = [
        'subscribed_at' => 'datetime',
        'is_active' => 'boolean',
        'unsubscribed_at' => 'datetime',
    ];
}
