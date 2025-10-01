<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Laidback Cafe</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'laidback': {
                            500: '#f1760b',
                            600: '#e25c01',
                            700: '#bb4304',
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
        <div class="max-w-4xl mx-auto px-4 py-4">
            <div class="flex items-center gap-4">
                <a href="/order/menu" class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center hover:bg-gray-200 transition">
                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <div>
                    <h1 class="text-xl font-bold text-gray-800">Shopping Cart</h1>
                    <p class="text-sm text-gray-500">Review your order</p>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-4 py-6 pb-32">
        <!-- Cart Items -->
        <div class="space-y-4 mb-6">
            <!-- Cart Item 1 -->
            <div class="bg-white rounded-2xl shadow-md p-4 hover:shadow-lg transition">
                <div class="flex gap-4">
                    <div class="w-20 h-20 bg-gradient-to-br from-amber-100 to-orange-100 rounded-xl flex items-center justify-center text-4xl flex-shrink-0">
                        ☕
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold text-gray-800 mb-1">Espresso</h3>
                        <p class="text-sm text-gray-500 mb-2">Single shot espresso yang kuat</p>
                        <p class="text-lg font-bold text-laidback-600">Rp 25.000</p>
                    </div>
                    <div class="flex flex-col items-end justify-between">
                        <button class="text-red-500 hover:text-red-700 p-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                        <div class="flex items-center gap-2 bg-gray-100 rounded-lg">
                            <button class="w-8 h-8 flex items-center justify-center hover:bg-gray-200 rounded-lg transition font-bold text-gray-700">-</button>
                            <span class="w-8 text-center font-bold text-gray-800">2</span>
                            <button class="w-8 h-8 flex items-center justify-center hover:bg-gray-200 rounded-lg transition font-bold text-gray-700">+</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cart Item 2 -->
            <div class="bg-white rounded-2xl shadow-md p-4 hover:shadow-lg transition">
                <div class="flex gap-4">
                    <div class="w-20 h-20 bg-gradient-to-br from-amber-100 to-orange-100 rounded-xl flex items-center justify-center text-4xl flex-shrink-0">
                        ☕
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold text-gray-800 mb-1">Cappuccino</h3>
                        <p class="text-sm text-gray-500 mb-2">Espresso dengan steamed milk</p>
                        <p class="text-lg font-bold text-laidback-600">Rp 35.000</p>
                    </div>
                    <div class="flex flex-col items-end justify-between">
                        <button class="text-red-500 hover:text-red-700 p-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                        <div class="flex items-center gap-2 bg-gray-100 rounded-lg">
                            <button class="w-8 h-8 flex items-center justify-center hover:bg-gray-200 rounded-lg transition font-bold text-gray-700">-</button>
                            <span class="w-8 text-center font-bold text-gray-800">1</span>
                            <button class="w-8 h-8 flex items-center justify-center hover:bg-gray-200 rounded-lg transition font-bold text-gray-700">+</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cart Item 3 -->
            <div class="bg-white rounded-2xl shadow-md p-4 hover:shadow-lg transition">
                <div class="flex gap-4">
                    <div class="w-20 h-20 bg-gradient-to-br from-yellow-100 to-amber-100 rounded-xl flex items-center justify-center text-4xl flex-shrink-0">
                        🥐
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold text-gray-800 mb-1">Croissant</h3>
                        <p class="text-sm text-gray-500 mb-2">Butter croissant segar</p>
                        <p class="text-lg font-bold text-laidback-600">Rp 25.000</p>
                    </div>
                    <div class="flex flex-col items-end justify-between">
                        <button class="text-red-500 hover:text-red-700 p-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                        <div class="flex items-center gap-2 bg-gray-100 rounded-lg">
                            <button class="w-8 h-8 flex items-center justify-center hover:bg-gray-200 rounded-lg transition font-bold text-gray-700">-</button>
                            <span class="w-8 text-center font-bold text-gray-800">1</span>
                            <button class="w-8 h-8 flex items-center justify-center hover:bg-gray-200 rounded-lg transition font-bold text-gray-700">+</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add More Items Button -->
        <a href="/order/menu" class="block w-full bg-white border-2 border-dashed border-gray-300 rounded-2xl p-4 text-center hover:border-laidback-500 hover:bg-laidback-50 transition group">
            <div class="flex items-center justify-center gap-2 text-gray-600 group-hover:text-laidback-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                <span class="font-semibold">Add More Items</span>
            </div>
        </a>
    </main>

    <!-- Bottom Summary Card -->
    <div class="fixed bottom-0 left-0 right-0 bg-white border-t-2 border-gray-200 shadow-2xl z-50">
        <div class="max-w-4xl mx-auto px-4 py-4">
            <!-- Summary Details -->
            <div class="space-y-2 mb-4">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Subtotal (4 items)</span>
                    <span class="font-semibold text-gray-800">Rp 110.000</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Tax (10%)</span>
                    <span class="font-semibold text-gray-800">Rp 11.000</span>
                </div>
                <div class="border-t pt-2 flex justify-between">
                    <span class="font-bold text-gray-800 text-lg">Total</span>
                    <span class="font-bold text-laidback-600 text-2xl">Rp 121.000</span>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-3">
                <button class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-4 rounded-xl transition">
                    Clear Cart
                </button>
                <a href="/order/checkout" class="flex-1 bg-gradient-to-r from-laidback-500 to-laidback-600 hover:from-laidback-600 hover:to-laidback-700 text-white font-bold py-4 rounded-xl transition shadow-lg hover:shadow-xl text-center">
                    Checkout
                </a>
            </div>
        </div>
    </div>

    <script>
        // Quantity controls
        document.querySelectorAll('.flex.items-center.gap-2').forEach(control => {
            const minus = control.querySelector('button:first-child');
            const plus = control.querySelector('button:last-child');
            const quantity = control.querySelector('span');

            minus.addEventListener('click', () => {
                let val = parseInt(quantity.textContent);
                if (val > 1) {
                    quantity.textContent = val - 1;
                    updateTotal();
                }
            });

            plus.addEventListener('click', () => {
                let val = parseInt(quantity.textContent);
                quantity.textContent = val + 1;
                updateTotal();
            });
        });

        function updateTotal() {
            // Calculate total logic here
            console.log('Total updated');
        }
    </script>
</body>
</html>