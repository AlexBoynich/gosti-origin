<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'cost',
        'receipt_time',
        'can_earlier',
        'customer_id',
        'payment_method_id',
    ];

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function pivot()
    {
        return $this->hasOne(ObtainingMethodOrder::class);
    }
}
