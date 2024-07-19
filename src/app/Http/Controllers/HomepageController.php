<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function view_homepage()
    {
        $user = Auth::check() ? Auth::user() : null;
        return view('Homepage', compact('user'));
        // return view('homepage', ['user' => Auth::check() ? '1' : '0']);
    }
}
