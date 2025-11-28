<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use UUID;

    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
    ];

    // cart item belongs to one cart
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    // cart item is associated with one product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
