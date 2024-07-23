<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no">
    <meta name="author" content="FiMo_IT">
    <meta name="keywords" content="Quiz, Test, Exam, User">
    <meta name="description" content="Test your knowledge here by picking a quiz on this page. Users can also create their own quizzes.">
    
    
    <title>Document</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="{{ URL::asset('/css/main.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/css/header.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/css/input_panel.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/css/buttons.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/css/inputs.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/css/quiz_specification_panel.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/css/footer.css') }}">

</head>
<body>

    <header>
        <h1 onclick="location.assign('/home')">QuTeHub</h1>
        
        @if ($user)

            <div class="account-icon-options-wrapper input-design-one">
                <img class="account-icon" src="{{ URL::asset('/icons/user_account_icon.png') }}">

                <div class="account-option-list">

                    <label>Logged as</label>
            
                    <label class="username"><b>{{ $user->name }}</b></label>
                    <hr>
            
                    <button class="submit-button"  onclick="location.assign('/quiz-specification')">New Quiz</button>
                    
                    <button class="submit-button">My Quizzes</button>

                    <button class="submit-button" onclick="location.assign('/logout')">Log Out</button>

                </div>
                
            </div>
  
        @else
        <div class="account-icon-options-wrapper input-design-one" onclick="location.assign('/login')">
            <img class="account-icon" src="{{ URL::asset('/icons/user_account_icon.png') }}" width="50px" onclick="location.assign('/login')">
        </div>
        @endif
    </header>

    
    <main class="content-wrapper">
        @yield('content')
    </main>

    <footer class="footer">
        <section class="contact-section">
            <h2>About Author</h2>
            <div class="contact-sites">
                <img src="{{ URL::asset('icons/github_logo.png') }}" alt="Github logo" width="35px">
                <img src="{{ URL::asset('icons/linkedin_logo.png') }}" alt="LinkedIn logo" width="35px">
            </div>
        </section>
        <p>© 2024 fimoIT. All rights reserved.</p>
    </footer>

<script src="{{ URL::asset("/js/main.js") }}"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->

    <!-- Including Popper scripts for dropdowns, popovers, tooltips, etc. -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>