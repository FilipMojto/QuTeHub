<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Quiz;

class PersonalQuizListController extends Controller
{
    public function view_PQL()
    {
        if (!Auth::check()){
            abort(500, 'Internal Server Error: Attempted to view editor panel without being logged in.');
        }

        $user = Auth::user();
        $quizzes = Quiz::where('user_id', $user->id)->get();


        return view('PersonalQuizListPanel', compact('quizzes'));
    }

    public function delete_quiz($id)
    {
    
        if (!Auth::check()){
            abort(500, 'Internal Server Error: Attempted to delete quiz without being logged in.');
        }    
        
        $quiz = Quiz::find($id);

        if (!$quiz){
            abort(500, 'Internal Server Error: Attempted to delete non-existing Quiz instance!');
        }

        if ($quiz->user_id != Auth::user()->id){
            abort(500, "Internal Server Error: Attempted to delete other User's Quiz instance!");
        }

        if ($quiz) {
            $quiz->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
}
