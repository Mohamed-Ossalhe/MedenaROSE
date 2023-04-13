<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'order_address',
        'total_price',
        'product_quantity',
        'status'
    ];

    // TODO: ADD relations to the modals
    public function products() {
        return $this->belongsToMany(Product::class, 'order_items', 'order_id', 'product_id');
    }
}
