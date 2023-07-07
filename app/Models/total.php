<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class total extends Model
{
    use HasFactory;
    protected $fillable = [
        'total_euro',
        'remaining_euro',
        'total_dollar',
        'remaining_dollar',
        'customer_id',
    ];
}
