<?php

namespace App\Models\Message;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageReply extends Model
{
    use HasFactory;
    protected $fillable = [
        'message_id', 'name', 'first_name', 'last_name', 'subject', 'status', 'message'
    ];

    public function message(){
        return $this->belongsTo(Message::class, 'message_id', 'id');
    }
}
