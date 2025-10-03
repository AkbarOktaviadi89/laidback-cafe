{{-- resources/views/owner/products/edit.blade.php --}}
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
                <h2 class="text-3xl font-bold text-gray-800">Edit Product</h2>
                <p class="text-gray-600">Update product information</p>
            </div>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('owner.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="bg-white rounded-2xl shadow-md p-8 space-y-6">
            <!-- Product Image -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Product Image</label>
                <div class="flex items-start gap-4">
                    <div id="imagePreview" class="w-32 h-32 bg-gradient-to-br from-amber-100 to-orange-100 rounded-xl flex items-center justify-center text-4xl overflow-hidden">
                        @if($product->image)
                            <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                        @else
                            {{ $product->category->icon ?? '🍽️' }}
                        @endif
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
                        @if($product->image)
                            <p class="text-xs text-gray-600 mt-1">Current: {{ basename($product->image) }}</p>
                        @endif
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
                        <option value="{{ $category->id }}" {{ (old('category_id', $product->category_id) == $category->id) ? 'selected' : '' }}>
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
                    value="{{ old('name', $product->name) }}"
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
                >{{ old('description', $product->description) }}</textarea>
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
                        value="{{ old('price', $product->price) }}"
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
                        value="{{ old('stock', $product->stock) }}"
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
                    {{ old('is_available', $product->is_available) ? 'checked' : '' }}
                    class="w-5 h-5 text-laidback-500 border-2 border-gray-300 rounded focus:ring-laidback-500"
                >
                <label for="is_available" class="text-sm font-semibold text-gray-700">
                    Mark as available for customers
                </label>
            </div>

            <!-- Product Info Card -->
            <div class="bg-gray-50 rounded-xl p-4 space-y-2">
                <h4 class="font-semibold text-gray-700 text-sm">Product Information</h4>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-500">Created:</span>
                        <span class="font-semibold text-gray-700 ml-2">{{ $product->created_at->format('d M Y') }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500">Last Updated:</span>
                        <span class="font-semibold text-gray-700 ml-2">{{ $product->updated_at->format('d M Y') }}</span>
                    </div>
                </div>
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
                    Update Product
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

    <!-- Delete Product Section (Separate Form) -->
    <div class="bg-white rounded-2xl shadow-md p-8 mt-6 border-2 border-red-200">
        <div class="flex items-start gap-4">
            <div class="p-3 bg-red-100 rounded-lg">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            <div class="flex-1">
                <h3 class="text-lg font-bold text-gray-800 mb-1">Danger Zone</h3>
                <p class="text-sm text-gray-600 mb-4">Once you delete this product, there is no going back. Please be certain.</p>
                <form action="{{ route('owner.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?\n\nThis action cannot be undone!')">
                    @csrf
                    @method('DELETE')
                    <button 
                        type="submit"
                        class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl transition flex items-center gap-2"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Delete Product Permanently
                    </button>
                </form>
            </div>
        </div>
    </div>
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