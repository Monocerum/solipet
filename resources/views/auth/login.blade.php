@extends('layouts.header-nologin')

@section('content')

<style>
    /* ===== Main Layout ===== */

    main {
        display: flex;
        justify-content: center;
        background: url("assets/transparent-logo.png");
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: left top;
    }

    .login-container {
        min-height: 80vh;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: flex-start;
    }

    /* ===== Tagline ===== */

    .solipet-tagline-container {
        height: 50vh;
        display: flex;
        align-items: flex-end;
        justify-content: flex-end;
        padding-right: 5%;
    }

    .solipet-tagline {
        display: flex;
        flex-direction: column;
        font-family: "Irish Grover", sans-serif;
        align-items: flex-end;
        color: #FFE3CA;
    }

    .solipet-tagline h3 {
        font-size: 2.1em;
        margin: 0;
        text-align: end;
    }

    .solipet-tagline h5 {
        font-size: 1.7em;
        margin: 0;
        text-align: end;
    }

    /* ===== Authentication Card ===== */

    .auth-card {
        background: #77401E;
        color: white;
        width: 50em;
        min-height: 50vh;
        border-radius: 1.5em;
    }

    .auth-card-header {
        font-family: "Irish Grover", sans-serif;
        font-size: 50px;
        padding: 5% 0 0 5%;
        color: #E8C7AA;
        text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    }

    .auth-card-body {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        font-family: "Manrope", sans-serif;
        padding: 2% 5%;
    }

    .auth-card-body form {
        width: 100%;
    }

    .auth-card-body input {
        background: #E8C7AA;
        margin-bottom: 2%;
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
        height: 3em;
    }

    /* ===== Password Visibility Toggle ===== */

    .password-wrapper {
        position: relative;
        width: 100%;
        margin-bottom: 2%;
    }

    .password-wrapper input {
        width: 100%;
        padding-right: 3rem;
        margin-bottom: 0;
    }

    .toggle-password {
        position: absolute;
        top: 50%;
        right: 12px;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #522222;
        cursor: pointer;
        padding: 5px;
        font-size: 1.2em;
        z-index: 2;
        height: auto;
        box-shadow: none;
    }

    .toggle-password:hover {
        color: #A36A43;
    }

    .toggle-password:focus-visible {
        outline: 2px solid #FFE1C8;
        border-radius: 4px;
    }

    /* ===== Remember Me ===== */

    .confirmation-container {
        display: flex;
        align-items: center;
        padding: 0 0 5% 0;
    }

    #remember {
        box-shadow: none;
        margin: 0 2% 0 0;
        height: 1.2em;
        width: 1.2em;
        cursor: pointer;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        border: 2px solid #E8C7AA;
        border-radius: 3px;
        background-color: transparent;
        position: relative;
    }

    #remember:checked {
        background-color: #77401E;
        border-color: #77401E;
    }

    #remember:checked::after {
        content: '✓';
        position: absolute;
        top: -2px;
        left: 2px;
        color: white;
        font-size: 14px;
        font-weight: bold;
    }

    .form-check-label {
        cursor: pointer;
        user-select: none;
    }

    /* ===== Login Button ===== */

    .auth-btn-container {
        display: flex;
        justify-content: center;
    }

    .auth-btn {
        background-color: #FFE1C8;
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
        border: none;
        padding: 2% 8%;
        border-radius: 0.5em;
        color: #522222;
        font-weight: 700;
        font-size: 2em;
        font-family: "Irish Grover", sans-serif;
        margin-top: 2%;
    }

    .auth-btn:hover {
        background-color: #E8C7AA;
    }

    /* ===== Forgot Password ===== */

    .forgot-container {
        display: flex;
        justify-content: center;
    }

    .forgot-container a {
        color: white;
        font-weight: bolder;
        font-style: italic;
    }

    /* ===== Register Redirect ===== */

    .redirect-container {
        display: flex;
        justify-content: center;
        padding-top: 5%;
    }

    .redirect-container p {
        font-size: 1.5em;
    }

    .redirect-container a {
        color: white;
        font-weight: bolder;
    }

    /* ===== Responsive Design ===== */

    @media screen and (max-width: 1450px) {
        .auth-card {
            width: 40em;
        }
    }

    @media screen and (max-width: 1000px) {
        .auth-card {
            width: 30em;
        }

        .solipet-tagline h3 {
            font-size: 1.5em;
        }

        .solipet-tagline h5 {
            font-size: 1.2em;
        }
    }

    @media screen and (max-width: 870px) {
        .login-container {
            flex-direction: column;
            align-items: center;
        }

        .solipet-tagline-container {
            height: 10vh;
            padding-right: 0;
            align-items: center;
        }

        .solipet-tagline {
            align-items: center;
        }

        .solipet-tagline h3,
        .solipet-tagline h5 {
            text-align: center;
        }
    }

    @media screen and (max-width: 550px) {
        .auth-card {
            width: 20em;
        }

        .auth-card-body {
            padding: 10%;
        }

        .redirect-container p {
            text-align: center;
            font-size: 1em;
        }
    }
</style>

<!-- ===== Login Container ===== -->

<div class="container login-container">

    <!-- Tagline -->

    <div class="solipet-tagline-container">
        <div class="solipet-tagline">
            <h5>YOUR PET'S NECESSITIES</h5>
            <h3>RIGHT INTO YOUR MAILBOX!</h3>
        </div>
    </div>

    <!-- Login Card -->

    <div class="login-card-container">
        <div class="card auth-card">

            <div class="card-body auth-card-body">

                <h2 class="auth-card-header">
                    {{ __('LOGIN') }}
                </h2>

                <form method="POST" action="{{ route('login') }}" id="loginForm">
                    @csrf

                    <!-- Email Address -->

                    <div>
                        <label for="email">
                            {{ __('Email Address') }}
                        </label>

                        <input
                            id="email"
                            type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                            autofocus
                        >

                        @error('email')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Password -->

                    <div>
                        <label for="password">
                            {{ __('Password') }}
                        </label>

                        <div class="password-wrapper">

                            <input
                                id="password"
                                type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                name="password"
                                required
                                autocomplete="current-password"
                            >

                            <button
                                type="button"
                                class="toggle-password"
                                onclick="togglePassword('password', this)"
                                aria-label="Show password"
                                title="Show password"
                                aria-pressed="false"
                            >
                                <i class="bi bi-eye" aria-hidden="true"></i>
                            </button>

                        </div>

                        @error('password')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Remember Me -->

                    <div class="form-check confirmation-container">

                        <input
                            class="form-check-input"
                            id="remember"
                            type="checkbox"
                            name="remember"
                            {{ old('remember') ? 'checked' : '' }}
                        >

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>

                    </div>

                    <!-- Login Button -->

                    <div class="auth-btn-container">
                        <button type="submit" class="auth-btn">
                            {{ __('LOGIN') }}
                        </button>
                    </div>

                    <!-- Forgot Password -->

                    <div class="forgot-container">
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>

                    <!-- Register Redirect -->

                    <div class="redirect-container">
                        <p>
                            Don't have an account?
                            <a href="{{ route('register') }}">Register now</a>!
                        </p>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

<!-- ===== Password Visibility Script ===== -->

<script>
    function togglePassword(inputId, button) {
        const input = document.getElementById(inputId);
        const icon = button.querySelector('i');

        if (input.type === 'password') {
            input.type = 'text';

            icon.classList.replace('bi-eye', 'bi-eye-slash');

            button.setAttribute('aria-label', 'Hide password');
            button.setAttribute('title', 'Hide password');
            button.setAttribute('aria-pressed', 'true');

        } else {
            input.type = 'password';

            icon.classList.replace('bi-eye-slash', 'bi-eye');

            button.setAttribute('aria-label', 'Show password');
            button.setAttribute('title', 'Show password');
            button.setAttribute('aria-pressed', 'false');
        }
    }
</script>

@endsection