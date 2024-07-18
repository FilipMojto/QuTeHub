<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterPanelController extends Controller
{
    public function view_register_panel()
    {
        return view('RegisterPanel');
    }

    public function register(Request $request)
    {
        $minUsernameChars = env('MIN_USERNAME_CHARS');
        $maxUsernameChars = env('MAX_USERNAME_CHARS');
        $minPasswordChars = env('MIN_PASSWORD_CHARS');
        $maxPasswordChars = env('MAX_PASSWORD_CHARS');
        
        // Define custom error messages for validation failures
        $messages = [
            'name.required' => 'Username is required.',
            'name.unique' => 'Username is already taken.',
            'name.min' => "Username must be at least $minUsernameChars characters long.",
            'name.max' => "Username must not exceed $maxUsernameChars characters.",
            'name.regex' => 'Username format is invalid.',
            'password.required' => 'Password is required.',
            'password.min' => "Password must be at least $minPasswordChars characters long.",
            'password.max' => "Password must not exceed $maxPasswordChars characters.",
            'password.regex' => 'Password format is invalid.',
            'email.required' => 'Email is required.',
            'email.email' => 'Email format is invalid.',
            'email.unique' => 'Email is already taken.',
        ];


        // Validate the request
        $request->validate([
            'name' => [
                'required',
                'unique:users',
                "min:$minUsernameChars",
                "max:$maxUsernameChars",
                // 'regex:/'. preg_quote($usernamePattern, '/') .'/'
            ],
            'password' => [
                'required',
                'confirmed',
                "min:$minPasswordChars",
                "max:$maxPasswordChars",
                // 'regex:/'. preg_quote($passwordPattern, '/') .'/'
            ],
            'email' => [
                'required',
                'email',
                'unique:users',
                
            ]
        ], $messages);

        // Create a new user
        $appuser = new User;
        $appuser->name = $request->name;
        $appuser->password = Hash::make($request->password);
        $appuser->email = $request->email;
        $appuser->save();

        // Redirect to a success page or login page
        return redirect()->route('login.view')->with('success', 'Registration successful! Please log in.');       
    }
}
