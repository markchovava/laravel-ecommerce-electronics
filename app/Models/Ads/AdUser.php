<?php

namespace App\Models\Ads;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdUser extends Model
{
    use HasFactory;

    protected $fillable = ['ad_id', 'user_id'];
}
