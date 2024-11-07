<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Message;
use App\Models\Graphic;
use App\Models\Timetable;
use App\Models\Content;
use App\Models\Location;
use App\Models\Venue;
use App\Models\Topic;

use Illuminate\Validation\Rule;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rules\File;


class GraphicController extends Controller
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
            'end_time_at' => ['required','after:start_time_at']
        ]);

        //Landscape files
        $landscapeFilesAttributes = $request->validate([
            'landscape' => [
                'required'
            ]
        ]);

        //Portrait files
        $portraitFilesAttributes = $request->validate([
            'portrait' => [
                'required'
            ]
        ]);
        
        //
        $userAttributes['type'] = 'graphic';
        $userAttributes['timetable_id'] = $timetable->id;
        
        //
        $content = Content::create($userAttributes);

        //landscape graphics graphics
        foreach ($request->landscape as $key => $landscape_file) {
            //multiple ways to do that
            //$path = $request->file('landscape')[$key]->store('graphics-landscape');
            //or
            $path = $landscape_file->store('graphics-landscape','public');
            //add the contents
            Graphic::create([
                'content_id' => $content->id,
                'path' => $path,
                'type'=>'landscape'
            ]);
        }
        //portrait graphics
        foreach ($request->portrait as $key => $portrait_file) {
            //diffrent way
            $path = $request->file('portrait')[$key]->store('graphics-portrait','public');
            //add the contents
            Graphic::create([
                'content_id' => $content->id,
                'path' => $path,
                'type'=>'portrait'
            ]);
        }
        
        //redirect
        return redirect('/contents/'.$timetable->id)->with('success',sprintf(__('validation.added'),'Content'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Graphic $graphic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Graphic $graphic)
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
            'end_time_at' => ['required','after:start_time_at']
        ]);

        //
        $userAttributes['type'] = 'graphic';
        $userAttributes['timetable_id'] = $content->timetable_id;

        //update
        $content->update($userAttributes);
        
        //first delete and then upload any new one
        $content->graphics()->exists() &&  $content->graphics()->forceDelete();

        //reorder or add any new
        if (!empty($request->landsape_graphics)) {
            foreach ($request->landsape_graphics as $key => $value) {
                Graphic::create([
                    'content_id' => $content->id,
                    'path' => $value,
                    'type'=>'landscape'
                ]);
            }
        }

        if (!empty($request->portrait_graphics)) {
            foreach ($request->portrait_graphics as $key => $value) {
                Graphic::create([
                    'content_id' => $content->id,
                    'path' => $value,
                    'type'=>'portrait'
                ]);
            }
        }


        //check if there are any new graphics for desktop
        if (!empty($request->file('landscape'))) {
            foreach ($request->landscape as $key => $landscape_file) {
                //multiple ways to do that
                //$path = $request->file('landscape')[$key]->store('graphics-landscape');
                //or
                $path = $landscape_file->store('graphics-landscape','public');
                //add the contents
                Graphic::create([
                    'content_id' => $content->id,
                    'path' => $path,
                    'type'=>'landscape'
                ]);
            }
        }

        //check if there are any new graphics for desktop
        if (!empty($request->file('portrait'))) {
            foreach ($request->portrait as $key => $portrait_file) {
                //diffrent way
                $path = $request->file('portrait')[$key]->store('graphics-portrait','public');
                //add the contents
                Graphic::create([
                    'content_id' => $content->id,
                    'path' => $path,
                    'type'=>'portrait'
                ]);
            }
        }
        
        //redirect
        return redirect('/contents/'.$content->timetable_id)->with('success',sprintf(__('validation.updated'),'Content'));
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(Graphic $graphic)
    {
        //
    }
}