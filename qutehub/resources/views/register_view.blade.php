@extends('layouts.layout')

@section('content')
<section id="register-panel" class="input-panel">
    <h2>REGISTER</h2>
    
    <form method="POST" action="{{ route('register.store') }}">
        @csrf <!-- CSRF token for security -->
        <div class="image-embedded-input-wrapper">
            <img class="left-side-image" src="{{ URL::asset('icons/username_icon.png') }}" width="30px">
            <input class="image-embedded-input" name="username" placeholder="Username" required pattern="{{ env('USERNAME_PATTERN') }}"><br>
        </div>

        <div class="image-embedded-input-wrapper">
            <img class="left-side-image" src="{{ URL::asset('icons/password_icon.png') }}" width="25px">
            <input class="image-embedded-input" name="password" placeholder="Password" type="password" required pattern="{{ env('PASSWORD_PATTERN') }}">
            <img class="right-side-image" src="{{ URL::asset('icons/show_password_icon.png') }}" width="25px">
        </div>

        <div class="image-embedded-input-wrapper">
            <img class="left-side-image" src="{{ URL::asset('icons/password_icon.png') }}" width="25px">
            <input class="image-embedded-input" name="password_confirmation" placeholder="Retype Password" type="password" required pattern="{{ env('PASSWORD_PATTERN') }}">
            <img class="right-side-image" src="{{ URL::asset('icons/show_password_icon.png') }}" width="25px">
        </div>

        <div class="flashed-messages">
            <!-- Display any flashed messages here -->
        </div>

        <button type="submit" class="submit-button">Register</button>
    </form>
    
    <label id="register-panel-to-login-section-label" class="to-prev-section-label">log in</label>
</section>
@endsection