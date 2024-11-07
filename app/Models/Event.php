<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Event extends Model
{
    use HasFactory;

    //event belongs to venue
    public function venue(){
        return $this->belongsTo(Venue::class);
    }
    
    //evenyt belongs to theme
    public function theme(){
        return $this->belongsTo(Theme::class);
    }

    //one event but multiple displays
    public function displays(){
        return $this->hasMany(Display::class);
    }

    
}