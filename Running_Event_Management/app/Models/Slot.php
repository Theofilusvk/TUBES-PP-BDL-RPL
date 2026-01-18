<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    protected $table = 'ms_slotkategori';
    protected $primaryKey = 'SlotID';
    public $timestamps = false;
    protected $guarded = [];
    
    protected $casts = [
        'TanggalMulai' => 'datetime',
        'TanggalSelesai' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'KategoriID', 'KategoriID');
    }
}
