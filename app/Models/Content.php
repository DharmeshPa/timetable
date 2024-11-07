<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    //timetable belongs to display
    public function timetable(){
        return $this->belongsTo(Timetable::class);
    }


    //content have many topics
    public function topics(){
        return $this->hasMany(Topic::class);
    }

    //content have many grapgic
    public function graphics(){
        return $this->hasMany(Graphic::class);
    }


    //content have many videos
    public function videos(){
        return $this->hasMany(Video::class);
    }

    //content have many messages
    public function messages(){
        return $this->hasMany(Message::class);
    }
}
