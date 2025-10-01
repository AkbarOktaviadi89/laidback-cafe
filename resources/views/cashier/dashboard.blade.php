<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier Dashboard - Laidback Cafe</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'laidback': {
                            500: '#f1760b',
                            600: '#e25c01',
                            700: '#bb4304',
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
                <div class="w-12 h-12 bg-laidback-500 rounded-xl flex items-center justify-center">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="font-bold text-lg">Laidback</h1>
                    <p class="text-xs text-gray-400">Cashier Panel</p>
                </div>
            </div>
        </div>

        <nav class="p-4">
            <a href="/cashier/dashboard" class="flex items-center gap-3 px-4 py-3 bg-laidback-500 rounded-xl mb-2 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span class="font-semibold">Dashboard</span>
            </a>
            <a href="/cashier/transactions" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-gray-700 rounded-xl mb-2 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                <span class="font-semibold">Transactions</span>
            </a>
        </nav>

        <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-700">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center">
                    <span class="font-bold text-sm">K1</span>
                </div>
                <div class="flex-1">
                    <p class="font-semibold text-sm">Kasir 1</p>
                    <p class="text-xs text-gray-400">cashier1@laidback.com</p>
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
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Dashboard</h2>
            <p class="text-gray-600">Welcome back, Kasir 1! Here's today's overview.</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Pending Orders -->
            <div class="bg-gradient-to-br from-yellow-400 to-orange-500 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="text-sm font-semibold bg-white/20 px-3 py-1 rounded-full">Live</span>
                </div>
                <p class="text-4xl font-bold mb-1">8</p>
                <p class="text-white/80 text-sm">Pending Orders</p>
            </div>

            <!-- Today's Orders -->
            <div class="bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <span class="text-sm font-semibold bg-white/20 px-3 py-1 rounded-full">Today</span>
                </div>
                <p class="text-4xl font-bold mb-1">45</p>
                <p class="text-white/80 text-sm">Total Orders</p>
            </div>

            <!-- Today's Revenue -->
            <div class="bg-gradient-to-br from-green-400 to-emerald-600 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="text-sm font-semibold bg-white/20 px-3 py-1 rounded-full">+12%</span>
                </div>
                <p class="text-4xl font-bold mb-1">5.4M</p>
                <p class="text-white/80 text-sm">Today's Revenue</p>
            </div>

            <!-- Completed -->
            <div class="bg-gradient-to-br from-purple-400 to-purple-600 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="text-sm font-semibold bg-white/20 px-3 py-1 rounded-full">Done</span>
                </div>
                <p class="text-4xl font-bold mb-1">37</p>
                <p class="text-white/80 text-sm">Completed Orders</p>
            </div>
        </div>

        <!-- Pending Transactions -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Pending Transactions</h3>
                    <p class="text-sm text-gray-500">Orders waiting for payment</p>
                </div>
                <button class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg font-semibold text-gray-700 transition text-sm">
                    View All
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b-2 border-gray-200">
                            <th class="text-left py-3 px-4 font-semibold text-gray-700 text-sm">Order ID</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-700 text-sm">Customer</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-700 text-sm">Table</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-700 text-sm">Items</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-700 text-sm">Total</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-700 text-sm">Status</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-700 text-sm">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                            <td class="py-4 px-4">
                                <span class="font-mono font-semibold text-gray-800">#LB-20251002-A1B2C3</span>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-laidback-100 rounded-full flex items-center justify-center">
                                        <span class="text-xs font-bold text-laidback-600">JD</span>
                                    </div>
                                    <span class="font-semibold text-gray-800">John Doe</span>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold">Table 5</span>
                            </td>
                            <td class="py-4 px-4 text-gray-600">4 items</td>
                            <td class="py-4 px-4">
                                <span class="font-bold text-gray-800">Rp 121.000</span>
                            </td>
                            <td class="py-4 px-4">
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-bold">Pending</span>
                            </td>
                            <td class="py-4 px-4">
                                <button class="px-4 py-2 bg-laidback-500 hover:bg-laidback-600 text-white rounded-lg font-semibold text-sm transition">
                                    Process
                                </button>
                            </td>
                        </tr>

                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                            <td class="py-4 px-4">
                                <span class="font-mono font-semibold text-gray-800">#LB-20251002-D4E5F6</span>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-laidback-100 rounded-full flex items-center justify-center">
                                        <span class="text-xs font-bold text-laidback-600">AS</span>
                                    </div>
                                    <span class="font-semibold text-gray-800">Alice Smith</span>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold">Table 3</span>
                            </td>
                            <td class="py-4 px-4 text-gray-600">2 items</td>
                            <td class="py-4 px-4">
                                <span class="font-bold text-gray-800">Rp 70.000</span>
                            </td>
                            <td class="py-4 px-4">
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-bold">Pending</span>
                            </td>
                            <td class="py-4 px-4">
                                <button class="px-4 py-2 bg-laidback-500 hover:bg-laidback-600 text-white rounded-lg font-semibold text-sm transition">
                                    Process
                                </button>
                            </td>
                        </tr>

                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                            <td class="py-4 px-4">
                                <span class="font-mono font-semibold text-gray-800">#LB-20251002-G7H8I9</span>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-laidback-100 rounded-full flex items-center justify-center">
                                        <span class="text-xs font-bold text-laidback-600">BJ</span>
                                    </div>
                                    <span class="font-semibold text-gray-800">Bob Johnson</span>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold">Table 8</span>
                            </td>
                            <td class="py-4 px-4 text-gray-600">6 items</td>
                            <td class="py-4 px-4">
                                <span class="font-bold text-gray-800">Rp 195.000</span>
                            </td>
                            <td class="py-4 px-4">
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-bold">Pending</span>
                            </td>
                            <td class="py-4 px-4">
                                <button class="px-4 py-2 bg-laidback-500 hover:bg-laidback-600 text-white rounded-lg font-semibold text-sm transition">
                                    Process
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition cursor-pointer">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold mb-2">View All Transactions</h3>
                <p class="text-white/80 text-sm">See complete transaction history</p>
            </div>

            <div class="bg-gradient-to-br from-pink-500 to-rose-600 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition cursor-pointer">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold mb-2">Print Reports</h3>
                <p class="text-white/80 text-sm">Generate daily sales reports</p>
            </div>

            <div class="bg-gradient-to-br from-cyan-500 to-blue-600 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition cursor-pointer">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold mb-2">Quick Calculator</h3>
                <p class="text-white/80 text-sm">Calculate change quickly</p>
            </div>
        </div>
    </div>
</body>
</html>