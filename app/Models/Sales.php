<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sales extends Model
{
    use HasFactory;
    protected $table = 'sales';
    protected $fillable = [
        'customer_id',
        'store_id',
        'payment_method',
        'price_total',
        'amount_total',
        'status_pay',
        'status_delivery'
    ];

    public function customer()
    {
        return $this->belongsTo(Customers::class);
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(PurchaseSales::class, 'sale_id', 'id');
    }
}
