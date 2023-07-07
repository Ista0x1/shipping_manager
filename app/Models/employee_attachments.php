<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employee_attachments extends Model
{
    use HasFactory;
    protected $fillable = [
        'file_name',
        'Created_by',
        'employee_id',
    ];
}
