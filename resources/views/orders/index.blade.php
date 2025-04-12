<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">All Orders</h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            @forelse($orders as $date => $dailyOrders)
                <div class="bg-white shadow-sm rounded-lg">
                    <div class="p-4 bg-orange-100 flex justify-between items-center">
                        <h3 class="text-lg font-bold">{{ \Carbon\Carbon::parse($date)->format('F j, Y') }}</h3>
                        <span class="font-semibold">Daily Total: Rs {{ number_format($dailyOrders->sum('total_amount'), 2) }}</span>
                    </div>

                    @foreach($dailyOrders as $order)
                        <div class="p-4 border-b">
                            <div class="flex justify-between items-center mb-2">
                                <div>
                                    <strong>Order #{{ $order->id }}</strong> — 
                                    <span class="text-gray-600">{{ $order->created_at->format('H:i') }}</span>
                                </div>
                                <div class="flex space-x-2 items-center">
                                    <div class="font-semibold">Rs {{ number_format($order->total_amount, 2) }}</div>
                                    <a href="{{ route('orders.show', $order) }}" class="bg-orange-500 text-white px-3 py-1 rounded">View Receipt</a>
                                    <!-- Delete Order Button with icon -->
                                    <form action="{{ route('orders.destroy', $order) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this order?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white p-2 rounded" aria-label="Delete Order">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22M8 7V4a1 1 0 011-1h6a1 1 0 011 1v3" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <table class="min-w-full border mb-4">
                                <thead class="bg-orange-50">
                                    <tr>
                                        <th class="px-4 py-2 border">Item</th>
                                        <th class="px-4 py-2 border">Size</th>
                                        <th class="px-4 py-2 border">Qty</th>
                                        <th class="px-4 py-2 border">Price</th>
                                        <th class="px-4 py-2 border">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->orderItems as $item)
                                        <tr>
                                            <td class="px-4 py-2 border">{{ $item->foodItem->name }}</td>
                                            <td class="px-4 py-2 border">{{ ucfirst($item->foodItem->size) }}</td>
                                            <td class="px-4 py-2 border">{{ $item->quantity }}</td>
                                            <td class="px-4 py-2 border">Rs {{ number_format($item->price, 2) }}</td>
                                            <td class="px-4 py-2 border">Rs {{ number_format($item->price * $item->quantity, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                </div>
            @empty
                <p class="text-center text-gray-500">No orders placed yet.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
