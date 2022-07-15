<?php

namespace App\Models\Payment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentResult extends Model
{
    use HasFactory;
   
    protected $fillable = [
        'details_id', 'reference', 'amount', 'paynowreference',
        'pollurl','status','hash', 'currency'
    ];
}
