<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Graphic extends Model
{
    use HasFactory;


    //graphic belongs to content
    public function content(){
        return $this->belongsTo(Content::class);
    }
}
