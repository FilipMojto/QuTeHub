@extends('base_layout')

@section('content')
<div class="quiz-specification-panel" style="display: block;">  

    <div class="header-submit-button-wrapper">
        <h2>Quiz Editor</h2>
        <button class="submit-button">Submit</button>
    </div>
        <!-- <button class="submit-button">Submit</button> -->


    <p>Please fill the following data to define your own quiz's parameters.</p>

    <div class="section-wrapper">
        <section class="general-info-section">
            <h3>Parameters</h3>
            <hr>

            <p>Selected quiz subjects are highlighted in <u style="color: rgb(1, 226, 1);"> green</u>.</p>

            <form class="general-info-form">
                <div class="name-difficulty-time-panel">
                    <fieldset class="general-info-form-input quiz-name-field input-design-one">
                        <legend>Name</legend>
                        <input class="input-design-one">
                    </fieldset>


                    <fieldset class="general-info-form-input quiz-difficulty-list input-design-one">
                        <legend>Difficulty</legend>

                        <select class="input-design-one">
                            <option>Easy</option>
                            <option>Moderate</option>
                            <option>Hard</option>
                        </select>
                    </fieldset>

                    <fieldset class="general-info-form-input quiz-time-field input-design-one">
                        <legend>Time</legend>
                        <input class="input-design-one" placeholder="---">
                        <select class="input-design-one">
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
                
                
            </form>
        </section>

        <section class="question-list-section">
            <h3>Questions</h3>
            <hr>

            <p>Use the <b>editor</b> below to set up your own Question List.</p>

            <div class="question-list-panel">
                <!-- <label id="empty-list-warning">[List is empty]</label> -->
                <div class="question-list" id="questionList">
                    <form id="demonstrativeQuestion" style="display: none;" class="question">
                        <div class="question-attributes">
                            <label class="question-no">1.</label>
                            <text class="question-text" placeholder="Insert question here">
                        </div>
                        
                        <div class="question-options">
                            <div class="question-option">
                                <label id="option-id" class="option-alpha">a)</label>
                                <input class="option-text" placeholder="Insert option here">
                            </div>
                        
                        </div>
                    </form>


                    <form style="display: flex;" class="question">
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
                    </form>

        
                </div>

                <div class="insert-question-button-wrapper">
                    <label><i>Insert Question ('alt + n')</i></label>
                    <img class="insert-question-icon" src="{{ URL::asset('/icons/insert_element.png') }}" width="50px" id="insertQuestionButton">
                </div>
            </div>
        </section>
    </div>

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
        
        // console.log('dssd');

        

        document.getElementById('insertQuestionButton').addEventListener('click', addNewQuestion);

        document.querySelectorAll('.question-option').forEach(option => {
            attachOptionEventListeners(option);
        });
    });
</script>
@endsection