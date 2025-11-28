<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use UUID;

    protected $fillable = [
        'user_id',
    ];

    // cart belongs to one user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // cart can have many cart items
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
