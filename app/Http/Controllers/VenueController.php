<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Auth;;
use App\Models\Venue;
use App\Models\Location;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('venues.index',
            [
                'venues'=> Venue::with(['locations'])->latest('id')->simplePaginate(10)
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('venues.create',[]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $userAttributes = $request->validate([
            'name' => ['required']
        ]);
        //add the venue
        $venue = Venue::create($userAttributes);
        
        //add associated records
        $request->locations[0] != "" && $venue->add($venue);

        //redirect
        return redirect('/venues')->with('success', sprintf(__('validation.added'),'Venue'));
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
    public function edit(Venue $venue)
    {

        //
        return view('venues.edit',
            [
                'venue' => $venue,
                'locations' => $venue->locations->pluck('name')->all()
            ]
        );
    }

    /**
     * Update the specified resource in storage.
    */
    public function update(Request $request, Venue $venue)
    {
        
        //validate
        $userAttributes = $request->validate([
            'name' => ['required'],
            'description' => ['nullable']
        ]);

        //
        $venue->update([
            'name' => $request->name,
            'description' => $request->description
        ]);
        
        //delete any associated records
        $venue->locations()->exists() && $venue->locations()->forceDelete();

        //add them again
        $request->locations && $venue->add($venue);

        //redirect
        return redirect('/venues')->with('success', sprintf(__('validation.updated'),'Venue'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venue $venue)
    {
        if(!Auth::user())
            abort('404');
        
        //check if it has any events
        if ($venue->events()->exists()) {
            return redirect()->back()->with('error', sprintf(__('validation.cannot_delete'),'venue','event'));
        }

        //check if it has any locations
        if ($venue->locations()->exists()) {
            return redirect()->back()->with('error', sprintf(__('validation.cannot_delete'),'venue','locations'));
        }

        //delete
        $venue->delete();
        
        //redirect
        return redirect()->back()->with('success', sprintf(__('validation.deleted'),'Venue'));
    }
}