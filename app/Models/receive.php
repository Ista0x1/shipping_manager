<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  App\Models\{customers,invoices,transaction};

class receive extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaction_id',
        'customer_id',
        'transaction_number',
        'amount',
        'Created_by',
        'receiver_city',
        'receiver_date',
        'received_amount',
    ];
    public function transaction()
    {
        return $this->belongsTo(transaction::class);
    }
    public function customer()
    {
        return $this->belongsTo(customer::class);
    }
}
