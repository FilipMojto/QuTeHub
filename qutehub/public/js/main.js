

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


});