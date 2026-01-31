<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border border-vintage-200 shadow-xl sm:rounded-lg p-6">
                <h2 class="text-2xl font-serif font-bold text-vintage-900 mb-6">Register New User</h2>
                
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block font-serif font-bold mb-2 text-vintage-900">Full Name</label>
                        <input type="text" name="name" class="w-full border-gray-300 rounded px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-serif font-bold mb-2 text-vintage-900">Email Address</label>
                        <input type="email" name="email" class="w-full border-gray-300 rounded px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-serif font-bold mb-2 text-vintage-900">Password</label>
                        <input type="password" name="password" class="w-full border-gray-300 rounded px-3 py-2" required>
                    </div>

                    <div class="mb-6">
                        <label class="block font-serif font-bold mb-2 text-vintage-900">Role</label>
                        <select name="role" class="w-full border-gray-300 rounded px-3 py-2">
                            <option value="user">Buyer (User)</option>
                            <option value="seller">Seller</option>
                            <option value="admin">Administrator</option>
                        </select>
                    </div>

                    <div class="flex justify-end gap-4">
                        <a href="{{ route('admin.users.index') }}" class="py-2 px-4 text-gray-600 font-serif hover:text-gray-900">Cancel</a>
                        <button type="submit" class="btn-vintage">Create User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>