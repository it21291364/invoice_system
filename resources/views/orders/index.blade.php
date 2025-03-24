<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">All Orders</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @foreach($orders as $order)
                <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                    <div class="p-4 border-b flex justify-between items-center">
                        <div>
                            <span class="font-bold">Order #{{ $order->id }}</span>
                            <span class="text-gray-600 ml-4">{{ $order->created_at->format('Y-m-d H:i') }}</span>
                        </div>
                        <div class="text-lg font-semibold">Rs {{ number_format($order->total_amount,2) }}</div>
                        <a href="{{ route('orders.show', $order) }}" class="bg-orange-500 text-white px-3 py-1 rounded">View Receipt</a>
                    </div>

                    <table class="min-w-full border">
                        <thead class="bg-orange-100">
                            <tr>
                                <th class="px-4 py-2 border">Food Item</th>
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
                                    <td class="px-4 py-2 border">Rs {{ number_format($item->price,2) }}</td>
                                    <td class="px-4 py-2 border">Rs {{ number_format($item->price * $item->quantity,2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach

            @if($orders->isEmpty())
                <p class="text-center text-gray-500">No orders have been placed yet.</p>
            @endif
        </div>
    </div>
</x-app-layout>
