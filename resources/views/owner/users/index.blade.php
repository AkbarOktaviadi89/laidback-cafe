{{-- resources/views/owner/users/index.blade.php --}}
@extends('layouts.owner')

@section('content')
<div class="flex items-center justify-between mb-8">
    <div>
        <h2 class="text-3xl font-bold text-gray-800 mb-2">User Management</h2>
        <p class="text-gray-600">Manage staff accounts and permissions</p>
    </div>
    <a href="{{ route('owner.users.create') }}" class="px-6 py-3 bg-laidback-500 hover:bg-laidback-600 text-white font-bold rounded-xl transition flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg>
        Add User
    </a>
</div>

<!-- Filters -->
<div class="bg-white rounded-2xl shadow-md p-6 mb-6">
    <form method="GET" action="{{ route('owner.users.index') }}" class="flex gap-4">
        <div class="flex-1">
            <input 
                type="text" 
                name="search" 
                placeholder="Search users by name or email..."
                value="{{ $search }}"
                class="w-full px-4 py-2 border-2 border-gray-200 rounded-xl focus:border-laidback-500 outline-none"
            >
        </div>
        <select name="role" class="px-4 py-2 border-2 border-gray-200 rounded-xl focus:border-laidback-500 outline-none">
            <option value="">All Roles</option>
            <option value="owner" {{ $role == 'owner' ? 'selected' : '' }}>Owner</option>
            <option value="cashier" {{ $role == 'cashier' ? 'selected' : '' }}>Cashier</option>
        </select>
        <button type="submit" class="px-6 py-2 bg-gray-800 hover:bg-gray-900 text-white font-semibold rounded-xl transition">
            Filter
        </button>
        @if($search || $role)
            <a href="{{ route('owner.users.index') }}" class="px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-xl transition">
                Clear
            </a>
        @endif
    </form>
</div>

<!-- Users Table -->
<div class="bg-white rounded-2xl shadow-md overflow-hidden">
    @if($users->isEmpty())
        <div class="text-center py-12">
            <div class="text-6xl mb-4">👥</div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">No Users Found</h3>
            <p class="text-gray-600">No users match your search</p>
        </div>
    @else
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50 border-b-2 border-gray-200">
                    <th class="text-left py-4 px-6 font-semibold text-gray-700">Name</th>
                    <th class="text-left py-4 px-6 font-semibold text-gray-700">Email</th>
                    <th class="text-left py-4 px-6 font-semibold text-gray-700">Phone</th>
                    <th class="text-left py-4 px-6 font-semibold text-gray-700">Role</th>
                    <th class="text-left py-4 px-6 font-semibold text-gray-700">Joined</th>
                    <th class="text-left py-4 px-6 font-semibold text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-laidback-500 to-laidback-600 rounded-full flex items-center justify-center text-white font-bold">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $user->name }}</p>
                                    @if($user->id === auth()->id())
                                        <span class="text-xs text-green-600 font-semibold">(You)</span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="text-gray-700">{{ $user->email }}</span>
                        </td>
                        <td class="py-4 px-6">
                            <span class="text-gray-700">{{ $user->phone ?? '-' }}</span>
                        </td>
                        <td class="py-4 px-6">
                            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $user->role === 'owner' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <span class="text-sm text-gray-600">{{ $user->created_at->format('d M Y') }}</span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('owner.users.edit', $user->id) }}" class="p-2 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-lg transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                @if($user->id !== auth()->id())
                                    <form action="{{ route('owner.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 bg-red-100 hover:bg-red-200 text-red-600 rounded-lg transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="p-6">
            {{ $users->links() }}
        </div>
    @endif
</div>
@endsection