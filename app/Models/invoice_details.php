<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\invoices;
class invoice_details extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'priceperitem',
        'quantity',
        'invoice_id',
    ];
    public function invoice()
    {
        return $this->belongsTo(invoices::class, 'invoice_id');
    }

}
