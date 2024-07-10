@extends('layouts.layout')


@section('content')
<section id="login-panel" class="input-panel">
    <h2>LOGIN</h2>
    <form>

        <div class="image-embedded-input-wrapper">
            <img class="left-side-image" src="{{ URL::asset('icons/username_icon.png') }}" width="30px">
            <input class="image-embedded-input" name="login-panel-username" placeholder="Username" required pattern=env('USERNAME_PATTERN')><br>
        </div>

        <div class="image-embedded-input-wrapper">
            <img class="left-side-image" id="password-input-icon" src="{{ URL::asset('icons/password_icon.png') }}" width="25px">
            <input id="password-input" class="image-embedded-input" name="login-panel-password" placeholder="Password" type="password" required pattern=env('PASSWORD_PATTERN')>
            <img class="right-side-image" src=" {{ URL::asset('icons/show_password_icon.png') }}" width="25px">     
        </div>

        <div class="flashed-messages">
       
        </div>

        <button class="submit-button"> Log in </button>    
    </form>

    
    <label id="login-panel-to-register-section-label" class="to-prev-section-label">register</label>
</section>

@endsection