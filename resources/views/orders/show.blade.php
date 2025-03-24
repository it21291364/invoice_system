<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div id="receipt">
                        <h1 class="text-2xl font-bold mb-4">Order Receipt</h1>
                        <p><strong>Order ID:</strong> {{ $order->id }}</p>
                        <p><strong>Date:</strong> {{ $order->created_at->format('Y-m-d H:i:s') }}</p>
                        <table class="min-w-full border mt-4">
                            <thead class="bg-orange-100">
                                <tr>
                                    <th class="border px-4 py-2">Food Item</th>
                                    <th class="border px-4 py-2">Size</th>
                                    <th class="border px-4 py-2">Quantity</th>
                                    <th class="border px-4 py-2">Price</th>
                                    <th class="border px-4 py-2">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderItems as $item)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $item->foodItem->name }}</td>
                                        <td class="border px-4 py-2">{{ ucfirst($item->foodItem->size) }}</td>
                                        <td class="border px-4 py-2">{{ $item->quantity }}</td>
                                        <td class="border px-4 py-2">Rs {{ number_format($item->price, 2) }}</td>
                                        <td class="border px-4 py-2">Rs {{ number_format($item->price * $item->quantity, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <h2 class="text-xl font-bold mt-4">Total Amount: Rs {{ number_format($order->total_amount, 2) }}</h2>
                    </div>
                    <button onclick="printReceipt()" class="bg-orange-500 text-white px-4 py-2 rounded mt-4">Print Receipt</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function printReceipt() {
            const printContents = document.getElementById('receipt').innerHTML;
            const originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            window.location.reload(); // Restore the page properly
        }
    </script>
</x-app-layout>