
@extends('layouts.header') 

@section('content')
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

.hero-section {
    width: 100vw;
    min-width: 100vw;
    max-width: 100vw;
    box-sizing: border-box;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: -20px;
    margin-bottom: 30px;
}

.sidebar-catalog {
    color: beige;
    font-family: 'Manrope', sans-serif;
    margin-left: 20px;
}
.sidebar-catalog h4,
.sidebar-catalog h5,
.sidebar-catalog label,
.sidebar-catalog a {
    color: #f2d5bc;
}

.sidebar-catalog h5 {
    background-color: #2E160C;
    color: #f2d5bc;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
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

.pixel-cat {
    width:100%; height:100%; display:flex; align-items:center; justify-content:center; overflow:hidden;
}

.pixel-cat img {
    max-width:100%; max-height:100%; object-fit:contain; display:block;
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
    @media (max-width: 1200px) {
        .responsive-item-container .item-card {
            width: 22%;
        }
    }
    @media (max-width: 900px) {
        .responsive-item-container .item-card {
            width: 30%;
        }
    }
    @media (max-width: 700px) {
        .responsive-item-container .item-card {
            width: 45%;
        }
    }
    @media (max-width: 500px) {
        .responsive-item-container {
            gap: 12px;
        }
        .responsive-item-container .item-card {
            width: 100%;
            min-width: 0;
        }
    }
</style>
@section('title', 'Shop | Solipet')

<div class="dropdown-bar">
                <div class="nav-item dropdown-pet">
                    <a id="petTypeDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Shop by Pet
                    </a>
                    <div class="dropdown-menu dropdown-menu-start" aria-labelledby="navbarDropdown5">
                        <a class="dropdown-item" href="{{ route('petpage', ['pet_type' => 'cat']) }}">
                            {{ __('Cat') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('petpage', ['pet_type' => 'dog']) }}">
                            {{ __('Dog') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('petpage', ['pet_type' => 'small_pet']) }}">
                            {{ __('Small Pet') }}
                        </a>
                    </div>
                </div>
    </div>
@if(request('pet_type') === 'cat')
<div class="hero-section">
    <img src="{{ asset('assets/shop-by-cat.png') }}" alt="Shop for Cat" style="max-width:100%; height:auto; border-radius:12px; box-shadow:0 2px 8px rgba(0,0,0,0.1);">
</div>
@elseif(request('pet_type') === 'dog')
<div class="hero-section">
    <img src="{{ asset('assets/shop-by-dog.png') }}" alt="Shop for Dog" style="max-width:100%; height:auto; border-radius:12px; box-shadow:0 2px 8px rgba(0,0,0,0.1);">
</div>
@elseif(request('pet_type') === 'small_pet')
<div class="hero-section">
    <img src="{{ asset('assets/shop-by-smallpet.png') }}" alt="Shop for Small Pet" style="max-width:100%; height:auto; border-radius:12px; box-shadow:0 2px 8px rgba(0,0,0,0.1);">
</div>
@else
<div class="hero-section">
    <img src="{{ asset('assets/shop-by-cat.png') }}" alt="Shop for Cat" style="max-width:100%; height:auto; border-radius:12px; box-shadow:0 2px 8px rgba(0,0,0,0.1);">
</div>
@endif
<div class="sidebar-catalog" style="display: flex; gap: 30px;">
    @php
        // Fetch unique categories and brands from the products table
        $categories = DB::table('products')
            ->selectRaw('DISTINCT category')
            ->whereNotNull('category')
            ->pluck('category')
            ->map(function($cat) {
                // Support comma-separated categories
                return array_map('trim', explode(',', $cat));
            })
            ->flatten()
            ->unique()
            ->sort()
            ->values();

        $brands = DB::table('products')
            ->selectRaw('DISTINCT brand')
            ->whereNotNull('brand')
            ->pluck('brand')
            ->map(function($brand) {
                // Support comma-separated brands
                return array_map('trim', explode(',', $brand));
            })
            ->flatten()
            ->unique()
            ->sort()
            ->values();

        // Get selected filters from request
        $selectedCategories = request()->input('category', []);
        $selectedBrands = request()->input('brand', []);
    @endphp

    <aside style="width: 250px; background: #1B0800; border-radius: 8px; padding: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
        <h4 style="font-family: 'Manrope', sans-serif; font-weight: bold; margin-bottom: 20px;">Catalogs</h4>
        <div style="margin-bottom: 30px;">
            <h5 style="font-family: 'Manrope', sans-serif; font-weight: bold; margin-bottom: 12px;">Categories</h5>
            <form id="category-filter-form" method="GET" action="{{ url()->current() }}">
                @foreach($categories as $cat)
                    <div style="margin-bottom: 10px;">
                        <input type="checkbox" id="category_{{ \Illuminate\Support\Str::slug($cat) }}" name="category[]" value="{{ $cat }}"
                            {{ in_array($cat, (array)$selectedCategories) ? 'checked' : '' }}
                            onchange="this.form.submit()">
                        <label for="category_{{ \Illuminate\Support\Str::slug($cat) }}" style="color: #f2d5bc;">{{ $cat }}</label>
                    </div>
                @endforeach
                @foreach(request()->except(['category']) as $key => $value)
                    @if(is_array($value))
                        @foreach($value as $v)
                            <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                        @endforeach
                    @else
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endif
                @endforeach
            </form>
        </div>
        <div>
            <h5 style="font-family: 'Manrope', sans-serif; font-weight: bold; margin-bottom: 12px;">Brands</h5>
            <form id="brand-filter-form" method="GET" action="{{ url()->current() }}">
                @foreach($brands as $brand)
                    <div style="margin-bottom: 10px;">
                        <input type="checkbox" id="brand_{{ \Illuminate\Support\Str::slug($brand) }}" name="brand[]" value="{{ $brand }}"
                            {{ in_array($brand, (array)$selectedBrands) ? 'checked' : '' }}
                            onchange="this.form.submit()">
                        <label for="brand_{{ \Illuminate\Support\Str::slug($brand) }}" style="color: #f2d5bc;">{{ $brand }}</label>
                    </div>
                @endforeach
                @foreach(request()->except(['brand']) as $key => $value)
                    @if(is_array($value))
                        @foreach($value as $v)
                            <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                        @endforeach
                    @else
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endif
                @endforeach
            </form>
        </div>
    </aside>

    <div style="flex: 1;">
<div class="item-container">
    @php

        $petType = request('pet_type');
        $query = DB::table('products');

        // Filter by pet type (column may contain multiple types, e.g., "cat,dog")
        if ($petType === 'dog') {
            $query->where('pet_type', 'like', '%dog%');
            $title = "Items for Dogs";
            $fixedImg = 'assets/dog-img.png';
        } elseif ($petType === 'small_pet') {
            $query->where('pet_type', 'like', '%small%pet%');
            $title = "Items for Small Pets";
            $fixedImg = 'assets/smallpet-img.png';
        } else {
            $query->where('pet_type', 'like', '%cat%');
            $title = "Items for Cats";
            $fixedImg = 'assets/cat-img.png';
        }

        // Fetch products, including product id and image
        $items = $query->get()->map(function($product) {
            return [
                'id' => $product->id,
                'title' => $product->name,
                'price' => $product->price,
                'savings' => $product->savings ?? null,
                'ratings' => $product->ratings ?? 0,
                'sold_count' => $product->rating_text ?? 0,
                'image' => $product->image ?? null,
            ];
        });
    @endphp

    @php
        // Apply filters to the products query
        if (!empty($selectedCategories)) {
            $query->where(function($q) use ($selectedCategories) {
                foreach ($selectedCategories as $cat) {
                    $q->orWhere('category', 'like', '%' . $cat . '%');
                }
            });
        }
        if (!empty($selectedBrands)) {
            $query->where(function($q) use ($selectedBrands) {
                foreach ($selectedBrands as $brand) {
                    $q->orWhere('brand', 'like', '%' . $brand . '%');
                }
            });
        }
        // Re-fetch filtered items
        $items = $query->get()->map(function($product) {
            return [
                'id' => $product->id,
                'title' => $product->name,
                'price' => $product->price,
                'savings' => $product->savings ?? null,
                'ratings' => $product->ratings ?? 0,
                'sold_count' => $product->rating_text ?? 0,
                'image' => $product->image ?? null,
            ];
        });
    @endphp

    <h1 style="font-family: 'Irish Grover', cursive;">{{ $title }}</h1>

    @if($items->isEmpty())
        <div style="font-family: 'Manrope', sans-serif; color:rgb(255, 143, 63); font-size: 1.2rem; margin-top: 40px;">
            No products found.
        </div>
    @else
        <div class="responsive-item-container">
            @foreach($items as $index => $item)
                <a class="item-card" href="{{ url('item/' . $item['id']) }}" style="text-decoration: none;">
                    <div>
                        <div class="item-image">
                            <div class="pixel-cat">
                                <img src="{{ asset($item['image']) }}" alt="Product Image">
                            </div>
                            <img src="{{ asset($fixedImg) }}" class="cat-img" alt="Pet">
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
                                        {{ is_numeric($item['sold_count']) ? number_format($item['sold_count']) : e($item['sold_count']) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif

</div> <br>

@include('components.footer')

@endsection

