{{-- resources/views/cashier/dashboard.blade.php --}}
@extends('layouts.cashier')

@section('content')
<!-- Header -->
<div class="mb-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-2">Cashier Dashboard</h2>
    <p class="text-gray-600">Welcome back, {{ auth()->user()->name }}</p>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white shadow-lg">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
            </div>
        </div>
        <p class="text-sm opacity-90 mb-1">Today's Orders</p>
        <p class="text-4xl font-bold">{{ $todayOrders }}</p>
    </div>

    <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 text-white shadow-lg">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
        <p class="text-sm opacity-90 mb-1">Today's Revenue</p>
        <p class="text-4xl font-bold">Rp {{ number_format($todayRevenue / 1000, 0) }}K</p>
    </div>

    <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-6 text-white shadow-lg">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
        <p class="text-sm opacity-90 mb-1">Completed Today</p>
        <p class="text-4xl font-bold">{{ $completedToday }}</p>
    </div>
</div>

<!-- Pending Orders -->
<div class="bg-white rounded-2xl shadow-lg p-6">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h3 class="text-2xl font-bold text-gray-800">Pending Orders</h3>
            <p class="text-sm text-gray-500">Orders waiting for payment</p>
        </div>
        <span class="px-4 py-2 bg-yellow-100 text-yellow-700 rounded-full font-bold text-lg">
            {{ $pendingOrders->count() }}
        </span>
    </div>

    @if($pendingOrders->isEmpty())
        <div class="text-center py-12">
            <div class="text-6xl mb-4">✅</div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">No Pending Orders</h3>
            <p class="text-gray-600">All orders have been processed</p>
        </div>
    @else
        <div class="space-y-4">
            @foreach($pendingOrders as $order)
                <div class="bg-gradient-to-r from-yellow-50 to-orange-50 rounded-xl p-5 border-2 border-yellow-200 hover:shadow-md transition">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <span class="font-bold text-lg text-gray-800">{{ $order->order_number }}</span>
                                <span class="px-2 py-1 bg-yellow-500 text-white rounded-full text-xs font-bold">PENDING</span>
                            </div>
                            <p class="text-sm text-gray-600">
                                <span class="font-semibold">{{ $order->customer_name }}</span>
                                @if($order->table_number)
                                    • {{ $order->table_number }}
                                @endif
                            </p>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-bold text-laidback-600">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                            <p class="text-xs text-gray-500">{{ $order->created_at->diffForHumans() }}</p>
                        </div>
                    </div>

                    <!-- Order Items Preview -->
                    <div class="bg-white rounded-lg p-3 mb-3">
                        <p class="text-xs font-semibold text-gray-600 mb-2">Order Items:</p>
                        <div class="space-y-1">
                            @foreach($order->items->take(3) as $item)
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-700">{{ $item->quantity }}x {{ $item->product_name }}</span>
                                    <span class="font-semibold text-gray-800">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                            @if($order->items->count() > 3)
                                <p class="text-xs text-gray-500 italic">+{{ $order->items->count() - 3 }} more items</p>
                            @endif
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-3">
                        <a href="{{ route('cashier.payment.show', $order->id) }}" class="flex-1 bg-gradient-to-r from-laidback-500 to-laidback-600 hover:from-laidback-600 hover:to-laidback-700 text-white font-bold py-3 rounded-xl transition text-center">
                            Process Payment
                        </a>
                        <a href="{{ route('cashier.transaction.show', $order->id) }}" class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-xl transition">
                            View Details
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection