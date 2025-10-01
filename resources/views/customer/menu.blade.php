<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Laidback Cafe</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'laidback': {
                            50: '#fef7ee',
                            100: '#fdecd3',
                            200: '#fad6a5',
                            300: '#f7b96d',
                            400: '#f49333',
                            500: '#f1760b',
                            600: '#e25c01',
                            700: '#bb4304',
                            800: '#95350a',
                            900: '#782d0b',
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
                        <p class="text-xs text-gray-500">Hi, <span class="font-semibold text-laidback-600">John Doe</span></p>
                    </div>
                </div>
                <a href="/order/cart" class="relative">
                    <div class="w-12 h-12 bg-laidback-500 rounded-full flex items-center justify-center shadow-lg hover:shadow-xl transition-shadow">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span class="absolute -top-1 -right-1 w-6 h-6 bg-red-500 text-white text-xs font-bold rounded-full flex items-center justify-center">3</span>
                    </div>
                </a>
            </div>
        </div>
    </header>

    <!-- Categories -->
    <div class="bg-white border-b sticky top-[72px] z-40 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <div class="flex gap-2 overflow-x-auto no-scrollbar">
                <button class="category-btn active px-6 py-2 bg-laidback-500 text-white rounded-full font-semibold whitespace-nowrap shadow-md">
                    ☕ All
                </button>
                <button class="category-btn px-6 py-2 bg-gray-100 text-gray-700 rounded-full font-semibold hover:bg-gray-200 whitespace-nowrap transition">
                    ☕ Coffee
                </button>
                <button class="category-btn px-6 py-2 bg-gray-100 text-gray-700 rounded-full font-semibold hover:bg-gray-200 whitespace-nowrap transition">
                    🥤 Non-Coffee
                </button>
                <button class="category-btn px-6 py-2 bg-gray-100 text-gray-700 rounded-full font-semibold hover:bg-gray-200 whitespace-nowrap transition">
                    🍔 Food
                </button>
                <button class="category-btn px-6 py-2 bg-gray-100 text-gray-700 rounded-full font-semibold hover:bg-gray-200 whitespace-nowrap transition">
                    🍰 Dessert
                </button>
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
            <p class="text-gray-600">Choose your favorite items</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Menu Item Card 1 -->
            <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-shadow overflow-hidden animate-scaleIn">
                <div class="relative h-48 bg-gradient-to-br from-amber-100 to-orange-100 overflow-hidden">
                    <div class="absolute inset-0 flex items-center justify-center text-8xl">☕</div>
                    <div class="absolute top-3 right-3 bg-green-500 text-white px-3 py-1 rounded-full text-xs font-bold">
                        Available
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="text-lg font-bold text-gray-800 mb-1">Espresso</h3>
                    <p class="text-sm text-gray-500 mb-3">Single shot espresso yang kuat</p>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-2xl font-bold text-laidback-600">Rp 25.000</span>
                        <span class="text-xs text-gray-500 bg-gray-100 px-3 py-1 rounded-full">☕ Coffee</span>
                    </div>
                    <button class="w-full bg-gradient-to-r from-laidback-500 to-laidback-600 hover:from-laidback-600 hover:to-laidback-700 text-white font-bold py-3 rounded-xl transition-all transform hover:-translate-y-0.5 shadow-md hover:shadow-lg">
                        Add to Cart
                    </button>
                </div>
            </div>

            <!-- Menu Item Card 2 -->
            <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-shadow overflow-hidden animate-scaleIn" style="animation-delay: 0.1s;">
                <div class="relative h-48 bg-gradient-to-br from-amber-100 to-orange-100 overflow-hidden">
                    <div class="absolute inset-0 flex items-center justify-center text-8xl">☕</div>
                    <div class="absolute top-3 right-3 bg-green-500 text-white px-3 py-1 rounded-full text-xs font-bold">
                        Available
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="text-lg font-bold text-gray-800 mb-1">Cappuccino</h3>
                    <p class="text-sm text-gray-500 mb-3">Espresso dengan steamed milk dan foam</p>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-2xl font-bold text-laidback-600">Rp 35.000</span>
                        <span class="text-xs text-gray-500 bg-gray-100 px-3 py-1 rounded-full">☕ Coffee</span>
                    </div>
                    <button class="w-full bg-gradient-to-r from-laidback-500 to-laidback-600 hover:from-laidback-600 hover:to-laidback-700 text-white font-bold py-3 rounded-xl transition-all transform hover:-translate-y-0.5 shadow-md hover:shadow-lg">
                        Add to Cart
                    </button>
                </div>
            </div>

            <!-- Menu Item Card 3 -->
            <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-shadow overflow-hidden animate-scaleIn" style="animation-delay: 0.2s;">
                <div class="relative h-48 bg-gradient-to-br from-green-100 to-emerald-100 overflow-hidden">
                    <div class="absolute inset-0 flex items-center justify-center text-8xl">🍵</div>
                    <div class="absolute top-3 right-3 bg-green-500 text-white px-3 py-1 rounded-full text-xs font-bold">
                        Available
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="text-lg font-bold text-gray-800 mb-1">Matcha Latte</h3>
                    <p class="text-sm text-gray-500 mb-3">Green tea latte premium</p>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-2xl font-bold text-laidback-600">Rp 35.000</span>
                        <span class="text-xs text-gray-500 bg-gray-100 px-3 py-1 rounded-full">🥤 Non-Coffee</span>
                    </div>
                    <button class="w-full bg-gradient-to-r from-laidback-500 to-laidback-600 hover:from-laidback-600 hover:to-laidback-700 text-white font-bold py-3 rounded-xl transition-all transform hover:-translate-y-0.5 shadow-md hover:shadow-lg">
                        Add to Cart
                    </button>
                </div>
            </div>

            <!-- Menu Item Card 4 -->
            <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-shadow overflow-hidden animate-scaleIn" style="animation-delay: 0.3s;">
                <div class="relative h-48 bg-gradient-to-br from-yellow-100 to-amber-100 overflow-hidden">
                    <div class="absolute inset-0 flex items-center justify-center text-8xl">🥐</div>
                    <div class="absolute top-3 right-3 bg-green-500 text-white px-3 py-1 rounded-full text-xs font-bold">
                        Available
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="text-lg font-bold text-gray-800 mb-1">Croissant</h3>
                    <p class="text-sm text-gray-500 mb-3">Butter croissant segar</p>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-2xl font-bold text-laidback-600">Rp 25.000</span>
                        <span class="text-xs text-gray-500 bg-gray-100 px-3 py-1 rounded-full">🍔 Food</span>
                    </div>
                    <button class="w-full bg-gradient-to-r from-laidback-500 to-laidback-600 hover:from-laidback-600 hover:to-laidback-700 text-white font-bold py-3 rounded-xl transition-all transform hover:-translate-y-0.5 shadow-md hover:shadow-lg">
                        Add to Cart
                    </button>
                </div>
            </div>

            <!-- Menu Item Card 5 -->
            <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-shadow overflow-hidden animate-scaleIn" style="animation-delay: 0.4s;">
                <div class="relative h-48 bg-gradient-to-br from-pink-100 to-rose-100 overflow-hidden">
                    <div class="absolute inset-0 flex items-center justify-center text-8xl">🍰</div>
                    <div class="absolute top-3 right-3 bg-green-500 text-white px-3 py-1 rounded-full text-xs font-bold">
                        Available
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="text-lg font-bold text-gray-800 mb-1">Cheesecake</h3>
                    <p class="text-sm text-gray-500 mb-3">New York style cheesecake</p>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-2xl font-bold text-laidback-600">Rp 40.000</span>
                        <span class="text-xs text-gray-500 bg-gray-100 px-3 py-1 rounded-full">🍰 Dessert</span>
                    </div>
                    <button class="w-full bg-gradient-to-r from-laidback-500 to-laidback-600 hover:from-laidback-600 hover:to-laidback-700 text-white font-bold py-3 rounded-xl transition-all transform hover:-translate-y-0.5 shadow-md hover:shadow-lg">
                        Add to Cart
                    </button>
                </div>
            </div>

            <!-- Menu Item Card 6 -->
            <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-shadow overflow-hidden animate-scaleIn" style="animation-delay: 0.5s;">
                <div class="relative h-48 bg-gradient-to-br from-orange-100 to-amber-100 overflow-hidden">
                    <div class="absolute inset-0 flex items-center justify-center text-8xl">🥪</div>
                    <div class="absolute top-3 right-3 bg-green-500 text-white px-3 py-1 rounded-full text-xs font-bold">
                        Available
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="text-lg font-bold text-gray-800 mb-1">Sandwich</h3>
                    <p class="text-sm text-gray-500 mb-3">Sandwich dengan berbagai isian</p>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-2xl font-bold text-laidback-600">Rp 35.000</span>
                        <span class="text-xs text-gray-500 bg-gray-100 px-3 py-1 rounded-full">🍔 Food</span>
                    </div>
                    <button class="w-full bg-gradient-to-r from-laidback-500 to-laidback-600 hover:from-laidback-600 hover:to-laidback-700 text-white font-bold py-3 rounded-xl transition-all transform hover:-translate-y-0.5 shadow-md hover:shadow-lg">
                        Add to Cart
                    </button>
                </div>
            </div>
        </div>
    </main>

    <!-- Floating Cart Button -->
    <div class="fixed bottom-6 right-6 z-50">
        <a href="/order/cart" class="flex items-center gap-3 bg-gradient-to-r from-laidback-500 to-laidback-600 text-white px-6 py-4 rounded-full shadow-2xl hover:shadow-3xl transition-all hover:scale-105">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <div>
                <div class="text-xs opacity-90">View Cart</div>
                <div class="font-bold">3 Items</div>
            </div>
            <div class="w-8 h-8 bg-white text-laidback-600 rounded-full flex items-center justify-center font-bold">
                3
            </div>
        </a>
    </div>

    <script>
        // Category filter functionality
        document.querySelectorAll('.category-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.category-btn').forEach(b => {
                    b.classList.remove('active', 'bg-laidback-500', 'text-white', 'shadow-md');
                    b.classList.add('bg-gray-100', 'text-gray-700');
                });
                this.classList.add('active', 'bg-laidback-500', 'text-white', 'shadow-md');
                this.classList.remove('bg-gray-100', 'text-gray-700');
            });
        });
    </script>
</body>
</html>