<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppUser;
use Illuminate\Support\Facades\Hash;

class RegisterPanelController
{
    public function show_register_panel()
    {
        return view('register_view');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'username' => 'required|unique:app_users|max:255',
            'password' => 'required|confirmed|min:8',
        ]);

        // Create a new user
        $appuser = new AppUser;
        $appuser->username = $request->username;
        $appuser->password = Hash::make($request->password);
        $appuser->save();

        // Redirect to a success page or login page
        return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
    }
}
