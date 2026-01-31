<div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-serif font-bold text-vintage-900 mb-8 border-b border-vintage-500 pb-2">Your Collection</h1>

    @if (session()->has('message'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    @if(count($cartItems) > 0)
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-vintage-100 text-vintage-900 font-serif uppercase text-sm">
                    <tr>
                        <th class="py-4 px-6">Artifact</th>
                        <th class="py-4 px-6">Price</th>
                        <th class="py-4 px-6 text-center">Quantity</th>
                        <th class="py-4 px-6">Total</th>
                        <th class="py-4 px-6 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach($cartItems as $item)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-4 px-6 flex items-center">
                                <div class="w-16 h-16 bg-gray-200 rounded mr-4 flex items-center justify-center text-xs text-gray-500">
                                    {{ $item->product->image ? 'Image' : 'No Image' }}
                                </div>
                                <span class="font-bold font-serif">{{ $item->product->name }}</span>
                            </td>
                            <td class="py-4 px-6">${{ number_format($item->product->price, 2) }}</td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center space-x-2">
                                    <button wire:click="decrementQty({{ $item->id }})" class="bg-gray-200 px-2 rounded hover:bg-gray-300">-</button>
                                    <span class="font-mono">{{ $item->quantity }}</span>
                                    <button wire:click="incrementQty({{ $item->id }})" class="bg-gray-200 px-2 rounded hover:bg-gray-300">+</button>
                                </div>
                            </td>
                            <td class="py-4 px-6 font-bold text-vintage-900">
                                <span class="text-vintage-800">${{ number_format($item->product->price * $item->quantity, 2) }}</span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <button wire:click="removeItem({{ $item->id }})" class="text-red-500 hover:text-red-700 hover:underline text-sm font-bold">
                                    Remove
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div class="p-6 bg-vintage-50 flex justify-end items-center space-x-4">
                <span class="text-xl font-serif text-vintage-900">Grand Total:</span>
                <span class="text-2xl font-bold font-serif text-vintage-900">${{ number_format($total, 2) }}</span>
            </div>
            <div class="p-6 bg-vintage-50 flex justify-end">
                <button wire:click="checkout" wire:loading.attr="disabled" class="btn-vintage text-lg">Proceed to Checkout</button>
            </div>
        </div>
    @else
        <div class="text-center py-20 bg-white rounded-lg shadow">
            <p class="text-2xl font-serif text-gray-400 mb-4">Your cart is empty.</p>
            <a href="{{ route('shop') }}" class="text-vintage-500 hover:underline">Go find some treasures</a>
        </div>
    @endif
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('checkout-complete', (event) => {
            alert('Checkout Successful! Total Amount: $' + parseFloat(event.total).toFixed(2));
        });
    });
</script>
@endpush