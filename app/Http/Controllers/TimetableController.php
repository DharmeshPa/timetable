<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Auth;
use App\Models\Timetable;
use App\Models\Display;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class TimetableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Display $display)
    {
        //
        return view('timetables.index',
            [
                'timetables'=> $display->timetables()->latest('id')->simplePaginate(10),
                'display' => $display
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Display $display)
    {
        //
        return view('timetables.create',[
            'display' => $display
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Display $display)
    {
        //validate
        $userAttributes = $request->validate([
            'name' => ['required',Rule::unique('timetables')],
            'start_at' => ['required'],
            'end_at' => ['required'],
            'start_time_at' => ['required'],
            'end_time_at' => ['required','after:start_time_at'],
            'item_expire_time' => ['required','numeric'],
            'description'=>['nullable']
        ]);
        
        //  
        $userAttributes['start_at'] = date("Y-m-d H:i:s",strtotime($request->start_at .' '.$request->start_time_at));
        $userAttributes['end_at'] = date("Y-m-d H:i:s",strtotime($request->end_at .' '.$request->end_time_at));

        //
        $userAttributes['display_id'] = $display->id;
        
        //add
        $timetable = Timetable::Create($userAttributes);

        // Send a notification to the Socket.IO server
        $this->notify_frontend($timetable);

        //return 
        return redirect('/timetables/'.$display->id)->with('success',sprintf(__('validation.added'),'Timetable'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Timetable $timetable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Timetable $timetable)
    {
        
        //
        return view('timetables.edit',[
            'timetable'=>$timetable
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Timetable $timetable)
    {
        //validate
        $userAttributes = $request->validate([
            'name' => ['required',Rule::unique('timetables')->ignore($timetable->id)],
            'start_at' => ['required','date'],
            'end_at' => ['required','date'],
            'start_time_at' => ['required'],
            'end_time_at' => ['required'],
            'item_expire_time' => ['required','numeric'],
            'description'=>['nullable']
        ]);

        //  
        $userAttributes['start_at'] = date("Y-m-d H:i:s",strtotime($request->start_at .' '.$request->start_time_at));
        $userAttributes['end_at'] = date("Y-m-d H:i:s",strtotime($request->end_at .' '.$request->end_time_at));

        //
        $userAttributes['description'] = $request->description;
        
        //add
        $timetable->update($userAttributes);

        // Send a notification to the Socket.IO server
        $this->notify_frontend($timetable);

        //return 
        return redirect('/timetables/'.$timetable->display_id)->with('success',sprintf(__('validation.updated'),'Timetable'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Timetable $timetable)
    {
        if(!Auth::user())
            abort('404');
       
        //check if it has any events
        if ($timetable->contents()->exists()) {
            return redirect()->back()->with('error', sprintf(__('validation.cannot_delete'),'timetable','contents'));
        }

        //delete
        $timetable->delete();
        
        // Send a notification to the Socket.IO server
        $this->notify_frontend($timetable);

        //redirect
        return redirect()->back()->with('success', sprintf(__('validation.deleted'),'Timetable'));
    }

    /**
     * Duplicate the existing model
     * 
    */
    public function duplicate(Timetable $timetable){

        //clone the model
        $new_timetable = $timetable->replicate();
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
        // Send a notification to the Socket.IO server
        $this->notify_frontend($timetable);
        
        //redirect
        return redirect()->back()->with('success', sprintf(__('validation.duplicate'),'Timetable'));
    }
}
