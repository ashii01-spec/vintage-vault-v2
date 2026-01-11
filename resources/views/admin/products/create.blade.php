<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-6">Add New Artifact</h2>
                
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Item Name</label>
                        <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Category</label>
                        <select name="category_id" class="w-full border rounded px-3 py-2">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Price ($)</label>
                            <input type="number" step="0.01" name="price" class="w-full border rounded px-3 py-2" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Quantity</label>
                            <input type="number" name="quantity" class="w-full border rounded px-3 py-2" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Description</label>
                        <textarea name="description" rows="4" class="w-full border rounded px-3 py-2" required></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Image</label>
                        <input type="file" name="image" class="w-full">
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('admin.products.index') }}" class="text-gray-600 px-4 py-2 mr-2">Cancel</a>
                        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">Save Artifact</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>