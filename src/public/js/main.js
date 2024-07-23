


document.addEventListener('DOMContentLoaded', () => {
    const icons = document.querySelectorAll('.right-side-input-icon');

    icons.forEach(icon => {
        icon.addEventListener('mousedown', () => {
            const input = icon.previousElementSibling;
            if (input) {
                input.type = 'text';
            }
        });

        

        icon.addEventListener('mouseup', () => {
            const input = icon.previousElementSibling;
            if (input) {
                input.type = 'password';
            }
        });

        icon.addEventListener('mouseleave', () => {
            const input = icon.previousElementSibling;
            if (input) {
                input.type = 'password';
            }
        });
    });


    // const icon = document.querySelector('oicon');

    // icon.addEventListener('click', () => {
    //     const list = icon.nextElementSibling;
    //     if (list) {
    //         list.classList.toggle('account-option-list-displayed');
    //     } else {
    //         console.error('No next sibling element found.');
    //     }
    // });

});

document.addEventListener('DOMContentLoaded', () => {
const icon = document.querySelector('.account-icon');

    icon.addEventListener('click', () => {
        const list = document.querySelector('.account-option-list');
        if (list) {
            list.classList.toggle('account-option-list-displayed');
        } else {
            console.error('No next sibling element found.');
        }

        const wrapper = document.querySelector('.account-icon-options-wrapper').classList.toggle('account-icon-options-wrapper-clicked');
    });


});

document.addEventListener('DOMContentLoaded', () => {
    const quiz_subjects = document.querySelectorAll('.quiz-subject');

    quiz_subjects.forEach(subject => {
        subject.addEventListener('click', () => {
            subject.classList.toggle('quiz-subject-selected');
        })
    });
})



document.addEventListener('DOMContentLoaded', () => {
    const insertButton = document.getElementById('insertQuestionButton');
    const questionList = document.getElementById('questionList');
    const demonstrativeQuestion = document.getElementById('demonstrativeQuestion');
    
    // Function to add new question
    const addNewQuestion = () => {
        const newQuestion = demonstrativeQuestion.cloneNode(true);
        const questionCount = questionList.getElementsByClassName('question').length;
        newQuestion.querySelector('.question-no').textContent = `${questionCount + 1}.`;
        newQuestion.querySelectorAll('input').forEach(input => input.value = '');
        questionList.appendChild(newQuestion);

        // Add event listener for the Enter key to the new question options
        newQuestion.querySelectorAll('.option-text').forEach(input => {
            input.addEventListener('keydown', handleOptionEnterKey);
        });

        // Update option labels for the new question
        updateOptionLabels(newQuestion);
    };


    const options = document.querySelectorAll('.question-option');

    function updateOptionId(option){
        if (option){
            const optionId = option.querySelector('.option-alpha');
            optionId.textContent = String.fromCharCode(optionId.charCodeAt(0) + 1) + ')';
            
            if (option.nextElementSibling){
                updateOptionId(option.nextElementSibling)
            }
        }
    }


    function addOptionEventListener(option){
        if (option){
            option.addEventListener('keypress', function(event) {
                if (event.key === "Enter"){
                    const newOption = option.cloneNode(true);
                    updateOptionId(newOption);

                    option.parentElement.insertBefore(newOption, option.nextSibling);
                    
                    addOptionEventListener(newOption);

                    newOption.querySelector('.option-text').focus();
                }
            })
        }
    }

    
    options.forEach(addOptionEventListener);
});
    


