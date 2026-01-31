<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold font-serif text-2xl text-vintage-900 leading-tight">
            {{ __('Manage Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-admin-message />

            <div class="bg-vintage-50 border border-vintage-200 shadow-xl sm:rounded-lg p-6">
                <div class="mb-6">
                    <h3 class="text-xl font-serif font-bold text-vintage-800">Order History</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-left font-serif text-sm">
                        <thead class="bg-vintage-200 text-vintage-900 uppercase text-xs">
                            <tr>
                                <th class="px-6 py-3">Order ID</th>
                                <th class="px-6 py-3">Customer</th>
                                <th class="px-6 py-3">Total</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3">Date</th>
                                <th class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-vintage-200 bg-white">
                            @foreach($orders as $order)
                            <tr class="hover:bg-vintage-100 transition-colors">
                                <td class="px-6 py-4 font-bold text-vintage-900">#{{ $order->id }}</td>
                                <td class="px-6 py-4">
                                    <div class="font-bold">{{ $order->user->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $order->user->email }}</div>
                                </td>
                                <td class="px-6 py-4 font-bold text-vintage-800">${{ number_format($order->total_price, 2) }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 rounded-full text-xs font-bold uppercase 
                                        {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : 
                                           ($order->status === 'cancelled' ? 'bg-red-100 text-red-800' : 
                                           ($order->status === 'shipped' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800')) }}">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-600">{{ $order->created_at->format('M d, Y H:i') }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="text-indigo-600 hover:text-indigo-900 font-bold text-sm">View Details</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $orders->links() }} 
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
