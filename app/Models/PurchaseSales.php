<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseSales extends Model
{
    use HasFactory;
    protected $table = 'purchases_sales';
    protected $fillable = [
        'sale_id',
        'product_id',
        'status_pay',
        'status_delivery',
        'price',
        'amount',
    ];
}
