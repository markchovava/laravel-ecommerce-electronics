<?php

namespace App\Models\Miscellaneous;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Miscellaneous extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'value'];
}
