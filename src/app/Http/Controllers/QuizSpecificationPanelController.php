<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizSpecificationPanelController extends Controller
{
    public function view_specification_panel()
    {
        return view('QuizSpecificationPanel');
    }
}
