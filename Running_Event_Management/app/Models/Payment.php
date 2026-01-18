<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'tr_pembayaran';
    protected $primaryKey = 'PembayaranID';
    public $timestamps = false;
    protected $guarded = [];
}
