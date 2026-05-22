<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Store extends Model
{
    use HasFactory;
    protected $table = 'store';
    protected $fillable = [
        'nama_toko',
        'jam_buka',
        'jam_tutup',
        'phone_number',
        'logo_toko',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'store_id');
    }

    public function order()
    {
        return $this->hasMany(Order::class, 'store_id');
    }

    public function getJamBukaAttribute($value)
    {
        return Carbon::parse($value)->format('H.i');
    }

    public function getJamTutupAttribute($value)
    {
        return Carbon::parse($value)->format('H.i');
    }

}
