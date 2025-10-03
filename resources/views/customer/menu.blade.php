{{-- resources/views/customer/menu.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Menu - Laidback Cafe</title>
    <script src="https://cdn.tailwindcss.com"></script>
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'laidback': {
                            500: '#f1760b',
                            600: '#e25c01',
                        },
                    },
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-laidback-500 to-laidback-600 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-800">Laidback</h1>
                        <p class="text-xs text-gray-500">Hi, <span class="font-semibold text-laidback-600">{{ session('customer_name') }}</span></p>
                    </div>
                </div>
                <a href="{{ route('customer.cart') }}" class="relative">
                    <div class="w-12 h-12 bg-laidback-500 rounded-full flex items-center justify-center shadow-lg hover:shadow-xl transition-shadow">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        @if($cartCount > 0)
                            <span class="absolute -top-1 -right-1 w-6 h-6 bg-red-500 text-white text-xs font-bold rounded-full flex items-center justify-center">{{ $cartCount }}</span>
                        @endif
                    </div>
                </a>
            </div>
        </div>
    </header>

    <!-- Categories -->
    <div class="bg-white border-b sticky top-[72px] z-40 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <div class="flex gap-2 overflow-x-auto no-scrollbar">
                <a href="{{ route('customer.menu') }}" class="category-btn {{ !request('category') ? 'active' : '' }} px-6 py-2 rounded-full font-semibold whitespace-nowrap shadow-md transition {{ !request('category') ? 'bg-laidback-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    ⭐ All
                </a>
                @foreach($categories as $category)
                    <a href="{{ route('customer.menu', ['category' => $category->slug]) }}" class="category-btn {{ request('category') == $category->slug ? 'active' : '' }} px-6 py-2 rounded-full font-semibold whitespace-nowrap transition {{ request('category') == $category->slug ? 'bg-laidback-500 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        {{ $category->icon }} {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        
        @keyframes scaleIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }
        .animate-scaleIn { animation: scaleIn 0.3s ease-out; }
    </style>

    <!-- Menu Items -->
    <main class="max-w-7xl mx-auto px-4 py-6 pb-24">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Our Menu</h2>
            <p class="text-gray-600">{{ $products->count() }} items available</p>
        </div>

        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        @if($products->isEmpty())
            <div class="text-center py-12">
                <div class="text-6xl mb-4">🍽️</div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">No products available</h3>
                <p class="text-gray-600">Please check back later</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($products as $index => $product)
                    <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-shadow overflow-hidden animate-scaleIn" style="animation-delay: {{ $index * 0.1 }}s;">
                        <div class="relative h-48 bg-gradient-to-br from-amber-100 to-orange-100 overflow-hidden">
                            @if($product->image)
                                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="absolute inset-0 flex items-center justify-center text-8xl">
                                    {{ $product->category->icon ?? '🍽️' }}
                                </div>
                            @endif
                            <div class="absolute top-3 right-3 {{ $product->is_available ? 'bg-green-500' : 'bg-red-500' }} text-white px-3 py-1 rounded-full text-xs font-bold">
                                {{ $product->is_available ? 'Available' : 'Sold Out' }}
                            </div>
                        </div>
                        <div class="p-5">
                            <h3 class="text-lg font-bold text-gray-800 mb-1">{{ $product->name }}</h3>
                            <p class="text-sm text-gray-500 mb-3">{{ Str::limit($product->description, 50) }}</p>
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-2xl font-bold text-laidback-600">{{ $product->formatted_price }}</span>
                                <span class="text-xs text-gray-500 bg-gray-100 px-3 py-1 rounded-full">{{ $product->category->icon }} {{ $product->category->name }}</span>
                            </div>
                            @if($product->is_available)
                                <form action="{{ route('customer.cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="w-full bg-gradient-to-r from-laidback-500 to-laidback-600 hover:from-laidback-600 hover:to-laidback-700 text-white font-bold py-3 rounded-xl transition-all transform hover:-translate-y-0.5 shadow-md hover:shadow-lg">
                                        Add to Cart
                                    </button>
                                </form>
                            @else
                                <button disabled class="w-full bg-gray-300 text-gray-500 font-bold py-3 rounded-xl cursor-not-allowed">
                                    Out of Stock
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </main>

    <!-- Floating Cart Button -->
    @if($cartCount > 0)
        <div class="fixed bottom-6 right-6 z-50">
            <a href="{{ route('customer.cart') }}" class="flex items-center gap-3 bg-gradient-to-r from-laidback-500 to-laidback-600 text-white px-6 py-4 rounded-full shadow-2xl hover:shadow-3xl transition-all hover:scale-105">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <div>
                    <div class="text-xs opacity-90">View Cart</div>
                    <div class="font-bold">{{ $cartCount }} Items</div>
                </div>
                <div class="w-8 h-8 bg-white text-laidback-600 rounded-full flex items-center justify-center font-bold">
                    {{ $cartCount }}
                </div>
            </a>
        </div>
    @endif
</body>
</html>