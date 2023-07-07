<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  App\Models\{taxes, shipping, products ,invoices , transaction , User};
class customers extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'email',
        'phone',
        'address',
        'city',
        'note',
        'country',
        'account_id'
    ];
    public function shipping()
{
    return $this->hasMany(shipping::class);
}
public function invoice()
{
    return $this->hasMany(invoices::class);
}
public function transactions()
    {
        return $this->hasMany(transaction::class);
    }
    public function user()
{
    return $this->belongsTo(User::class);
}
}
