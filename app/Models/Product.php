<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name', 'brand',
        'price', 'quantity',
        'alert_stock', 'description'
    ];

    public function orderdetail()
    {
        return $this->hasMany(Order_Detail::class);
    }
    public function cart()
    {
        return $this->hasMany(Cart::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
