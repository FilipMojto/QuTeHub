document.addEventListener('DOMContentLoaded', function() {
    const togglePasswordIcons= document.querySelectorAll('.right-side-image');

    togglePasswordIcons.forEach(function(icon){
        icon.addEventListener('click', function() {
        
            const parentWrapper = icon.closest('.image-embedded-input-wrapper');
            // Find the input within this parent wrapper
            const passwordInput = parentWrapper.querySelector('input');
        
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
        })
        
    })
});