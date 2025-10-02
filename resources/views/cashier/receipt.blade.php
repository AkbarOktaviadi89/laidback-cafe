{{-- resources/views/cashier/receipt.blade.php --}}
@extends('layouts.cashier')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <a href="{{ route('cashier.transactions') }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-xl transition">
            ← Back
        </a>
        <a href="{{ route('cashier.print-receipt', $order->id) }}" target="_blank" class="px-6 py-3 bg-laidback-500 hover:bg-laidback-600 text-white font-bold rounded-xl transition flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
            </svg>
            Print Receipt
        </a>
    </div>

    <!-- Receipt -->
    <div class="bg-white rounded-2xl shadow-2xl p-8 border-2 border-gray-200">
        <div class="text-center mb-6 pb-6 border-b-2 border-dashed">
            <h1 class="text-3xl font-bold text-gray-800 mb-1">Laidback Cafe</h1>
            <p class="text-sm text-gray-600">Thank you for your order!</p>
        </div>

        <div class="mb-6">
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-gray-500">Order Number</p>
                    <p class="font-bold text-gray-800">{{ $order->order_number }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Date</p>
                    <p class="font-bold text-gray-800">{{ $order->created_at->format('d M Y, H:i') }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Customer</p>
                    <p class="font-bold text-gray-800">{{ $order->customer_name }}</p>
                </div>
                @if($order->table_number)
                    <div>
                        <p class="text-gray-500">Table</p>
                        <p class="font-bold text-gray-800">{{ $order->table_number }}</p>
                    </div>
                @endif
                <div>
                    <p class="text-gray-500">Cashier</p>
                    <p class="font-bold text-gray-800">{{ $order->cashier->name }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Payment</p>
                    <p class="font-bold text-gray-800">{{ ucfirst($order->payment_method) }}</p>
                </div>
            </div>
        </div>

        <div class="mb-6">
            <h3 class="font-bold text-gray-800 mb-3">Items</h3>
            <div class="space-y-2">
                @foreach($order->items as $item)
                    <div class="flex justify-between text-sm">
                        <div class="flex-1">
                            <p class="font-semibold text-gray-800">{{ $item->product_name }}</p>
                            <p class="text-gray-500">{{ $item->quantity }} × Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                        </div>
                        <p class="font-bold text-gray-800">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="border-t-2 border-dashed pt-4 mb-6">
            <div class="space-y-2<div class="border-t-2 border-dashed pt-4 mb-6">
            <div class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-600">Subtotal</span>
                    <span class="font-semibold">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Tax (10%)</span>
                    <span class="font-semibold">Rp {{ number_format($order->tax, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-lg font-bold pt-2 border-t">
                    <span class="text-gray-800">Total</span>
                    <span class="text-laidback-600">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <div class="bg-green-50 rounded-xl p-4 border-2 border-green-200 mb-6">
            <div class="flex justify-between text-sm mb-2">
                <span class="text-gray-600">Amount Paid</span>
                <span class="font-bold text-gray-800">Rp {{ number_format($order->amount_paid, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Change</span>
                <span class="font-bold text-green-600 text-lg">Rp {{ number_format($order->change_amount, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="text-center pt-6 border-t-2 border-dashed">
            <p class="text-gray-600 text-sm mb-2">Visit us again soon!</p>
            <p class="text-gray-500 text-xs">www.laidbackcafe.com</p>
        </div>
    </div>
</div>
@endsection