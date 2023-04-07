<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'quantity'
    ];

    public function images() {
        return $this->hasMany(CategoryImage::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
