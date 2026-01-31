@include('layouts.navbar')
<x-guest-layout>
    <div class="bg-vintage-100 py-16 tracking-tight">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h1 class="text-4xl md:text-5xl font-serif font-bold text-vintage-900 uppercase tracking-widest">Artifact Gallery</h1>
                <p class="text-vintage-800 font-serif italic mt-4 italic opacity-75">"A curated visual journey through the history of the Vault."</p>
                <div class="w-24 h-1 bg-vintage-500 mx-auto mt-6"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach($products as $product)
                    <div class="card-vintage group">
                        <div class="h-64 bg-vintage-200 overflow-hidden relative">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="h-full w-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="h-full w-full flex items-center justify-center bg-vintage-100 italic text-vintage-500 font-serif">
                                     Artifact #{{ $product->id }}
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-vintage-900 bg-opacity-40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center p-4">
                                <span class="border border-white text-white px-4 py-2 text-sm uppercase tracking-widest font-bold">View History</span>
                            </div>
                        </div>
                        <div class="p-4 text-center">
                            <h3 class="font-serif text-lg font-bold text-vintage-900 mb-1">{{ $product->name }}</h3>
                            <span class="text-xs font-serif uppercase text-vintage-500 tracking-wider">{{ $product->category->name }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
            
            @if($products->isEmpty())
                <div class="text-center py-20 italic text-vintage-500 font-serif">
                    The gallery is currently empty. More artifacts coming soon.
                </div>
            @endif
        </div>
    </div>
    
    @include('layouts.footer')
</x-guest-layout>
