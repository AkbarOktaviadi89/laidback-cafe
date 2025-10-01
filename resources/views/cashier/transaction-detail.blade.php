{{-- resources/views/cashier/transaction-detail.blade.php --}}
@extends('layouts.cashier')

@section('content')
<!-- Header -->
<div class="flex items-center justify-between mb-8">
    <div class="flex items-center gap-4">
        <a href="{{ route('cashier.transactions') }}" class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow hover:shadow-md transition">
            <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Transaction Details</h1>
            <p class="text-sm text-gray-500">Order {{ $order->order_number }}</p>
        </div>
    </div>
    <div class="flex gap-3">
        @if($order->status == 'pending')
            <a href="{{ route('cashier.payment.show', $order->id) }}" class="px-6 py-3 bg-laidback-500 hover:bg-laidback-600 text-white font-bold rounded-xl transition">
                Process Payment
            </a>
        @else
            <a href="{{ route('cashier.receipt', $order->id) }}" class="px-6 py-3 bg-green-500 hover:bg-green-600 text-white font-bold rounded-xl transition">
                View Receipt
            </a>
        @endif
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Order Info -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Customer & Order Info -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Order Information</h2>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Customer Name</p>
                    <p class="font-semibold text-gray-800">{{ $order->customer_name }}</p>
                </div>
                @if($order->table_number)
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Table Number</p>
                        <p class="font-semibold text-gray-800">{{ $order->table_number }}</p>
                    </div>
                @endif
                <div>
                    <p class="text-sm text-gray-500 mb-1">Order Date</p>
                    <p class="font-semibold text-gray-800">{{ $order->created_at->format('d M Y, H:i') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 mb-1">Status</p>
                    <span class="inline-block px-3 py-1 rounded-full text-sm font-bold {{ $order->status == 'paid' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
                @if($order->cashier)
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Cashier</p>
                        <p class="font-semibold text-gray-800">{{ $order->cashier->name }}</p>
                    </div>
                @endif
                @if($order->paid_at)
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Paid At</p>
                        <p class="font-semibold text-gray-800">{{ $order->paid_at->format('d M Y, H:i') }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Order Items -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Order Items</h2>
            <div class="space-y-3">
                @foreach($order->items as $item)
                    <div class="flex justify-between items-center pb-3 border-b">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-gradient-to-br from-amber-100 to-orange-100 rounded-xl flex items-center justify-center text-2xl">
                                {{ $item->product->category->icon ?? '🍽️' }}
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800">{{ $item->product_name }}</p>
                                <p class="text-sm text-gray-500">Rp {{ number_format($item->price, 0, ',', '.') }} × {{ $item->quantity }}</p>
                            </div>
                        </div>
                        <p class="font-bold text-gray-800">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        @if($order->notes)
            <!-- Notes -->
            <div class="bg-yellow-50 rounded-2xl p-6 border-2 border-yellow-200">
                <h3 class="font-bold text-gray-800 mb-2">Order Notes</h3>
                <p class="text-gray-700">{{ $order->notes }}</p>
            </div>
        @endif
    </div>

    <!-- Payment Summary -->
    <div class="space-y-6">
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Payment Summary</h2>
            <div class="space-y-3 mb-4">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Subtotal</span>
                    <span class="font-semibold">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Tax (10%)</span>
                    <span class="font-semibold">Rp {{ number_format($order->tax, 0, ',', '.') }}</span>
                </div>
                <div class="border-t-2 pt-3 flex justify-between">
                    <span class="font-bold text-gray-800">Total</span>
                    <span class="text-2xl font-bold text-laidback-600">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                </div>
            </div>

            @if($order->status == 'paid')
                <div class="bg-green-50 rounded-xl p-4 border-2 border-green-200">
                    <p class="text-sm text-gray-600 mb-2">Payment Method</p>
                    <p class="font-bold text-gray-800 mb-3">{{ ucfirst($order->payment_method) }}</p>
                    
                    <div class="space-y-1 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Amount Paid</span>
                            <span class="font-semibold">Rp {{ number_format($order->amount_paid, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Change</span>
                            <span class="font-semibold text-green-600">Rp {{ number_format($order->change_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection