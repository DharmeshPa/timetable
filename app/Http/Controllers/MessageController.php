<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\Timetable;
use App\Models\Content;
use App\Models\Location;
use App\Models\Venue;
use App\Models\Topic;
use Illuminate\Validation\Rule;
use Illuminate\Support\Arr;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Timetable $timetable, $type, Request $request)
    {
        //
        $userAttributes = $request->validate([
            'start_time_at' => ['required'],
            'end_time_at' => ['required','after:start_time_at'],
            'message' => ['required']
        ]);

        //
        $userAttributes['type'] = $type;
        $userAttributes['timetable_id'] = $timetable->id;
        
        //
        $content = Content::create(Arr::except($userAttributes, ['message']));

        // Send a notification to the Socket.IO server
        $this->notify_frontend($content);

        //
        Message::create([
            'content_id' => $content->id,
            'message' => $request->message
        ]);

        //redirect
        return redirect('/contents/'.$timetable->id)->with('success',sprintf(__('validation.added'),'Content'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Content $content)
    {
       
        //
        $userAttributes = $request->validate([
            'start_time_at' => ['required'],
            'end_time_at' => ['required','after:start_time_at'],
            'message' => ['required']
        ]);

        //
        $userAttributes['type'] = $content->type;
        $userAttributes['timetable_id'] = $content->timetable_id;

        //
        $content->update(Arr::except($userAttributes, ['message']));
        
        //delete any associated records
        $content->messages()->exists() &&  $content->messages()->forceDelete();

        //
        Message::create([
            'content_id' => $content->id,
            'message' => $request->message
        ]);

        // Send a notification to the Socket.IO server
        $this->notify_frontend($content);
        
        //redirect
        return redirect('/contents/'.$content->timetable_id)->with('success',sprintf(__('validation.updated'),'Content'));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }
}
