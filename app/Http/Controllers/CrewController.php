<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use \App\Models\Crew;
use \App\Models\Role;
use \Illuminate\Validation\Rule;


class CrewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('crews.index',
            [
                'crews'=> Crew::with(['roles'])->latest('id')->simplePaginate(10)
            ]
        );
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('crews.create',[
            'roles'=> Role::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
    */
    public function store(Request $request)
    {
        //
        $userAttributes = $request->validate([
           'name' => ['required','unique:crews'],
           'email'=>['nullable'],
           'description'=>['nullable'],
           'phone'=>['nullable'],
        ]);

        //
        $rolesAttributes = $request->validate([
           'roles' => ['required']
        ]);

        //add the crew
        $crew = Crew::create($userAttributes);

        //add associated records
        $request->roles && $crew->roles()->attach($request->roles);
        
        //redirect
        return redirect('/crews')->with('success',sprintf(__('validation.added'),'Crew'));
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
    public function edit(Crew $crew)
    {
        //
        return view('crews.edit',[
            'crew'=>$crew,
            'roles'=> Role::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Crew $crew)
    {
        //
        $userAttributes = $request->validate([
           'name' => ['required'],
           'email' => ['required',Rule::unique('crews')->ignore($crew->id)],
        ]);

        //add the description
        $userAttributes['description'] = $request->description;

        //
        $rolesAttributes = $request->validate([
           'roles' => ['required']
        ]);

        //update
        $crew->update($userAttributes);

        //remove it all
        $request->roles && $crew->roles()->detach();

        //add it again
        $request->roles && $crew->roles()->attach($request->roles);

        //redirect
        return redirect('/crews')->with('success',sprintf(__('validation.updated'),'Crew'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Crew $crew)
    {
         if(!Auth::user())
            abort('404');
       
        //check if it has any events
        if ($crew->roles()->exists()) {
            return redirect()->back()->with('error', sprintf(__('validation.cannot_delete'),'crew','roles'));
        }

        //check if it has any locations
        if ($crew->locations()->exists()) {
            return redirect()->back()->with('error', sprintf(__('validation.cannot_delete'),'crew','locations'));
        }

        //delete
        $crew->delete();
        
        //redirect
        return redirect()->back()->with('success', sprintf(__('validation.deleted'),'Crew'));
    }
}