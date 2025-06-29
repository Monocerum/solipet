@extends('layouts.header-nologin')

@section('content')
<style>
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
        
        h3 {
            font-size: 2.1em;
            margin: 0;
            text-align: end;
        }

        h5 {
            font-size: 1.7em;
            margin: 0;
            text-align: end;
        }
    }

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

        input {
            background: #E8C7AA;
            margin-bottom: 2%;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            height: 3em;
        }

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

        #tos {
            color: white;
            font-weight: bolder;
        }
    }

    .redirect-container {
        display: flex;
        justify-content: center;
        padding-top: 5%;

        p {
            font-size: 1.5em;

            a {
                color: white;
                font-weight: bolder;
            }
        }
    }

    .forgot-container {
        display: flex;
        justify-content: center;
        
        a {
            color: white;
            font-weight: bolder;
            font-style: italic;
        }
    }

    @media screen and (max-width: 1450px) {
        .auth-card {
            background: #77401E;
            color: white;
            width: 40em;
            min-height: 50vh;
            border-radius: 1.5em;
        }
    }

    @media screen and (max-width: 1000px) {
        .auth-card {
            width: 30em;
        }

        .solipet-tagline {
            h3 {
                font-size: 1.5em;
            }

            h5 {
                font-size: 1.2em;
            }
        }
    }

    @media screen and (max-width: 870px) {
        .login-container {
            display: flex;
            flex-direction: column;
            align-items: center;

            .solipet-tagline-container {
                height: 10vh;
                display: flex;
                padding-right: 0;
                align-items: center;

                .solipet-tagline {
                    align-items: center;
                }

                h3, h5 {
                    text-align: center;
                }
            }
        }
    }

    @media screen and (max-width: 550px) {
        .auth-card {
            width: 25em;
        }

        .auth-card-body {
            padding: 10%;
        }
    }

    @media screen and (max-width: 550px) {
        .auth-card {
            width: 20em;
        }

        .redirect-container {
            p {
                text-align: center;
                font-size: 1em;
            }
        }
    }
</style>

<div class="container login-container">
    <div class="solipet-tagline-container">
        <div class="solipet-tagline">
            <h5>YOUR PET'S NECESSITIES</h5>
            <h3>RIGHT INTO YOUR MAILBOX!</h3>
        </div>
    </div>
    <div class="login-card-container">
            <div class="card auth-card">
                <div class="card-body auth-card-body">
                    <h2 class="auth-card-header">{{ __('LOGIN') }}</h2>
                    <form method="POST" action="{{ route('login') }}" id="loginForm">
                        @csrf

                        <div>
                            <label for="email">{{ __('Email Address') }}</label>

                            <div>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="password">{{ __('Password') }}</label>

                            <div>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <div>
                                <div class="form-check confirmation-container">
                                    <input class="form-check-input" id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="auth-btn-container">
                            <button type="submit" class="auth-btn">
                                {{ __('LOGIN') }}
                            </button>
                        </div>
                        <div class="forgot-container">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                        <div class="redirect-container">
                            <p>Don't have an account? <a href="{{ route('register') }}">Register now</a>!</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const rememberCheckbox = document.getElementById('remember');
    const loginForm = document.getElementById('loginForm');

    // Check if we have remembered credentials from the backend
    @if(isset($rememberedCredentials) && $rememberedCredentials)
        const rememberedEmail = '{{ $rememberedCredentials['email'] }}';
        const rememberedPassword = '{{ $rememberedCredentials['password'] }}';
        
        if (rememberedEmail && rememberedPassword) {
            emailInput.value = rememberedEmail;
            passwordInput.value = rememberedPassword;
            rememberCheckbox.checked = true;
        }
    @endif

    // Handle remember me checkbox change
    rememberCheckbox.addEventListener('change', function() {
        if (!this.checked) {
            // If unchecked, clear any stored credentials
            clearStoredCredentials();
        }
    });

    // Handle form submission
    loginForm.addEventListener('submit', function(e) {
        if (rememberCheckbox.checked) {
            // Store credentials in localStorage as backup (optional)
            storeCredentialsLocally();
        } else {
            // Clear stored credentials if remember me is unchecked
            clearStoredCredentials();
        }
    });

    // Function to store credentials locally (optional backup)
    function storeCredentialsLocally() {
        try {
            const credentials = {
                email: emailInput.value,
                password: passwordInput.value
            };
            localStorage.setItem('rememberedCredentials', JSON.stringify(credentials));
        } catch (e) {
            console.log('Could not store credentials locally');
        }
    }

    // Function to clear stored credentials
    function clearStoredCredentials() {
        try {
            localStorage.removeItem('rememberedCredentials');
        } catch (e) {
            console.log('Could not clear local credentials');
        }
    }

    // Auto-fill from localStorage if no backend credentials (fallback)
    if (!emailInput.value && !passwordInput.value) {
        try {
            const storedCredentials = localStorage.getItem('rememberedCredentials');
            if (storedCredentials) {
                const credentials = JSON.parse(storedCredentials);
                emailInput.value = credentials.email || '';
                passwordInput.value = credentials.password || '';
                if (credentials.email && credentials.password) {
                    rememberCheckbox.checked = true;
                }
            }
        } catch (e) {
            console.log('Could not retrieve local credentials');
        }
    }
});
</script>
@endsection
