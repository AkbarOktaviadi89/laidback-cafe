<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Dashboard - Laidback Cafe</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
    <!-- Sidebar -->
    <div class="fixed left-0 top-0 bottom-0 w-64 bg-gradient-to-b from-gray-900 to-gray-800 text-white z-50">
        <div class="p-6 border-b border-gray-700">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-gradient-to-br from-laidback-500 to-laidback-600 rounded-xl flex items-center justify-center shadow-lg">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="font-bold text-lg">Laidback</h1>
                    <p class="text-xs text-gray-400">Owner Panel</p>
                </div>
            </div>
        </div>

        <nav class="p-4">
            <a href="/owner/dashboard" class="flex items-center gap-3 px-4 py-3 bg-laidback-500 rounded-xl mb-2 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                <span class="font-semibold">Dashboard</span>
            </a>
            <a href="/owner/products" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-gray-700 rounded-xl mb-2 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                <span class="font-semibold">Products</span>
            </a>
            <a href="/owner/users" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-gray-700 rounded-xl mb-2 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                <span class="font-semibold">Users</span>
            </a>
            <a href="/owner/transactions" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-gray-700 rounded-xl mb-2 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                <span class="font-semibold">Transactions</span>
            </a>
            <a href="/owner/reports" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-gray-700 rounded-xl mb-2 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <span class="font-semibold">Reports</span>
            </a>
        </nav>

        <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-700">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 bg-gradient-to-br from-laidback-500 to-laidback-600 rounded-full flex items-center justify-center">
                    <span class="font-bold text-sm">OW</span>
                </div>
                <div class="flex-1">
                    <p class="font-semibold text-sm">Owner Laidback</p>
                    <p class="text-xs text-gray-400">owner@laidback.com</p>
                </div>
            </div>
            <button class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-red-500 hover:bg-red-600 rounded-lg transition text-sm font-semibold">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                Logout
            </button>
        </div>
    </div>

    <!-- Main Content -->
    <div class="ml-64 p-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Dashboard Overview</h2>
                <p class="text-gray-600">Monitor your business performance</p>
            </div>
            <div class="flex items-center gap-3">
                <select class="px-4 py-2 bg-white border-2 border-gray-200 rounded-xl font-semibold text-gray-700 focus:border-laidback-500 outline-none">
                    <option>Today</option>
                    <option>This Week</option>
                    <option>This Month</option>
                    <option>This Year</option>
                </select>
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
            <div class="bg-white rounded-2xl p-6 shadow-md hover:shadow-lg transition">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-green-500 bg-green-50 px-2 py-1 rounded-full">+12.5%</span>
                </div>
                <p class="text-gray-500 text-sm mb-1">Total Revenue</p>
                <p class="text-3xl font-bold text-gray-800">Rp 24.5M</p>
                <p class="text-xs text-gray-400 mt-2">vs last month: Rp 21.8M</p>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-md hover:shadow-lg transition">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-purple-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-green-500 bg-green-50 px-2 py-1 rounded-full">+8.2%</span>
                </div>
                <p class="text-gray-500 text-sm mb-1">Total Orders</p>
                <p class="text-3xl font-bold text-gray-800">1,247</p>
                <p class="text-xs text-gray-400 mt-2">vs last month: 1,153</p>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-md hover:shadow-lg transition">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-orange-400 to-orange-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-green-500 bg-green-50 px-2 py-1 rounded-full">+15.3%</span>
                </div>
                <p class="text-gray-500 text-sm mb-1">Total Customers</p>
                <p class="text-3xl font-bold text-gray-800">892</p>
                <p class="text-xs text-gray-400 mt-2">vs last month: 773</p>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-md hover:shadow-lg transition">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-green-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-green-500 bg-green-50 px-2 py-1 rounded-full">+5.1%</span>
                </div>
                <p class="text-gray-500 text-sm mb-1">Avg Order Value</p>
                <p class="text-3xl font-bold text-gray-800">Rp 98K</p>
                <p class="text-xs text-gray-400 mt-2">vs last month: Rp 93K</p>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Revenue Chart -->
            <div class="bg-white rounded-2xl p-6 shadow-md">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Revenue Trend</h3>
                        <p class="text-sm text-gray-500">Last 7 days performance</p>
                    </div>
                    <select class="px-3 py-1 bg-gray-100 rounded-lg text-sm font-semibold text-gray-700">
                        <option>7 Days</option>
                        <option>30 Days</option>
                        <option>90 Days</option>
                    </select>
                </div>
                <canvas id="revenueChart" class="w-full" height="250"></canvas>
            </div>

            <!-- Top Products -->
            <div class="bg-white rounded-2xl p-6 shadow-md">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Top Products</h3>
                        <p class="text-sm text-gray-500">Best selling items</p>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-amber-100 to-orange-100 rounded-xl flex items-center justify-center text-2xl">☕</div>
                        <div class="flex-1">
                            <p class="font-semibold text-gray-800">Cappuccino</p>
                            <p class="text-sm text-gray-500">324 orders</p>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-gray-800">Rp 11.3M</p>
                            <div class="w-20 h-2 bg-gray-200 rounded-full mt-1 overflow-hidden">
                                <div class="h-full bg-laidback-500" style="width: 85%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-amber-100 to-orange-100 rounded-xl flex items-center justify-center text-2xl">☕</div>
                        <div class="flex-1">
                            <p class="font-semibold text-gray-800">Cafe Latte</p>
                            <p class="text-sm text-gray-500">298 orders</p>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-gray-800">Rp 10.4M</p>
                            <div class="w-20 h-2 bg-gray-200 rounded-full mt-1 overflow-hidden">
                                <div class="h-full bg-laidback-500" style="width: 78%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-100 to-emerald-100 rounded-xl flex items-center justify-center text-2xl">🍵</div>
                        <div class="flex-1">
                            <p class="font-semibold text-gray-800">Matcha Latte</p>
                            <p class="text-sm text-gray-500">267 orders</p>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-gray-800">Rp 9.3M</p>
                            <div class="w-20 h-2 bg-gray-200 rounded-full mt-1 overflow-hidden">
                                <div class="h-full bg-laidback-500" style="width: 70%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-yellow-100 to-amber-100 rounded-xl flex items-center justify-center text-2xl">🥐</div>
                        <div class="flex-1">
                            <p class="font-semibold text-gray-800">Croissant</p>
                            <p class="text-sm text-gray-500">189 orders</p>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-gray-800">Rp 4.7M</p>
                            <div class="w-20 h-2 bg-gray-200 rounded-full mt-1 overflow-hidden">
                                <div class="h-full bg-laidback-500" style="width: 45%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-pink-100 to-rose-100 rounded-xl flex items-center justify-center text-2xl">🍰</div>
                        <div class="flex-1">
                            <p class="font-semibold text-gray-800">Cheesecake</p>
                            <p class="text-sm text-gray-500">156 orders</p>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-gray-800">Rp 6.2M</p>
                            <div class="w-20 h-2 bg-gray-200 rounded-full mt-1 overflow-hidden">
                                <div class="h-full bg-laidback-500" style="width: 52%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>