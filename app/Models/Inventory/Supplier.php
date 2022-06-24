<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    public $fillable = [
        'name', 'phone_number', 'email', 'address'
    ];

     /* One to many */
     public function purchases(){
        return $this->hasMany(Purchase::class, 'supplier_id', 'id');
    }
}
