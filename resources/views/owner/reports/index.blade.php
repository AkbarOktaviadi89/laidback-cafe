{{-- resources/views/owner/reports/index.blade.php --}}
@extends('layouts.owner')

@section('content')
<div class="mb-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-2">Sales Reports</h2>
    <p class="text-gray-600">Analyze your business performance</p>
</div>

<!-- Date Range Filter -->
<div class="bg-white rounded-2xl shadow-md p-6 mb-6">
    <form method="GET" action="{{ route('owner.reports') }}" class="flex flex-wrap gap-4 items-end">
        <div class="flex-1 min-w-[200px]">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Start Date</label>
            <input 
                type="date" 
                name="start_date" 
                value="{{ $startDate }}"
                class="w-full px-4 py-2 border-2 border-gray-200 rounded-xl focus:border-laidback-500 outline-none"
            >
        </div>
        
        <div class="flex-1 min-w-[200px]">
            <label class="block text-sm font-semibold text-gray-700 mb-2">End Date</label>
            <input 
                type="date" 
                name="end_date" 
                value="{{ $endDate }}"
                class="w-full px-4 py-2 border-2 border-gray-200 rounded-xl focus:border-laidback-500 outline-none"
            >
        </div>
        
        <button type="submit" class="px-6 py-2 bg-gray-800 hover:bg-gray-900 text-white font-semibold rounded-xl transition">
            Generate Report
        </button>
        
        <a href="{{ route('owner.reports.export', ['start_date' => $startDate, 'end_date' => $endDate]) }}" class="px-6 py-2 bg-laidback-500 hover:bg-laidback-600 text-white font-semibold rounded-xl transition flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
            </svg>
            Export CSV
        </a>
    </form>
</div>

<!-- Summary Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-lg p-6 text-white">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
        <p class="text-sm opacity-90 mb-1">Total Revenue</p>
        <p class="text-3xl font-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
    </div>

    <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl shadow-lg p-6 text-white">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
            </div>
        </div>
        <p class="text-sm opacity-90 mb-1">Total Orders</p>
        <p class="text-3xl font-bold">{{ number_format($totalOrders) }}</p>
    </div>

    <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-lg p-6 text-white">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
        </div>
        <p class="text-sm opacity-90 mb-1">Total Customers</p>
        <p class="text-3xl font-bold">{{ number_format($totalCustomers) }}</p>
    </div>

    <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl shadow-lg p-6 text-white">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                </svg>
            </div>
        </div>
        <p class="text-sm opacity-90 mb-1">Avg Order Value</p>
        <p class="text-3xl font-bold">Rp {{ number_format($totalOrders > 0 ? $totalRevenue / $totalOrders : 0, 0, ',', '.') }}</p>
    </div>
</div>

<!-- Charts & Tables -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Daily Sales Chart - FIXED HEIGHT CONTAINER -->
    <div class="bg-white rounded-2xl shadow-md p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Daily Sales Trend</h3>
        <div style="height: 300px;">
            <canvas id="dailySalesChart"></canvas>
        </div>
    </div>

    <!-- Payment Methods - FIXED HEIGHT CONTAINER -->
    <div class="bg-white rounded-2xl shadow-md p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Payment Methods</h3>
        <div style="height: 300px;">
            <canvas id="paymentMethodsChart"></canvas>
        </div>
    </div>
</div>

<!-- Top Products Table -->
<div class="bg-white rounded-2xl shadow-md p-6 mb-8">
    <h3 class="text-lg font-bold text-gray-800 mb-4">Top Selling Products</h3>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b-2 border-gray-200">
                    <th class="text-left py-3 px-4 font-semibold text-gray-700">#</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-700">Product Name</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-700">Quantity Sold</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-700">Revenue</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-700">Percentage</th>
                </tr>
            </thead>
            <tbody>
                @forelse($topProducts as $index => $product)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                        <td class="py-3 px-4">
                            <span class="w-8 h-8 flex items-center justify-center rounded-full font-bold {{ $index < 3 ? 'bg-laidback-100 text-laidback-600' : 'bg-gray-100 text-gray-600' }}">
                                {{ $index + 1 }}
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            <span class="font-semibold text-gray-800">{{ $product->product_name }}</span>
                        </td>
                        <td class="py-3 px-4">
                            <span class="text-gray-700">{{ $product->total_quantity }}</span>
                        </td>
                        <td class="py-3 px-4">
                            <span class="font-bold text-gray-800">Rp {{ number_format($product->total_revenue, 0, ',', '.') }}</span>
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex items-center gap-2">
                                <div class="flex-1 bg-gray-200 rounded-full h-2 max-w-[100px]">
                                    <div class="bg-laidback-500 h-2 rounded-full" style="width: {{ $totalRevenue > 0 ? ($product->total_revenue / $totalRevenue * 100) : 0 }}%"></div>
                                </div>
                                <span class="text-sm text-gray-600">{{ $totalRevenue > 0 ? number_format($product->total_revenue / $totalRevenue * 100, 1) : 0 }}%</span>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-gray-500">
                            No product sales data available for this period
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Daily Breakdown Table -->
<div class="bg-white rounded-2xl shadow-md p-6">
    <h3 class="text-lg font-bold text-gray-800 mb-4">Daily Breakdown</h3>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b-2 border-gray-200">
                    <th class="text-left py-3 px-4 font-semibold text-gray-700">Date</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-700">Orders</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-700">Revenue</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-700">Avg Order</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dailySales as $sale)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                        <td class="py-3 px-4">
                            <span class="font-semibold text-gray-800">{{ \Carbon\Carbon::parse($sale->date)->format('d M Y') }}</span>
                        </td>
                        <td class="py-3 px-4">
                            <span class="text-gray-700">{{ $sale->orders }}</span>
                        </td>
                        <td class="py-3 px-4">
                            <span class="font-bold text-gray-800">Rp {{ number_format($sale->revenue, 0, ',', '.') }}</span>
                        </td>
                        <td class="py-3 px-4">
                            <span class="text-gray-700">Rp {{ number_format($sale->orders > 0 ? $sale->revenue / $sale->orders : 0, 0, ',', '.') }}</span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-8 text-center text-gray-500">
                            No sales data available for this period
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Daily Sales Chart
const dailySalesCtx = document.getElementById('dailySalesChart').getContext('2d');
new Chart(dailySalesCtx, {
    type: 'line',
    data: {
        labels: @json($dailySales->pluck('date')->map(fn($d) => \Carbon\Carbon::parse($d)->format('M d'))),
        datasets: [{
            label: 'Revenue',
            data: @json($dailySales->pluck('revenue')),
            borderColor: '#f1760b',
            backgroundColor: 'rgba(241, 118, 11, 0.1)',
            tension: 0.4,
            fill: true
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
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
                        return 'Rp ' + (value / 1000).toFixed(0) + 'K';
                    }
                }
            }
        }
    }
});

// Payment Methods Chart
const paymentMethodsCtx = document.getElementById('paymentMethodsChart').getContext('2d');
new Chart(paymentMethodsCtx, {
    type: 'doughnut',
    data: {
        labels: @json($paymentMethods->pluck('payment_method')->map(fn($p) => ucfirst($p ?? 'N/A'))),
        datasets: [{
            data: @json($paymentMethods->pluck('total')),
            backgroundColor: [
                '#10b981',
                '#3b82f6',
                '#f59e0b',
                '#ef4444'
            ]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});
</script>
@endsection