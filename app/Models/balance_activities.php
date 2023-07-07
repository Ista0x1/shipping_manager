<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class balance_activities extends Model
{
    use HasFactory;
    protected $fillable = [
        'amount',
        'Created_by',
        'balance_id',
        'date',
    ];

}
