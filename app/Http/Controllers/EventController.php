<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Venue;
use Illuminate\Validation\Rule;
use GuzzleHttp\Client;



class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('events.index',
            [
                'events'=> Event::with(['venue'])->latest('id')->simplePaginate(10)
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('events.create',
            [
                'venues' => Venue::all('id', 'name as title'),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $userAttributes = $request->validate([
            "name" => ['required',Rule::unique('events')],
            "venue_id" => ['required'],
            "offset" => ['required','numeric'],
            "theme_id" => ['required'],
        ]);
        //
        $userAttributes['description'] = $request->description;

        //
        Event::create($userAttributes);

        //
        return redirect('/events')->with('success',sprintf(__('validation.added'),'Event'));
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
    public function edit(Event $event)
    {
        //
        return view('events.edit',
            [
                'event'=>$event
            ]
        );
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $userAttributes = $request->validate([
            "name" => ['required',Rule::unique('events')->ignore($event->id)],
            "venue_id" => ['required'],
            "offset" => ['required','numeric'],
            "theme_id" => ['required'],
        ]);
        //
        $userAttributes['description'] = $request->description;

        //
        $event->update($userAttributes);
        
        // Send a notification to the Socket.IO server
        $this->notify_frontend($event);

        //
        return redirect('/events')->with('success',sprintf(__('validation.updated'),'Event'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        if(!Auth::user())
            abort('404');
        
        //delete
        $event->delete();
        
        //
        $this->notify_frontend($event);

        //redirect
        return redirect()->back()->with('success', sprintf(__('validation.deleted'),'Event'));
    }
    

}
