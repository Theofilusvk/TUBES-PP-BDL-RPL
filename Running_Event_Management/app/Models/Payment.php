<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'tr_pembayaran';
    protected $primaryKey = 'PembayaranID';
    public $timestamps = false;
    
    // Explicitly defining date columns helps Carbon conversion
    protected $dates = ['TanggalBayar'];

    protected $guarded = [];

    public function registration()
    {
        return $this->belongsTo(Registration::class, 'PendaftaranID', 'PendaftaranID');
    }
}
