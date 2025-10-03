{{-- resources/views/owner/products/create.blade.php --}}
@extends('layouts.owner')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <a href="{{ route('owner.products.index') }}" class="p-2 hover:bg-gray-100 rounded-lg transition">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div>
                <h2 class="text-3xl font-bold text-gray-800">Add New Product</h2>
                <p class="text-gray-600">Create a new menu item for your restaurant</p>
            </div>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('owner.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="bg-white rounded-2xl shadow-md p-8 space-y-6">
            <!-- Product Image -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Product Image</label>
                <div class="flex items-start gap-4">
                    <div id="imagePreview" class="w-32 h-32 bg-gradient-to-br from-amber-100 to-orange-100 rounded-xl flex items-center justify-center text-4xl overflow-hidden">
                        🍽️
                    </div>
                    <div class="flex-1">
                        <input 
                            type="file" 
                            name="image" 
                            id="imageInput"
                            accept="image/jpeg,image/png,image/jpg"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-laidback-50 file:text-laidback-700 hover:file:bg-laidback-100 cursor-pointer"
                        >
                        <p class="text-xs text-gray-500 mt-2">JPG, JPEG or PNG. Max size 2MB</p>
                        @error('image')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Category -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Category *</label>
                <select 
                    name="category_id" 
                    required
                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-laidback-500 outline-none @error('category_id') border-red-500 @enderror"
                >
                    <option value="">Select a category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->icon }} {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Product Name -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Product Name *</label>
                <input 
                    type="text" 
                    name="name" 
                    value="{{ old('name') }}"
                    required
                    placeholder="e.g., Spicy Chicken Burger"
                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-laidback-500 outline-none @error('name') border-red-500 @enderror"
                >
                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                <textarea 
                    name="description" 
                    rows="4"
                    placeholder="Describe your product..."
                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-laidback-500 outline-none resize-none @error('description') border-red-500 @enderror"
                >{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Price and Stock -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Price -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Price (Rp) *</label>
                    <input 
                        type="number" 
                        name="price" 
                        value="{{ old('price') }}"
                        required
                        min="0"
                        step="0.01"
                        placeholder="25000"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-laidback-500 outline-none @error('price') border-red-500 @enderror"
                    >
                    @error('price')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Stock -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Stock Quantity *</label>
                    <input 
                        type="number" 
                        name="stock" 
                        value="{{ old('stock', 0) }}"
                        required
                        min="0"
                        placeholder="100"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-laidback-500 outline-none @error('stock') border-red-500 @enderror"
                    >
                    @error('stock')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Availability -->
            <div class="flex items-center gap-3">
                <input 
                    type="checkbox" 
                    name="is_available" 
                    id="is_available"
                    value="1"
                    {{ old('is_available', true) ? 'checked' : '' }}
                    class="w-5 h-5 text-laidback-500 border-2 border-gray-300 rounded focus:ring-laidback-500"
                >
                <label for="is_available" class="text-sm font-semibold text-gray-700">
                    Mark as available for customers
                </label>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-3 pt-4 border-t border-gray-200">
                <button 
                    type="submit"
                    class="px-6 py-3 bg-laidback-500 hover:bg-laidback-600 text-white font-bold rounded-xl transition flex items-center gap-2"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Create Product
                </button>
                <a 
                    href="{{ route('owner.products.index') }}"
                    class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold rounded-xl transition"
                >
                    Cancel
                </a>
            </div>
        </div>
    </form>
</div>

<!-- Image Preview Script -->
<script>
document.getElementById('imageInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('imagePreview');
            preview.innerHTML = `<img src="${e.target.result}" alt="Preview" class="w-full h-full object-cover">`;
        }
        reader.readAsDataURL(file);
    }
});
</script>
@endsection