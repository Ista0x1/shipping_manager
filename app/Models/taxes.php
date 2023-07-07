<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  App\Models\{shipping, customers, products,invoices};

class taxes extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'tax_rate',
    ];
    public function shipping()
{
    return $this->hasMany(shipping::class);
}
public function invoice()
{
    return $this->hasMany(invoices::class);
}
}
