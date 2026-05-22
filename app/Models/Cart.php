<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'product_id', 'store_id', 'quantity'];
    protected $casts = [
        'quantity' => 'integer',
    ];

    // Set user_id default dengan session ID (untuk guest user)
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($cart) {
            if (empty($cart->user_id)) {
                $cart->user_id = Session::getId();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
