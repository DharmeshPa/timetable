<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;

    //vanue has many events
    public function events(){
        return $this->hasMany(Event::class);
    }

    //venue has many locations
    public function locations()
    {
       return $this->hasMany(Location::class);
    }

    //add associated records
    public function add($venue){

        foreach (request('locations') as $value) {
            $venue->locations()->firstOrCreate([
                'name' => $value,
            ]);
        }
    }
}
