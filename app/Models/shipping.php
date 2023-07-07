<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  App\Models\{taxes, customers, products, shipping_method};
class shipping extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'city_origin',
        'city_final',
        'adress_origin',
        'adress_final',
        'zip_origin',
        'zip_final',
        'phone_origin',
        'phone_final',
        'country_origin',
        'country_final',
        'date_origin',
        'date_final',
        'status',
        'status_value',
        'note',
        'method_id',
        'customer_id',
        'tax_id',
        'user_id',
        'total',
        'tax_amount',
    ];
// Shipping model
public function products()
{
    return $this->hasMany(products::class);
}
public function method()
{
    return $this->belongsTo(shipping_method::class);
}
public function customer()
{
    return $this->belongsTo(customers::class);
}

public function tax()
{
    return $this->belongsTo(taxes::class);
}

}
