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
    display: flex;
    justify-content: flex-end;

    img {
        margin-bottom: -400px;
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
            text-align: end;
        }

        h5 {
            font-size: 1.7em;
            margin: 0;
            text-align: end;
        }
    }

.dog-peek {
    width: 100%;
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
    text-transform: uppercase;
    letter-spacing: 1px;
    text-align: center;
}

.pet-card-container {
    display: flex;
    justify-content: center;
    z-index: 3;
    align-items: flex-end;
    flex-wrap: wrap;
    margin: 0 5%;
}

.pet-box {
    position: relative;
    margin-top: -41em;
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
    background: linear-gradient(123.61deg, #92491C 24.06%, #F7DBB4 122.75%);
    color: white;
    border: none;
    width: 50%;
    padding: 10px 16px;
    border-radius: 10px;
    font-size: 0.9rem;
    font-weight: bold;
    text-decoration: none;
    transition: all 0.3s ease-in-out;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    position: relative;
    overflow: hidden;
}

.shop-button::after {
    content: '';
    position: absolute;
    width: 100%;
    height: 300%;
    top: -100%;
    left: 0;
    background: rgba(255, 255, 255, 0.2);
    transform: rotate(25deg);
    transition: top 0.5s ease;
    z-index: 0;
}

.shop-button:hover::after {
    top: 100%;
}

.shop-button:hover {
    background: linear-gradient(123.61deg, #F7DBB4 24.06%, #92491C 122.75%);
    transform: scale(1.05) rotate(-0.5deg);
    box-shadow: 0 6px 12px rgba(146, 73, 28, 0.4);
}

.dog-pet-type {
    width: 70%;
    border-radius: 2em;
    box-shadow: 0 4px 15px rgba(77, 59, 0, 0.5);
    background: linear-gradient(123.61deg, #92491C 24.06%, #F7DBB4 122.75%);
}

.home-container h6 {
    text-align: center;
    font-size: 1.2rem;
    font-family: 'Manrope', sans-serif;
    color: #F7DBB4;
    margin-top: 2em;
}

.item-card {
    border: 4px solid #8b4513;
}

.item-image {
    width: 100%;
    height: 180px;
    background-color: #4a2c2a;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
}

.item-info {
    padding: 12px;
}

.item-name {
    font-size: 18px;
    font-weight: bold;
    color: #2c1810;
    margin-bottom: 8px;
    text-transform: uppercase;
}

.item-price {
    background: linear-gradient(90deg, #4a2c2a 0%,rgb(236, 189, 156) 100%);
    color: #f4d4b8;
    padding: 4px 8px;
    font-size: 12px;
    font-weight: bold;
    margin-bottom: 8px;
    display: inline-block;
    width: 100%;
}

.item-details {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 10px;
    color: #4a2c2a;
}

.discount {
    font-weight: bold;
}

.rating {
    margin-left: 20px;
    display: flex;
    align-items: center;
    gap: 2px;
}

.star {
    color: #000000;
}

.sold-count {
    margin-left: 30px;
    font-size: 9px;
}

.promos {
    margin: 0 5%;
}

.promos h2 {
    display: flex;
    flex-direction: column;
    font-family: "Irish Grover", sans-serif;
    align-items: center;
    color: #FFE3CA;
    font-size: 3.3em;
    margin: 0;
}

h6 {
    margin: 0 5%;
}

@media screen and (max-width: 1465px) {
    #dogContainer {
        margin-top: -30em;
    }

    #catContainer {
        margin-top: -30em;
    }

    #smallPetContainer {
        margin-top: -5em;
    }

    .solipet-logo {
        width: 25em;
    }
}

@media screen and (max-width: 1250px) {
    .solipet-logo {
        width: 20em;
    }

    .hero-img {
        img {
            width: 90%;
            margin-bottom: -500px;
        }
    }
}

@media screen and (max-width: 1050px) {
    .solipet-logo {
        width: 15em;
    }

    .hero-section {
        min-height: 60vh;

    }

    .hero-img {
        justify-content: center;

        img {
            width: 60%;
            margin-bottom: -350px;
        }
    }

    .solipet-tagline {
        h3 {
            font-size: 1.5em;
            margin: 0;
            text-align: end;
        }

        h5 {
            font-size: 1.2em;
            margin: 0;
            text-align: end;
        }
    }
    
    .hero-text {
        width: 50%;
        height: 50vh;
    }
}

@media screen and (max-width: 960px) {
    #dogContainer {
        margin-top: -20em;
    }

    #catContainer {
        margin-top: -2em;
    }

    #smallPetContainer {
        margin-top: -5em;
    }
}

@media screen and (max-width: 800px) {
    .hero-section {
        flex-direction: column;
        align-items: center;
    }

    .solipet-logo {
        width: 25em;
    }

    .hero-img {
        img {
            width: 60%;
            margin-bottom: -180px;
        }
    }
}

@media screen and (max-width: 800px) {
    .solipet-logo {
        width: 20em;
    }
}

@media screen and (max-width: 700px) {
    .hero-img {
        img {
            width: 60%;
            margin-bottom: -160px;
        }
    }
}

@media screen and (max-width: 550px) {
    .hero-img {
        img {
            width: 60%;
            margin-bottom: -125px;
        }
    }

    #dogContainer {
        margin-top: -15em;
    }

    .pet-box {
        display: flex;
        justify-content: center;
        width: 90%;

        img {
            width: 80%;
        }
    }

    .pet-img {
        width: 50%;
    }

    .hero-text {
        width: 50%;
        height: 30vh;
    }
}

@media screen and (max-width: 470px) {
    .pet-name {
        margin: 0.5rem 0;
    }
}

@media screen and (max-width: 450px) {
    .solipet-logo {
        width: 15em;
    }

    .hero-img {
        img {
            width: 60%;
            margin-bottom: -100px;
        }
    }

    #dogContainer {
        margin-top: -15em;
    }

    .shop-button {
        padding: 2%;
        border-radius: 0.2em;
    }

    #dogContainer {
        margin-top: -10em;
    }

    .carousel-track {
        .carousel-item {
            width: 250px;
        }
    }
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
            <div class="background-pet">
                <img src="{{ asset('assets/dog-peek.png') }}" alt="Dog face background" class="dog-peek">
            </div>
        </div>
        <div class="pet-card-container">
            <div class="pet-box" id="dogContainer">
                <img src="{{ asset('assets/dog-container.png') }}" class="pet-frame" alt="Dog Frame">
                <div class="pet-content">
                    <div class="pet-img">
                        <img src="assets/dog-photo.png" alt="Photo of a Dog" class="dog-pet-type">
                    </div>
                    <h2 class="pet-name">DOGS</h2>
                    <a href="{{ route('login') }}" class="shop-button">SHOP NOW</a>
                </div>
            </div>
            <div class="pet-box" id="catContainer">
                <img src="{{ asset('assets/cat-container.png') }}" class="pet-frame" alt="Cat Frame">
                <div class="pet-content">
                    <div class="pet-img">
                        <img src="assets/cat-photo.png" alt="Photo of a Cat" class="dog-pet-type">
                    </div>
                    <h2 class="pet-name">CATS</h2>
                    <a href="{{ route('login') }}" class="shop-button">SHOP NOW</a>
                </div>
            </div>
            <div class="pet-box" id="smallPetContainer">
                <img src="{{ asset('assets/small-pet-container.png') }}" class="pet-frame" alt="Rabbit Frame">
                <div class="pet-content">
                    <div class="pet-img">
                        <img src="assets/hamster-photo.png" alt="Photo of a Hamster" class="dog-pet-type">
                    </div>
                    <h2 class="pet-name">SMALL PETS</h2>
                    <a href="{{ route('login') }}" class="shop-button">SHOP NOW</a>
                </div>
            </div>

        </div>
        <h6>WHICH PET DO YOU WANT TO SHOP FOR?</h6> 
        <br> <br> <br>
        <section class="promos">
            <h2>SOLIPET PROMOS</h2>
            @php

                $query = DB::table('products');
                $title = "All Items";
                $fixedImg = null;

                // Fetch products, including product id
                $items = $query->get()->map(function($product) {
                    return [
                        'id' => $product->id,
                        'title' => $product->title,
                        'price' => $product->price,
                        'savings' => $product->savings ?? null,
                        'ratings' => $product->ratings ?? 0,
                        'sold_count' => $product->sold_count ?? 0,
                    ];
                });
            @endphp
            <div id="productCarousel" class="carousel-container">
                <button class="carousel-arrow left" onclick="carouselPrev()">&lt;</button>
                <div class="carousel-track">
                    @foreach($items as $index => $item)
                        <a class="item-card carousel-item" href="{{ route('itempage') }}" style="text-decoration: none;">
                            <div>
                                <div class="item-image">
                                    <div class="pixel-cat"></div>
                                </div>
                                <div class="item-info">
                                    <div class="item-name">{{ $item['title'] }}</div>
                                    <div class="item-price">PHP {{ number_format($item['price'], 2) }}</div>
                                    <div class="item-details">
                                        <span class="discount">
                                            @if(isset($item['savings']))
                                                {{ Str::before($item['savings'], 'P') }}
                                            @endif
                                        </span>
                                        <div class="rating">
                                            @php
                                                $fullStars = floor($item['ratings']);
                                                $halfStar = ($item['ratings'] - $fullStars) >= 0.5;
                                            @endphp
                                            @for($i = 0; $i < 5; $i++)
                                                @if($i < $fullStars)
                                                    <span class="star">★</span>
                                                @elseif($i == $fullStars && $halfStar)
                                                    <span class="star">⯨</span>
                                                @else
                                                    <span class="star">☆</span>
                                                @endif
                                            @endfor
                                            <span class="sold-count">
                                                {{ is_numeric($item['sold_count']) ? number_format($item['sold_count']) : e($item['sold_count']) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
                <button class="carousel-arrow right" onclick="carouselNext()">&gt;</button>
            </div>
            <style>
            .carousel-container {
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 2em 0;
                position: relative;
                width: 100%;
                max-width: 1100px;
                margin-left: auto;
                margin-right: auto;
            }
            .carousel-arrow {
                background: #6B3410;
                color: #fff;
                border: none;
                border-radius: 50%;
                width: 2.5em;
                height: 2.5em;
                font-size: 1.5em;
                cursor: pointer;
                z-index: 2;
            }
            .carousel-track {
                display: flex;
                overflow-x: auto;
                scroll-behavior: smooth;
                width: 900px;
                min-height: 220px;
                transition: none;
                scrollbar-width: none; 
                -ms-overflow-style: none; 
            }
            .carousel-track::-webkit-scrollbar {
                display: none; 
            }
            .carousel-item {
                width: 300px;
                margin: 0 10px;
                background: linear-gradient(135deg, #f4d4b8, #e8c4a0);
                border-radius: 1em;
                box-shadow: 0 2px 8px rgba(107,52,16,0.08);
                display: flex;
                flex-direction: column;
                align-items: center;
                padding: 1em;
                transition: box-shadow 0.2s;
                flex-shrink: 0;
            }
            </style>
            <script>
            let carouselIndex = 0;
            const visibleItems = 3;
            function updateCarousel() {
                const track = document.querySelector('.carousel-track');
                const items = document.querySelectorAll('.carousel-item');
                const maxIndex = items.length - visibleItems;
                if (carouselIndex < 0) carouselIndex = 0;
                if (carouselIndex > maxIndex) carouselIndex = maxIndex;
                track.scrollTo({
                    left: carouselIndex * 320,
                    behavior: 'smooth'
                });
            }
            function carouselPrev() {
                carouselIndex--;
                updateCarousel();
            }
            function carouselNext() {
                carouselIndex++;
                updateCarousel();
            }
            document.addEventListener('DOMContentLoaded', updateCarousel);
            </script>
        </section> <br> <br> <br>
        @include('components.footer')
    </div>
@endsection