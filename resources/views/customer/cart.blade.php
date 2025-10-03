{{-- resources/views/customer/cart.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cart - Laidback Cafe</title>
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
                <a href="{{ route('customer.menu') }}" class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center hover:bg-gray-200 transition">
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
        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        @if(empty($cart) || count($cart) == 0)
            <div class="text-center py-12">
                <div class="text-6xl mb-4">🛒</div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Your cart is empty</h3>
                <p class="text-gray-600 mb-6">Start adding some delicious items!</p>
                <a href="{{ route('customer.menu') }}" class="inline-block px-6 py-3 bg-laidback-500 hover:bg-laidback-600 text-white font-bold rounded-xl transition">
                    Browse Menu
                </a>
            </div>
        @else
            <!-- Cart Items -->
            <div class="space-y-4 mb-6">
                @foreach($cart as $id => $item)
                    <div class="bg-white rounded-2xl shadow-md p-4 hover:shadow-lg transition">
                        <div class="flex gap-4">
                            <div class="w-20 h-20 bg-gradient-to-br from-amber-100 to-orange-100 rounded-xl flex items-center justify-center text-4xl flex-shrink-0">
                                @if(isset($item['image']) && $item['image'])
                                    <img src="{{ Storage::url($item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover rounded-xl">
                                @else
                                    🍽️
                                @endif
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-gray-800 mb-1">{{ $item['name'] }}</h3>
                                <p class="text-sm text-gray-500 mb-2">Rp {{ number_format($item['price'], 0, ',', '.') }} each</p>
                                <p class="text-lg font-bold text-laidback-600">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</p>
                            </div>
                            <div class="flex flex-col items-end justify-between">
                                <form action="{{ route('customer.cart.remove', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 p-1">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                                <div class="flex items-center gap-2 bg-gray-100 rounded-lg">
                                    <form action="{{ route('customer.cart.update', $id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="quantity" value="{{ max(1, $item['quantity'] - 1) }}">
                                        <button type="submit" class="w-8 h-8 flex items-center justify-center hover:bg-gray-200 rounded-lg transition font-bold text-gray-700">-</button>
                                    </form>
                                    <span class="w-8 text-center font-bold text-gray-800">{{ $item['quantity'] }}</span>
                                    <form action="{{ route('customer.cart.update', $id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="quantity" value="{{ $item['quantity'] + 1 }}">
                                        <button type="submit" class="w-8 h-8 flex items-center justify-center hover:bg-gray-200 rounded-lg transition font-bold text-gray-700">+</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Add More Items Button -->
            <a href="{{ route('customer.menu') }}" class="block w-full bg-white border-2 border-dashed border-gray-300 rounded-2xl p-4 text-center hover:border-laidback-500 hover:bg-laidback-50 transition group">
                <div class="flex items-center justify-center gap-2 text-gray-600 group-hover:text-laidback-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span class="font-semibold">Add More Items</span>
                </div>
            </a>
        @endif
    </main>

    @if(!empty($cart) && count($cart) > 0)
        <!-- Bottom Summary Card -->
        <div class="fixed bottom-0 left-0 right-0 bg-white border-t-2 border-gray-200 shadow-2xl z-50">
            <div class="max-w-4xl mx-auto px-4 py-4">
                <!-- Summary Details -->
                <div class="space-y-2 mb-4">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Subtotal ({{ array_sum(array_column($cart, 'quantity')) }} items)</span>
                        <span class="font-semibold text-gray-800">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Tax (10%)</span>
                        <span class="font-semibold text-gray-800">Rp {{ number_format($tax, 0, ',', '.') }}</span>
                    </div>
                    <div class="border-t-2 pt-2 flex justify-between items-center">
                        <span class="text-lg font-bold text-gray-800">Total</span>
                        <span class="text-2xl font-bold text-laidback-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>
                
                <!-- Checkout Button -->
                <a href="{{ route('customer.checkout') }}" class="block w-full bg-gradient-to-r from-laidback-500 to-laidback-600 hover:from-laidback-600 hover:to-laidback-700 text-white font-bold py-4 rounded-xl transition shadow-lg hover:shadow-xl text-center text-lg">
                    Proceed to Checkout
                </a>
            </div>
        </div>
    @endif
</body>
</html>