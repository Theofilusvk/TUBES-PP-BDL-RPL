<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'ms_kategorilomba';
    protected $primaryKey = 'KategoriID';
    public $timestamps = false;
    protected $guarded = [];
    protected $appends = ['Harga'];

    public function event()
    {
        return $this->belongsTo(Event::class, 'EventID', 'EventID');
    }

    public function slots()
    {
        return $this->hasMany(Slot::class, 'KategoriID', 'KategoriID');
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class, 'KategoriID', 'KategoriID');
    }

    public function price()
    {
        return $this->hasOne(CategoryPrice::class, 'KategoriID', 'KategoriID');
    }

    public function getHargaAttribute()
    {
        return optional($this->price)->Nominal ?? 0;
    }
}
