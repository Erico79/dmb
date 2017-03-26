<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body', 'sender', 'recipients', 'recipients', 'message_status', 'message_type', 'content_type', 'subject'
    ];
}
