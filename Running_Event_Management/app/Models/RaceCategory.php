<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RaceCategory extends Model
{
    protected $table = 'ms_kategorilomba';
    protected $primaryKey = 'KategoriID';
    public $timestamps = false;
    protected $guarded = [];
}
