<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $table = 'tr_pendaftaran';
    protected $primaryKey = 'PendaftaranID';
    public $timestamps = false; // Using custom timestamp columns if any, or defaults
    
    // The table has 'TanggalPendaftaran' which is managed by DB default usually, 
    // but Eloquent expects created_at/updated_at by default.
    // We can disable timestamps or map them.
    const CREATED_AT = 'TanggalPendaftaran';
    const UPDATED_AT = null;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'PenggunaID', 'PenggunaID');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'KategoriID', 'KategoriID');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'PendaftaranID', 'PendaftaranID');
    }
}
