<!-- resources/views/layouts/layout.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuTeHub</title>
    <link rel="stylesheet" href="{{ URL::asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/homepage.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/utils.css') }}">
</head>
<body>
    <header class="website-header">

    <div class="logo-menu-section">
        <h1>QuTeHub</h1>


        <div class="vertical-space-filler">
            <div class="header-menu">
                <div class="header-menu-option">
        
                        <label>Home</label>
                
                </div>
                
                <div class="header-menu-option">
        
                        <label>Public</label>
            
                    <div class="dropdown-arrow-icon-container">
                    <img class="dropdown-arrow-icon" src={{ URL::asset('icons/arrow_dropdown.png'); }} width="13px">

                        <!-- <img class="dropdown-arrow-icon" src="static/icons/arrow_dropdown.png" width="13px"> -->
                    </div>
                    <div class="dropdown-menu-options">
                        <a href="#popular-assessments-section">Popular</a>
                        <a href="#recommended-assessments-section">Recommended</a>
                    </div>
                </div>
                
                <div class="header-menu-option">
                    <label>Personal</label>
                    
                    <div class="dropdown-arrow-icon-container">
                        <img class="dropdown-arrow-icon" src={{ URL::asset('icons/arrow_dropdown.png'); }} width="13px">

                        <!-- <img class="dropdown-arrow-icon" src="static/icons/arrow_dropdown.png" width="13px"> -->
                    </div>
                    <div class="dropdown-menu-options">
                        <a>Created</a>
                        <a>Private</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="search-bar-account-icon-section">
    <span class="search-bar">
        <img src={{ URL::asset('/icons/search.png'); }} width="15px">

        <!-- <img src="static/icons/search.png" width="15px"> -->
        <input type="text" placeholder="search">
    </span>
    <img class="account-panel-icon" src={{ URL::asset('icons/user_account_icon.png'); }} width="50px">
    <!-- <img class="account-panel-icon" src="static/icons/user_account_icon.png" width="50px"> -->
    </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <section class="contact-section">
            <h2>About Me</h2>
            <div class="contact-sites">
                <img src="{{ URL::asset('icons/github_logo.png'); }}" alt="Github logo is displayed here." width="50px">
                <img src="{{ URL::asset('icons/linkedin_logo.png'); }}" alt="LinkedIn logo is displayed here." width="50px">

                <!-- <img src="static/icons/github_logo.png" alt="Github logo is displayed here." width="50px"> -->
                <!-- <img src="static/icons/linkedin_logo.png" alt="LinkedIn logo is displayed here." width="50px"> -->
            </div>
        </section>
        <div class="copyright-notice">© 2024 fimoIT. All rights reserved.</div>
    </footer>

    <script src="{{ URL::asset('js/main.js') }}"></script>
</body>
</html>