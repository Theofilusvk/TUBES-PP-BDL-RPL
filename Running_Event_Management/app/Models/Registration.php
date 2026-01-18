<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $table = 'tr_pendaftaran';
    protected $primaryKey = 'PendaftaranID';
    public $timestamps = false; // Check schema if WaktuPendaftaran exists
    protected $guarded = [];
}
