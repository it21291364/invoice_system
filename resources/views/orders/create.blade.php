<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-4">Create New Order</h1>
                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf
                        <div id="order-items">
                            <div class="order-item mb-4 flex items-end space-x-4">
                                <div class="w-full">
                                    <label class="block text-sm font-medium text-gray-700">Select Food Item</label>
                                    <select name="food_items[0][id]"
                                        class="food-item-select mt-1 block w-full border-gray-300 rounded" required>
                                        <option value="">-- Select --</option>
                                        @foreach ($foodItems as $foodItem)
                                            <option value="{{ $foodItem->id }}" data-price="{{ $foodItem->price }}">
                                                {{ $foodItem->name }} — {{ ucfirst($foodItem->size) }} — Rs
                                                {{ number_format($foodItem->price, 2) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="w-24">
                                    <label class="block text-sm font-medium text-gray-700">Quantity</label>
                                    <input type="number" name="food_items[0][quantity]" min="1" value="1"
                                        class="quantity-input mt-1 block w-full border-gray-300 rounded" required>
                                </div>
                                <button type="button"
                                    class="remove-item bg-red-500 text-white px-3 py-1 rounded">Remove</button>
                            </div>
                        </div>

                        <button type="button" id="add-item"
                            class="bg-orange-500 text-white px-4 py-2 rounded mb-4">Add Another Item</button>

                        <div class="mb-4">
                            <h2 class="text-xl font-bold">Total Amount: Rs <span id="total-amount">0.00</span></h2>
                        </div>

                        <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded">Save Order</button>
                        <a href="{{ route('dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded ml-4">
                            Close Order
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let itemIndex = 1;

        document.getElementById('add-item').addEventListener('click', function() {
            const container = document.getElementById('order-items');
            const newItem = document.createElement('div');
            newItem.classList.add('order-item', 'mb-4', 'flex', 'items-end', 'space-x-4');
            newItem.innerHTML = `
                <div class="w-full">
                    <label class="block text-sm font-medium text-gray-700">Select Food Item</label>
                    <select name="food_items[${itemIndex}][id]" class="food-item-select mt-1 block w-full border-gray-300 rounded" required>
                        <option value="">-- Select --</option>
                        @foreach ($foodItems as $foodItem)
                            <option value="{{ $foodItem->id }}" data-price="{{ $foodItem->price }}">
                                {{ $foodItem->name }} — {{ ucfirst($foodItem->size) }} — Rs {{ number_format($foodItem->price, 2) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="w-24">
                    <label class="block text-sm font-medium text-gray-700">Quantity</label>
                    <input type="number" name="food_items[${itemIndex}][quantity]" min="1" value="1" class="quantity-input mt-1 block w-full border-gray-300 rounded" required>
                </div>
                <button type="button" class="remove-item bg-red-500 text-white px-3 py-1 rounded">Remove</button>
            `;
            container.appendChild(newItem);
            itemIndex++;
            updateTotal();
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-item')) {
                e.target.closest('.order-item').remove();
                updateTotal();
            }
        });

        document.addEventListener('change', updateTotal);

        function updateTotal() {
            let total = 0;
            document.querySelectorAll('.order-item').forEach(item => {
                const select = item.querySelector('.food-item-select');
                const quantity = parseInt(item.querySelector('.quantity-input').value) || 0;
                const price = parseFloat(select.options[select.selectedIndex]?.dataset.price || 0);
                total += price * quantity;
            });
            document.getElementById('total-amount').textContent = total.toFixed(2);
        }
    </script>
</x-app-layout>
