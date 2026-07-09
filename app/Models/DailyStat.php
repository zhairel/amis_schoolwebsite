<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyStat extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'date',
        'total_visits',
        'unique_visitors',
        'page_views',
        'created_at',
    ];

    protected $casts = [
        'date' => 'date',
        'created_at' => 'datetime',
    ];
}
