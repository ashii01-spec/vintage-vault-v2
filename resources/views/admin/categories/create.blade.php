<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border border-vintage-200 shadow-xl sm:rounded-lg p-6">
                <h2 class="text-2xl font-serif font-bold text-vintage-900 mb-6">Create New Category</h2>
                
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label class="block text-vintage-800 font-serif font-bold mb-2">Category Name</label>
                        <input type="text" name="name" class="w-full border-gray-300 rounded px-3 py-2 focus:ring-vintage-500 focus:border-vintage-500" required>
                    </div>

                    <div class="mb-6">
                        <label class="block text-vintage-800 font-serif font-bold mb-2">Description</label>
                        <textarea name="description" rows="3" class="w-full border-gray-300 rounded px-3 py-2 focus:ring-vintage-500 focus:border-vintage-500"></textarea>
                    </div>

                    <div class="flex justify-end gap-4">
                        <a href="{{ route('admin.categories.index') }}" class="py-2 px-4 text-gray-600 hover:text-gray-900 font-serif">Cancel</a>
                        <button type="submit" class="btn-vintage">Save Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>