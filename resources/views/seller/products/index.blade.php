<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold font-serif text-2xl text-vintage-900 leading-tight">
            {{ __('My Artifacts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-admin-message />

            <div class="bg-vintage-50 border border-vintage-200 shadow-xl sm:rounded-lg p-6">
                <div class="flex justify-between mb-6">
                    <h3 class="text-xl font-serif font-bold text-vintage-800">Your Listed Artifacts</h3>
                    <a href="{{ route('seller.products.create') }}" class="btn-vintage text-sm">
                        + List New Artifact
                    </a>
                </div>

                <table class="min-w-full text-left font-serif text-sm">
                    <thead class="bg-vintage-200 text-vintage-900 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-3">Image</th>
                            <th class="px-6 py-3">Name</th>
                            <th class="px-6 py-3">Category</th>
                            <th class="px-6 py-3">Price</th>
                            <th class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-vintage-200 bg-white">
                        @foreach($products as $product)
                        <tr class="hover:bg-vintage-100 transition-colors">
                            <td class="px-6 py-4">
                                @if($product->image)
                                    <img src="{{ asset('storage/'.$product->image) }}" class="w-12 h-12 object-cover rounded border border-vintage-200 shadow-sm">
                                @else
                                    <span class="text-gray-400 italic">No Img</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-bold text-vintage-900">{{ $product->name }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $product->category->name }}</td>
                            <td class="px-6 py-4 font-bold text-vintage-800">${{ $product->price }}</td>
                            <td class="px-6 py-4 flex gap-3">
                                <a href="{{ route('seller.products.edit', $product->id) }}" class="text-indigo-600 hover:text-indigo-900 font-bold text-sm">Edit</a>
                                <form action="{{ route('seller.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this artifact?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 font-bold text-sm">Remove</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $products->links() }} 
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
