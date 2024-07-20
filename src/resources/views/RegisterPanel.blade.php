@extends('base_layout')

@section('content')
<section class="input-panel">
    <label class="panel-info-icon">i</label>

    <section class="info-box">
        <h4>Tip 1</h4>
        <p><b>Username</b> has to be unique and must contain 8-20 characters.</p>
        
        <h4>Tip 2</h4>
        <p><b>E-mail</b> has to be unique and must follow the standard mail format.</p>

        <h4>Tip 3</h4>
        <p><b>Password</b> must contain 8-20 characters.</p>
    </section>

    <h1>Register</h1>
    
    <form method="POST" action="{{ route('register.store') }}">
        @csrf <!-- CSRF token for security -->

        <div class="input-alert-wrapper">
            <div class="input-icon-wrapper">
                <img class="left-side-input-icon" src="{{ URL::asset('/icons/username_icon.png') }}" width="25px">
                <input placeholder="Username" name="name" type="text" required>
            </div>

            @if ($errors->has('name'))
                <div class="alert alert-danger"><img src="{{ URL::asset('icons/warning.png') }}" width="20px">{{ $errors->first('name') }}</div>
            @endif
        </div>

        <div class="input-alert-wrapper">
            <div class="input-icon-wrapper">
                <img class="left-side-input-icon" src="{{ URL::asset('/icons/email.png') }}" width="25px">
                <input placeholder="E-mail" name="email" type="email" required>
            </div>

            @if ($errors->has('email'))
                <div class="alert alert-danger"><img src="{{ URL::asset('icons/warning.png') }}" width="20px">{{ $errors->first('email') }}</div>
            @endif
        </div>

        <div class="input-alert-wrapper">
            <div class="input-icon-wrapper">
                <img class="left-side-input-icon" src="{{ URL::asset('/icons/password_icon.png') }}" width="25px" >
                <input placeholder="Password" name="password" type="password" required>
                <img class="right-side-input-icon" src="{{ URL::asset('/icons/show_password_icon.png') }}" width="25px">
            </div>

            @if ($errors->has('password'))
                <div class="alert alert-danger"><img src="{{ URL::asset('icons/warning.png') }}" width="20px">{{ $errors->first('password') }}</div>
            @endif
        </div>

        <div class="input-icon-wrapper">
            <img class="left-side-input-icon" src="{{ URL::asset('/icons/password_icon.png') }}" width="25px" >
            <input placeholder="Repeat Password" name="password_confirmation" type="password" required>
            <img class="right-side-input-icon" src="{{ URL::asset('/icons/show_password_icon.png') }}" width="25px">
        </div>

        <button class="submit-button" style="margin-top: 35px; margin-bottom: -15px;">Proceed</button>

        <div class="flashed-messages">
            @if ($errors->has('register-error'))
                <div class="alert alert-danger"><img src="{{ URL::asset('icons/warning.png') }}" width="20px">{{ $errors->first('register-error') }}</div>
            @endif
        </div>
    </form>
    
    <label>Already have Account?</label>
    
    <label class="panel-switcher-label" onclick="location.assign('/login')">Log In</label>
</section>
@endsection