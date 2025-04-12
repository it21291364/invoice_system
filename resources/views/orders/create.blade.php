<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">The Orange Bay — POS</h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Two-Column Layout -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Column 1: Food Items Grid -->
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h1 class="text-2xl font-bold mb-4">Select Food Items</h1>
                    <div class="grid grid-cols-3 gap-4">
                        @foreach ($foodItems as $foodItem)
                            <button type="button"
                                class="food-item-btn bg-orange-50 shadow-lg rounded-xl p-4 flex flex-col items-center transition transform hover:scale-110 hover:bg-orange-100 hover:ring-2 hover:ring-orange-400 hover:ring-offset-2"
                                data-id="{{ $foodItem->id }}"
                                data-name="{{ $foodItem->name }}"
                                data-price="{{ $foodItem->price }}"
                                data-size="{{ ucfirst($foodItem->size) }}">
                                <!-- Smaller emoji -->
                                <div class="text-xl mb-2">🍽️</div>
                                <!-- Combined food item name and size with distinct color for size -->
                                <span class="block font-bold text-2xl">
                                    {{ $foodItem->name }} -
                                    <span class="text-orange-500">{{ ucfirst($foodItem->size) }}</span>
                                </span>
                                <!-- Price displayed separately -->
                                <span class="block text-sm">Rs {{ number_format($foodItem->price, 2) }}</span>
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Column 2: Order Summary Section -->
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h1 class="text-2xl font-bold mb-4">Order Summary</h1>
                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf
                        <table class="w-full mb-4">
                            <thead>
                                <tr>
                                    <th class="text-left py-2">Item</th>
                                    <th class="py-2 text-center">Size</th>
                                    <th class="py-2 text-center">Price</th>
                                    <th class="py-2 text-center">Quantity</th>
                                    <th class="py-2 text-center">Total</th>
                                    <th class="py-2 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="order-summary">
                                <!-- Order items will be added here dynamically -->
                            </tbody>
                        </table>
                        <div class="mb-4 text-right">
                            <h2 class="text-xl font-bold">
                                Grand Total: Rs <span id="grand-total">0.00</span>
                            </h2>
                        </div>
                        <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded">Save Order</button>
                        <a href="{{ route('dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded ml-4">Close Order</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Object to hold order items. Keys are food item IDs.
        let orderItems = {};

        // Add a food item or increase quantity if already added.
        function addFoodItem(id, name, price, size) {
            if (orderItems[id]) {
                orderItems[id].quantity++;
            } else {
                orderItems[id] = { name: name, price: price, quantity: 1, size: size };
            }
            updateOrderSummary();
        }

        // Update the dynamic order summary table and calculate the grand total.
        function updateOrderSummary() {
            const summaryBody = document.getElementById('order-summary');
            summaryBody.innerHTML = '';
            let grandTotal = 0;

            for (let id in orderItems) {
                const item = orderItems[id];
                const total = item.price * item.quantity;
                grandTotal += total;

                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="py-2">${item.name}</td>
                    <td class="py-2 text-center">${item.size}</td>
                    <td class="py-2 text-center">Rs ${item.price.toFixed(2)}</td>
                    <td class="py-2 text-center">
                        <button type="button" class="decrease bg-gray-300 px-2 rounded" data-id="${id}">-</button>
                        <span class="mx-2">${item.quantity}</span>
                        <button type="button" class="increase bg-gray-300 px-2 rounded" data-id="${id}">+</button>
                        <input type="hidden" name="food_items[${id}][id]" value="${id}">
                        <input type="hidden" name="food_items[${id}][quantity]" value="${item.quantity}" class="quantity-input-${id}">
                        <input type="hidden" name="food_items[${id}][size]" value="${item.size}">
                    </td>
                    <td class="py-2 text-center">Rs ${total.toFixed(2)}</td>
                    <td class="py-2 text-center">
                        <button type="button" class="remove-item bg-red-500 text-white px-2 rounded" data-id="${id}">Remove</button>
                    </td>
                `;
                summaryBody.appendChild(row);
            }
            document.getElementById('grand-total').textContent = grandTotal.toFixed(2);
        }

        // Attach event listeners to food item grid buttons.
        document.querySelectorAll('.food-item-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                // Add animation on click: temporarily scale down the button.
                button.classList.add('scale-95');
                setTimeout(() => {
                    button.classList.remove('scale-95');
                }, 150);

                const id = button.getAttribute('data-id');
                const name = button.getAttribute('data-name');
                const price = parseFloat(button.getAttribute('data-price'));
                const size = button.getAttribute('data-size');
                addFoodItem(id, name, price, size);
            });
        });

        // Handle increasing, decreasing, and removing items using event delegation.
        document.getElementById('order-summary').addEventListener('click', function(event) {
            const id = event.target.getAttribute('data-id');
            if (event.target.classList.contains('increase')) {
                orderItems[id].quantity++;
            } else if (event.target.classList.contains('decrease')) {
                if (orderItems[id].quantity > 1) {
                    orderItems[id].quantity--;
                }
            } else if (event.target.classList.contains('remove-item')) {
                delete orderItems[id];
            }
            updateOrderSummary();
        });
    </script>
</x-app-layout>
