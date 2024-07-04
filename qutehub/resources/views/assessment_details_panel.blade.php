@extends('layouts.layout')

@section('content')

    <section class="assessment-description-panel">
        <h2>Basic Math Quiz</h2>

        <div class="description-content">  
            <div class="assessment-description">

                <div class="assessment-attributes">
                    <label>Type:</label> <label>Quiz</label>
                    <label>Time:</label> <label>20min</label>
                    <label>Questions:</label> <label>30</label>
                    <label>Difficulty:</label> <label>Easy</label>
                    <label>Testers:</label> <label>1920</label>
                    <label>Creator:</label> <label>Joseph Kirk</label>
                    <label>Created at:</label> <label>29.05.2020</label>
                    <label>Updated at:</label> <label>14.07.2022</label>
                </div>

                <section class="description-container">
                    <h3>Description</h3>
                    <article>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                    </article>
                </section>
            </div>

            <div class="assessment-image-accept-button">
                <img src={{ URL::asset('img/math_theme.png');}} width="300px">
                <button>Take the Quiz</button>
            </div>
        </div>
    </section>

@endsection