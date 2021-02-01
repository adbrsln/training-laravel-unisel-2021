<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        $rules = [
            'name' => 'required|string|max:255',
        ];

        $data = [
            'name' => $request->name,
        ];

        if($request->has('password') && !empty($request->password)) {
            $rules['password'] = 'required|string|confirmed|min:8';
            $data['password'] = Hash::make($request->password);
        }

        $request->validate($rules);

        auth()->user()->update($data);

        alert()->success('Profile', 'Your profile has been successfully updated.');

        return redirect()->route('profile.show');
    }
}
