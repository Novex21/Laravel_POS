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
        return $this->hasMany('App\Models\Order_Detail');
    }
    public function cart()
    {
        return $this->hasMany('App\Models\Cart');
    }
}
