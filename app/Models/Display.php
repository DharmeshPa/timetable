<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Display extends Model
{
    use HasFactory;

    //display belongs to an event
    public function event(){
        return $this->belongsTo(Event::class);
    }

    //display has many timetables
    public function timetables(){
        return $this->hasMany(Timetable::class);
    }

    //get active timetable
    public function timetable($display){

        // Calculate the current time using an offset
        $offsetHours = $display->event->offset; // Get the offset value
        $now = Carbon::now()->addHours($offsetHours); // Adjust current time based on the offset

        // Get the active timetable and return it
        return $display->timetables()
            ->where('start_at', '<=', $now) // Check if start time is less than or equal to now
            ->where('end_at', '>=', $now)   // Check if end time is greater than or equal to now
            ->orderBy('id', 'asc')          // Order by ID in ascending order
            ->first();
    }
}