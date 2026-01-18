<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $table = 'tr_peserta';
    protected $primaryKey = 'PesertaID';
    public $timestamps = false;
    protected $guarded = [];
}
