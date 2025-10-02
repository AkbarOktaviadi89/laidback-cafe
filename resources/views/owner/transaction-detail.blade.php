{{-- resources/views/owner/transaction-detail.blade.php --}}
@extends('layouts.owner')

@section('content')
<!-- Header -->
<div class="flex items-center justify-between mb-8">
    <div class="flex items-center gap-4">
        <a href="{{ route('owner.transactions') }}" class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow hover:shadow-md transition">
            <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Transaction Details</h1>
            <p class="text-sm text-gray-500">Order #{{ $order->order_number }}</p>
        </div>
    </div>
    <div class="flex gap-3">
        @if($order->status == 'paid')
            <button onclick="window.print()" class="px-4 py-2 bg-gray-800 hover:bg-gray-900 text-white font-semibold rounded-xl transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
                Print
            </button>
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
                    <p class="text-sm text-gray-500 mb-1">Order Number</p>
                    <p class="font-bold text-gray-800">{{ $order->order_number }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 mb-1">Order Date</p>
                    <p class="font-semibold text-gray-800">{{ $order->created_at->format('d M Y, H:i') }}</p>
                </div>
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
                    <p class="text-sm text-gray-500 mb-1">Status</p>
                    <span class="inline-block px-3 py-1 rounded-full text-sm font-bold {{ $order->status == 'paid' ? 'bg-green-100 text-green-700' : ($order->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
                @if($order->payment_method)
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Payment Method</p>
                        <span class="inline-block px-3 py-1 rounded-full text-sm font-bold {{ $order->payment_method == 'cash' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }}">
                            {{ ucfirst($order->payment_method) }}
                        </span>
                    </div>
                @endif
                @if($order->cashier)
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Processed By</p>
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
                    <div class="flex justify-between items-center pb-3 border-b border-gray-200 last:border-0">
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
                <h3 class="font-bold text-gray-800 mb-2 flex items-center gap-2">
                    <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                    </svg>
                    Order Notes
                </h3>
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
                    <span class="font-semibold text-gray-800">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Tax (10%)</span>
                    <span class="font-semibold text-gray-800">Rp {{ number_format($order->tax, 0, ',', '.') }}</span>
                </div>
                <div class="border-t-2 border-gray-200 pt-3 flex justify-between">
                    <span class="font-bold text-gray-800">Total</span>
                    <span class="text-2xl font-bold text-laidback-600">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                </div>
            </div>

            @if($order->status == 'paid')
                <div class="bg-green-50 rounded-xl p-4 border-2 border-green-200 mt-4">
                    <div class="flex items-center gap-2 mb-3">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="font-bold text-green-800">Payment Completed</p>
                    </div>
                    
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Amount Paid</span>
                            <span class="font-semibold text-gray-800">Rp {{ number_format($order->amount_paid, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Change</span>
                            <span class="font-semibold text-green-600">Rp {{ number_format($order->change_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-yellow-50 rounded-xl p-4 border-2 border-yellow-200 mt-4">
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="font-bold text-yellow-800">Payment Pending</p>
                    </div>
                    <p class="text-sm text-yellow-700">This order is waiting for payment processing</p>
                </div>
            @endif
        </div>

        <!-- Timeline -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Order Timeline</h2>
            <div class="space-y-4">
                <div class="flex gap-3">
                    <div class="flex flex-col items-center">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                        @if($order->status == 'paid')
                            <div class="w-0.5 h-full bg-blue-200 my-1"></div>
                        @endif
                    </div>
                    <div class="flex-1 pb-4">
                        <p class="font-semibold text-gray-800">Order Created</p>
                        <p class="text-sm text-gray-500">{{ $order->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>

                @if($order->status == 'paid')
                    <div class="flex gap-3">
                        <div class="flex flex-col items-center">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <p class="font-semibold text-gray-800">Payment Completed</p>
                            <p class="text-sm text-gray-500">{{ $order->paid_at->format('d M Y, H:i') }}</p>
                            @if($order->cashier)
                                <p class="text-xs text-gray-400 mt-1">By {{ $order->cashier->name }}</p>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-gradient-to-br from-laidback-500 to-laidback-600 rounded-2xl shadow-lg p-6 text-white">
            <h3 class="font-bold mb-4">Quick Actions</h3>
            <div class="space-y-2">
                <a href="{{ route('owner.transactions') }}" class="block w-full px-4 py-2 bg-white/20 hover:bg-white/30 rounded-lg font-semibold transition text-center">
                    View All Transactions
                </a>
                @if($order->status == 'paid')
                    <button onclick="window.print()" class="block w-full px-4 py-2 bg-white/20 hover:bg-white/30 rounded-lg font-semibold transition">
                        Print Receipt
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        body * {
            visibility: hidden;
        }
        .print-area, .print-area * {
            visibility: visible;
        }
        .print-area {
            position: absolute;
            left: 0;
            top: 0;
        }
    }
</style>
@endsection