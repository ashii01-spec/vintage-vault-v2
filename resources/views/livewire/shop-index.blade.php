<div>
    @if (session()->has('message'))
        <div x-data="{ show: true }" 
             x-show="show" 
             x-init="setTimeout(() => show = false, 5000)"
             class="fixed top-20 right-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow-lg z-50 animate-bounce">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif
    <div class="container mx-auto py-12 px-4">
        
            <div class="flex flex-col md:flex-row gap-8">

            <aside class="w-full md:w-1/4">
                <h2 class="text-xl font-serif font-bold text-vintage-900 mb-4">Categories</h2>
                <div class="bg-white p-4 space-y-2 rounded-lg">
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
                        <div class="card-vintage group">
                            <div class="h-64 bg-vintage-100 flex items-center justify-center border-b border-vintage-500 overflow-hidden relative">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="h-full w-full object-cover group-hover:scale-110 transition-transform duration-500" alt="{{ $product->name }}">
                                @else
                                    <span class="font-serif italic text-vintage-500 group-hover:scale-110 transition-transform">🏛️ Vintage Artifact</span>
                                @endif
                            </div>
                            <div class="p-6">
                                <span class="text-xs font-serif text-vintage-500 uppercase tracking-widest">{{ $product->category->name }}</span>
                                <h3 class="text-xl font-serif font-bold text-vintage-900 mt-1">{{ $product->name }}</h3>
                                <p class="text-gray-600 text-sm mt-2 italic">"{{ $product->description }}"</p>
                                <div class="mt-6 flex justify-between items-center">
                                    <span class="text-2xl font-bold text-vintage-900 font-serif">${{ number_format($product->price, 2) }}</span>
                                    <button wire:click="addToCart({{ $product->id }})" 
                                            class="btn-vintage hover:tracking-widest transition-all active:scale-95">
                                        Add to Cart
                                    </button>
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
