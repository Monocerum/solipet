@extends('layouts.header')
<style>

.dropdown-bar {
    margin-bottom: 20px;
    display: flex;
    gap: 15px;
    padding: 10px;
    border-radius: 6px;
}

.dropdown-bar > div {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    gap: 30px;
    height: 50px;
}

.dropdown-pet {
    position: relative;
    width: 200px;
}

.dropdown-pet1 {
    position: relative;
    width: 300px;
}

.dropdown-pet .dropdown-toggle, .dropdown-pet1 .dropdown-toggle {
    color: beige;
    font-family: 'Manrope', sans-serif;
    font-size: 1.25rem;
    font-weight: bold;
}

.dropdown-pet .dropdown-toggle:hover,
.dropdown-pet .dropdown-toggle:focus,
.dropdown-pet .dropdown-toggle:active {
    color: white;
    text-decoration: none;
}

.home-container {
    display: flex;
    flex-direction: column;

}

.hero-section {
    display: flex;
    flex-direction: row;
    justify-content: space-evenly;
    background: url("assets/transparent-logo.png");
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: left top;
    min-height: 100vh;
    align-items: center;
    overflow: hidden;
}

    .solipet-tagline-container {
        display: flex;
        align-items: flex-end;
        justify-content: flex-end;
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
        }

        h5 {
            font-size: 1.7em;
            margin: 0;
            text-align: end;
        }
    }

.hero-text {
    height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    align-items: end;
    width: 30%;
}


</style>

@section('content')

<div class="home-container">
        <div class="dropdown-bar">
            <div>
                <div class="nav-item dropdown-pet">
                    <a id="petTypeDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Shop by Pet
                    </a>
                    <div class="dropdown-menu dropdown-menu-start" aria-labelledby="navbarDropdown5">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            {{ __('Cat') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            {{ __('Dog') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            {{ __('Small Pet') }}
                        </a>
                    </div>
                </div>
            </div>
    </div>
        <section class="hero-section">
            <div class="hero-text">
                <div class="solipet-logo-container">
                    <img src="assets/company_logo.svg" alt="" class="solipet-logo">
                </div>
                <div class="solipet-tagline-container">
                    <div class="solipet-tagline">
                        <h5>YOUR PET’S NECESSITIES</h5>
                        <h3>RIGHT INTO YOUR MAILBOX!</h3>
                    </div>
                </div>
            </div>
            <div class="hero-img">
                <img src="assets/hero-image.png" alt="Photo of a Dog in a Mailbox" id="heroImage">
            </div>
        </section>
</div>
@endsection
