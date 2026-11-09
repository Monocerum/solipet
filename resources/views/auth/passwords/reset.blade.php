```php
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

        form {
            width: 100%;
        }

        input {
            background: #E8C7AA;
            margin-bottom: 2%;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            height: 3em;
            width: 100%;
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

    /* Password visibility toggle */

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
        width: auto;
        box-shadow: none;
    }

    .toggle-password:hover {
        color: #A36A43;
    }

    .toggle-password:focus-visible {
        outline: 2px solid #FFE1C8;
        border-radius: 4px;
    }

    /* Password requirements */

    .password-requirements {
        background: #E8C7AA;
        color: #522222;
        padding: 10px 15px;
        border-radius: 0.5em;
        margin: 8px 0 15px;
        font-size: 0.85em;
    }

    .password-requirements p {
        font-weight: bold;
        margin-bottom: 5px;
    }

    .password-requirements ul {
        margin: 0;
        padding-left: 20px;
    }

    .password-requirements li {
        margin-bottom: 3px;
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
            width: 20em;
        }

        .auth-card-body {
            padding: 10%;
        }

        .auth-card-header {
            font-size: 2em;
        }

        .redirect-container {
            p {
                text-align: center;
                font-size: 1em;
            }
        }

        .password-requirements {
            font-size: 0.75em;
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
                <h2 class="auth-card-header">
                    {{ __('RESET PASSWORD') }}
                </h2>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <!-- Email Address -->
                    <div>
                        <label for="email">{{ __('Email Address') }}</label>

                        <input
                            id="email"
                            type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            name="email"
                            value="{{ $email ?? old('email') }}"
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

                    <!-- New Password -->
                    <div>
                        <label for="password">{{ __('New Password') }}</label>

                        <div class="password-wrapper">
                            <input
                                id="password"
                                type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                name="password"
                                required
                                autocomplete="new-password"
                            >

                            <button
                                type="button"
                                class="toggle-password"
                                onclick="togglePassword('password', this)"
                                aria-label="Show password"
                                title="Show password"
                                aria-pressed="false"
                            >
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>

                        <div class="password-requirements">
                            <p>Your password must contain:</p>
                            <ul>
                                <li>At least 8 characters</li>
                                <li>At least one uppercase letter (A-Z)</li>
                                <li>At least one lowercase letter (a-z)</li>
                                <li>At least one number (0-9)</li>
                                <li>At least one special character (!@#$%^&amp;*)</li>
                            </ul>
                        </div>

                        @error('password')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Confirm New Password -->
                    <div>
                        <label for="password-confirm">
                            {{ __('Confirm New Password') }}
                        </label>

                        <div class="password-wrapper">
                            <input
                                id="password-confirm"
                                type="password"
                                class="form-control"
                                name="password_confirmation"
                                required
                                autocomplete="new-password"
                            >

                            <button
                                type="button"
                                class="toggle-password"
                                onclick="togglePassword('password-confirm', this)"
                                aria-label="Show password"
                                title="Show password"
                                aria-pressed="false"
                            >
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Reset Password Button -->
                    <div class="auth-btn-container">
                        <button type="submit" class="auth-btn">
                            {{ __('RESET PASSWORD') }}
                        </button>
                    </div>
                </form>

                <div class="redirect-container">
                    <p>
                        Remember your password?
                        <a href="{{ route('login') }}">Login here</a>!
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

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
```