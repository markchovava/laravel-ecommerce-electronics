<?php

namespace App\Models\Ads;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Ads extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'percent', 'price',
        'link', 'status', 'click_name', 'image'
    ];

     /* Many to Many */
     public function authors()
     {
         return $this->belongsToMany(User::class, 'ad_users', 'ad_id', 'user_id')
             ->withTimestamps();
     }
}
