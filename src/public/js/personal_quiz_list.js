function checkPQLState(){
    console.log("CHECKING...");
    let rows = document.querySelectorAll('#personal-quiz-list .PQL-row');
    for (let row of rows) {
        if (row.style.display !== 'none') {
            document.getElementById('empty-PQL-warning').style.display = 'none';
            return;  // Exit the function if at least one row is displayed
        }
    }
    document.getElementById('empty-PQL-warning').style.display = 'block';
}



function confirmDeletion(quizId, quizName) {
    if (confirm('Are you sure you want to delete the quiz: ' + quizName + '?')) {
        // Send the request to the server to delete the quiz
        deleteQuiz(quizId);
    }
}

function deleteQuiz(quizId) {

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    // Make an AJAX request to delete the quiz
    
    fetch('/quizzes/' + quizId, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': csrfToken, // Include the CSRF token
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Remove the quiz element from the DOM
            document.getElementById('quiz-' + quizId).remove();
        } else {
            alert('Failed to delete the quiz.');
        }
    })
    .catch(error => console.error('Error:', error));

    checkPQLState();
}








document.addEventListener('DOMContentLoaded', () => {

    checkPQLState();


    document.getElementById('quiz-search-input').addEventListener('input', function() {

        let filter = this.value.toLowerCase();
        let quizzes = document.querySelectorAll('#personal-quiz-list .PQL-row');
        quizzes.forEach(function(quiz) {
            let quizName = quiz.querySelector('.quiz-name').textContent.toLowerCase();
            if (quizName.includes(filter)) {
                quiz.style.display = '';
            } else {
                quiz.style.display = 'none';
            }
        });

        checkPQLState();
    });
});

