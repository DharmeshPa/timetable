<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timetable;
use App\Models\Content;
use App\Models\Location;
use App\Models\Venue;
use App\Models\Topic;
use Illuminate\Validation\Rule;
use Laravel\Prompts\multiselect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Timetable $timetable)
    {
        
        //
        return view('contents.index',
            [
                'contents' => $timetable->contents()->oldest('start_time_at')->simplePaginate(100),
                'timetable' => $timetable
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Timetable $timetable, String $type)
    {
        //
        return view('contents.create',[
            'type' => $type,
            'timetable' => $timetable,
            'locations'=> Location::select('id','name as title')->where('venue_id',$timetable->display->event->venue->id)->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
    */
    public function store(Timetable $timetable, $type, Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Content $content)
    {
        //
        $timetable = Timetable::find($content->timetable_id);

        //
        return view('contents.edit',[
            'content' => $content,
            'locations'=> Location::select('id','name as title')->where('venue_id',$timetable->display->event->venue->id)->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Content $content)
    {}

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(Content $content)
    {
        if(!Auth::user())
            abort('404');
        
        //delete associated records
        $content->messages()->exists() &&  $content->messages()->forceDelete();
        $content->graphics()->exists() && Storage::disk('public')->delete($content->graphics->pluck('path')->all());
        $content->graphics()->exists() &&  $content->graphics()->forceDelete();
        $content->topics()->exists() &&  $content->topics()->forceDelete();

        //delete
        $content->delete();

        //
        $this->notify_frontend($content);

        //redirect
        return redirect()->back()->with('success', sprintf(__('validation.deleted'),'Content'));
    }
    /**
     * Duplicate the existing model
     * 
    */
    public function duplicate(Content $content){

        //clone the model
        $new_content = $content->replicate();
        $new_content->save();

        //clone another model
        if($content->type === 'message' && $content->messages()->exists() ){
            foreach ($content->messages as $key => $message) {
                $new_message = $message->replicate();
                $new_message->content_id = $new_content->id;
                $new_message->save();
            }
        }
        //clone another model
        if($content->type === 'graphic' && $content->graphics()->exists()){
            foreach ($content->graphics as $key => $graphic) {
                $new_graphic = $graphic->replicate();
                $new_graphic->content_id = $new_content->id;
                $new_graphic->save();
            }
        }
        //clone another model
        if($content->type === 'topics' && $content->topics()->exists()){
            foreach ($content->topics as $key => $topic) {
                $new_topic = $topic->replicate();
                $new_topic->content_id = $new_content->id;
                $new_topic->save();
            }
        }
        
        //
        $this->notify_frontend($content);

        //redirect
        return redirect()->back()->with('success', sprintf(__('validation.duplicate'),'Content'));
    }
}