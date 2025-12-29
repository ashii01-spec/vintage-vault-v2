<div>
    <div class="container mx-auto py-12 px-4">
    <div class="flex flex-col md:flex-row gap-8">
        
        <aside class="w-full md:w-1/4">
            <h2 class="text-xl font-serif font-bold text-vintage-900 mb-4">Categories</h2>
            <div class="space-y-2">
                <button wire:click="$set('selectedCategory', null)" 
                        class="block w-full text-left px-4 py-2 rounded hover:bg-vintage-100 {{ is_null($selectedCategory) ? 'bg-vintage-100 font-bold' : '' }}">
                    All Items
                </button>
                @foreach($categories as $category)
                    <button wire:click="filterByCategory({{ $category->id }})" 
                            class="block w-full text-left px-4 py-2 rounded hover:bg-vintage-100 {{ $selectedCategory == $category->id ? 'bg-vintage-100 font-bold' : '' }}">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>
        </aside>

        <div class="w-full md:w-3/4">
            <div class="mb-6">
                <input wire:model.live="search" type="text" placeholder="Search for vintage treasures..." 
                       class="w-full border-vintage-500 rounded-lg shadow-sm focus:ring-vintage-500 focus:border-vintage-500">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($products as $product)
                    <div class="card-vintage">
                        <div class="h-48 bg-gray-200 flex items-center justify-center text-gray-500">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                            @else
                                <span class="font-serif italic">No Image</span>
                            @endif
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-bold text-vintage-900">{{ $product->name }}</h3>
                            <p class="text-gray-600 text-sm mt-1 truncate">{{ $product->description }}</p>
                            <div class="mt-4 flex justify-between items-center">
                                <span class="text-lg font-bold text-vintage-900">${{ $product->price }}</span>
                                <button class="btn-vintage text-xs">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12 text-gray-500">
                        No vintage items found matching your criteria.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
</div>
