<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Auth;
use App\Models\Display;
use App\Models\Event;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DisplayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Event $event)
    {
        //
        return view('displays.index',
            [
                'displays'=> $event->displays()->latest('id')->simplePaginate(10),
                'event' => $event
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Event $event)
    {
        //
        return view('displays.create',
            [
                'event'=>$event
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Event $event)
    {
        //
        $userAttributes = $request->validate([
            'name' => ['required',Rule::unique('displays')],
            'description'=> ['nullable']
        ]);

        //add the description
        $userAttributes['event_id'] = $event->id;
       
        //add the record
        Display::create($userAttributes);
        //
        return redirect('/displays/' . $event->id)->with('success',sprintf(__('validation.added'),'Display'));
    }
    /**
     * Display the specified resource.
     */
    public function show(Display $display)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Display $display)
    {
        //
        return view('displays.edit',[
            'display' => $display
        ]);
    }

    /**
     * Update the specified resource in storage.
    */
    public function update(Request $request, Display $display)
    {
        
        $userAttributes = $request->validate([
            'name' => ['required',Rule::unique('displays')->ignore($display->id)],
            'description' => ['nullable']
        ]);
        //add the description
        
        //add the record
        $display->update($userAttributes);
        
        //
        return redirect('/displays/'.$display->event_id)->with('success',sprintf(__('validation.updated'),'Display'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Display $display)
    {
        if(!Auth::user())
            abort('404');
       
        //check if it has any events
        // if ($display->event()->exists()) {
        //     return redirect()->back()->with('error', sprintf(__('validation.cannot_delete'),'display','event'));
        // }

        //check if it has any locations
        if ($display->timetables()->exists()) {
            return redirect()->back()->with('error', sprintf(__('validation.cannot_delete'),'display','timetables'));
        }

        //delete
        $display->delete();
        
        //redirect
        return redirect()->back()->with('success', sprintf(__('validation.deleted'),'Display'));
    }

    /**
     * Duplicate the existing model
     * 
    */
    public function duplicate(Display $display){

        //clone the model
        $new_display = $display->replicate();
        $new_display->name = Str::replace('_copy', '', $display->name) .'_copy';
        $new_display->save();

        if($display->timetables()->exists()){
            foreach ($display->timetables as $key => $timetable) {
                //clone the model
                $new_timetable = $timetable->replicate();
                $new_timetable->display_id = $new_display->id;
                $new_timetable->name = Str::replace('_copy', '', $timetable->name) .'_copy';
                $new_timetable->save();

                //clone another model
                if($timetable->contents()->exists()){
                    foreach ($timetable->contents as $key => $content) {
                        //clone the model
                        $new_content = $content->replicate();
                        $new_content->timetable_id = $new_timetable->id;
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
                    }
                }
            }
        }
        //redirect
        return redirect()->back()->with('success', sprintf(__('validation.duplicate'),'Display'));
    }
}
