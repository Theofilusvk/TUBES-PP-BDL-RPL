<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'ms_kategorilomba';
    protected $primaryKey = 'KategoriID';
    public $timestamps = false;
    protected $guarded = [];

    public function event()
    {
        return $this->belongsTo(Event::class, 'EventID', 'EventID');
    }
}
