document.addEventListener('DOMContentLoaded', function() {
    const togglePasswordIcons = document.querySelectorAll('.right-side-image');

    togglePasswordIcons.forEach(function(icon) {
        icon.addEventListener('mousedown', function() {
            const parentWrapper = icon.closest('.image-embedded-input-wrapper');
            // Find the input within this parent wrapper
            const passwordInput = parentWrapper.querySelector('input');

            // Toggle the type attribute of the input field
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Prevent default behavior (like selecting text) on mousedown
            return false;
        });

        // Reset input type to password when mouse button is released
        icon.addEventListener('mouseup', function() {
            const parentWrapper = icon.closest('.image-embedded-input-wrapper');
            // Find the input within this parent wrapper
            const passwordInput = parentWrapper.querySelector('input');

            // Reset input type to password
            passwordInput.setAttribute('type', 'password');
        });
    });
});