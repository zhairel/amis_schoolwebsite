<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'admin_announcement_id',
        'title',
        'content',
        'category',
        'priority',
        'image',
        'publish_date',
        'author',
    ];

    protected $casts = [
        'publish_date' => 'datetime',
    ];
}
