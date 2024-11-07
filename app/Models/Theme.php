<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;


    //theme has many events
    public function events(){
        return $this->hasMany(Event::class);
    }
}
