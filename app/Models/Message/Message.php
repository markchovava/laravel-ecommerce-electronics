<?php

namespace App\Models\Message;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'subject',
        'message'
    ];

    public function message_reply(){
        return $this->hasOne(Message::class, 'message_id', 'id');
    }
}
