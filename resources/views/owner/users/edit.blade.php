{{-- resources/views/owner/users/edit.blade.php --}}
@extends('layouts.owner')

@section('content')
<div class="flex items-center gap-4 mb-8">
    <a href="{{ route('owner.users.index') }}" class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow hover:shadow-md transition">
        <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
    </a>
    <div>
        <h2 class="text-3xl font-bold text-gray-800 mb-2">Edit User</h2>
        <p class="text-gray-600">Update user information</p>
    </div>
</div>

<div class="max-w-2xl">
    <form action="{{ route('owner.users.update', $user->id) }}" method="POST" class="bg-white rounded-2xl shadow-lg p-8">
        @csrf
        @method('PUT')
        
        <div class="space-y-6">
            <!-- Name -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                <input 
                    type="text" 
                    name="name" 
                    value="{{ old('name', $user->name) }}"
                    required
                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-laidback-500 focus:ring-4 focus:ring-laidback-100 outline-none @error('name') border-red-500 @enderror"
                >
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                <input 
                    type="email" 
                    name="email" 
                    value="{{ old('email', $user->email) }}"
                    required
                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-laidback-500 focus:ring-4 focus:ring-laidback-100 outline-none @error('email') border-red-500 @enderror"
                >
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Phone Number (Optional)</label>
                <input 
                    type="text" 
                    name="phone" 
                    value="{{ old('phone', $user->phone) }}"
                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-laidback-500 focus:ring-4 focus:ring-laidback-100 outline-none"
                >
            </div>

            <!-- Role -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Role</label>
                <select 
                    name="role" 
                    required
                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-laidback-500 focus:ring-4 focus:ring-laidback-100 outline-none @error('role') border-red-500 @enderror"
                >
                    <option value="owner" {{ old('role', $user->role) == 'owner' ? 'selected' : '' }}>Owner</option>
                    <option value="cashier" {{ old('role', $user->role) == 'cashier' ? 'selected' : '' }}>Cashier</option>
                </select>
                @error('role')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password (Optional) -->
            <div class="border-t pt-6">
                <h3 class="font-bold text-gray-800 mb-4">Change Password (Optional)</h3>
                <p class="text-sm text-gray-600 mb-4">Leave blank if you don't want to change the password</p>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">New Password</label>
                        <input 
                            type="password" 
                            name="password" 
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-laidback-500 focus:ring-4 focus:ring-laidback-100 outline-none @error('password') border-red-500 @enderror"
                            placeholder="Minimum 8 characters"
                        >
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Confirm New Password</label>
                        <input 
                            type="password" 
                            name="password_confirmation" 
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-laidback-500 focus:ring-4 focus:ring-laidback-100 outline-none"
                            placeholder="Re-enter new password"
                        >
                    </div>
                </div>
            </div>
        </div>

        <div class="flex gap-4 mt-8">
            <a href="{{ route('owner.users.index') }}" class="flex-1 px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold rounded-xl text-center transition">
                Cancel
            </a>
            <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-laidback-500 to-laidback-600 hover:from-laidback-600 hover:to-laidback-700 text-white font-bold rounded-xl transition">
                Update User
            </button>
        </div>
    </form>
</div>
@endsection