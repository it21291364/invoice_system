<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Receipt Container (58mm wide with increased base font size) -->
                    <div id="receipt" style="width: 58mm; margin: 0 auto; font-size: 16px; line-height: 1.4;">
                        <!-- Header -->
                        <h1 class="text-center text-3xl font-bold mb-2">THE ORANGE BAY</h1>
                        <hr class="my-2 border-t-2 border-gray-400">
                        <p class="text-center text-lg font-semibold mb-2">Order Receipt</p>
                        <p><strong>Order ID:</strong> {{ $order->id }}</p>
                        <p><strong>Date:</strong> {{ $order->created_at->format('Y-m-d H:i:s') }}</p>
                        <hr class="my-2 border-dotted border-gray-400">
                        
                        <!-- Order Summary Table -->
                        <table class="w-full mt-4 border-collapse" style="font-size: 16px;">
                            <thead>
                                <tr>
                                    <th class="border px-2 py-1">Item</th>
                                    <th class="border px-2 py-1">Size</th>
                                    <th class="border px-2 py-1">Qty</th>
                                    <th class="border px-2 py-1">Price</th>
                                    <th class="border px-2 py-1">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderItems as $item)
                                    <tr>
                                        <td class="border px-2 py-1">{{ $item->foodItem->name }}</td>
                                        <td class="border px-2 py-1">{{ ucfirst($item->foodItem->size) }}</td>
                                        <td class="border px-2 py-1">{{ $item->quantity }}</td>
                                        <td class="border px-2 py-1">Rs {{ number_format($item->price, 2) }}</td>
                                        <td class="border px-2 py-1">Rs {{ number_format($item->price * $item->quantity, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <h2 class="text-center text-xl font-bold mt-4">Total Amount: Rs {{ number_format($order->total_amount, 2) }}</h2>
                        <hr class="my-2 border-t-2 border-gray-400">
                        
                        <!-- Footer -->
                        <p class="text-center mt-4 font-semibold">Thank You for Your Purchase!</p>
                        <p class="text-center text-sm mt-2">
                            Contact Us:<br>
                            0740300045 | 0712178541
                        </p>
                    </div>
                    
                    <!-- Print Receipt Button -->
                    <button onclick="printReceipt()" class="bg-orange-500 text-white px-4 py-2 rounded mt-4">
                        Print Receipt
                    </button>
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
            window.location.reload(); // Restore the page properly after printing
        }
    </script>
</x-app-layout>
