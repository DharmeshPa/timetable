<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Timetable extends Model
{
    use HasFactory;


    //timetable belongs to display
    public function display(){
        return $this->belongsTo(Display::class);
    }


    //timetable has many contents
    public function contents(){
        return $this->hasMany(Content::class);
    }

    //get active contents
    public function activeContents($timetable){

        $now = Carbon::now()->addHours($timetable->display->event->offset);

        // Single query to fetch both topics and non-topics
        return $timetable->contents()
            ->where('visibility', '=', 1)
            ->where(function ($query) use ($now, $timetable) {
                $query->where(function ($subQuery) use ($now, $timetable) {
                    // Condition for topics
                    $subQuery->where('type', '=', 'topics')
                        ->where('end_time_at', '>', $now->copy()->subMinutes(abs($timetable->item_expire_time))->format('H:i'));
                })
                ->orWhere(function ($subQuery) use ($now) {
                    // Condition for non-topics
                    $subQuery->where('type', '!=', 'topics')
                        ->where('end_time_at', '>', $now->format('H:i'));
                });
            })
            ->orderBy('start_time_at', 'asc')
            ->get();
    }
}
