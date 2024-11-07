<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    //topic belongs to content
    public function content(){
        return $this->belongsTo(Content::class);
    }

     // A topic belongs to one location
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
