document.addEventListener('DOMContentLoaded', function() {

    document.getElementById('login-panel-to-prev-section-label').addEventListener('click', function() {
        window.location.href = '/register';
    });
});

document.addEventListener('DOMContentLoaded', function() {

    document.getElementById('register-panel-to-prev-section-label').addEventListener('click', function() {
        window.location.href = '/login';
    });
});