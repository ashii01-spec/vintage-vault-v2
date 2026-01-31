<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-bold text-2xl text-vintage-900 leading-tight">
            {{ __('Manage Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-admin-message />

            <div class="bg-vintage-50 border border-vintage-200 shadow-xl sm:rounded-lg p-6">
                <div class="flex justify-between mb-6">
                    <h3 class="text-xl font-serif font-bold text-vintage-800">All Registered Users</h3>
                    <a href="{{ route('admin.users.create') }}" class="btn-vintage text-sm">
                        + Add New User
                    </a>
                </div>

                <table class="min-w-full text-left font-serif">
                    <thead class="bg-vintage-200 text-vintage-900 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-3">Name</th>
                            <th class="px-6 py-3">Email</th>
                            <th class="px-6 py-3">Phone</th>
                            <th class="px-6 py-3">Address</th>
                            <th class="px-6 py-3">Role</th>
                            <th class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-vintage-200 bg-white">
                        @foreach($users as $user)
                        <tr class="hover:bg-vintage-100 transition-colors">
                            <td class="px-6 py-4 font-bold">{{ $user->name }}</td>
                            <td class="px-6 py-4">{{ $user->email }}</td>
                            <td class="px-6 py-4">{{ $user->phone }}</td>
                            <td class="px-6 py-4">{{ $user->address }}</td>
                            <td class="px-6 py-4">
                                @if($user->role === 'admin')
                                    <span class="bg-red-100 text-red-800 py-1 px-3 rounded-full text-xs font-bold uppercase">Admin</span>
                                @elseif($user->role === 'seller')
                                    <span class="bg-yellow-100 text-yellow-800 py-1 px-3 rounded-full text-xs font-bold uppercase">Seller</span>
                                @else
                                    <span class="bg-green-100 text-green-800 py-1 px-3 rounded-full text-xs font-bold uppercase">Buyer</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 flex gap-3">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-600 hover:underline text-sm font-bold">Edit</a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Remove this user?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline text-sm font-bold">Remove</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>