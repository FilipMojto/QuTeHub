<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginPanelController
{
    public function show_login_panel()
    {
        return view('login_view');
    }
}
