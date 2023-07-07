<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\{customers , invoice_details, taxes};
class invoices extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'status',
        'status_value',
        'invoice_date',
        'due_date',
        'customer_id',
        'tax_id',
        'user_id',
        'total',
        'tax_amount',
    ];
    protected $dates = ['deleted_at'];

    public function customer()
{
    return $this->belongsTo(customers::class);
}
    public function invoice_detail(){
        return $this->hasMany(invoice_details::class);
    }
    public function tax(){
        return $this->belongsTo(taxes::class);
    }
}
