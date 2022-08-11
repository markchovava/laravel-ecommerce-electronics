<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Product\Product;
use App\Models\Role\Role;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name','email','password','first_name','last_name','address',
        'phone_number','date_of_birth','code','status','gender',
        'image','role_id','id_number','delivery_address'
    ];



    public function products()
    {
        return $this->belongsToMany(Product::class, 'user_products', 'user_id', 'product_id')
            ->withTimestamps();
    }

    public function ads(){
        return $this->belongsToMany(Ads::class, 'ad_users', 'user_id', 'ad_id')
            ->withTimestamps();
    }

    public function purchases(){
        return $this->hasMany(Quote::class, 'supplier_id', 'id');
    }

    /* One to many */
    public function quotes(){
        return $this->hasMany(Quote::class, 'user_id', 'id');
    }

    public function carts(){
        return $this->belongsTo(Cart::class, 'customer_id', 'id');
    }

    public function role(){
        return $this->belongsTo(Role::class, 'role_id', 'level_id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
}
