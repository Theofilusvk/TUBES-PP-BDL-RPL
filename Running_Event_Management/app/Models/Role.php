<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'ms_peran';
    protected $primaryKey = 'PeranID';
    public $timestamps = false;
    protected $fillable = ['NamaPeran'];
}
