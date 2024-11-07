<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    //message belongs to content
    public function content(){
        return $this->belongsTo(Content::class);
    }
}
