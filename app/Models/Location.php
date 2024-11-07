<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;


    //location belongs to venue
    public function venue(){
        return $this->belongsTo(Venue::class);
    }

    //
    public function crews()
    {
        return $this->belongsToMany(Crew::class);
    }

    // A location can have many topics
    public function topics()
    {
        return $this->hasMany(Topic::class);
    }
}