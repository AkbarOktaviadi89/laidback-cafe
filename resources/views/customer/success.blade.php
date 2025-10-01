{{-- resources/views/customer/success.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success - Laidback Cafe</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
    <div class="min-h-screen flex items-center justify-center px-4 py-12">
        <div class="max-w-2xl w-full">
            <!-- Success Animation -->
            <div class="text-center mb-8">
                <div class="inline-block p-6 bg-green-100 rounded-full mb-4">
                    <svg class="w-20 h-20 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Order Placed Successfully!</h1>
                <p class="text-gray-600">Thank you for your order, {{ $order->customer_name }}</p>
            </div>

            <!-- Order Details Card -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
                <div class="border-b pb-4 mb-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500">Order Number</p>
                            <p class="text-xl font-bold text-gray-800">{{ $order->order_number }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-500">Status</p>
                            <span class="inline-block px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-sm font-bold">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <h3 class="font-bold text-gray-800 mb-3">Order Items</h3>
                    <div class="space-y-2">
                        @foreach($order->items as $item)
                            <div class="flex justify-between items-center py-2 border-b">
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $item->product_name }}</p>
                                    <p class="text-sm text-gray-500">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                </div>
                                <p class="font-bold text-gray-800">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="border-t pt-4">
                    <div class="space-y-2 mb-3">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Tax (10%)</span>
                            <span>Rp {{ number_format($order->tax, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center text-xl font-bold">
                        <span>Total</span>
                        <span class="text-laidback-600">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                    <div class="flex items-start gap-3">
                        <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <p class="font-semibold text-blue-800 mb-1">Next Steps</p>
                            <p class="text-sm text-blue-700">
                                Please proceed to the cashier to complete your payment. 
                                Show this order number: <strong>{{ $order->order_number }}</strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-4">
                <a href="{{ route('home') }}" class="flex-1 px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold rounded-xl text-center transition">
                    New Order
                </a>
                <button onclick="window.print()" class="flex-1 px-6 py-3 bg-laidback-500 hover:bg-laidback-600 text-white font-bold rounded-xl transition flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                    Print
                </button>
            </div>
        </div>
    </div>
</body>
</html>