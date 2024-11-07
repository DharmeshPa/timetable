<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    //video belongs to content
    public function content(){
        return $this->belongsTo(Content::class);
    }
}
