<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginPanelController extends Controller
{
    public function view_login_panel()
    {
        if (Auth::check()){
            return back()->withErrors(['login-error' => 'Already logged in!']);
        }

        return view('LoginPanel');
    }

    public function login(Request $request)
    {
        if (Auth::check()){
            return;
        }

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
        ];

        // Validate the input
        $request->validate([
            'name' => [
                'required',
                "min:$minUsernameChars",
                "max:$maxUsernameChars",
                // "regex:/$usernamePattern/", // Validate against provided pattern
            ],
            'password' => [
                'required',     
                "min:$minPasswordChars",
                "max:$maxPasswordChars",
                // "regex:/$passwordPattern/", // Validate against provided pattern
            ],
        ], $messages);

        // Retrieve the user by username
        $user = User::where('name', $request->input('name'))->first();
        
        // Check if the user exists and the password is correct
        if ($user && Hash::check($request->input('password'), $user->password)) {
            // Check if 'remember_me' checkbox is checked
            $remember = $request->has('remember_me');

            // Log the user in
            Auth::login($user, $remember);

            // Redirect to the intended page
            return redirect()->intended('home'); 
        } else {
            // Redirect back with an error message
            return back()->withErrors([
                'login-error' => 'Username or password invalid!',
            ])->withInput();
        }
    }

    public function logout()
    {
        if (Auth::check()){
            Auth::logout();
            return back()->with('login', 'Logout successful!');
        }

        return back()->withErrors('login', 'User not logged in!');
    }
}