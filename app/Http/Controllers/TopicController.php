<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timetable;
use App\Models\Content;
use App\Models\Location;
use App\Models\Venue;
use App\Models\Topic;
use Illuminate\Validation\Rule;

class TopicController extends Controller
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
            'group_title' => ['nullable',Rule::requiredIf(count($request->names)>1)]
        ]);

        //
        $topicAttributes = $request->validate([
            'names.*' => ['required'],
            'locations.*' => ['required']
        ]);

        //other alues
        $userAttributes['visibility'] = ($request->has('visibility') ? 0 : 1);
        $userAttributes['group_title_bold'] = ($request->has('group_title_bold') ? 1 : 0);
        $userAttributes['group_title_italic'] = ($request->has('group_title_italic') ? 1 : 0);
        $userAttributes['hide_session_end_time'] = ($request->has('hide_session_end_time') ? 1 : 0);
        $userAttributes['type'] = $type;
        $userAttributes['timetable_id'] = $timetable->id;

        //
        $content = Content::create($userAttributes);

        //create a topics
        foreach ($request->names as $key => $name) {
            // code...
            Topic::create([
                'location_id' => $request->locations[$key],
                'content_id' => $content->id,
                'title' => $request->names[$key],
                'bold' => ($request->bold[$key] ? 1 : 0),
                'italic' => ($request->italic[$key] ? 1 : 0),
                'description' => $request->descriptions[$key],
                'requirement' => $request->requirements[$key],
            ]);
        }

        //redirect
        return redirect('/contents/'.$timetable->id)->with('success',sprintf(__('validation.added'),'Content'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Topic $topic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Topic $topic)
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
            'group_title' => ['nullable',Rule::requiredIf(count($request->names)>1)]
        ]);

        //
        $topicAttributes = $request->validate([
            'names.*' => ['required'],
            'locations.*' => ['required']
        ]);

        //other values
        $userAttributes['visibility'] = ($request->has('visibility') ? 0 : 1);
        $userAttributes['group_title_bold'] = ($request->has('group_title_bold') ? 1 : 0);
        $userAttributes['group_title_italic'] = ($request->has('group_title_italic') ? 1 : 0);
        $userAttributes['hide_session_end_time'] = ($request->has('hide_session_end_time') ? 1 : 0);
        $userAttributes['type'] = $content->type;
        $userAttributes['timetable_id'] = $content->timetable_id;

        //
        $content->update($userAttributes);

        //delete any associated records
        $content->topics()->exists() &&  $content->topics()->forceDelete();

        //create a topics
        foreach ($request->names as $key => $name) {
            //we could check
            Topic::create([
                'location_id' => $request->locations[$key],
                'content_id' => $content->id,
                'title' => $request->names[$key],
                'bold' => ($request->bold[$key] ? 1 : 0),
                'italic' => ($request->italic[$key] ? 1 : 0),
                'description' => $request->descriptions[$key],
                'requirement' => $request->requirements[$key],
            ]);
        }
        //redirect
        return redirect('/contents/'.$content->timetable_id)->with('success',sprintf(__('validation.updated'),'Content'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Topic $topic)
    {
        //
    }
}
