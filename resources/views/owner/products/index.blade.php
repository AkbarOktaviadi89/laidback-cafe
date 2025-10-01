{{-- resources/views/owner/products/index.blade.php --}}
@extends('layouts.owner')

@section('content')
<div class="flex items-center justify-between mb-8">
    <div>
        <h2 class="text-3xl font-bold text-gray-800 mb-2">Product Management</h2>
        <p class="text-gray-600">Manage your menu items and inventory</p>
    </div>
    <a href="{{ route('owner.products.create') }}" class="px-6 py-3 bg-laidback-500 hover:bg-laidback-600 text-white font-bold rounded-xl transition flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg>
        Add Product
    </a>
</div>

<!-- Filters -->
<div class="bg-white rounded-2xl shadow-md p-6 mb-6">
    <form method="GET" action="{{ route('owner.products.index') }}" class="flex gap-4">
        <div class="flex-1">
            <input 
                type="text" 
                name="search" 
                placeholder="Search products..."
                value="{{ $search }}"
                class="w-full px-4 py-2 border-2 border-gray-200 rounded-xl focus:border-laidback-500 outline-none"
            >
        </div>
        <select name="category" class="px-4 py-2 border-2 border-gray-200 rounded-xl focus:border-laidback-500 outline-none">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ $category == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="px-6 py-2 bg-gray-800 hover:bg-gray-900 text-white font-semibold rounded-xl transition">
            Filter
        </button>
        @if($search || $category)
            <a href="{{ route('owner.products.index') }}" class="px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-xl transition">
                Clear
            </a>
        @endif
    </form>
</div>

<!-- Products Table -->
<div class="bg-white rounded-2xl shadow-md overflow-hidden">
    @if($products->isEmpty())
        <div class="text-center py-12">
            <div class="text-6xl mb-4">📦</div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">No Products Found</h3>
            <p class="text-gray-600 mb-4">Start by adding your first product</p>
            <a href="{{ route('owner.products.create') }}" class="inline-block px-6 py-3 bg-laidback-500 hover:bg-laidback-600 text-white font-bold rounded-xl transition">
                Add Product
            </a>
        </div>
    @else
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50 border-b-2 border-gray-200">
                    <th class="text-left py-4 px-6 font-semibold text-gray-700">Product</th>
                    <th class="text-left py-4 px-6 font-semibold text-gray-700">Category</th>
                    <th class="text-left py-4 px-6 font-semibold text-gray-700">Price</th>
                    <th class="text-left py-4 px-6 font-semibold text-gray-700">Stock</th>
                    <th class="text-left py-4 px-6 font-semibold text-gray-700">Status</th>
                    <th class="text-left py-4 px-6 font-semibold text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                @if($product->image)
                                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-12 h-12 rounded-lg object-cover">
                                @else
                                    <div class="w-12 h-12 bg-gradient-to-br from-amber-100 to-orange-100 rounded-lg flex items-center justify-center text-2xl">
                                        {{ $product->category->icon ?? '🍽️' }}
                                    </div>
                                @endif
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $product->name }}</p>
                                    <p class="text-sm text-gray-500">{{ Str::limit($product->description, 40) }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm font-semibold">
                                {{ $product->category->icon }} {{ $product->category->name }}
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <span class="font-bold text-gray-800">{{ $product->formatted_price }}</span>
                        </td>
                        <td class="py-4 px-6">
                            <span class="font-semibold {{ $product->stock <= 10 ? 'text-red-600' : 'text-gray-800' }}">
                                {{ $product->stock }}
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <form action="{{ route('owner.products.toggle', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-3 py-1 {{ $product->is_available ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }} rounded-full text-xs font-bold hover:opacity-80 transition">
                                    {{ $product->is_available ? 'Available' : 'Unavailable' }}
                                </button>
                            </form>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('owner.products.edit', $product->id) }}" class="p-2 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-lg transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                <form action="{{ route('owner.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 bg-red-100 hover:bg-red-200 text-red-600 rounded-lg transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="p-6">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection