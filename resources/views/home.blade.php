@include('layouts.navbar')
<x-guest-layout>
    <div class="bg-vintage-900 text-vintage-50 py-24 px-4 text-center relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none" 
             style="background-image: url('https://www.transparenttextures.com/patterns/aged-paper.png');">
        </div>
        
        <h1 class="text-5xl md:text-7xl font-serif font-bold tracking-widest mb-6">VINTAGE VAULT</h1>
        <p class="text-xl md:text-2xl font-serif italic mb-10 text-vintage-100 opacity-80">
            "Preserving the timeless artifacts of history."
        </p>
        <a href="{{ route('shop') }}" class="inline-block border-2 border-vintage-100 text-vintage-100 py-3 px-8 text-lg font-bold uppercase tracking-widest hover:bg-vintage-100 hover:text-vintage-900 transition-all duration-300">
            Enter the Vault
        </a>
    </div>

    <div class="container mx-auto py-16 px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-serif font-bold text-vintage-900 uppercase tracking-widest">Featured Artifacts</h2>
            <div class="w-24 h-1 bg-vintage-500 mx-auto mt-4"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($featuredProducts as $product)
                <div class="bg-white border border-vintage-100 rounded-lg shadow-lg overflow-hidden group">
                    <div class="h-80 bg-vintage-100 flex items-center justify-center overflow-hidden">
                        @if($product->image)
                             <img src="{{ asset('storage/' . $product->image) }}" class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                             <span class="font-serif text-2xl text-vintage-500 opacity-50">Artifact #{{ $product->id }}</span>
                        @endif
                    </div>
                    <div class="p-6 text-center">
                        <span class="text-xs font-serif text-vintage-500 uppercase">{{ $product->category->name }}</span>
                        <h3 class="font-serif text-xl font-bold text-vintage-900 mt-2">{{ $product->name }}</h3>
                        <p class="text-vintage-900 font-bold mt-2">${{ number_format($product->price, 2) }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
    @include('layouts.footer')
</x-guest-layout>
