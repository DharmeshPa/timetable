<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Lang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
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
        return view('auth.login',[]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $userAttributes = $request->validate([
            'email' => ['required'],
            'password'=>['required']
        ]);

        //Log them in
        //attempt the login
        if (! Auth::attempt($userAttributes)){
            throw ValidationException::withMessages([
                'email' => [__('validation.email')],
            ]);
        }
        //Redirect the user
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
    public function destroy()
    {
        //
        Auth::logout();

        //
        return redirect('/login');
    }
}