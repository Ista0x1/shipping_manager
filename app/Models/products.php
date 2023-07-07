<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  App\Models\{taxes, customers, shipping};
class products extends Model
{
    use HasFactory;

        protected $fillable = [
            'name',
            'description',
            'quantity',
            'weight',
            'price',
            'width',
            'depth',
            'shipping_id',
        ];
        public function shipping()
        {
            return $this->belongsTo(shipping::class);
        }
}
