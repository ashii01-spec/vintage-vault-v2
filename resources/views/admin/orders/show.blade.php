<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold font-serif text-2xl text-vintage-900 leading-tight">
                {{ __('Order Details') }} #{{ $order->id }}
            </h2>
            <a href="{{ route('admin.orders.index') }}" class="text-vintage-700 hover:underline font-serif">&larr; Back to List</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-admin-message />

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Order Summary -->
                <div class="md:col-span-2">
                    <div class="bg-white border border-vintage-200 shadow-xl sm:rounded-lg overflow-hidden">
                        <div class="bg-vintage-100 p-4 border-b border-vintage-200">
                            <h3 class="text-lg font-serif font-bold text-vintage-800">Artifacts in Order</h3>
                        </div>
                        <table class="min-w-full text-left font-serif text-sm">
                            <thead class="bg-vintage-50 text-vintage-900 uppercase text-xs border-b border-vintage-200">
                                <tr>
                                    <th class="px-6 py-3">Artifact</th>
                                    <th class="px-6 py-3 text-center">Price</th>
                                    <th class="px-6 py-3 text-center">Qty</th>
                                    <th class="px-6 py-3 text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-vintage-100 italic">
                                @foreach($order->items as $item)
                                <tr>
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-vintage-900">{{ $item->product->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $item->product->category->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-center">${{ number_format($item->price, 2) }}</td>
                                    <td class="px-6 py-4 text-center">{{ $item->quantity }}</td>
                                    <td class="px-6 py-4 text-right font-bold text-vintage-800">${{ number_format($item->price * $item->quantity, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-vintage-50 border-t-2 border-vintage-200">
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-right font-bold text-vintage-900 uppercase tracking-wider">Grand Total</td>
                                    <td class="px-6 py-4 text-right font-bold text-2xl text-vintage-900">${{ number_format($order->total_price, 2) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <!-- Order Status & Customer Info -->
                <div class="md:col-span-1 space-y-6">
                    <!-- Status Update -->
                    <div class="bg-white border border-vintage-200 shadow-xl sm:rounded-lg p-6">
                        <h3 class="text-lg font-serif font-bold text-vintage-800 mb-4">Update Status</h3>
                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="w-full border-vintage-300 rounded-md shadow-sm focus:border-vintage-500 focus:ring focus:ring-vintage-200 focus:ring-opacity-50 mb-4 font-serif">
                                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            <button type="submit" class="w-full btn-vintage">Update Fulfillment</button>
                        </form>
                    </div>

                    <!-- Customer Info -->
                    <div class="bg-white border border-vintage-200 shadow-xl sm:rounded-lg p-6">
                        <h3 class="text-lg font-serif font-bold text-vintage-800 mb-4">Customer Details</h3>
                        <div class="space-y-3 font-serif">
                            <div>
                                <span class="text-xs text-gray-500 uppercase block">Name</span>
                                <span class="font-bold text-vintage-900">{{ $order->user->name }}</span>
                            </div>
                            <div>
                                <span class="text-xs text-gray-500 uppercase block">Email</span>
                                <span class="text-vintage-800">{{ $order->user->email }}</span>
                            </div>
                            <div>
                                <span class="text-xs text-gray-500 uppercase block">Ordered On</span>
                                <span class="text-vintage-800">{{ $order->created_at->format('F j, Y \a\t g:i A') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
