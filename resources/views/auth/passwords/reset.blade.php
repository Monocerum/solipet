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
                <h2 class="auth-card-header">{{ __('RESET PASSWORD') }}</h2>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div>
                        <label for="email">{{ __('Email Address') }}</label>

                        <div>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="password">{{ __('New Password') }}</label>

                        <div>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="password-confirm">{{ __('Confirm New Password') }}</label>

                        <div>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="auth-btn-container">
                        <button type="submit" class="auth-btn">
                            {{ __('RESET PASSWORD') }}
                        </button>
                    </div>
                </form>

                <div class="redirect-container">
                    <p>Remember your password? <a href="{{ route('login') }}">Login here</a>!</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
