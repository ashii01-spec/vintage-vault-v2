<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border border-vintage-200 shadow-xl sm:rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-6 font-serif text-vintage-900">Add New Artifact</h2>
                
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="block text-vintage-900 font-bold mb-2 font-serif">Item Name</label>
                        <input type="text" name="name" class="w-full border-gray-300 rounded px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-vintage-900 font-bold mb-2 font-serif">Category</label>
                        <select name="category_id" class="w-full border-gray-300 rounded px-3 py-2">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-vintage-900 font-bold mb-2 font-serif">Price ($)</label>
                            <input type="number" step="0.01" name="price" class="w-full border-gray-300 rounded px-3 py-2" required>
                        </div>
                        <div>
                            <label class="block text-vintage-900 font-bold mb-2 font-serif">Quantity</label>
                            <input type="number" name="quantity" class="w-full border-gray-300 rounded px-3 py-2" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-vintage-900 font-bold mb-2 font-serif">Description</label>
                        <textarea name="description" rows="4" class="w-full border-gray-300 rounded px-3 py-2" required></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-vintage-900 font-bold mb-2 font-serif">Image</label>
                        <input type="file" name="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-vintage-100 file:text-vintage-700 hover:file:bg-vintage-200">
                    </div>

                    <div class="flex justify-end mt-6">
                        <a href="{{ route('admin.products.index') }}" class="text-gray-600 px-4 py-2 mr-2 font-serif hover:text-gray-900">Cancel</a>
                        <button type="submit" class="btn-vintage">Save Artifact</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>