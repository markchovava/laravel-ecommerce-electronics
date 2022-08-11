<?php

namespace App\Models\Role;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'level_id', 'name', 'description']; 

    /* One to many */
    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'level_id');
    }
}
