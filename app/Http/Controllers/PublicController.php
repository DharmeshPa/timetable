<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Display;

class PublicController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Display $display)
    {   
        
        //we have the $display
        //we have the active timetable
        $timetable = ($display->timetable($display) ? $display->timetable($display) : [] );

        //we have the contents and locations
        $contents = (!empty($timetable) ? $timetable->activeContents($timetable) : []);
        
        return view('public.show',[
            'display'=>$display,
            'timetable'=>$timetable,
            'contents' => $contents
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
