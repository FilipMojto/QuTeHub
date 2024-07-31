@extends('base_layout')

@section('content')
<form class="quiz-specification-panel" id="editor-panel-form" method="POST" action="{{ route('quiz.store') }}">
    @csrf

    <!-- <input type="hidden" name="subjects" id="selected-subjects"> -->
    <input type="hidden" name="difficulty" id="selected-difficulty">
    <input type="hidden" name="type" id="selected-type">
    <input type="hidden" id="questionsData" name="questions">
    <input type="hidden" id="question-time-unit" name="time-unit"> 

    <div id="subjects-container"></div>

    <div>
        <div class="quiz-editor-nav-menu">

     
            <h2 style="font-size: 1.3em;" style="grid-area: a;">Quiz Editor</h2>
            <div class="nav-menu-panel" style="grid-area: b;">
                <div class="arrow arrow-left arrow-disabled"></div>
                <div class="nav-menu-options">
                    
                    <div class="menu-option-wrapper"><label class="menu-option selected-menu-option">Parameters</label></div>
                    <div class="menu-option-wrapper"><label class="menu-option">Question List</label></div>
                    <div class="menu-option-wrapper"><label class="menu-option">Submission</label></div>

                    <!-- <label class="menu-option selected-menu-option">Parameters</label>
                    <label class="menu-option">Question List</label>
                    <label class="menu-option">Submission</label> -->
                </div>
                <div class="arrow arrow-right arrow-right-enabled"></div>
            </div>
     

       
                <!-- <button type="button" id="prev-panel-button" class="submit-button">Back</button> -->
            <input style="grid-area: c;" type="submit" id="next-panel-button" class="submit-button" value="Next">
        
        </div>
    </div>

    @if ($errors->has('subjects'))
                            <div class="alert-text-image-wrapper">
                                <img src="{{ URL::asset('icons/warning.png') }}" width="20px">
                                <label class="alert-text">{{ $errors->first('subjects') }}</label>
                            </div>
                        @endif

    <div id="section-wrapper">
        <section id="general-info-section" class="quiz-editor-panel" style="display: block;">
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
                        <div class="type-difficulty-wrapper">
                            <fieldset class="input-design-one">
                                <legend>Type</legend>

                                <select id="quiz-type-list" class="input-design-one">
                                    <option value="">Quiz</option>
                                    <option value="">Test</option>
                                    <option value="">Questionnaire</option>
                                </select>
                            </fieldset>

                            <fieldset class="input-design-one">
                                <legend>Difficulty</legend>
                                <select class="input-design-one" id="quiz-difficulty-list">
                                    <option value="">---</option>
                                    <option value="Easy">Easy</option>
                                    <option value="Moderate">Moderate</option>
                                    <option value="Hard">Hard</option>
                                </select>
                            </fieldset>
                        </div>

                        @if ($errors->has('type'))
                            <div class="alert-text-image-wrapper">
                                <img src="{{ URL::asset('icons/warning.png') }}" width="20px">
                                <label class="alert-text">{{ $errors->first('type') }}</label>
                            </div>
                        @endif

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
                                <input name="time" type="text" class="input-design-one" required pattern="^[0-9]*$">
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


                <div class="input-alert-wrapper quiz-description-wrapper">
                    <fieldset class="general-info-form-input input-design-one">
                        <legend>Description</legend>
                        <textarea name="description" class="input-design-one quiz-description-area" placeholder="Add description text"></textarea>
                        
                    </fieldset>

                    @if ($errors->has('description'))
                        <div class="alert-text-image-wrapper">
                            <img src="{{ URL::asset('icons/warning.png') }}" width="20px">
                            <label class="alert-text">{{ $errors->first('description') }}</label>
                        </div>
                    @endif
                </div>


            </section>


        </section>

        <section id="question-list-section" class="quiz-editor-panel" style="display: none;">
            <h3>Question List</h3>
            <hr>
            <div class="question-list-panel">
                <div class="question-list" id="questionList">
                    <div id="demonstrativeQuestion" class="question" style="display: none;">
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

        <section id="submission-section" class="quiz-editor-panel" style="display: none;">
            <h3>Check & Submit</h3>
            <hr>

    
            <div class="quiz-content-wrapper">
                
                <fieldset class="parameter-list-wrapper">
                    <legend>Parameters</legend>
                    <div class="parameter-list">
                        <label>Name</label><label id="submission-quiz-name">Basic Math Quiz</label>
                        <label>Type</label><label id="submission-quiz-type">Quiz</label>
                        <label>Time</label><label id="submission-quiz-time">30min</label>
                        <label>Questions</label><label id="submission-question-count">40</label>
                        <label>Difficulty</label><label id="submission-quiz-difficulty">Easy</label>
                        <label>Subject(s)</label><label id="submission-quiz-subjects"></label>
                        <label>Creator</label> <label id="submission-quiz-creator">Joseph Kirk</label>
                        
                    </div>
                </fieldset>

                

                <fieldset class="quiz-description-text">
                    <legend>Description</legend>

                    <p id="submission-quiz-description">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                </fieldset>
                
                <fieldset>
                    <legend>Image</legend>
                <img class="quiz-image" src="{{ URL::asset('/img/math_theme.png') }}" width="220px">
                </fieldset>
            </div>
    
            
    
        </section>

    </div>

</form>

<script>
    /**
     * @param {string} name of element to validate
     * @param {Array<string>} array of classes element needs to contain
     * @returns {Boolean} true if element was validated successfully false otherwise;
     * 
     **/
    function validateElement(element, classList){
        if (!element){
            return false;
        }

        for(class_ in classList){
            if (!element.classList.contains(class_)){
                return false;
            }
        }

        return true;
    }

// ############################ quiz-editor --- dynamic panel switching ############################ //


//     document.addEventListener('DOMContentLoaded', () => {

//         const nextButton = document.getElementById('next-panel-button');
//         const prevArrow = document.querySelector('.nav-menu-panel').querySelector('.arrow-left');
//         const nextArrow = document.querySelector('.nav-menu-panel').querySelector('.arrow-right');

//         const panels = document.querySelectorAll('#section-wrapper > section');
//         const menuOptions = document.querySelector('.nav-menu-options').querySelectorAll('label');

//         let currentPanelIndex = 0;

//         function showPanel(index) {
//             panels.forEach((panel, i) => {
//                 panel.style.display = i === index ? 'block' : 'none';
//             });
//         }

//         function changeSelectedOption(index){
//             menuOptions.forEach((option, i) => {
//                 if (i === index){
//                     option.classList.add('selected-menu-option')
//                 }
//                 else{
//                     option.classList.remove('selected-menu-option');

//                 }
//             });
//         }

//         let disableNextClick = false;

//         function addNextPanelEventListener(element){
//             element.addEventListener('click', () => {
//                 if (disableNextClick) return;

//                 const form = document.getElementById('editor-panel-form');
//                 if (form.reportValidity()){
//                     if(currentPanelIndex === panels.length - 1) {
//                         form.submit();
//                     }
//                     else{
//                         processNextPanelRequest();

//                         if (currentPanelIndex === panels.length - 1){
//                             nextArrow.classList.remove('arrow-right-enabled');
//                             disableNextClick = true; // Disable further clicks
//                             currentPanelIndex;
//                         }
//                     }
//                 }
//             });
//         }

//         function processPrevPanelRequest(){
//             console.log(currentPanelIndex)

//             if (currentPanelIndex > 0) {
//                 disableNextClick = false;

//                 if (currentPanelIndex === 1){
//                     prevArrow.classList.remove('arrow-left-enabled');
//                 }

//                 currentPanelIndex--;
//                 showPanel(currentPanelIndex);
//                 changeSelectedOption(currentPanelIndex);
//                 nextArrow.classList.add('arrow-right-enabled');
//                 // nextArrow.classList.remove('arrow-disabled');
//                 // addNextPanelEventListener(nextArrow);
//             }
            
//         }

//         function processNextPanelRequest(){
//             if (currentPanelIndex === 0){

//             }

//             if (currentPanelIndex < panels.length - 1) {

               
                
//                 currentPanelIndex++;
//                 showPanel(currentPanelIndex);
//                 changeSelectedOption(currentPanelIndex);
//                 // prevArrow.classList.remove('arrow-disabled');
//                 prevArrow.classList.add('arrow-left-enabled');

//                 // if (currentPanelIndex === 1){
//                 //     nextArrow.classList.add('arrow-disabled');
//                 //     nextArrow.removeEventListener('click', preventDefault, true);

//                 // }
//             }
//             // else if (currentPanelIndex === panels.length - 1){
//             //     nextArrow.classList.add('arrow-disabled');
//             //         nextArrow.removeEventListener('click', preventDefault, true);
//             // }
//         }

//         // prevButton.addEventListener('click', processPrevPanelRequest);
//         prevArrow.addEventListener('click', processPrevPanelRequest);

//         addNextPanelEventListener(nextArrow);
//         // nextButton.addEventListener('click', processNextPanelRequest);
//         // nextArrow.addEventListener('click', () => {
//         //     const form = document.getElementById('editor-panel-form');
//         //     if (form.reportValidity()){
//         //         if(currentPanelIndex === panels.length - 1) {
//         //             form.submit();
//         //         }
//         //         else{
//         //             processNextPanelRequest();
//         //         }
//         //     }
//         // });


//         //showPanel(currentPanelIndex); // Initially show the first panel



// // ############################ editor-panel-form --- submission process ############################ //


//         document.getElementById('editor-panel-form').addEventListener('submit', function (event) {

//             if (currentPanelIndex === 0){
//                 const quizParams = {
//                     name: document.querySelector('[name="name"]').value,
//                     type: document.querySelector('[name="type"]').value,
//                     difficulty: document.querySelector('[name="difficulty"]').value,
//                     time: 
//                 }
//             }

//             $.ajax({
//                 url: '/validate-editor-panel',
//                 type: 'POST',
//                 data
//             })

//             event.preventDefault(); // Prevent default form submission
            
//             // Submission panel (last panel in the sequence) is reached
//             if (currentPanelIndex === panels.length - 1){
//                 // console.log("VALUE!");
//                 // console.log(document.getElementById('quiz-type-list').selectedIndex);
//                 document.getElementById('selected-type').value = document.getElementById('quiz-type-list').selectedIndex;

//                 // const subjectTagList = document.querySelector('.subject-tag-list');
//                 // const selectedLabels = subjectTagList.querySelectorAll('.quiz-subject-selected');
//                 // const allLabels = Array.from(subjectTagList.children);
//                 // // const selectedIndices = Array.from(selectedLabels).map(label => {
//                 // //     return allLabels.indexOf(label);
//                 // // });

//                 const selectedIndices = [];

//                 const tags = document.querySelector('.subject-tag-list').children;

//                 for (let i = 0; i < tags.length; i++) {
//                     const tag = tags[i];
//                     if (tag.classList.contains('quiz-subject-selected')) {
//                         selectedIndices.push(i);
//                     }
//                 }

//                 document.getElementById('selected-subjects').value = JSON.stringify(selectedIndices);

//                 const difficultyList = document.getElementById('quiz-difficulty-list');
         
//                 document.getElementById('selected-difficulty').value = difficultyList.selectedIndex;
//                 // document.getElementById('selected-difficulty').type = 'text';

//                 const timeUnitList = document.getElementById('quiz-time-unit-list');
//                 document.getElementById('question-time-unit').value = timeUnitList.selectedIndex;


//                 const questions = [];
//                 const questionList = document.querySelectorAll('.question-list .question');
//                 questionList.forEach((questionElem, index) => {
//                     const questionText = questionElem.querySelector('.question-text').value;
//                     const options = [];
//                     questionElem.querySelectorAll('.question-option').forEach(optionElem => {
//                         options.push(optionElem.querySelector('.option-text').value);
//                     });
//                     questions.push({
//                         questionText: questionText,
//                         options: options
//                     });
//                 });
//                 document.getElementById('questionsData').value = JSON.stringify(questions);

//                 event.target.submit(); // Submit the form
//             }
//             else{
//                 processNextPanelRequest();
//             }

            
//         });
        
//     });



// // ############################ question-list-editor --- event processing ############################ //



//     document.getElementById('insertQuestionButton').addEventListener('click', addNewQuestion);

//     document.querySelectorAll('.question-option').forEach(option => {
//         processOptionKeyEvent(option);
//     });


//     document.querySelectorAll('.question-text').forEach(processOptionKeyEvent);
    

//     function updateOptionId(option, operation) {

//     // this function updates question-option ordinal number based on operation request. This update is carried out on
//     // current option and on all its subsequent option siblings.
//     // operation: int
//     //  a) 0 - decrement no.
//     //  b) 1 - increment no.

//         if (option) {
//             const optionId = option.querySelector('.option-alpha');
//             const currentCharCode = optionId.textContent.charCodeAt(0);
//             let newCharCode;

//             if (operation === 1) {
//                 newCharCode = currentCharCode + 1; // Increment
//             } else if (operation === 0) {
//                 newCharCode = currentCharCode - 1; // Decrement
//             } else {
//                 return; // Invalid operation
//             }

//             optionId.textContent = String.fromCharCode(newCharCode) + ')';

//             if (option.nextSibling) {
//                 updateOptionId(option.nextSibling, operation);
//             }
//         }
//     }

//     function processOptionKeyEvent(option){

//         // this function contains processing logic for all option-text or question-text elements
//         // function contains all required keydown events and their mapped procedures

//         if(option){
//             option.addEventListener('keydown', function(event) {
//                 if (event.key === "Enter") {
//                     event.preventDefault();
//                     const newOption = option.cloneNode(true);
//                     const newOptionText = newOption.querySelector('.option-text');
//                     newOptionText.value = "";
//                     option.parentElement.insertBefore(newOption, option.nextSibling);
//                     processOptionKeyEvent(newOption);
//                     newOptionText.focus();
//                     updateOptionId(newOption, 1);
//                 }
//                 else if (event.key === "ArrowDown") {
    
//                     if (option.className === 'question-option') {
//                         const nextElement = option.nextElementSibling;
//                         if (nextElement){
//                             nextElement.querySelector('.option-text').focus();
//                         }
//                         else{
//                             option.parentElement.parentElement.nextElementSibling.querySelector('.question-text').focus();
//                         }
//                     }
//                     else{
//                         option.parentElement.nextElementSibling.querySelector('.question-option > .option-text').focus();
//                     }
//                 }
//                 else if (event.key === "ArrowUp") {

                
//                     if (option.className === 'question-option') {
//                         const prevElement = option.previousElementSibling;
//                         if (prevElement){
//                             prevElement.querySelector('.option-text').focus();
//                         }
//                         else{
//                             option.parentElement.previousElementSibling.querySelector('.question-text').focus();
//                         }
//                     }
//                     else{
//                         option.parentElement.parentElement.previousElementSibling.querySelector('.question-option:last-child > .option-text').focus();
//                     }
//                 }
//                 else if (event.key === "Backspace" && option.querySelector('.option-text').value === ''){
//                     const prevOption = option.previousElementSibling;
//                     if (prevOption) {
//                         option.remove(); // Remove the element from the DOM
//                         prevOption.querySelector('.option-text').focus();
//                         event.preventDefault(); // Prevent default backspace action
//                         event.stopPropagation(); // Stop event propagation
//                         updateOptionId(prevOption.nextSibling, 0); // Decrement IDs for following options
//                     }
//                 }
//                 else if (event.altKey && event.key === 'n') {
//                     event.preventDefault(); // Prevent default browser behavior (e.g., opening a new window/tab)
//                     addNewQuestion();
//                 }
//             });
//         }
//     }



//     function addNewQuestion() {
//         const questionList = document.getElementById('questionList');
        
//         const demonstrativeQuestion = document.getElementById('demonstrativeQuestion');
//         const newQuestion = demonstrativeQuestion.cloneNode(true);
//         newQuestion.style.display = 'flex';

//         const questionCount = questionList.getElementsByClassName('question').length;
//         newQuestion.querySelector('.question-no').textContent = `${questionCount}.`;
//         questionList.appendChild(newQuestion);
//         newQuestion.querySelectorAll('.question-text').forEach(processOptionKeyEvent);
//         newQuestion.querySelector('.question-text').focus();

//         newQuestion.querySelectorAll('.question-option').forEach(option => {
//             processOptionKeyEvent(option);
//         });

//         // document.getElementById('empty-list-warning').style.display = 'none';
//     }


</script>

@endsection