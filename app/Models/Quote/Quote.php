<?php

namespace App\Models\Quote;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Quote\QuoteItem;
use App\Models\User;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'quote_number',
        'grandtotal_cents',
        'zw_grandtotal_cents',
        'address',
        'full_name',
        'email',
        'phone',
        'client_address',
        'client_name',
        'client_phone',
        'client_email',
        'quote_date',
        'quote_due_date',
        'notes'
    ];

    public function quote_items(){
        return $this->hasMany(QuoteItem::class, 'quote_id', 'id');
    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
