<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold font-serif text-vintage-900">Edit My Artifact: {{ $product->name }}</h2>
                    <a href="{{ route('seller.products.index') }}" class="text-gray-600 hover:text-gray-900 font-serif">Back to My List</a>
                </div>
                
                <form action="{{ route('seller.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="block text-vintage-900 font-bold mb-2 font-serif">Item Name</label>
                        <input type="text" name="name" value="{{ $product->name }}" class="w-full border-gray-300 rounded px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-vintage-900 font-bold mb-2 font-serif">Category</label>
                        <select name="category_id" class="w-full border-gray-300 rounded px-3 py-2">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-vintage-900 font-bold mb-2 font-serif">Price ($)</label>
                            <input type="number" step="0.01" name="price" value="{{ $product->price }}" class="w-full border-gray-300 rounded px-3 py-2" required>
                        </div>
                        <div>
                            <label class="block text-vintage-900 font-bold mb-2 font-serif">Quantity</label>
                            <input type="number" name="quantity" value="{{ $product->quantity }}" class="w-full border-gray-300 rounded px-3 py-2" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-vintage-900 font-bold mb-2 font-serif">Description</label>
                        <textarea name="description" rows="4" class="w-full border-gray-300 rounded px-3 py-2" required>{{ $product->description }}</textarea>
                    </div>

                    <div class="mb-6 bg-gray-50 p-4 rounded border border-gray-200">
                        <label class="block text-vintage-900 font-bold mb-2 font-serif">Product Image</label>
                        
                        @if($product->image)
                            <div class="flex items-start gap-4 mb-4">
                                <div class="relative">
                                    <img src="{{ asset('storage/'.$product->image) }}" class="w-32 h-32 object-cover rounded border border-gray-300 shadow-sm">
                                    <span class="text-xs text-gray-500 block mt-1 text-center">Current Image</span>
                                </div>
                    
                                <div class="flex items-center h-32">
                                    <label class="flex items-center space-x-2 cursor-pointer p-2 hover:bg-red-50 rounded border border-transparent hover:border-red-200 transition-colors">
                                        <input type="checkbox" name="remove_image" value="1" class="rounded text-red-600 focus:ring-red-500">
                                        <span class="text-red-700 font-bold text-sm">Delete this image</span>
                                    </label>
                                </div>
                            </div>
                        @endif
                    
                        <label class="block text-sm text-gray-700 font-bold mb-1">
                            {{ $product->image ? 'Replace with new image:' : 'Upload Image:' }}
                        </label>
                        <input type="file" name="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-vintage-100 file:text-vintage-700 hover:file:bg-vintage-200">
                    </div>

                    <div class="flex justify-end mt-6">
                        <button type="submit" class="btn-vintage">Update Artifact</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
