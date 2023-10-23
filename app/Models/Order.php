<?php

namespace App\Models;

use App\Models\User;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'items',
        'name',
        'address',
        'payment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

public function cartItems()
{
    return $this->hasMany(CartItem::class);
}

    protected $casts = [
        'items' => 'array',
    ];
}