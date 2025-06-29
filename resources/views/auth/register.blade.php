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
    
    .register-container {
        min-height: 100vh;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: flex-start;
    }

    .solipet-tagline-container {
        height: 80vh;
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
        min-height: 80vh;
        border-radius: 1.5em;
    }

    .auth-card-header {
        font-family: "Irish Grover", sans-serif;
        font-size: 50px;
        padding: 5% 0;
        color: #E8C7AA;
        text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    }

    .auth-card-body {
        font-family: "Manrope", sans-serif;
        padding: 2% 5%;

        input[type="text"], input[type="email"], input[type="password"] {
            background: #E8C7AA;
            margin-bottom: 2%;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            height: 3em;
        }
        
        .confirmation-container {
            display: flex;
            align-items: flex-start;
            padding: 0 0 5% 0;
            gap: 10px;
        }

        #terms_agreement {
            box-shadow: none;
            margin: 0;
            height: 1.2em;
            width: 1.2em;
            background: #E8C7AA;
            border: 2px solid #522222;
            border-radius: 3px;
            cursor: pointer;
            flex-shrink: 0;
            margin-top: 2px;
            position: relative;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        #terms_agreement:checked {
            background: #522222;
            position: relative;
        }

        #terms_agreement:checked::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #E8C7AA;
            font-size: 0.8em;
            font-weight: bold;
        }

        #terms_agreement:hover {
            border-color: #77401E;
            background: #F2D5BC;
        }

        .confirmation-container label {
            cursor: pointer;
            line-height: 1.4;
            margin: 0;
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
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .auth-btn:disabled {
            background-color: #ccc;
            color: #666;
            cursor: not-allowed;
            opacity: 0.6;
        }

        .auth-btn:hover:not(:disabled) {
            background-color: #E8C7AA;
            transform: translateY(-2px);
            box-shadow: 0px 6px 6px rgba(0, 0, 0, 0.3);
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
        .register-container {
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

        .auth-card-header {
            font-size: 3em;
        }

        .redirect-container {
            p {
                text-align: center;
                font-size: 1em;
            }
        }
    }
</style>

<div class="container register-container">
    <div class="solipet-tagline-container">
        <div class="solipet-tagline">
            <h5>YOUR PET'S NECESSITIES</h5>
            <h3>RIGHT INTO YOUR MAILBOX!</h3>
        </div>
    </div>
    <div class="register-card-container">
        <div class="auth-card solipet-register">
                <div class="card auth-card">
                    <div class="card-body auth-card-body">
                        <h2 class="auth-card-header">{{ __('REGISTER') }}</h2>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div>
                                <label for="name">{{ __('Name') }}</label>
                            </div>
                            <div>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Full Name | Example: Juan Dela Cruz" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div>
                                <label for="username">{{ __('Username') }}</label>
                            </div>
                            <div>
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" placeholder="Username | Example: juandc" required autocomplete="username">

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div>
                                <label for="email">{{ __('Email Address') }}</label>
                            </div>
                            <div>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email | Example: sui@gmail.com" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div>
                                <label for="password">{{ __('Password') }}</label>
                            </div>

                            <div>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div>
                                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                            </div>

                            <div>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <div class="form-check confirmation-container">
                                <input type="checkbox" class="form-check-input @error('terms_agreement') is-invalid @enderror" id="terms_agreement" name="terms_agreement" value="1" {{ old('terms_agreement') ? 'checked' : '' }} required>
                                <label for="terms_agreement">By signing up, you agree to Solipet's <a href="{{ route('terms') }}" id="tos" target="_blank">Terms of Service</a> & <a href="{{ route('privacy') }}" id="tos" target="_blank">Privacy Policy</a>.</label>
                                @error('terms_agreement')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="auth-btn-container">
                                <button type="submit" class="auth-btn">
                                    {{ __('REGISTER') }}
                                </button>
                            </div>

                            <div class="redirect-container">
                                <p>Have an account? <a href="{{ route('login') }}">Log In</a>!</p>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkbox = document.getElementById('terms_agreement');
    const label = document.querySelector('.confirmation-container label');
    const submitBtn = document.querySelector('.auth-btn');
    
    // Make the entire label clickable
    label.addEventListener('click', function(e) {
        // Don't trigger if clicking on a link
        if (e.target.tagName === 'A') {
            return;
        }
        checkbox.checked = !checkbox.checked;
        updateSubmitButton();
    });
    
    // Update submit button state when checkbox changes
    checkbox.addEventListener('change', function() {
        updateSubmitButton();
    });
    
    function updateSubmitButton() {
        if (checkbox.checked) {
            submitBtn.disabled = false;
            submitBtn.style.opacity = '1';
            submitBtn.style.cursor = 'pointer';
        } else {
            submitBtn.disabled = true;
            submitBtn.style.opacity = '0.6';
            submitBtn.style.cursor = 'not-allowed';
        }
    }
    
    // Initial state
    updateSubmitButton();
    
    // Prevent form submission if checkbox is not checked
    document.querySelector('form').addEventListener('submit', function(e) {
        if (!checkbox.checked) {
            e.preventDefault();
            alert('Please agree to the Terms of Service and Privacy Policy to continue.');
            checkbox.focus();
        }
    });
});
</script>
