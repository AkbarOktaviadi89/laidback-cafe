{{-- resources/views/owner/dashboard.blade.php --}}
@extends('layouts.owner')

@section('content')
<!-- Header -->
<div class="flex items-center justify-between mb-8">
    <div>
        <h2 class="text-3xl font-bold text-gray-800 mb-2">Dashboard Overview</h2>
        <p class="text-gray-600">Monitor your business performance</p>
    </div>
    <div class="flex items-center gap-3">
        <form method="GET" action="{{ route('owner.dashboard') }}">
            <select name="period" onchange="this.form.submit()" class="px-4 py-2 bg-white border-2 border-gray-200 rounded-xl font-semibold text-gray-700 focus:border-laidback-500 outline-none">
                <option value="today" {{ $period == 'today' ? 'selected' : '' }}>Today</option>
                <option value="week" {{ $period == 'week' ? 'selected' : '' }}>This Week</option>
                <option value="month" {{ $period == 'month' ? 'selected' : '' }}>This Month</option>
                <option value="year" {{ $period == 'year' ? 'selected' : '' }}>This Year</option>
            </select>
        </form>
        <button class="px-4 py-2 bg-laidback-500 hover:bg-laidback-600 text-white font-semibold rounded-xl transition flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
            </svg>
            Export
        </button>
    </div>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Revenue -->
    <div class="bg-white rounded-2xl p-6 shadow-md hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <span class="text-xs font-bold {{ $revenueGrowth >= 0 ? 'text-green-500 bg-green-50' : 'text-red-500 bg-red-50' }} px-2 py-1 rounded-full">
                {{ $revenueGrowth >= 0 ? '+' : '' }}{{ number_format($revenueGrowth, 1) }}%
            </span>
        </div>
        <p class="text-gray-500 text-sm mb-1">Total Revenue</p>
        <p class="text-3xl font-bold text-gray-800">Rp {{ number_format($totalRevenue / 1000000, 1) }}M</p>
        <p class="text-xs text-gray-400 mt-2">{{ ucfirst($period) }}</p>
    </div>

    <!-- Total Orders -->
    <div class="bg-white rounded-2xl p-6 shadow-md hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-purple-600 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
            </div>
            <span class="text-xs font-bold {{ $ordersGrowth >= 0 ? 'text-green-500 bg-green-50' : 'text-red-500 bg-red-50' }} px-2 py-1 rounded-full">
                {{ $ordersGrowth >= 0 ? '+' : '' }}{{ number_format($ordersGrowth, 1) }}%
            </span>
        </div>
        <p class="text-gray-500 text-sm mb-1">Total Orders</p>
        <p class="text-3xl font-bold text-gray-800">{{ number_format($totalOrders) }}</p>
        <p class="text-xs text-gray-400 mt-2">{{ ucfirst($period) }}</p>
    </div>

    <!-- Total Customers -->
    <div class="bg-white rounded-2xl p-6 shadow-md hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-gradient-to-br from-orange-400 to-orange-600 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
            <span class="text-xs font-bold {{ $customersGrowth >= 0 ? 'text-green-500 bg-green-50' : 'text-red-500 bg-red-50' }} px-2 py-1 rounded-full">
                {{ $customersGrowth >= 0 ? '+' : '' }}{{ number_format($customersGrowth, 1) }}%
            </span>
        </div>
        <p class="text-gray-500 text-sm mb-1">Total Customers</p>
        <p class="text-3xl font-bold text-gray-800">{{ number_format($totalCustomers) }}</p>
        <p class="text-xs text-gray-400 mt-2">{{ ucfirst($period) }}</p>
    </div>

    <!-- Avg Order Value -->
    <div class="bg-white rounded-2xl p-6 shadow-md hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-green-600 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                </svg>
            </div>
            <span class="text-xs font-bold {{ $avgGrowth >= 0 ? 'text-green-500 bg-green-50' : 'text-red-500 bg-red-50' }} px-2 py-1 rounded-full">
                {{ $avgGrowth >= 0 ? '+' : '' }}{{ number_format($avgGrowth, 1) }}%
            </span>
        </div>
        <p class="text-gray-500 text-sm mb-1">Avg Order Value</p>
        <p class="text-3xl font-bold text-gray-800">Rp {{ number_format($avgOrderValue / 1000, 0) }}K</p>
        <p class="text-xs text-gray-400 mt-2">{{ ucfirst($period) }}</p>
    </div>
</div>

<!-- Charts & Top Products -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Revenue Chart -->
    <div class="bg-white rounded-2xl p-6 shadow-md">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-lg font-bold text-gray-800">Revenue Trend</h3>
                <p class="text-sm text-gray-500">Last 7 days performance</p>
            </div>
        </div>
        <canvas id="revenueChart" height="250"></canvas>
    </div>

    <!-- Top Products -->
    <div class="bg-white rounded-2xl p-6 shadow-md">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-lg font-bold text-gray-800">Top Products</h3>
                <p class="text-sm text-gray-500">Best selling items</p>
            </div>
        </div>
        @if($topProducts->isEmpty())
            <div class="text-center py-8 text-gray-500">
                <p>No sales data available</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach($topProducts as $item)
                    @php
                        $maxRevenue = $topProducts->max('total_revenue');
                        $percentage = $maxRevenue > 0 ? ($item->total_revenue / $maxRevenue) * 100 : 0;
                    @endphp
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-amber-100 to-orange-100 rounded-xl flex items-center justify-center text-2xl">
                            {{ $item->product->category->icon ?? 'ðŸ½ï¸' }}
                        </div>
                        <div class="flex-1">
                            <p class="font-semibold text-gray-800">{{ $item->product_name }}</p>
                            <p class="text-sm text-gray-500">{{ $item->total_quantity }} orders</p>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-gray-800">Rp {{ number_format($item->total_revenue / 1000000, 1) }}M</p>
                            <div class="w-20 h-2 bg-gray-200 rounded-full mt-1 overflow-hidden">
                                <div class="h-full bg-laidback-500" style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<!-- Recent Transactions & Low Stock -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Recent Transactions -->
    <div class="bg-white rounded-2xl p-6 shadow-md">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-bold text-gray-800">Recent Transactions</h3>
            <a href="{{ route('owner.transactions') }}" class="text-sm text-laidback-600 font-semibold hover:underline">View All</a>
        </div>
        @if($recentTransactions->isEmpty())
            <div class="text-center py-8 text-gray-500">
                <p>No transactions yet</p>
            </div>
        @else
            <div class="space-y-3">
                @foreach($recentTransactions->take(5) as $transaction)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-laidback-100 rounded-full flex items-center justify-center">
                                <span class="text-xs font-bold text-laidback-600">{{ strtoupper(substr($transaction->customer_name, 0, 2)) }}</span>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800 text-sm">{{ $transaction->customer_name }}</p>
                                <p class="text-xs text-gray-500">{{ $transaction->order_number }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-gray-800 text-sm">Rp {{ number_format($transaction->total / 1000, 0) }}K</p>
                            <span class="text-xs px-2 py-1 rounded-full {{ $transaction->status == 'paid' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                {{ ucfirst($transaction->status) }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Low Stock Alert -->
    <div class="bg-white rounded-2xl p-6 shadow-md">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-bold text-gray-800">Low Stock Alert</h3>
            <span class="text-sm bg-red-100 text-red-700 px-3 py-1 rounded-full font-semibold">{{ $lowStockProducts->count() }}</span>
        </div>
        @if($lowStockProducts->isEmpty())
            <div class="text-center py-8 text-gray-500">
                <p>✅ All products well stocked</p>
            </div>
        @else
            <div class="space-y-3">
                @foreach($lowStockProducts as $product)
                    <div class="flex items-center justify-between p-3 bg-red-50 rounded-lg border border-red-200">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center text-xl">
                                {{ $product->category->icon ?? 'ðŸ½ï¸' }}
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800 text-sm">{{ $product->name }}</p>
                                <p class="text-xs text-gray-500">{{ $product->category->name }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-red-600">{{ $product->stock }} left</p>
                            <a href="{{ route('owner.products.edit', $product->id) }}" class="text-xs text-laidback-600 hover:underline">Update</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<!-- Cashier Performance -->
@if($cashierPerformance->isNotEmpty())
<div class="bg-white rounded-2xl p-6 shadow-md">
    <h3 class="text-lg font-bold text-gray-800 mb-6">Cashier Performance</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($cashierPerformance as $performance)
            <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl p-5 text-white">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                        <span class="font-bold">{{ strtoupper(substr($performance->cashier->name, 0, 2)) }}</span>
                    </div>
                    <div>
                        <p class="font-bold">{{ $performance->cashier->name }}</p>
                        <p class="text-xs opacity-80">{{ $performance->cashier->email }}</p>
                    </div>
                </div>
                <div class="space-y-1">
                    <p class="text-2xl font-bold">{{ $performance->total_orders }}</p>
                    <p class="text-sm opacity-90">Total Orders</p>
                    <p class="text-lg font-semibold">Rp {{ number_format($performance->total_revenue / 1000000, 1) }}M</p>
                    <p class="text-xs opacity-80">Total Revenue</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endif

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Revenue Chart
const ctx = document.getElementById('revenueChart').getContext('2d');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: @json($revenueTrend->pluck('date')->map(fn($d) => \Carbon\Carbon::parse($d)->format('M d'))),
        datasets: [{
            label: 'Revenue',
            data: @json($revenueTrend->pluck('revenue')),
            borderColor: '#f1760b',
            backgroundColor: 'rgba(241, 118, 11, 0.1)',
            tension: 0.4,
            fill: true
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return 'Rp ' + (value / 1000000).toFixed(1) + 'M';
                    }
                }
            }
        }
    }
});
</script>
@endsection