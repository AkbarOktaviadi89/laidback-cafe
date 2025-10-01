{{-- resources/views/customer/checkout.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Laidback Cafe</title>
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
                <a href="{{ route('customer.cart') }}" class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center hover:bg-gray-200 transition">
                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <div>
                    <h1 class="text-xl font-bold text-gray-800">Checkout</h1>
                    <p class="text-sm text-gray-500">Complete your order</p>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-4 py-6 pb-32">
        <!-- Customer Info -->
        <div class="bg-gradient-to-r from-laidback-500 to-laidback-600 rounded-2xl p-6 mb-6 shadow-lg text-white">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm opacity-90">Customer</p>
                    <p class="text-lg font-bold">{{ session('customer_name') }}</p>
                </div>
            </div>
            @if(session('table_number'))
                <div class="flex items-center gap-2 text-sm opacity-90">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span>{{ session('table_number') }}</span>
                </div>
            @endif
        </div>

        <form action="{{ route('customer.checkout.place') }}" method="POST">
            @csrf
            
            <!-- Order Summary -->
            <div class="bg-white rounded-2xl shadow-md p-6 mb-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Order Summary</h2>
                <div class="space-y-3 mb-4">
                    @foreach($cart as $item)
                        <div class="flex justify-between items-center pb-3 border-b">
                            <div class="flex items-center gap-3">
                                <span class="text-2xl">🍽️</span>
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $item['name'] }}</p>
                                    <p class="text-sm text-gray-500">x{{ $item['quantity'] }}</p>
                                </div>
                            </div>
                            <p class="font-bold text-gray-800">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Payment Method -->
            <div class="bg-white rounded-2xl shadow-md p-6 mb-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Payment Method</h2>
                @error('payment_method')
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl text-sm">
                        {{ $message }}
                    </div>
                @enderror
                <div class="space-y-3">
                    <label class="flex items-center gap-4 p-4 border-2 {{ old('payment_method', 'cash') == 'cash' ? 'border-laidback-500 bg-laidback-50' : 'border-gray-200' }} rounded-xl cursor-pointer hover:border-laidback-300 transition">
                        <input type="radio" name="payment_method" value="cash" {{ old('payment_method', 'cash') == 'cash' ? 'checked' : '' }} class="w-5 h-5 text-laidback-600">
                        <div class="flex items-center gap-3 flex-1">
                            <div class="w-12 h-12 bg-laidback-100 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-laidback-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-gray-800">Cash</p>
                                <p class="text-sm text-gray-500">Pay at cashier</p>
                            </div>
                        </div>
                    </label>

                    <label class="flex items-center gap-4 p-4 border-2 {{ old('payment_method') == 'transfer' ? 'border-laidback-500 bg-laidback-50' : 'border-gray-200' }} rounded-xl cursor-pointer hover:border-laidback-300 transition">
                        <input type="radio" name="payment_method" value="transfer" {{ old('payment_method') == 'transfer' ? 'checked' : '' }} class="w-5 h-5 text-laidback-600">
                        <div class="flex items-center gap-3 flex-1">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-gray-800">Bank Transfer</p>
                                <p class="text-sm text-gray-500">Transfer to our account</p>
                            </div>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Notes -->
            <div class="bg-white rounded-2xl shadow-md p-6 mb-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Additional Notes (Optional)</h2>
                <textarea 
                    name="notes"
                    rows="3" 
                    placeholder="e.g., Less sugar, extra ice..."
                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-laidback-500 focus:ring-4 focus:ring-laidback-100 outline-none resize-none"
                >{{ old('notes') }}</textarea>
            </div>

            <!-- Price Breakdown -->
            <div class="bg-white rounded-2xl shadow-md p-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Price Details</h2>
                <div class="space-y-3">
                    <div class="flex justify-between text-gray-700">
                        <span>Subtotal</span>
                        <span class="font-semibold">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-gray-700">
                        <span>Tax (10%)</span>
                        <span class="font-semibold">Rp {{ number_format($tax, 0, ',', '.') }}</span>
                    </div>
                    <div class="border-t-2 pt-3 flex justify-between items-center">
                        <span class="text-xl font-bold text-gray-800">Total</span>
                        <span class="text-2xl font-bold text-laidback-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </form>
    </main>

    <!-- Bottom Action -->
    <div class="fixed bottom-0 left-0 right-0 bg-white border-t-2 border-gray-200 shadow-2xl z-50">
        <div class="max-w-4xl mx-auto px-4 py-4">
            <button onclick="document.querySelector('form').submit()" class="w-full bg-gradient-to-r from-laidback-500 to-laidback-600 hover:from-laidback-600 hover:to-laidback-700 text-white font-bold py-4 rounded-xl transition shadow-lg hover:shadow-xl text-lg flex items-center justify-center gap-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Place Order
            </button>
            <p class="text-center text-xs text-gray-500 mt-2">By placing order, you agree to our terms & conditions</p>
        </div>
    </div>
</body>
</html>