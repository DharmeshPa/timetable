<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use \App\Models\Role;
use \Illuminate\Validation\Rule;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('roles.index',['roles'=> Role::with(['crews'])->latest('id')->simplePaginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $userAttributes = $request->validate(
            [
                'title' => ['required',Rule::unique('roles')]
            ]
        );
        //add the description
        $userAttributes['description'] = $request->description;

        //update
        Role::create($userAttributes);

        //redirect
        return redirect('/roles')->with('success',sprintf(__('validation.added'),'Role/position/job title'));
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
    public function edit(Role $role)
    {
        //
        return view('roles.edit',['role'=>$role]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        //
        $userAttributes = $request->validate(
            [
                'title' => ['required',Rule::unique('roles')->ignore($role->id)]
            ]
        );
        //add the description
        $userAttributes['description'] = $request->description;
        
        //update
        $role->update($userAttributes);

        //redirect
        return redirect('/roles')->with('success',sprintf(__('validation.updated'),'Role/position/job title'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
         if(!Auth::user())
            abort('404');
       
        //check if it has any events
        if ($role->crews()->exists()) {
            return redirect()->back()->with('error', sprintf(__('validation.cannot_delete'),'role','crews'));
        }

        //delete
        $role->delete();
        
        //redirect
        return redirect()->back()->with('success', sprintf(__('validation.deleted'),'Crew'));
    }
}
