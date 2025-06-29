@extends('layouts.header')

@section('content')
<style>
.dropdown-bar {
    margin-bottom: 20px;
    display: flex;
    gap: 15px;
    background-color: beige;
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
    color: #000000;
    font-family: 'Manrope', sans-serif;
    font-size: 1.25rem;
    font-weight: bold;
}

.result-container {
    padding: 10px;
    margin-left: 20px;
    margin-right: auto;
    
}

.result-container h4 {
    font-family: 'Irish Grover', cursive; 
    color: #f2d5bc;
}

.result-container p{
    font-family: 'Manrope', cursive; 
    color: #f2d5bc;
}

.result-label{
    display: flex; 
    align-items: center; 
    gap: 20px;
}

.result-label p {
    margin-left: auto;
    margin-right: 10px;
    text-align: right;
}

.item-card {
    width: 15%;
    background: linear-gradient(135deg, #f4d4b8, #e8c4a0);
    border: 4px solid #8b4513;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.3);
    overflow: hidden;
    position: relative;
    transition: transform 0.18s cubic-bezier(.4,2,.6,1), box-shadow 0.18s cubic-bezier(.4,2,.6,1), border-color 0.18s;
}
.item-card:hover, .item-card:focus {
    transform: translateY(-8px) scale(1.03);
    box-shadow: 0 8px 24px rgba(139,69,19,0.25), 0 2px 8px rgba(0,0,0,0.12);
    border-color: #c97d3d;
    z-index: 2;
}

.pixel-cat {
    width:100%; height:100%; display:flex; align-items:center; justify-content:center; overflow:hidden;
}

.pixel-cat img {
    max-width:100%; max-height:100%; object-fit:contain; display:block;
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
    background-color: #f4d4b8;
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

.cat-img {
    position: absolute; 
    left: 0; 
    bottom: 0; 
    width: 100px; 
    height: auto; 
    z-index: 2; 
    margin-left: -7px;
    margin-bottom: -4px;
    pointer-events: none;
}

.responsive-item-container {
        display: flex;
        flex-wrap: wrap;
        gap: 24px;
    }
    .responsive-item-container .item-card {
        width: 15%;
        min-width: 220px;
        max-width: 100%;
        box-sizing: border-box;
    }
</style>
<div class="dropdown-bar">
    <div>
        <div class="nav-item dropdown-pet">
            <a id="navbarDropdown1" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Filter By Pet
            </a>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown1">
                <form method="GET" action="{{ url()->current() }}">
                    <input type="hidden" name="query" value="{{ request('query') }}">
                    <input type="hidden" name="sort" value="{{ request('sort') }}">

                    <button class="dropdown-item" type="submit" name="pet" value="cat">
                        {{ __('Cat') }}
                    </button>
                    <button class="dropdown-item" type="submit" name="pet" value="dog">
                        {{ __('Dog') }}
                    </button>
                    <button class="dropdown-item" type="submit" name="pet" value="small_animal">
                        {{ __('Small Animal') }}
                    </button>
                    <button class="dropdown-item" type="submit" name="pet" value="">
                        {{ __('All Pets') }}
                    </button>
                </form>
            </div>
        </div>
        <div class="nav-item dropdown-pet">
            <a id="navbarDropdown2" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Sort By
            </a>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown2">
                <a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}">
                    {{ __('Newest First') }}
                </a>
                <a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort' => 'rating_desc']) }}">
                    {{ __('Highest Ratings First') }}
                </a>
                <a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort' => 'price_asc']) }}">
                    {{ __('Lowest Price First') }}
                </a>
            </div>
        </div>
    </div>
</div>
<div class="result-container">
        <div class="result-label">
            <h4>Search Results for: " {{ $query }} "</h4>
            @if(request('pet'))
                <p><strong>Filter:</strong> For <u>{{ ucfirst(str_replace('_', ' ', request('pet'))) }}</u> Only </p>
            @endif
        </div>
        <br>

        @if ($results->isEmpty())
            <p>No results found.</p>
        @else
            <div class="responsive-item-container">
                @foreach($results as $index => $item)
                    <a class="item-card" href="{{ url('item/' . $item['id']) }}" style="text-decoration: none;">
                        <div>
                            <div class="item-image">
                                <div class="pixel-cat">
                                    <img src="{{ asset($item['image']) }}" alt="Product Image">
                                </div>
                            </div>
                            <div class="item-info">
                                <div class="item-name">{{ $item['title'] }}</div>
                                <div class="item-price">PHP {{ number_format($item['price'], 2) }}</div>
                                <div class="item-details">
                                    <span class="discount">
                                        @if(isset($item['savings']))
                                            {{ Str::before($item['savings'], 'P') . ' Off!' }}
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
                                            {{ is_numeric($item['rating_text']) ? number_format($item['rating_text']) : e($item['rating_text']) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
</div> <br> <br> <br>
@include('components.footer')
@endsection
