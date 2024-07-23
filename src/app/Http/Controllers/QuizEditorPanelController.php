<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\QuestionChoice;
use App\Models\QuizSubject;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;

class QuizEditorPanelController extends Controller
{
    public function view_specification_panel()
    {
        return view('QuizEditorPanel');
    }

    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Name is required.',
            'name.unique' => 'Name is already taken.',
            'name.max' => 'Name must not exceed 50 characters.',
            'name.min' => 'Name must contain at least 6 characters.',
            'difficulty.required' => 'Difficulty is required.',
            'difficulty.max' => 'Difficulty must not exceed 6 characters.',
            'time.required' => 'Time is required.',
            'time.max' => 'Time must not exceed 5 digits.',
        ];

        $validatedData = $request->validate([
            'name' => 'required|string|min:6|max:50|unique:quizzes,name',
            'difficulty' => 'integer',
            'time' => 'required|integer|max:99999',
            'time-unit' => 'required|integer',
            'subjects' => 'required|string',
            'questions' => 'required|string'
        ], $messages);

        // Log validated data to see what is being passed
        Log::info('Validated Data: ', $validatedData);

        
        

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
                'user_id' => auth()->id(),
                'difficulty_id' => $validatedData['difficulty'] + 1,
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
