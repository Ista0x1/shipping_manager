<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  App\Models\{shipping_out, customers, products, shipping_method};

class shipping_out_detail extends Model
{
    use HasFactory;
  protected  $table = 'shipping_outs_details';
    protected $fillable = [
        'customer_id',
        'quantity',
        'volume',
        'product_name',
        'brand',
        'description',
        'shipping_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function shippingOut()
    {
        return $this->belongsTo(ShippingOut::class, 'shipping_id');
    }
}
