<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasicInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_logo', 
        'company_name',
        'company_phone_number', 
        'company_email',  
        'company_address', 
    ]; 
}
