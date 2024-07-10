

document.addEventListener('DOMContentLoaded', () => {
    const options = document.querySelectorAll('.header-menu-option');

    options.forEach(option => {
        option.addEventListener('click', () => {
            const dropdown = option.querySelector('.dropdown-menu-options');
            const icon = option.querySelector('.dropdown-arrow-icon');

            // Toggle 'dropdown-arrow-icon-clicked' class to rotate the arrow
            icon.classList.toggle('dropdown-arrow-icon-clicked');

            if (dropdown) {
                // Toggle display of dropdown menu
                // dropdown.style.display = dropdown.style.display === 'flex' ? 'none' : 'flex';
                dropdown.classList.toggle('dropdown-menu-displayed')
            }
        });
    });

    // Close dropdowns and reset arrow rotation if clicking outside
    document.addEventListener('click', (event) => {
        const isClickInside = event.target.closest('.header-menu-option');

        if (!isClickInside) {
            // Remove 'dropdown-arrow-icon-clicked' class and reset rotation
            options.forEach(option => {
                const icon = option.querySelector('.dropdown-arrow-icon');
                if (icon && icon.classList.contains('dropdown-arrow-icon-clicked')) {
                    icon.classList.remove('dropdown-arrow-icon-clicked');
                }
            });

            // Hide all dropdown menus
            document.querySelectorAll('.dropdown-menu-displayed').forEach(dropdown => {
                // dropdown.style.display = 'none';
                dropdown.classList.remove('dropdown-menu-displayed')
            });
        }
    });


    // this part forces all quiz-list elements displayed in homepage to
    // respond to click events

    const elements = document.querySelectorAll('.quiz-element');

    elements.forEach(element => {
        element.addEventListener('click', () => {
            location.assign('/assessment-details');
        })
    });


    // Switching between login and register panels


    document.getElementById('login-panel-to-register-section-label').addEventListener('click', function() {
        window.location.href = '/register';
    });






    // Toggling passwords when clicking on icon

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



// Why the hell is this necessary?
document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('register-panel-to-login-section-label').addEventListener('click', function() {
        window.location.href = '/login';
    });


    // Toggling passwords when clicking on icon

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
})