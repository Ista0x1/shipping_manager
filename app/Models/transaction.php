<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  App\Models\{customers,invoices,receive};

class transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'transaction_number',
        'city',
        'date',
        'amount',
        'remaining_amount',
        'Created_by',
    ];
    public function customer()
    {
        return $this->belongsTo(customers::class,'customer_id');
    }
    public function receive()
    {
        return $this->hasMany(receive::class);
    }
}
