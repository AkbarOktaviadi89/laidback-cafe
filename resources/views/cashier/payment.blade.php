<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Process Payment - Laidback Cafe</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
    <div class="max-w-6xl mx-auto p-6">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center gap-4">
                <a href="/cashier/dashboard" class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow hover:shadow-md transition">
                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Process Payment</h1>
                    <p class="text-sm text-gray-500">Order #LB-20251002-A1B2C3</p>
                </div>
            </div>
            <div class="text-right">
                <p class="text-sm text-gray-500">Cashier</p>
                <p class="font-semibold text-gray-800">Kasir 1</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Order Details -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Order Details</h2>
                
                <!-- Customer Info -->
                <div class="bg-gradient-to-r from-laidback-500 to-laidback-600 rounded-xl p-4 mb-4 text-white">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm opacity-90">Customer</p>
                            <p class="font-bold text-lg">John Doe</p>
                        </div>
                    </div>
                    <div class="mt-3 flex items-center gap-4 text-sm">
                        <div class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            </svg>
                            <span>Table 5</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>14:30</span>
                        </div>
                    </div>
                </div>

                <!-- Items List -->
                <div class="space-y-3 mb-4">
                    <div class="flex justify-between items-center pb-3 border-b">
                        <div class="flex items-center gap-3">
                            <span class="text-2xl">☕</span>
                            <div>
                                <p class="font-semibold text-gray-800">Espresso</p>
                                <p class="text-sm text-gray-500">Rp 25.000 × 2</p>
                            </div>
                        </div>
                        <p class="font-bold text-gray-800">Rp 50.000</p>
                    </div>
                    <div class="flex justify-between items-center pb-3 border-b">
                        <div class="flex items-center gap-3">
                            <span class="text-2xl">☕</span>
                            <div>
                                <p class="font-semibold text-gray-800">Cappuccino</p>
                                <p class="text-sm text-gray-500">Rp 35.000 × 1</p>
                            </div>
                        </div>
                        <p class="font-bold text-gray-800">Rp 35.000</p>
                    </div>
                    <div class="flex justify-between items-center pb-3 border-b">
                        <div class="flex items-center gap-3">
                            <span class="text-2xl">🥐</span>
                            <div>
                                <p class="font-semibold text-gray-800">Croissant</p>
                                <p class="text-sm text-gray-500">Rp 25.000 × 1</p>
                            </div>
                        </div>
                        <p class="font-bold text-gray-800">Rp 25.000</p>
                    </div>
                </div>

                <!-- Price Summary -->
                <div class="bg-gray-50 rounded-xl p-4">
                    <div class="space-y-2 mb-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="font-semibold">Rp 110.000</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Tax (10%)</span>
                            <span class="font-semibold">Rp 11.000</span>
                        </div>
                    </div>
                    <div class="border-t-2 pt-3 flex justify-between items-center">
                        <span class="text-lg font-bold text-gray-800">Total</span>
                        <span class="text-3xl font-bold text-laidback-600">Rp 121.000</span>
                    </div>
                </div>
            </div>

            <!-- Payment Form -->
            <div class="space-y-6">
                <!-- Payment Method -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Payment Method</h2>
                    <div class="flex gap-3">
                        <button onclick="selectPayment('cash')" id="btnCash" class="flex-1 p-4 border-2 border-laidback-500 bg-laidback-50 rounded-xl transition">
                            <div class="flex items-center justify-center gap-2 text-laidback-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <span class="font-bold">Cash</span>
                            </div>
                        </button>
                        <button onclick="selectPayment('transfer')" id="btnTransfer" class="flex-1 p-4 border-2 border-gray-200 rounded-xl hover:border-gray-300 transition">
                            <div class="flex items-center justify-center gap-2 text-gray-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                </svg>
                                <span class="font-bold">Transfer</span>
                            </div>
                        </button>
                    </div>
                </div>

                <!-- Amount Paid Input -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Amount Paid</h2>
                    <div class="mb-4">
                        <input 
                            type="text" 
                            id="amountPaid"
                            placeholder="0"
                            class="w-full text-4xl font-bold text-center py-4 px-6 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-laidback-500 focus:ring-4 focus:ring-laidback-100 outline-none"
                            oninput="calculateChange()"
                        >
                        <p class="text-center text-sm text-gray-500 mt-2">Enter amount received from customer</p>
                    </div>

                    <!-- Quick Amount Buttons -->
                    <div class="grid grid-cols-3 gap-3 mb-4">
                        <button onclick="setAmount(121000)" class="py-3 px-4 bg-gray-100 hover:bg-gray-200 rounded-lg font-semibold transition">Exact</button>
                        <button onclick="setAmount(150000)" class="py-3 px-4 bg-gray-100 hover:bg-gray-200 rounded-lg font-semibold transition">150k</button>
                        <button onclick="setAmount(200000)" class="py-3 px-4 bg-gray-100 hover:bg-gray-200 rounded-lg font-semibold transition">200k</button>
                    </div>

                    <!-- Change Display -->
                    <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl p-6 text-white">
                        <p class="text-sm opacity-90 mb-1">Change Amount</p>
                        <p class="text-4xl font-bold" id="changeAmount">Rp 0</p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <button onclick="confirmPayment()" class="w-full bg-gradient-to-r from-laidback-500 to-laidback-600 hover:from-laidback-600 hover:to-laidback-700 text-white font-bold py-4 rounded-xl transition shadow-lg hover:shadow-xl mb-3 flex items-center justify-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Confirm Payment
                    </button>
                    <button onclick="printReceipt()" class="w-full bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-4 rounded-xl transition flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        Print Receipt
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div id="successModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-3xl p-8 max-w-md w-full text-center animate-scaleIn">
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">Payment Successful!</h3>
            <p class="text-gray-600 mb-6">Transaction completed successfully</p>
            <div class="space-y-3">
                <button onclick="printReceipt()" class="w-full bg-laidback-500 hover:bg-laidback-600 text-white font-bold py-3 rounded-xl transition">
                    Print Receipt
                </button>
                <button onclick="closeModal()" class="w-full bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-3 rounded-xl transition">
                    Back to Dashboard
                </button>
            </div>
        </div>
    </div>

    <style>
        @keyframes scaleIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }
        .animate-scaleIn { animation: scaleIn 0.3s ease-out; }
    </style>

    <script>
        const totalAmount = 121000;
        let paymentMethod = 'cash';

        function selectPayment(method) {
            paymentMethod = method;
            const btnCash = document.getElementById('btnCash');
            const btnTransfer = document.getElementById('btnTransfer');
            
            if (method === 'cash') {
                btnCash.className = 'flex-1 p-4 border-2 border-laidback-500 bg-laidback-50 rounded-xl transition';
                btnTransfer.className = 'flex-1 p-4 border-2 border-gray-200 rounded-xl hover:border-gray-300 transition';
            } else {
                btnTransfer.className = 'flex-1 p-4 border-2 border-laidback-500 bg-laidback-50 rounded-xl transition';
                btnCash.className = 'flex-1 p-4 border-2 border-gray-200 rounded-xl hover:border-gray-300 transition';
            }
        }

        function formatCurrency(amount) {
            return 'Rp ' + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        function setAmount(amount) {
            document.getElementById('amountPaid').value = formatCurrency(amount);
            calculateChange();
        }

        function calculateChange() {
            const input = document.getElementById('amountPaid').value;
            const amount = parseInt(input.replace(/\D/g, '')) || 0;
            const change = amount - totalAmount;
            
            if (change >= 0) {
                document.getElementById('changeAmount').textContent = formatCurrency(change);
                document.getElementById('changeAmount').parentElement.className = 'bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl p-6 text-white';
            } else {
                document.getElementById('changeAmount').textContent = 'Kurang ' + formatCurrency(Math.abs(change));
                document.getElementById('changeAmount').parentElement.className = 'bg-gradient-to-r from-red-500 to-rose-600 rounded-xl p-6 text-white';
            }
        }

        // Format input as currency while typing
        document.getElementById('amountPaid').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value) {
                e.target.value = formatCurrency(parseInt(value));
            }
        });

        function confirmPayment() {
            const input = document.getElementById('amountPaid').value;
            const amount = parseInt(input.replace(/\D/g, '')) || 0;
            
            if (amount < totalAmount) {
                alert('Pembayaran kurang! Total yang harus dibayar: ' + formatCurrency(totalAmount));
                return;
            }
            
            // Show success modal
            document.getElementById('successModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('successModal').classList.add('hidden');
            window.location.href = '/cashier/dashboard';
        }

        function printReceipt() {
            window.print();
        }
    </script>
</body>
</html>