{{-- resources/views/cashier/transactions.blade.php --}}
@extends('layouts.cashier')

@section('content')
<!-- Header -->
<div class="flex items-center justify-between mb-8">
    <div>
        <h2 class="text-3xl font-bold text-gray-800 mb-2">Transaction History</h2>
        <p class="text-gray-600">View and manage all transactions</p>
    </div>
</div>

<!-- Filters -->
<div class="bg-white rounded-2xl shadow-md p-6 mb-6">
    <form method="GET" action="{{ route('cashier.transactions') }}" class="flex gap-4">
        <div class="flex-1">
            <input 
                type="text" 
                name="search" 
                placeholder="Search by order number or customer name..."
                value="{{ $search }}"
                class="w-full px-4 py-2 border-2 border-gray-200 rounded-xl focus:border-laidback-500 outline-none"
            >
        </div>
        <select name="status" class="px-4 py-2 border-2 border-gray-200 rounded-xl focus:border-laidback-500 outline-none">
            <option value="all" {{ $status == 'all' ? 'selected' : '' }}>All Status</option>
            <option value="pending" {{ $status == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="paid" {{ $status == 'paid' ? 'selected' : '' }}>Paid</option>
        </select>
        <button type="submit" class="px-6 py-2 bg-laidback-500 hover:bg-laidback-600 text-white font-semibold rounded-xl transition">
            Filter
        </button>
        @if($search || $status != 'all')
            <a href="{{ route('cashier.transactions') }}" class="px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-xl transition">
                Clear
            </a>
        @endif
    </form>
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
                        <th class="text-left py-4 px-6 font-semibold text-gray-700">Status</th>
                        <th class="text-left py-4 px-6 font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                            <td class="py-4 px-6">
                                <span class="font-bold text-gray-800">{{ $transaction->order_number }}</span>
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
                                <span class="font-semibold text-gray-800">{{ $transaction->items->count() }}</span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-bold text-laidback-600">Rp {{ number_format($transaction->total, 0, ',', '.') }}</span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $transaction->status == 'paid' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                    {{ ucfirst($transaction->status) }}
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('cashier.transaction.show', $transaction->id) }}" class="p-2 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-lg transition" title="View Details">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                    @if($transaction->status == 'pending')
                                        <a href="{{ route('cashier.payment.show', $transaction->id) }}" class="p-2 bg-laidback-100 hover:bg-laidback-200 text-laidback-600 rounded-lg transition" title="Process Payment">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                            </svg>
                                        </a>
                                    @else
                                        <a href="{{ route('cashier.receipt', $transaction->id) }}" class="p-2 bg-green-100 hover:bg-green-200 text-green-600 rounded-lg transition" title="View Receipt">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                        </a>
                                    @endif
                                </div>
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