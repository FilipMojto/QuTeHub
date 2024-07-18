@extends('base_layout')


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
    <!-- <img class="panel-info-icon" src="{{ URL::asset('/icons/info.png') }}" width="25px"> -->
    <h1>Login</h1>

    <form method="POST" action="{{ route('login.get') }}">
        @csrf <!-- CSRF token for security -->
        
        <div class="input-alert-wrapper">
            <div class="input-icon-wrapper">
                <img class="left-side-input-icon" src="{{ URL::asset('/icons/username_icon.png') }}" width="25px">
                <input placeholder="Username" type="text" name="name" required>
            </div>

            @if ($errors->has('name'))
                <div class="alert alert-danger"><img src="{{ URL::asset('icons/warning.png') }}" width="20px">{{ $errors->first('name') }}</div>
            @endif
        </div>

        
        <div class="input-alert-wrapper">
            <div class="input-icon-wrapper">
                <img class="left-side-input-icon" src="{{ URL::asset('/icons/password_icon.png') }}" width="25px" >
                <input placeholder="Password" type="password" name="password" required>
                <img class="right-side-input-icon" src="{{ URL::asset('/icons/show_password_icon.png') }}" width="25px">
            </div>

            @if ($errors->has('password'))
                <div class="alert alert-danger"><img src="{{ URL::asset('icons/warning.png') }}" width="20px">{{ $errors->first('password') }}</div>
            @endif
        </div>


        <div class="flashed-messages input-alert-wrapper">
            @if ($errors->has('login-error'))
                <div class="alert alert-danger"> <img src="{{ URL::asset('icons/warning.png') }}" width="20px"> {{ $errors->first('login-error') }}</div>
            @endif
        </div>

        <button>Proceed</button>

        
    </form>

    <label>Already registered?</label>

    <label class="panel-switcher-label" onclick="location.assign('/register')">Register</label>

</section>

@endsection