<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Lang;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class RegisterController extends Controller
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
        return view('auth.register',[
            'title' => __('titles.register')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate
        $userAttributes = $request->validate([
            'name' => ['required'],
            'email' => ['required','unique:users,email'],
            'password'=>['required','min:8','confirmed']
        ]);
                
        //add the data
        $user = User::create($userAttributes);

        //log the user in and create session data
        Auth::login($user);

        //redirect the user
        return redirect('/events');
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
