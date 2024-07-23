@extends('base_layout')

@section('content')
<form class="quiz-specification-panel" id="editor-panel-form" method="POST" action="{{ route('quiz.store') }}">
    @csrf

    <input type="hidden" name="subjects" id="selected-subjects">
    <input type="hidden" name="difficulty" id="selected-difficulty">
    <input type="hidden" id="questionsData" name="questions">
    <input type="hidden" id="question-time-unit" name="time-unit"> 

    <div>
        <div class="quiz-editor-nav-menu">

     
            <h2 style="font-size: 1.3em;" style="grid-area: a;">Quiz Editor</h2>
            <div class="nav-menu-panel" style="grid-area: b;">
                <div class="arrow arrow-left"></div>
                <div class="nav-menu-options">
                    
                    <div class="menu-option-wrapper"><label for="" class="menu-option selected-menu-option">Parameters</label></div>
                    <div class="menu-option-wrapper"><label for="" class="menu-option">Question List</label></div>
                    <div class="menu-option-wrapper"><label for="" class="menu-option">Submissions</label></div>

                    <!-- <label class="menu-option selected-menu-option">Parameters</label>
                    <label class="menu-option">Question List</label>
                    <label class="menu-option">Submission</label> -->
                </div>
                <div class="arrow arrow-right"></div>
            </div>
     

       
                <!-- <button type="button" id="prev-panel-button" class="submit-button">Back</button> -->
            <input style="grid-area: c;" type="submit" id="next-panel-button" class="submit-button" value="Next">
        
        </div>
    </div>

    <div id="section-wrapper">
        <section class="general-info-section" style="display: block;">
            <h3>Parameters</h3>
            <hr>
            <section class="general-info-form">
                <div class="quiz-inputs-panel">

                    <div class="input-alert-wrapper">
                        <fieldset class="input-design-one">
                            <legend>Name</legend>
                            <input name="name" type="text" class="input-design-one" required>
                        </fieldset>

                        @if ($errors->has('name'))
                            <div class="alert-text-image-wrapper">
                                <img src="{{ URL::asset('icons/warning.png') }}" width="20px">
                                <label class="alert-text">{{ $errors->first('name') }}</label>
                            </div>
                        @endif
                    </div>
                    
                    <div class="input-alert-wrapper">
                        <fieldset class="input-design-one">
                            <legend>Difficulty</legend>
                            <select class="input-design-one" id="quiz-difficulty-list">
                                <option value="">---</option>
                                <option value="Easy">Easy</option>
                                <option value="Moderate">Moderate</option>
                                <option value="Hard">Hard</option>
                            </select>
                        </fieldset>

                        @if ($errors->has('difficulty'))
                            <div class="alert-text-image-wrapper">
                                <img src="{{ URL::asset('icons/warning.png') }}" width="20px">
                                <label class="alert-text">{{ $errors->first('difficulty') }}</label>
                            </div>
                        @endif
                    </div>

                    <div class="input-alert-wrapper">
                        <div class="time-value-unit-wrapper">

                        
                            <fieldset class="input-design-one">
                                <legend>Time</legend>
                                <input name="time" type="text" class="input-design-one" required>
                            </fieldset>
                            <fieldset class="input-design-one">
                                <legend>Unit</legend>
                                <select name="unit" class="input-design-one" id="quiz-time-unit-list">
                                    <!-- <option>---</option> -->
                                    <option>seconds</option>
                                    <option>minutes</option>
                                    <option>hours</option>
                                </select>
                            </fieldset>
                        </div>

                            @if ($errors->has('time'))
                                <div class="alert-text-image-wrapper">
                                    <img src="{{ URL::asset('icons/warning.png') }}" width="20px">
                                    <label class="alert-text">{{ $errors->first('time') }}</label>
                                </div>
                            @endif
                        
                    </div>
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

        <section class="question-list-section" style="display: none;">
            <h3>Question List</h3>
            <hr>
            <div class="question-list-panel">
                <div class="question-list" id="questionList">
                    <div id="demonstrativeQuestion" style="display: none;">
                        <div class="question-attributes">
                            <label class="question-no">1.</label>
                            <input class="question-text" placeholder="Insert question here">
                        </div>
                        <div class="question-options">
                            <div class="question-option">
                                <label class="option-alpha">a)</label>
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
                                <label class="option-alpha">a)</label>
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

        <section id="submission-section" style="display: none;">
            <h3>Submission</h3>
            <hr>
        </section>

    </div>

</form>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Navigation buttons
        // const prevButton = document.getElementById('prev-panel-button');
        const nextButton = document.getElementById('next-panel-button');
        const prevArrow = document.querySelector('.nav-menu-panel').querySelector('.arrow-left');
        const nextArrow = document.querySelector('.nav-menu-panel').querySelector('.arrow-right');

        const panels = document.querySelectorAll('#section-wrapper > section');
        const menuOptions = document.querySelector('.nav-menu-options').querySelectorAll('label');

        let currentPanelIndex = 0;

        function showPanel(index) {
            panels.forEach((panel, i) => {
                panel.style.display = i === index ? 'block' : 'none';
            });
        }

        function changeSelectedOption(index){
            menuOptions.forEach((option, i) => {
                if (i === index){
                    option.classList.add('selected-menu-option')
                }
                else{
                    option.classList.remove('selected-menu-option');

                }
            });
        }

        function processPrevPanelRequest(){
            if (currentPanelIndex > 0) {
                currentPanelIndex--;
                showPanel(currentPanelIndex);
                changeSelectedOption(currentPanelIndex);
            }
        }

        function processNextPanelRequest(){
            if (currentPanelIndex < panels.length - 1) {
                currentPanelIndex++;
                showPanel(currentPanelIndex);
                changeSelectedOption(currentPanelIndex);
            }
        }

        // prevButton.addEventListener('click', processPrevPanelRequest);
        prevArrow.addEventListener('click', processPrevPanelRequest);

        // nextButton.addEventListener('click', processNextPanelRequest);
        nextArrow.addEventListener('click', () => {
            const form = document.getElementById('editor-panel-form');
            if (form.reportValidity()){
                if(currentPanelIndex === panels.length - 1) {
                    form.submit();
                }
                else{
                    processNextPanelRequest();
                }
            }
        });


        showPanel(currentPanelIndex); // Initially show the first panel

        document.getElementById('editor-panel-form').addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent default form submission
            
            // Submission panel (last panel in the sequence) is reached
            if (currentPanelIndex === panels.length - 1){
                const subjectTagList = document.querySelector('.subject-tag-list');
                const selectedLabels = document.querySelectorAll('.quiz-subject-selected');
                const allLabels = Array.from(subjectTagList.children);
                const selectedIndices = Array.from(selectedLabels).map(label => {
                    return allLabels.indexOf(label);
                });

                document.getElementById('selected-subjects').value = JSON.stringify(selectedIndices);

                const difficultyList = document.getElementById('quiz-difficulty-list');
         
                document.getElementById('selected-difficulty').value = difficultyList.selectedIndex;
                // document.getElementById('selected-difficulty').type = 'text';

                const timeUnitList = document.getElementById('quiz-time-unit-list');
                document.getElementById('question-time-unit').value = timeUnitList.selectedIndex;


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
            }
            else{
                processNextPanelRequest();
            }

            
        });
        
    });

    document.getElementById('insertQuestionButton').addEventListener('click', addNewQuestion);

    document.querySelectorAll('.question-option').forEach(option => {
        attachOptionEventListeners(option);
    });

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
                    const prevOption = option.previousElementSibling;
                    if (prevOption) {
                        option.remove(); // Remove the element from the DOM
                        prevOption.querySelector('.option-text').focus();
                        event.preventDefault(); // Prevent default backspace action
                        event.stopPropagation(); // Stop event propagation
                        updateOptionId(prevOption.nextSibling, 0); // Decrement IDs for following options
                    }
                }
                else if (event.altKey && event.key === 'n') {
                    event.preventDefault(); // Prevent default browser behavior (e.g., opening a new window/tab)
                    addNewQuestion();
                }
            });
        }
    }

    function attachOptionEventListeners(option) {
        processOptionKeyEvent(option);
    }

    function addNewQuestion() {
        const questionList = document.getElementById('questionList');
        const demonstrativeQuestion = document.getElementById('demonstrativeQuestion');
        const newQuestion = demonstrativeQuestion.cloneNode(true);
        newQuestion.style.display = 'flex';

        const questionCount = questionList.getElementsByClassName('question').length + 1;
        newQuestion.querySelector('.question-no').textContent = `${questionCount}.`;
        questionList.appendChild(newQuestion);
        newQuestion.querySelector('.question-text').focus();

        newQuestion.querySelectorAll('.question-option').forEach(option => {
            attachOptionEventListeners(option);
        });

        document.getElementById('empty-list-warning').style.display = 'none';
    }

    
</script>

@endsection