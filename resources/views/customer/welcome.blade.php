<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Laidback Cafe</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'laidback': {
                            50: '#fef7ee',
                            100: '#fdecd3',
                            200: '#fad6a5',
                            300: '#f7b96d',
                            400: '#f49333',
                            500: '#f1760b',
                            600: '#e25c01',
                            700: '#bb4304',
                            800: '#95350a',
                            900: '#782d0b',
                        },
                    },
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-amber-50 via-orange-50 to-yellow-50 min-h-screen">
    <!-- Animated Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-laidback-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-yellow-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-orange-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
    </div>

    <style>
        @keyframes blob {
            0%, 100% { transform: translate(0, 0) scale(1); }
            25% { transform: translate(20px, -50px) scale(1.1); }
            50% { transform: translate(-20px, 20px) scale(0.9); }
            75% { transform: translate(50px, 50px) scale(1.05); }
        }
        .animate-blob { animation: blob 7s infinite; }
        .animation-delay-2000 { animation-delay: 2s; }
        .animation-delay-4000 { animation-delay: 4s; }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .animate-float { animation: float 3s ease-in-out infinite; }
        
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-slideUp { animation: slideUp 0.8s ease-out forwards; }
    </style>

    <div class="relative min-h-screen flex items-center justify-center px-4 py-12">
        <div class="max-w-md w-full">
            <!-- Logo & Brand -->
            <div class="text-center mb-8 animate-slideUp">
                <div class="inline-block p-4 bg-white rounded-full shadow-2xl mb-4 animate-float">
                    <svg class="w-20 h-20 text-laidback-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                    </svg>
                </div>
                <h1 class="text-5xl font-bold text-gray-800 mb-2">Laidback</h1>
                <p class="text-xl text-laidback-600 font-medium">Cafe & Eatery</p>
                <div class="flex items-center justify-center gap-2 mt-3">
                    <span class="w-12 h-0.5 bg-laidback-400"></span>
                    <span class="text-gray-500 text-sm">Est. 2024</span>
                    <span class="w-12 h-0.5 bg-laidback-400"></span>
                </div>
            </div>

            <!-- Welcome Card -->
            <div class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-2xl p-8 border border-white animate-slideUp" style="animation-delay: 0.2s;">
                <div class="text-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Welcome! 👋</h2>
                    <p class="text-gray-600">Please enter your name to start ordering</p>
                </div>

                <form action="{{ route('customer.start') }}" method="POST" class="space-y-6">
    @csrf
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">Your Name</label>
        <input 
            type="text" 
            name="customer_name" 
            placeholder="e.g., John Doe"
            required
            class="w-full px-4 py-4 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-laidback-500 focus:ring-4 focus:ring-laidback-100 outline-none transition-all text-lg"
        >
    </div>

    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">Table Number (Optional)</label>
        <input 
            type="text" 
            name="table_number" 
            placeholder="e.g., Table 5"
            class="w-full px-4 py-4 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-laidback-500 focus:ring-4 focus:ring-laidback-100 outline-none transition-all text-lg"
        >
    </div>

    <button 
        type="submit"
        class="w-full bg-gradient-to-r from-laidback-500 to-laidback-600 hover:from-laidback-600 hover:to-laidback-700 text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 text-lg"
    >
        Start Ordering 🍽️
    </button>
</form>


                <!-- Features -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="grid grid-cols-3 gap-4 text-center">
                        <div>
                            <div class="text-2xl mb-1">⚡</div>
                            <p class="text-xs text-gray-600 font-medium">Fast Service</p>
                        </div>
                        <div>
                            <div class="text-2xl mb-1">🌟</div>
                            <p class="text-xs text-gray-600 font-medium">Fresh Menu</p>
                        </div>
                        <div>
                            <div class="text-2xl mb-1">💳</div>
                            <p class="text-xs text-gray-600 font-medium">Easy Payment</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center mt-6 animate-slideUp" style="animation-delay: 0.4s;">
                <p class="text-sm text-gray-600">
                    Powered by <span class="font-semibold text-laidback-600">Laidback Cafe</span>
                </p>
            </div>
        </div>
    </div>
</body>
</html>