
@extends('layouts.header-nologin')

@section('content')

<style>
    .forgot-page {
        min-height: 75vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 50px 20px;
        font-family: 'Nunito', sans-serif;
    }

    .forgot-card {
        width: 100%;
        max-width: 480px;
        background: #FAE3C2;
        border: 2px solid #DAB08A;
        border-radius: 22px;
        padding: 40px;
        box-shadow: 0 10px 30px rgba(46, 22, 12, 0.12);
    }

    .forgot-title {
        color: #2E160C;
        font-family: 'Manrope', sans-serif;
        font-size: 27px;
        font-weight: 800;
        text-align: center;
        margin-bottom: 10px;
    }

    .forgot-description {
        color: #572215;
        font-size: 14px;
        line-height: 1.7;
        text-align: center;
        margin-bottom: 28px;
    }

    .forgot-label {
        display: block;
        color: #2E160C;
        font-size: 14px;
        font-weight: 800;
        margin-bottom: 9px;
    }

    .forgot-input {
        width: 100%;
        padding: 13px 16px;
        background: #FFF9F0;
        border: 1.5px solid #DAB08A;
        border-radius: 12px;
        color: #2E160C;
        font-size: 14px;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .forgot-input:focus {
        border-color: #572215;
        box-shadow: 0 0 0 3px rgba(87, 34, 21, 0.12);
    }

    .forgot-input.is-invalid {
        border-color: #C0392B;
    }

    .forgot-error {
        display: block;
        color: #C0392B;
        font-size: 12px;
        margin-top: 7px;
    }

    .forgot-success {
        background: #E6F2E5;
        border: 1px solid #A8CBA4;
        border-radius: 10px;
        padding: 12px 15px;
        color: #315D32;
        font-size: 13px;
        margin-bottom: 22px;
        line-height: 1.5;
    }

    .forgot-submit {
        width: 100%;
        border: none;
        border-radius: 12px;
        padding: 14px 18px;
        margin-top: 23px;
        background: #572215;
        color: #FAE3C2;
        font-family: 'Manrope', sans-serif;
        font-size: 14px;
        font-weight: 800;
        cursor: pointer;
        transition: background 0.2s, transform 0.2s;
    }

    .forgot-submit:hover {
        background: #2E160C;
        transform: translateY(-2px);
    }

    .forgot-back {
        display: block;
        width: fit-content;
        margin: 22px auto 0;
        color: #572215;
        font-size: 13px;
        font-weight: 800;
        text-decoration: none;
        transition: color 0.2s;
    }

    .forgot-back:hover {
        color: #2E160C;
        text-decoration: underline;
    }

    @media (max-width: 576px) {
        .forgot-page {
            padding: 30px 16px;
        }

        .forgot-card {
            padding: 30px 22px;
            border-radius: 18px;
        }

        .forgot-title {
            font-size: 23px;
        }
    }
</style>

<div class="forgot-page">
    <div class="forgot-card">

        <h1 class="forgot-title">
            Forgot Password?
        </h1>

        <p class="forgot-description">
            No worries! Enter the email address associated with your
            Solipet account, and we'll send you a link to reset your password.
        </p>

        @if (session('status'))
            <div class="forgot-success" role="alert">
                <i class="fas fa-check-circle"></i>
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div>
                <label for="email" class="forgot-label">
                    Email Address
                </label>

                <input
                    id="email"
                    type="email"
                    class="forgot-input @error('email') is-invalid @enderror"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Enter your registered email"
                    required
                    autocomplete="email"
                    autofocus
                >

                @error('email')
                    <span class="forgot-error" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button type="submit" class="forgot-submit">
                <i class="fas fa-paper-plane"></i>
                Send Password Reset Link
            </button>
        </form>

        <a href="{{ route('login') }}" class="forgot-back">
            <i class="fas fa-arrow-left"></i>
            Back to Login
        </a>

    </div>
</div>

@endsection
