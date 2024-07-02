<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuTeHub</title>

    <link rel="stylesheet" href={{ URL::asset('css/header.css'); }}>
    <link rel="stylesheet" href={{ URL::asset('css/main.css'); }}>
    <link rel="stylesheet" href={{ URL::asset('css/footer.css'); }} >
    <link rel="stylesheet" href={{ URL::asset('css/homepage.css'); }}  >
    <link rel="stylesheet" href={{ URL::asset('css/utils.css'); }} >


</head>
<body>
    
    <main> -->
@extends('layouts.layout')

@section('content')
    <section id="popular-assessments-section">
        <h2>Popular</h2>
        <hr>


        <div class="quiz-list">
            <div class="quiz-element">
                <h3>Basic Math Quiz</h3>
                <hr>
                <article>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</article>
                
                <div class="quiz-attributes">
                    <span class="quiz-time">
                        <img src={{ URL::asset('icons/quiz_time_icon.png'); }} width="20px">

                        <!-- <img src="static/icons/quiz_time_icon.png" width="20px"> -->
                        <label>20min</label>
                    </span>
    
                    <span class="quiz-question-count">
                        <img src={{ URL::asset('icons/question-sign.png'); }} width="20px">

                        <!-- <img src="static/icons/question-sign.png" width="20px"> -->
                        <label>50</label>
                    </span>
    
                    <span class="quiz-difficulty">
                    <label>easy</label>
                    </span>
                </div>
    
                <div class="category-tag-list">
    
                    <div class="category-tag">
                        <label>math</label>
                    </div>
                </div>
            </div>


            <div class="quiz-element">
                <h3>Basic Math Quiz</h3>
                <hr>
                <article>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</article>
                
                <div class="quiz-attributes">
                    <span class="quiz-time">
                        <img src="static/icons/quiz_time_icon.png" width="20px">
                        <label>20min</label>
                    </span>
    
                    <span class="quiz-question-count">
                        <img src="static/icons/question-sign.png" width="20px">
                        <label>50</label>
                    </span>
    
                    <span class="quiz-difficulty">
                    <label>easy</label>
                    </span>
                </div>
    
                <div class="category-tag-list">
    
                    <div class="category-tag">
                        <label>math</label>
                    </div>
                </div>
            </div>


            <div class="quiz-element">
                <h3>Basic Math Quiz</h3>
                <hr>
                <article>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</article>
                
                <div class="quiz-attributes">
                    <span class="quiz-time">
                        <img src="static/icons/quiz_time_icon.png" width="20px">
                        <label>20min</label>
                    </span>
    
                    <span class="quiz-question-count">
                        <img src="static/icons/question-sign.png" width="20px">
                        <label>50</label>
                    </span>
    
                    <span class="quiz-difficulty">
                    <label>easy</label>
                    </span>
                </div>
    
                <div class="category-tag-list">
    
                    <div class="category-tag">
                        <label>math</label>
                    </div>
                </div>
            </div>


            <div class="quiz-element">
                <h3>Basic Math Quiz</h3>
                <hr>
                <article>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</article>
                
                <div class="quiz-attributes">
                    <span class="quiz-time">
                        <img src="static/icons/quiz_time_icon.png" width="20px">
                        <label>20min</label>
                    </span>
    
                    <span class="quiz-question-count">
                        <img src="static/icons/question-sign.png" width="20px">
                        <label>50</label>
                    </span>
    
                    <span class="quiz-difficulty">
                    <label>easy</label>
                    </span>
                </div>
    
                <div class="category-tag-list">
    
                    <div class="category-tag">
                        <label>math</label>
                    </div>
                </div>
            </div>



            <div class="quiz-element">
                <h3>Basic Math Quiz</h3>
                <hr>
                <article>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</article>
                
                <div class="quiz-attributes">
                    <span class="quiz-time">
                        <img src="static/icons/quiz_time_icon.png" width="20px">
                        <label>20min</label>
                    </span>
    
                    <span class="quiz-question-count">
                        <img src="static/icons/question-sign.png" width="20px">
                        <label>50</label>
                    </span>
    
                    <span class="quiz-difficulty">
                    <label>easy</label>
                    </span>
                </div>
    
                <div class="category-tag-list">
    
                    <div class="category-tag">
                        <label>math</label>
                    </div>
                </div>
            </div>



            <div class="quiz-element">
                <h3>Basic Math Quiz</h3>
                <hr>
                <article>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</article>
                
                <div class="quiz-attributes">
                    <span class="quiz-time">
                        <img src="static/icons/quiz_time_icon.png" width="20px">
                        <label>20min</label>
                    </span>
    
                    <span class="quiz-question-count">
                        <img src="static/icons/question-sign.png" width="20px">
                        <label>50</label>
                    </span>
    
                    <span class="quiz-difficulty">
                    <label>easy</label>
                    </span>
                </div>
    
                <div class="category-tag-list">
    
                    <div class="category-tag">
                        <label>math</label>
                    </div>
                </div>
            </div>



            <div class="quiz-element">
                <h3>Basic Math Quiz</h3>
                <hr>
                <article>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</article>
                
                <div class="quiz-attributes">
                    <span class="quiz-time">
                        <img src="static/icons/quiz_time_icon.png" width="20px">
                        <label>20min</label>
                    </span>
    
                    <span class="quiz-question-count">
                        <img src="static/icons/question-sign.png" width="20px">
                        <label>50</label>
                    </span>
    
                    <span class="quiz-difficulty">
                    <label>easy</label>
                    </span>
                </div>
    
                <div class="category-tag-list">
    
                    <div class="category-tag">
                        <label>math</label>
                    </div>
                </div>
            </div>



            <div class="quiz-element">
                <h3>Basic Math Quiz</h3>
                <hr>
                <article>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</article>
                
                <div class="quiz-attributes">
                    <span class="quiz-time">
                        <img src="static/icons/quiz_time_icon.png" width="20px">
                        <label>20min</label>
                    </span>
    
                    <span class="quiz-question-count">
                        <img src="static/icons/question-sign.png" width="20px">
                        <label>50</label>
                    </span>
    
                    <span class="quiz-difficulty">
                    <label>easy</label>
                    </span>
                </div>
    
                <div class="category-tag-list">
    
                    <div class="category-tag">
                        <label>math</label>
                    </div>
                </div>
            </div>

            
        </div>


    </section>

    <section id="recomended-assessments-section">
        <h2>Recommended</h2>
        <hr>
    </section>
@endsection
