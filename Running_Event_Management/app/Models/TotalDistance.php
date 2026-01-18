<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TotalDistance extends Model
{
    protected $table = 'total_distances';
    protected $guarded = [];
    public $timestamps = false; // We handle LastUpdated manually or via schema default
    
    protected $casts = [
        'LastUpdated' => 'datetime',
        'TotalDistance' => 'decimal:2'
    ];
}
