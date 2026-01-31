<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl font-serif text-vintage-900 leading-tight">
            {{ __('Seller Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-admin-message />
            
            <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                <!-- Manage My Artifacts -->
                <div class="bg-white border border-vintage-200 overflow-hidden shadow-xl sm:rounded-lg p-6 hover:shadow-2xl transition-shadow cursor-pointer" onclick="window.location='{{ route('seller.products.index') }}'">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-bold font-serif text-vintage-800">Manage My Artifacts</h3>
                        <svg class="w-8 h-8 text-vintage-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">Add, edit, or remove your personal vintage artifacts from the catalog.</p>
                    <a href="{{ route('seller.products.index') }}" class="text-vintage-700 font-bold hover:underline">Go to My Artifacts &rarr;</a>
                </div>
            </div>
            
            <div class="mt-8 bg-vintage-50 border border-vintage-200 p-6 rounded-lg">
                <h3 class="text-lg font-bold font-serif text-vintage-900 mb-2">Welcome Back, Collector!</h3>
                <p class="text-gray-600">This is your personal vault management. Use the card above to list your unique pieces. Remember, quality and history are what our patrons seek.</p>
            </div>
        </div>
    </div>
</x-app-layout>
