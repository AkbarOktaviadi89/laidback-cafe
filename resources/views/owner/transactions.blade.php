{{-- resources/views/owner/transactions.blade.php --}}
@extends('layouts.owner')

@section('content')
<div class="mb-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-2">Transaction History</h2>
    <p class="text-gray-600">View and manage all transactions</p>
</div>

<!-- Filters -->
<div class="bg-white rounded-2xl shadow-md p-6 mb-6">
    <form method="GET" action="{{ route('owner.transactions') }}" class="flex flex-wrap gap-4">
        <div class="flex-1 min-w-[200px]">
            <input 
                type="text" 
                name="search" 
                placeholder="Search by order number or customer name..."
                value="{{ $search ?? '' }}"
                class="w-full px-4 py-2 border-2 border-gray-200 rounded-xl focus:border-laidback-500 outline-none"
            >
        </div>
        
        <select name="status" class="px-4 py-2 border-2 border-gray-200 rounded-xl focus:border-laidback-500 outline-none">
            <option value="all" {{ ($status ?? 'all') == 'all' ? 'selected' : '' }}>All Status</option>
            <option value="pending" {{ ($status ?? '') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="paid" {{ ($status ?? '') == 'paid' ? 'selected' : '' }}>Paid</option>
            <option value="completed" {{ ($status ?? '') == 'completed' ? 'selected' : '' }}>Completed</option>
            <option value="cancelled" {{ ($status ?? '') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>
        
        <button type="submit" class="px-6 py-2 bg-gray-800 hover:bg-gray-900 text-white font-semibold rounded-xl transition">
            Filter
        </button>
        
        @if(($search ?? '') || ($status ?? 'all') != 'all')
            <a href="{{ route('owner.transactions') }}" class="px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-xl transition">
                Clear
            </a>
        @endif
    </form>
</div>

<!-- Summary Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-lg p-6 text-white">
        <div class="flex items-center justify-between mb-2">
            <p class="text-blue-100 font-semibold">Total Orders</p>
            <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold">{{ $transactions->total() }}</p>
    </div>
    
    <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl shadow-lg p-6 text-white">
        <div class="flex items-center justify-between mb-2">
            <p class="text-green-100 font-semibold">Completed</p>
            <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold">{{ $transactions->where('status', 'paid')->count() }}</p>
    </div>
    
    <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-2xl shadow-lg p-6 text-white">
        <div class="flex items-center justify-between mb-2">
            <p class="text-yellow-100 font-semibold">Pending</p>
            <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold">{{ $transactions->where('status', 'pending')->count() }}</p>
    </div>
    
    <div class="bg-gradient-to-br from-laidback-500 to-laidback-600 rounded-2xl shadow-lg p-6 text-white">
        <div class="flex items-center justify-between mb-2">
            <p class="text-orange-100 font-semibold">Total Revenue</p>
            <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold">Rp {{ number_format($transactions->where('status', 'paid')->sum('total'), 0, ',', '.') }}</p>
    </div>
</div>

<!-- Transactions Table -->
<div class="bg-white rounded-2xl shadow-md overflow-hidden">
    @if($transactions->isEmpty())
        <div class="text-center py-12">
            <div class="text-6xl mb-4">📋</div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">No Transactions Found</h3>
            <p class="text-gray-600">No transactions match your filters</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 border-b-2 border-gray-200">
                        <th class="text-left py-4 px-6 font-semibold text-gray-700">Order #</th>
                        <th class="text-left py-4 px-6 font-semibold text-gray-700">Customer</th>
                        <th class="text-left py-4 px-6 font-semibold text-gray-700">Date</th>
                        <th class="text-left py-4 px-6 font-semibold text-gray-700">Items</th>
                        <th class="text-left py-4 px-6 font-semibold text-gray-700">Total</th>
                        <th class="text-left py-4 px-6 font-semibold text-gray-700">Payment</th>
                        <th class="text-left py-4 px-6 font-semibold text-gray-700">Status</th>
                        <th class="text-left py-4 px-6 font-semibold text-gray-700">Cashier</th>
                        <th class="text-left py-4 px-6 font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                            <td class="py-4 px-6">
                                <span class="font-mono font-bold text-gray-800">{{ $transaction->order_number }}</span>
                            </td>
                            <td class="py-4 px-6">
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $transaction->customer_name }}</p>
                                    @if($transaction->table_number)
                                        <p class="text-sm text-gray-500">{{ $transaction->table_number }}</p>
                                    @endif
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <div>
                                    <p class="text-sm text-gray-800">{{ $transaction->created_at->format('d M Y') }}</p>
                                    <p class="text-xs text-gray-500">{{ $transaction->created_at->format('H:i') }}</p>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="text-gray-700">{{ $transaction->items->count() }} items</span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-bold text-gray-800">Rp {{ number_format($transaction->total, 0, ',', '.') }}</span>
                            </td>
                            <td class="py-4 px-6">
                                @if($transaction->payment_method)
                                    <span class="px-3 py-1 rounded-full text-xs font-bold {{ $transaction->payment_method === 'cash' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }}">
                                        {{ ucfirst($transaction->payment_method) }}
                                    </span>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $transaction->status == 'paid' ? 'bg-green-100 text-green-700' : ($transaction->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                                    {{ ucfirst($transaction->status) }}
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                @if($transaction->cashier)
                                    <span class="text-sm text-gray-700">{{ $transaction->cashier->name }}</span>
                                @else
                                    <span class="text-gray-400 text-sm">-</span>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                <a href="{{ route('owner.transactions.show', $transaction->id) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-laidback-100 hover:bg-laidback-200 text-laidback-700 font-semibold rounded-lg transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="p-6">
            {{ $transactions->links() }}
        </div>
    @endif
</div>
@endsection