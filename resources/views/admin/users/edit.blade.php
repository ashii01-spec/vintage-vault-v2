<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border border-vintage-200 shadow-xl sm:rounded-lg p-6">
                <h2 class="text-2xl font-serif font-bold text-vintage-900 mb-6">Edit User Details</h2>
                
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block font-serif font-bold mb-2 text-vintage-900">Full Name</label>
                        <input type="text" name="name" value="{{ $user->name }}" class="w-full border-gray-300 rounded px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-serif font-bold mb-2 text-vintage-900">Email Address</label>
                        <input type="email" name="email" value="{{ $user->email }}" class="w-full border-gray-300 rounded px-3 py-2" required>
                    </div>

                    <div class="mb-6">
                        <label class="block font-serif font-bold mb-2 text-vintage-900">Role</label>
                        <select name="role" class="w-full border-gray-300 rounded px-3 py-2">
                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>Buyer (User)</option>
                            <option value="seller" {{ $user->role == 'seller' ? 'selected' : '' }}>Seller</option>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Administrator</option>
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Note: Changing your own role may lock you out of the admin panel.</p>
                    </div>

                    <div class="flex justify-end gap-4">
                        <a href="{{ route('admin.users.index') }}" class="py-2 px-4 text-gray-600 font-serif hover:text-gray-900">Cancel</a>
                        <button type="submit" class="btn-vintage">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>