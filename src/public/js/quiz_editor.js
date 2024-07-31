

document.addEventListener('DOMContentLoaded', () => {



// ############################ panel switching by arrows ############################ //


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

    let disableNextClick = false;

    function addNextPanelEventListener(element){
        element.addEventListener('click', async () => {
            if (disableNextClick) return;

            const form = document.getElementById('editor-panel-form');
            
            
            // form.dispatchEvent(new Event('submit', { cancelable: true }));
            const result = await handleFormSubmission.call(form, new Event('submit', { cancelable: true }));
            // if(currentPanelIndex === panels.length - 1) {
            //     form.submit();
            // }
            if(currentPanelIndex < panels.length - 1 && result){
                // processNextPanelRequest();

                if (currentPanelIndex === panels.length - 1){
                    nextArrow.classList.remove('arrow-right-enabled');
                    disableNextClick = true; // Disable further clicks
                    currentPanelIndex;
                }
            }
        });
    }

    function processPrevPanelRequest(){

        if (currentPanelIndex > 0) {
            disableNextClick = false;

            if (currentPanelIndex === 1){
                prevArrow.classList.remove('arrow-left-enabled');
            }

            currentPanelIndex--;
            showPanel(currentPanelIndex);
            changeSelectedOption(currentPanelIndex);
            nextArrow.classList.add('arrow-right-enabled');
            document.querySelector('.quiz-specification-panel input[type="submit"]').classList.remove('submit-button-pulsing');

        }
        
    }

    function processNextPanelRequest(){

        if (currentPanelIndex < panels.length - 1) {


            if (currentPanelIndex === panels.length - 2){
                nextArrow.classList.remove('arrow-right-enabled');
            }

            currentPanelIndex++;
            showPanel(currentPanelIndex);
            changeSelectedOption(currentPanelIndex);
            prevArrow.classList.add('arrow-left-enabled');
        }

    }


    prevArrow.addEventListener('click', processPrevPanelRequest);
    addNextPanelEventListener(nextArrow);




// ############################ editor-panel-form --- submission process ############################ //
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const quizAttributes = {
        name: '',
        type: '',
        difficulty: '',
        time: '',
        unit: '',
        subjects: '',
        description: '',
        questions: ''

    };

    

    const panelForm = document.getElementById('editor-panel-form');
    let selectedSubjects = [];

    async function handleFormSubmission(event) {
        event.preventDefault(); // Prevent default form submission
        // console.log("hehe2");
        if (!panelForm.reportValidity()){
            return false;
        }

        if (currentPanelIndex < panels.length - 2){
            document.querySelector('.quiz-specification-panel input[type="submit"]').classList.remove('submit-button-pulsing');
        }
        else{
            document.querySelector('.quiz-specification-panel input[type="submit"]').classList.add('submit-button-pulsing');

        }

        

        if (currentPanelIndex === 0){
       
            try{
            
                // extracting and converting data into required format

                // -> quiz-type
                document.getElementById('selected-type').value = document.getElementById('quiz-type-list').selectedIndex;
                // Quiz Parameters Needed For Verificaton
                
                // -> quiz-difficulty
                const difficultyList = document.getElementById('quiz-difficulty-list');
        
                document.getElementById('selected-difficulty').value = difficultyList.selectedIndex;
                // document.getElementById('selected-difficulty').type = 'text';

                // -> quiz-time-unit
                const timeUnitList = document.getElementById('quiz-time-unit-list');
                document.getElementById('question-time-unit').value = timeUnitList.selectedIndex;

                // -> quiz-subjsts
                const selectedSubjectIndices = [];

                const tags = document.querySelector('.subject-tag-list').children;

                selectedSubjects = [];
                for (let i = 0; i < tags.length; i++) {
                    const tag = tags[i];
                    
                    if (tag.classList.contains('quiz-subject-selected')) {
                        selectedSubjectIndices.push(i);
                        
                        
                        selectedSubjects.push(tags[i]);
                        console.log(selectedSubjects.length);
                    }
                }

                const container = document.getElementById('subjects-container');
                selectedSubjectIndices.forEach(subject => {
                    const input = document.createElement('input');
                    input.type = 'hidden'; // Use hidden inputs to avoid showing them on the page
                    input.name = 'subjects[]'; // Use array notation
                    input.value = subject;
                    container.appendChild(input);
                });

                // document.getElementById('selected-subjects').value = JSON.stringify(selectedSubjectIndices);

                // ------------------- //
                
                // filling request data with quiz params for validation


                quizAttributes['name'] = document.querySelector('[name="name"]').value;
                quizAttributes['type'] = document.querySelector('[name="type"]').value;
                quizAttributes['difficulty'] = document.querySelector('[name="difficulty"]').value;
                quizAttributes['time'] = document.querySelector('[name="time"]').value;
                quizAttributes['time-unit'] = document.querySelector('[name="time-unit"]').value;
                console.log(selectedSubjectIndices);
                quizAttributes['subjects'] = selectedSubjectIndices;
                
        
                const response = await fetch('/validate-quiz-params', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify(quizAttributes)
                });

                const data = await response.json();

                // .then(response => response.json())
                // .then(data => {
                if (data.errors) {
                    console.log('Errors:', data.errors);
                    for (const [field, messages] of Object.entries(data.errors)) {
                        alert(`Error in ${field}: ${messages.join(', ')}`);
                    }

                    return false;
                } else {
                    // console.log('Validation Passed:', data.message);
                    // alert(data.message);

                    
                    processNextPanelRequest();
                    return true;
                    
                }
                //})
                //.catch(error => console.error('Errors:', error));
            } catch(error){
                console.error('Errors:', error);
                return false;
            }
        }

        else if(currentPanelIndex === panels.length - 2){
            // console.log("hehe");
            document.getElementById('submission-quiz-name').innerHTML = quizAttributes['name'];
            document.getElementById('submission-quiz-type').innerHTML = document.getElementById('quiz-type-list').options[document.getElementById('quiz-type-list').selectedIndex].text;


            // Set the initial quiz time
            let quizTime = parseFloat(quizAttributes['time']);
            let timeUnit = parseInt(quizAttributes['time-unit']);
            console.log(timeUnit);
            
            // Check the quiz time unit and adjust the time accordingly
            if (timeUnit === 0) {
                quizTime /= 60; // Convert to seconds if the unit is minutes
            } else if (timeUnit === 2) {
                quizTime *= 60; // Convert to hours if the unit is hours
            }

            quizTime = Math.round(quizTime * 100) / 100
    
            console.log(quizTime);
            // Set the adjusted quiz time in the innerHTML of the element
            document.getElementById('submission-quiz-time').innerHTML = quizTime + 'min';

            // * (Math.pow(60, quizAttributes['time-unit'] - 2));
            document.getElementById('submission-question-count').innerHTML = document.querySelectorAll('.question-list > .question').length - 1;

            // -> quiz-difficulty
            // const difficultyList = document.getElementById('quiz-difficulty-list');
        
            // document.getElementById('selected-difficulty').value = difficultyList.selectedIndex;
            document.getElementById('submission-quiz-difficulty').innerHTML = document.getElementById('quiz-difficulty-list').options[document.getElementById('quiz-difficulty-list').selectedIndex].text;
            // const user = @json($user);

   
            console.log(selectedSubjects.length);
            const subjectsText = selectedSubjects.length > 0 ? Array.from(selectedSubjects).map(subject => subject.textContent.trim()).join(', ') : '---';

            console.log(subjectsText);
            document.getElementById('submission-quiz-subjects').innerHTML = subjectsText;

            document.getElementById('submission-quiz-creator').innerHTML = document.querySelector('.username').textContent;

            let description  =document.getElementById('submission-quiz-description');

            description.innerHTML = document.querySelector('#general-info-section [name="description"]').value;

            if (description.innerHTML === ""){
                description.innerHTML = "---";
            }            

        }
 
        // Submission panel (last panel in the sequence) is reached
        else if (currentPanelIndex === panels.length - 1){
    

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

        if (currentPanelIndex < panels.length - 1) {
            processNextPanelRequest();
        }
    }


    panelForm.addEventListener('submit', handleFormSubmission);
    
});



// ############################ question-list-editor --- event processing ############################ //



document.getElementById('insertQuestionButton').addEventListener('click', addNewQuestion);

document.querySelectorAll('.question-option').forEach(option => {
    processOptionKeyEvent(option);
});


document.querySelectorAll('.question-text').forEach(processOptionKeyEvent);


function updateOptionId(option, operation) {

// this function updates question-option ordinal number based on operation request. This update is carried out on
// current option and on all its subsequent option siblings.
// operation: int
//  a) 0 - decrement no.
//  b) 1 - increment no.

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

    // this function contains processing logic for all option-text or question-text elements
    // function contains all required keydown events and their mapped procedures

    if(option){
        option.addEventListener('keydown', function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
                const newOption = option.cloneNode(true);
                const newOptionText = newOption.querySelector('.option-text');
                newOptionText.value = "";
                option.parentElement.insertBefore(newOption, option.nextSibling);
                processOptionKeyEvent(newOption);
                newOptionText.focus();
                updateOptionId(newOption, 1);
            }
            else if (event.key === "ArrowDown") {

                if (option.className === 'question-option') {
                    const nextElement = option.nextElementSibling;
                    if (nextElement){
                        nextElement.querySelector('.option-text').focus();
                    }
                    else{
                        option.parentElement.parentElement.nextElementSibling.querySelector('.question-text').focus();
                    }
                }
                else{
                    option.parentElement.nextElementSibling.querySelector('.question-option > .option-text').focus();
                }
            }
            else if (event.key === "ArrowUp") {

            
                if (option.className === 'question-option') {
                    const prevElement = option.previousElementSibling;
                    if (prevElement){
                        prevElement.querySelector('.option-text').focus();
                    }
                    else{
                        option.parentElement.previousElementSibling.querySelector('.question-text').focus();
                    }
                }
                else{
                    option.parentElement.parentElement.previousElementSibling.querySelector('.question-option:last-child > .option-text').focus();
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



function addNewQuestion() {
    const questionList = document.getElementById('questionList');
    
    const demonstrativeQuestion = document.getElementById('demonstrativeQuestion');
    const newQuestion = demonstrativeQuestion.cloneNode(true);
    newQuestion.style.display = 'flex';

    const questionCount = questionList.getElementsByClassName('question').length;
    newQuestion.querySelector('.question-no').textContent = `${questionCount}.`;
    questionList.appendChild(newQuestion);
    newQuestion.querySelectorAll('.question-text').forEach(processOptionKeyEvent);
    newQuestion.querySelector('.question-text').focus();

    newQuestion.querySelectorAll('.question-option').forEach(option => {
        processOptionKeyEvent(option);
    });

    // document.getElementById('empty-list-warning').style.display = 'none';
}