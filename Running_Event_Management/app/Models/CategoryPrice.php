<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryPrice extends Model
{
    protected $table = 'ms_biayakategori';
    protected $primaryKey = 'BiayaID';
    public $timestamps = false;
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'KategoriID', 'KategoriID');
    }
}
