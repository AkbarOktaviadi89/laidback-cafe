{{-- resources/views/cashier/payment.blade.php --}}
@extends('layouts.cashier')

@section('content')
<!-- Header -->
<div class="flex items-center justify-between mb-8">
    <div class="flex items-center gap-4">
        <a href="{{ route('cashier.dashboard') }}" class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow hover:shadow-md transition">
            <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Process Payment</h1>
            <p class="text-sm text-gray-500">Order #{{ $order->order_number }}</p>
        </div>
    </div>
    <div class="text-right">
        <p class="text-sm text-gray-500">Cashier</p>
        <p class="font-semibold text-gray-800">{{ auth()->user()->name }}</p>
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
                    <p class="font-bold text-lg">{{ $order->customer_name }}</p>
                </div>
            </div>
            <div class="mt-3 flex items-center gap-4 text-sm">
                @if($order->table_number)
                    <div class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        </svg>
                        <span>{{ $order->table_number }}</span>
                    </div>
                @endif
                <div class="flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>{{ $order->created_at->format('H:i') }}</span>
                </div>
            </div>
        </div>

        <!-- Items List -->
        <div class="space-y-3 mb-4">
            @foreach($order->items as $item)
                <div class="flex justify-between items-center pb-3 border-b">
                    <div class="flex items-center gap-3">
                        <span class="text-2xl">{{ $item->product->category->icon ?? '🍽️' }}</span>
                        <div>
                            <p class="font-semibold text-gray-800">{{ $item->product_name }}</p>
                            <p class="text-sm text-gray-500">Rp {{ number_format($item->price, 0, ',', '.') }} × {{ $item->quantity }}</p>
                        </div>
                    </div>
                    <p class="font-bold text-gray-800">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                </div>
            @endforeach
        </div>

        <!-- Price Summary -->
        <div class="bg-gray-50 rounded-xl p-4">
            <div class="space-y-2 mb-3">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Subtotal</span>
                    <span class="font-semibold">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Tax (10%)</span>
                    <span class="font-semibold">Rp {{ number_format($order->tax, 0, ',', '.') }}</span>
                </div>
            </div>
            <div class="border-t-2 pt-3 flex justify-between items-center">
                <span class="text-lg font-bold text-gray-800">Total</span>
                <span class="text-3xl font-bold text-laidback-600">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <!-- Payment Form -->
    <div class="space-y-6">
        <form action="{{ route('cashier.payment.process', $order->id) }}" method="POST" id="paymentForm" onsubmit="return validatePayment()">
            @csrf
            
            <!-- Payment Method -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Payment Method</h2>
                <div class="flex gap-3">
                    <button type="button" onclick="selectPayment('cash')" id="btnCash" class="flex-1 p-4 border-2 border-laidback-500 bg-laidback-50 rounded-xl transition">
                        <input type="radio" name="payment_method" value="cash" checked class="hidden">
                        <div class="flex items-center justify-center gap-2 text-laidback-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span class="font-bold">Cash</span>
                        </div>
                    </button>
                    <button type="button" onclick="selectPayment('transfer')" id="btnTransfer" class="flex-1 p-4 border-2 border-gray-200 rounded-xl hover:border-gray-300 transition">
                        <input type="radio" name="payment_method" value="transfer" class="hidden">
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
                        type="number" 
                        name="amount_paid"
                        id="amountPaid"
                        placeholder="0"
                        step="1"
                        required
                        class="w-full text-4xl font-bold text-center py-4 px-6 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-laidback-500 focus:ring-4 focus:ring-laidback-100 outline-none"
                        oninput="calculateChange()"
                    >
                    <p class="text-center text-sm text-gray-500 mt-2">Enter amount received from customer</p>
                    <p id="errorMessage" class="text-center text-sm text-red-600 mt-2 hidden"></p>
                </div>

                <!-- Quick Amount Buttons -->
                <div class="grid grid-cols-3 gap-3 mb-4">
                    <button type="button" onclick="setAmount({{ $order->total }})" class="py-3 px-4 bg-gray-100 hover:bg-gray-200 rounded-lg font-semibold transition">Exact</button>
                    <button type="button" onclick="setAmount({{ ceil($order->total / 50000) * 50000 }})" class="py-3 px-4 bg-gray-100 hover:bg-gray-200 rounded-lg font-semibold transition">{{ number_format(ceil($order->total / 50000) * 50000 / 1000, 0) }}K</button>
                    <button type="button" onclick="setAmount({{ ceil($order->total / 100000) * 100000 }})" class="py-3 px-4 bg-gray-100 hover:bg-gray-200 rounded-lg font-semibold transition">{{ number_format(ceil($order->total / 100000) * 100000 / 1000, 0) }}K</button>
                </div>

                <!-- Change Display -->
                <div id="changeDisplay" class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl p-6 text-white">
                    <p class="text-sm opacity-90 mb-1">Change Amount</p>
                    <p class="text-4xl font-bold" id="changeAmount">Rp 0</p>
                </div>
                <div id="insufficientDisplay" class="bg-gradient-to-r from-red-500 to-red-600 rounded-xl p-6 text-white hidden">
                    <p class="text-sm opacity-90 mb-1">Insufficient Payment</p>
                    <p class="text-4xl font-bold" id="shortfallAmount">Rp 0</p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <button type="submit" id="submitButton" class="w-full bg-gradient-to-r from-laidback-500 to-laidback-600 hover:from-laidback-600 hover:to-laidback-700 text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-xl transition text-lg flex items-center justify-center gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Confirm Payment
                </button>
            </div>
        </form>
    </div>
</div>

<script>
const orderTotal = {{ $order->total }};

function selectPayment(method) {
    document.querySelectorAll('[name="payment_method"]').forEach(radio => {
        radio.checked = radio.value === method;
    });
    
    const cashBtn = document.getElementById('btnCash');
    const transferBtn = document.getElementById('btnTransfer');
    
    if (method === 'cash') {
        cashBtn.className = 'flex-1 p-4 border-2 border-laidback-500 bg-laidback-50 rounded-xl transition';
        transferBtn.className = 'flex-1 p-4 border-2 border-gray-200 rounded-xl hover:border-gray-300 transition';
    } else {
        transferBtn.className = 'flex-1 p-4 border-2 border-laidback-500 bg-laidback-50 rounded-xl transition';
        cashBtn.className = 'flex-1 p-4 border-2 border-gray-200 rounded-xl hover:border-gray-300 transition';
    }
}

function setAmount(amount) {
    document.getElementById('amountPaid').value = amount;
    calculateChange();
}

function calculateChange() {
    const amountPaid = parseFloat(document.getElementById('amountPaid').value) || 0;
    const change = amountPaid - orderTotal;
    
    const changeDisplay = document.getElementById('changeDisplay');
    const insufficientDisplay = document.getElementById('insufficientDisplay');
    const submitButton = document.getElementById('submitButton');
    const errorMessage = document.getElementById('errorMessage');
    
    if (change >= 0) {
        // Sufficient payment
        changeDisplay.classList.remove('hidden');
        insufficientDisplay.classList.add('hidden');
        errorMessage.classList.add('hidden');
        submitButton.disabled = false;
        submitButton.classList.remove('opacity-50', 'cursor-not-allowed');
        document.getElementById('changeAmount').textContent = 'Rp ' + change.toLocaleString('id-ID');
    } else {
        // Insufficient payment
        changeDisplay.classList.add('hidden');
        insufficientDisplay.classList.remove('hidden');
        errorMessage.classList.remove('hidden');
        errorMessage.textContent = 'Amount must be at least Rp ' + orderTotal.toLocaleString('id-ID');
        submitButton.disabled = true;
        submitButton.classList.add('opacity-50', 'cursor-not-allowed');
        document.getElementById('shortfallAmount').textContent = 'Rp ' + Math.abs(change).toLocaleString('id-ID') + ' short';
    }
}

function validatePayment() {
    const amountPaid = parseFloat(document.getElementById('amountPaid').value) || 0;
    
    if (amountPaid < orderTotal) {
        alert('Insufficient payment amount! Please enter at least Rp ' + orderTotal.toLocaleString('id-ID'));
        return false;
    }
    
    return true;
}
</script>
@endsection