<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'store_id',
        'title',
        'description',
        'price',
        'stock',
        'image',
        'category'
    ];

    public $timestamps = true;

    // Relasi ke Store
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function cart()
    {
        return $this->hasMany(Cart::class, 'product_id');
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'product_likes', 'product_id', 'user_id')->withTimestamps();
    }
}
