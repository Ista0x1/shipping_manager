<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wearhouse extends Model
{
    use HasFactory;
    protected $fillable = [
        'chwal',
        'petit_coli',
        'grand_coli',
        'nas',
        'f1',
        'f2',
    ];
}
