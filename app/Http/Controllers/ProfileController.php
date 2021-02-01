<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware([
            'auth',
            'permission:update-profile'
        ]);
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        auth()->user()->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        alert()->success('Profile', 'Your profile has been successfully updated.');

        return redirect()->route('profile');
    }
}
