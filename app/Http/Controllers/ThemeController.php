<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use App\Models\Theme;


class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        //
        return view('themes.index',
            [
                'themes'=> Theme::with(['events'])->latest('id')->simplePaginate(10)
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('themes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        //
        $userAttributes = $request->validate(
            [
              'name' => ['required','unique:themes,name'],
              'bg_image' => ['required'],
              'slider_duration' => ['required'],
              'slider_pause' => ['required'],
              'slider_easing' => ['required'],
              'slider_effect' => ['required'],
              'custom_css' => ['nullable'],
            ]
        );

        //upload the file
        $userAttributes['bg_image'] = $request->file('bg_image')->store('events','public');

        //create a new theme
        Theme::create($userAttributes);

        //
        return redirect('/themes')->with('success',sprintf(__('validation.added'),'Theme'));
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
    public function edit(Theme $theme)
    {
        //
        return view('themes.edit',[
            'theme' => $theme
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Theme $theme)
    {
        //
        $userAttributes = $request->validate(
            [
              'name' => ['required',Rule::unique('themes')->ignore($theme->id)],
              'slider_duration' => ['required'],
              'slider_pause' => ['required'],
              'slider_easing' => ['required'],
              'slider_effect' => ['required'],
              'custom_css' => ['nullable'],
            ]
        );
        
        //upload the file
        if(!empty($request->file('bg_image'))){
            $userAttributes['bg_image'] = $request->file('bg_image')->store('events','public');
        }

        //update the value
        $theme->update($userAttributes);

        // Send a notification to the Socket.IO server
        $this->notify_frontend($theme);

        //return to the theme
        //
        return redirect('/themes/'.$theme->id.'/edit')->with('success',sprintf(__('validation.updated'),'Theme'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Theme $theme)
    {
        if(!Auth::user())
            abort('404');
        
        //check if it has any events
        if ($theme->events()->exists()) {
            return redirect()->back()->with('error', sprintf(__('validation.cannot_delete'),'theme','events'));
        }

        //delete
        $theme->delete();
        
        // Send a notification to the Socket.IO server
        $this->notify_frontend($theme);

        //redirect
        return redirect()->back()->with('success', sprintf(__('validation.deleted'),'Event'));
    }
}
