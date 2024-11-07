<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Location;
use \App\Models\Crew;
use \App\Models\Venue;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        //
        return view('locations.index',
            [
                'locations'=> Location::with(['crews'])->latest('id')->simplePaginate(10)
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Use the `map` function to transform the crews collection

        return view('locations.create',
            [
                'venues' => Venue::all('id', 'name as title'),
                'crews' => Crew::all('id', 'name as title'),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         
        //
        $userAttributes = $request->validate(
            [
                'name'=> ['required',\Illuminate\Validation\Rule::unique('locations')],
                'venue_id' => ['required']
            ]
        );
       
        //add the location
        $location = Location::create($userAttributes);

        //
        $request->crews && $location->crews()->attach($request->crews);

        //redirect usr
        return redirect('/locations')->with('success',sprintf(__('validation.added'),'Location'));
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
    public function edit(Location $location)
    {
        //
        return view('locations.edit',
            [
                'location' => $location,
                'venues' => Venue::all('id', 'name as title'),
                'crews' => Crew::all('id', 'name as title'),
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $location)
    {
        
        //
        $userAttributes = $request->validate(
            [
                'name'=> ['required',\Illuminate\Validation\Rule::unique('locations')->ignore($location->id)],
                'venue_id' => ['required']
            ]
        );
       
        //add the location
        $location->update($userAttributes);

        //remo them
        $request->crews && $location->crews()->detach();
        
        //add them again
        $request->crews && $location->crews()->attach($request->crews);

        //redirect usr
        return redirect('/locations')->with('success',sprintf(__('validation.updated'),'Location'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        if(!Auth::user())
            abort('404');
        
        //check if it has any events
        if ($location->crews()->exists()) {
            return redirect()->back()->with('error', sprintf(__('validation.cannot_delete'),'location/room','crews'));
        }

        //check if it has any locations
        if ($location->venue()->exists()) {
            return redirect()->back()->with('error', sprintf(__('validation.cannot_delete'),'location/room','venue'));
        }

        //delete
        $location->delete();
        
        //redirect
        return redirect()->back()->with('success', sprintf(__('validation.deleted'),'Location'));
    }
}