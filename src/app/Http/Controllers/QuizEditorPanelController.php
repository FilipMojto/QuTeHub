<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\QuestionChoice;
use App\Models\QuizSubject;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Log;

class QuizEditorPanelController extends Controller
{
    public function view_specification_panel()
    {

        if (!Auth::check()){
            abort(500, 'Internal Server Error: Attempted to view editor panel without being logged in.');
        }
        $user = Auth::check() ? Auth::user() : null;

       

        return view('QuizEditorPanel', compact('user'));    
    }

    public function validate_quiz_params(Request $request)
    {
        $messages = [
            'name.required' => 'Name is required.',
            'name.unique' => 'Name is already taken.',
            'name.max' => 'Name must not exceed 50 characters.',
            'name.min' => 'Name must contain at least 6 characters.',
            'type.required' => 'Type is required.',
            'difficulty.required' => 'Difficulty is required.',
            'difficulty.max' => 'Difficulty must not exceed 6 characters.',
            'time.required' => 'Time is required.',
            'time.max' => 'Time must not exceed 5 digits.',
            'description.max' => 'Description must not exceed 65535 characters.',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:6|max:50|unique:quizzes,name',
            'type' => 'required|integer|unique:quiz_types,type',
            'difficulty' => 'integer',
            'time' => 'required|integer|max:99999',
            'time-unit' => 'required|integer',
            'subjects' => 'required|string',
            'description' => 'nullable|string|max:65535',
            // 'questions' => 'required|string'
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        return response()->json(['message' => 'Quiz validated successfully!']);
    }

    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Name is required.',
            'name.unique' => 'Name is already taken.',
            'name.max' => 'Name must not exceed 50 characters.',
            'name.min' => 'Name must contain at least 6 characters.',
            'type.required' => 'Type is required.',
            'difficulty.required' => 'Difficulty is required.',
            'difficulty.max' => 'Difficulty must not exceed 6 characters.',
            'time.required' => 'Time is required.',
            'time.max' => 'Time must not exceed 5 digits.',
            'description.max' => 'Description must not exceed 65535 characters.',
        ];

        $validatedData = $request->validate([
            'name' => 'required|string|min:6|max:50|unique:quizzes,name',
            'type' => 'required|integer|unique:quiz_types,type',
            'difficulty' => 'integer',
            'time' => 'required|integer|max:99999',
            'time-unit' => 'required|integer',
            'subjects' => 'required|string',
            'description' => 'nullable|string|max:65535',
            'questions' => 'required|string'
        ], $messages);


        
        DB::transaction(function () use ($validatedData, $request) {
            $time_unit = 1;
        
            if ($validatedData['time-unit'] === '1'){
                $time_unit = 60;
            }
            else if ( $validatedData['time-unit'] === '2'){
                $time_unit = 3600;
            }

            $new_quiz = Quiz::create([
                'name' => $validatedData['name'],
                'time' => $validatedData['time'] * $time_unit,
                'description' => $validatedData['description'],
                'user_id' => auth()->id(),
                'quiz_type_id' => $validatedData['type'] + 1,
                'difficulty_id' => $validatedData['difficulty'],
            ]);

            // Handle subjects
            $subjects = json_decode($validatedData['subjects'], true);
            foreach ($subjects as $subject) {
                QuizSubject::create([
                    'quiz_id' => $new_quiz->id,
                    'subject_id' => $subject,
                ]);
            }

            // Handle questions
            $questions = json_decode($validatedData['questions'], true);
            foreach ($questions as $question) {
                $savedQuestion = $new_quiz->questions()->create(['text' => $question['questionText']]);
                foreach ($question['options'] as $option) {
                    $savedQuestion->choices()->create(['text' => $option]);
                }
            }
        });

        return redirect()->back()->with('success', 'Quiz created successfully!');
    }
}
