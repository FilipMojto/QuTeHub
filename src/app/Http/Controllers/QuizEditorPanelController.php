<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizEditorPanelController extends Controller
{
    public function view_specification_panel()
    {
        return view('QuizEditorPanel');
    }
}
