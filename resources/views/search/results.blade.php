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

.result-container h4, p{
    font-family: 'Irish Grover', cursive; 
    color: #f2d5bc;
}

.item-card {
    width: 200px;
    background: linear-gradient(135deg, #f4d4b8, #e8c4a0);
    border: 4px solid #8b4513;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.3);
    overflow: hidden;
    position: relative;
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
</style>
<div class="dropdown-bar">
    <div>
        <div class="nav-item dropdown-pet">
            <a id="navbarDropdown1" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Shop By Pet
            </a>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown1">
                {{-- TODO: Replace route to proper name and file --}}
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
                    {{ __('Small Animal') }}
                </a>
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
        <h4>Search Results for: " {{ $query }} "</h4>

        @if ($results->isEmpty())
            <p>No results found.</p>
        @else
            <div style="display: flex; flex-wrap: wrap; gap: 24px;">
                @foreach($results as $index => $item)
                    <a class="item-card" href="{{ route('itempage', ['id' => $item['id']]) }}" style="text-decoration: none;">
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
                                        @for($i = 0; $i < 5; $i++)
                                            <span class="star">{{ $i < ($item['ratings'] ?? 0) ? '★' : '☆' }}</span>
                                        @endfor
                                        <span class="sold-count">{{ $item['rating_text'] ?? '' }}</span>
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
