@extends('base_layout')

@section('content')
<div class="quiz-specification-panel" style="display: block;">  

    <form id="editor-panel-form" method="POST" action="{{ route('quiz.store') }}">
        @csrf

        <input type="hidden" name="subjects" id="selected-subjects">
        <input type="hidden" name="difficulty" id="selected-difficulty">
        <input type="hidden" id="questionsData" name="questions">

        <div class="header-submit-button-wrapper">
            <h2>Quiz Editor</h2>
            <input type="submit" class="submit-button">
            <div class="alert">
                @if ($errors->has('name'))
                    <div class="alert">{{ $errors->first('name') }}</div>
                @elseif ($errors->has('difficulty'))
                    <div class="alert">{{ $errors->first('difficulty') }}</div>
                @elseif ($errors->has('time'))
                    <div class="alert">{{ $errors->first('time') }}</div>
                @elseif ($errors->has('questions'))
                    <div class="alert">{{ $errors->first('questions') }}</div>
                @elseif ($errors->has('subjects'))
                    <div class="alert">{{ $errors->first('subjects') }}</div>
                @endif
            </div>
        </div>
            <!-- <button class="submit-button">Submit</button> -->


        <p style="max-width: 40em;">Please fill the following data to define your own quiz's parameters. To define questions use the editor below.</p>
        <!-- <p>To define questions use the editor below.</p> -->

        <div class="section-wrapper">
            <section class="general-info-section">
                <h3>Parameters</h3>
                <hr>

                <!-- <p>Selected quiz subjects are highlighted in <u style="color: rgb(1, 226, 1);"> green</u>.</p> -->

                <section class="general-info-form">
                    <div class="name-difficulty-time-panel">
                        <fieldset class="general-info-form-input quiz-name-field input-design-one">
                            <legend>Name</legend>
                            <input name="name" class="input-design-one" required>
                        </fieldset>


                        <fieldset class="general-info-form-input quiz-difficulty-list input-design-one">
                            <legend>Difficulty</legend>

                            <select class="input-design-one" required>
                                <option>Easy</option>
                                <option>Moderate</option>
                                <option>Hard</option>
                            </select>
                        </fieldset>

                        <fieldset class="general-info-form-input quiz-time-field input-design-one">
                            <legend>Time</legend>
                            <input name="time" class="input-design-one" placeholder="---" required>
                            <select class="input-design-one" required>
                                <option>minutes</option>
                                <option>seconds</option>
                                <option>hours</option>
                            </select>
                        </fieldset>
                    </div>

                    <fieldset class="general-info-form-input subject-tag-list input-design-one">
                        <legend>Subject</legend>

                        <label class="quiz-subject">Math</label>
                        <label class="quiz-subject">Geography</label>
                        <label class="quiz-subject">Language</label>
                        <label class="quiz-subject">History</label>
                        <label class="quiz-subject">Science</label>
                        <label class="quiz-subject">Biology</label>
                        <label class="quiz-subject">Chemistry</label>
                        <label class="quiz-subject">Physics</label>
                    </fieldset>
                    
                    
                </section>
            </section>

            <section class="question-list-section">
                <h3>Questions</h3>
                <hr>

                <!-- <p>Use the <b>editor</b> below to set up your own Question List.</p> -->

                <div class="question-list-panel">
                    <!-- <label id="empty-list-warning">[List is empty]</label> -->
                    <div class="question-list" id="questionList">
                        <div id="demonstrativeQuestion" style="display: none;">
                            <div class="question-attributes">
                                <label class="question-no">1.</label>
                                <input class="question-text" placeholder="Insert question here">
                            </div>
                            
                            <div class="question-options">
                                <div class="question-option">
                                    <label id="option-id" class="option-alpha">a)</label>
                                    <input class="option-text" placeholder="Insert option here">
                                </div>
                            
                            </div>
                        </div>


                        <div style="display: flex;" class="question">
                            <div class="question-attributes">
                                <label class="question-no">1.</label>
                                <input class="question-text" placeholder="Insert question here">
                            </div>
                            
                            <div class="question-options">
                                <div class="question-option">
                                    <label id="option-id" class="option-alpha">a)</label>
                                    <input class="option-text" placeholder="Insert option here">
                                </div>
                            
                            </div>
                        </div>

            
                    </div>

                    <div class="insert-question-button-wrapper">
                        <label><i>Insert Question ('alt + n')</i></label>
                        <img class="insert-question-icon" src="{{ URL::asset('/icons/insert_element.png') }}" width="50px" id="insertQuestionButton">
                    </div>
                </div>
            </section>
        </div>
    </form>


    <!-- <button class="submit-button">Submit</button> -->
</div>

<script>
    function updateOptionId(option, operation) {
        if (option) {
            const optionId = option.querySelector('.option-alpha');
            const currentCharCode = optionId.textContent.charCodeAt(0);
            let newCharCode;

            if (operation === 1) {
                newCharCode = currentCharCode + 1; // Increment
            } else if (operation === 0) {
                newCharCode = currentCharCode - 1; // Decrement
            } else {
                return; // Invalid operation
            }

            optionId.textContent = String.fromCharCode(newCharCode) + ')';

            if (option.nextSibling) {
                updateOptionId(option.nextSibling, operation);
            }
        }
    }


    function processOptionKeyEvent(option){
        if(option){
            option.addEventListener('keydown', function(event) {
                if (event.key === "Enter") {
                    event.preventDefault();
                    const newOption = option.cloneNode(true);
                    const newOptionText = newOption.querySelector('.option-text');
                    newOptionText.value = "";
                    option.parentElement.insertBefore(newOption, option.nextSibling);
                    attachOptionEventListeners(newOption);
                    newOptionText.focus();
                    updateOptionId(newOption, 1);
                }
                else if (event.key === "ArrowDown") {
                    const nextOption = option.nextElementSibling;
                    if (nextOption) {
                        nextOption.querySelector('.option-text').focus();
                    }
                }
                else if (event.key === "ArrowUp") {
                    const prevOption = option.previousElementSibling;
                    if (prevOption) {
                        prevOption.querySelector('.option-text').focus();
                    }
                }
                else if (event.key === "Backspace" && option.querySelector('.option-text').value === ''){
                    // option.style.display = 'none';
                    const prevOption = option.previousElementSibling;
                    if (prevOption) {
                        // const parent = option.parentElement;
                        option.remove(); // Remove the element from the DOM
                        // updateOptionId(prevOption.nextSibling, 0); // Decrement IDs for following options
                        prevOption.querySelector('.option-text').focus();
                        event.preventDefault(); // Prevent default backspace action
                        event.stopPropagation(); // Stop event propagation
                        updateOptionId(prevOption.nextSibling, 0); // Decrement IDs for following options

                    }
                }
                else if (event.altKey && event.key === 'n') {
                    // console.log("pressed n!");
                    // Your logic when Ctrl + N is pressed
                    
                    event.preventDefault(); // Prevent default browser behavior (e.g., opening a new window/tab)
                    addNewQuestion();
                }

            });
        }
    }


    function attachOptionEventListeners(option) {
        processOptionKeyEvent(option);
    }

    function addNewQuestion(option) {
        // console.log('dssd');
    
        const questionList = document.getElementById('questionList');
        const demonstrativeQuestion = document.getElementById('demonstrativeQuestion');
        const newQuestion = demonstrativeQuestion.cloneNode(true);
        newQuestion.style.display = 'flex';

        const questionCount = questionList.getElementsByClassName('question').length + 1;
        newQuestion.querySelector('.question-no').textContent = `${questionCount - 1}.`;
        // newQuestion.querySelectorAll('input').forEach(input => input.value = '');
        questionList.appendChild(newQuestion);
        newQuestion.querySelector('.question-text').focus();
    

        newQuestion.querySelectorAll('.question-option').forEach(option => {
            attachOptionEventListeners(option);
        });

        document.getElementById('empty-list-warning').style.display = 'none';
    };

    document.addEventListener('DOMContentLoaded', () => {
    
        document.getElementById('insertQuestionButton').addEventListener('click', addNewQuestion);

        document.querySelectorAll('.question-option').forEach(option => {
            attachOptionEventListeners(option);
        });
    });

    document.getElementById('editor-panel-form').addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent default form submission

        const subjectTagList = document.querySelector('.subject-tag-list');
        const selectedLabels = document.querySelectorAll('.quiz-subject-selected');
        const allLabels = Array.from(subjectTagList.children);
        const selectedIndices = Array.from(selectedLabels).map(label => {
            return allLabels.indexOf(label);
        });

        document.getElementById('selected-subjects').value = JSON.stringify(selectedIndices);

        const difficultyList = document.querySelector('.quiz-difficulty-list select');
        document.getElementById('selected-difficulty').value = difficultyList.selectedIndex;
        document.getElementById('selected-difficulty').type = 'text';

        const questions = [];
        const questionList = document.querySelectorAll('.question-list .question');
        questionList.forEach((questionElem, index) => {
            const questionText = questionElem.querySelector('.question-text').value;
            const options = [];
            questionElem.querySelectorAll('.question-option').forEach(optionElem => {
                options.push(optionElem.querySelector('.option-text').value);
            });
            questions.push({
                questionText: questionText,
                options: options
            });
        });
        document.getElementById('questionsData').value = JSON.stringify(questions);

        event.target.submit(); // Submit the form
    });
</script>

@endsection