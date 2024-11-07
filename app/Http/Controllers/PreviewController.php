<?php

namespace App\Http\Controllers;

use App\Models\Timetable;
use App\Models\Display;
use Illuminate\Http\Request;

class PreviewController extends Controller
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
     * Timetable the specified resource.
     */
    public function show(Timetable $timetable)
    {   
        
        //get the display
        $display = $timetable->display;

        //we have the contents and locations
        $contents = (!empty($timetable) ? $timetable->activeContents($timetable) : []);

        //return the view
        return view('preview.show',[
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
