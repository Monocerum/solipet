@extends('layouts.header')
<style>

.dropdown-bar {
    margin-bottom: 20px;
    display: flex;
    padding-left: 5%;
    border-radius: 6px;
}

.dropdown-bar > div {
    justify-content: flex-start;
    padding: 10px;
    display: flex;
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
    overflow: visible;
    position: relative;
    z-index: 2;

}

.hero-img {
    position: relative;
    z-index: 3;

    img {
        margin-bottom: -150px;
    }
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

.solipet-logo {
    width: 28em;
}

.selection-area {
    position: relative;
    width: 100%;
    background: #dcb99c;
    -webkit-mask-image: url('/assets/curved.svg');
    mask-image: url('/assets/curved.svg');
    -webkit-mask-size: 100% 100%;
    mask-size: 100% 100%;
    -webkit-mask-repeat: no-repeat;
    mask-repeat: no-repeat;
    -webkit-mask-position: top;
    mask-position: top;
    padding-top: 150px;
    z-index: 1;
    dispaly: flex;
    
    justify-content: center;
}

.selection-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 40px;
    text-align: center;
}

.selection-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: #6B3410;
    margin-bottom: 50px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.pet-card-container {
    display: flex;
    justify-content: center;
    z-index: 3;
    align-items: flex-end;
}

.pet-box {
    position: relative;
    cursor: pointer;
    margin-top: -38em;
}

.pet-frame {
    display: block;
}

.pet-content {
    position: absolute;
    bottom: 1.8em;
    width: 100%;
    text-align: center;
    z-index: 5;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.pet-name {
    font-weight: bold;
    font-size: 1.5rem;
    color: #6B3410;
    margin: 1rem 0;
}

.shop-button {
    background-color: #6B3410;
    color: white;
    border: none;
    width: 50%;
    padding: 6px 12px;
    border-radius: 10px;
    font-size: 0.9rem;
    background: linear-gradient(123.61deg, #92491C 24.06%, #F7DBB4 122.75%);
}

.dog-pet-type {
    width: 70%;
    border-radius: 2em;
    box-shadow: 0 4px 15px rgba(77, 59, 0, 0.5);
    background: linear-gradient(123.61deg, #92491C 24.06%, #F7DBB4 122.75%);
}

</style>

@section('content')

<div class="home-container">
        <div class="dropdown-bar">
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
        <div class="selection-area">
            <h2 class="selection-title">Which Pet Do You Want to Shop For?</h2>
            <div class="background-pet">
                <img src="{{ asset('assets/dog-peek.png') }}" alt="Dog face background">
            </div>
        </div>
            <div class="pet-card-container">
                <div class="pet-box">
                    <img src="{{ asset('assets/dog-container.png') }}" class="pet-frame" alt="Dog Frame">
                    <div class="pet-content">
                        <div class="pet-img">
                            <img src="assets/dog-photo.png" alt="Photo of a Dog" class="dog-pet-type">
                        </div>
                        <h2 class="pet-name">DOGS</h2>
                        <button class="shop-button">SHOP NOW</button>
                    </div>
                </div>
                <div class="pet-box">
                    <img src="{{ asset('assets/cat-container.png') }}" class="pet-frame" alt="Cat Frame">
                    <div class="pet-content">
                        <div class="pet-img">
                            <img src="assets/cat-photo.png" alt="Photo of a Cat" class="dog-pet-type">
                        </div>
                        <h2 class="pet-name">CATS</h2>
                        <button class="shop-button">SHOP NOW</button>
                    </div>
                </div>
                <div class="pet-box">
                    <img src="{{ asset('assets/small-pet-container.png') }}" class="pet-frame" alt="Rabbit Frame">
                    <div class="pet-content">
                        <div class="pet-img">
                            <img src="assets/hamster-photo.png" alt="Photo of a Hamster" class="dog-pet-type">
                        </div>
                        <h2 class="pet-name">SMALL PETS</h2>
                        <button class="shop-button">SHOP NOW</button>
                    </div>
                </div>
            </div>
    </div>
@endsection
