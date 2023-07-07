<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  App\Models\{shipping, customers, products, shipping_method};

class shipping_out extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'customer_id',
        'method_id',
        'description',
        'shipping_id',
    ];

    public function customer()
    {
        return $this->belongsTo(customer::class);
    }

    public function method()
    {
        return $this->belongsTo(shippingMethod::class);
    }

    public function shipping()
    {
        return $this->belongsTo(shipping::class);
    }
}
