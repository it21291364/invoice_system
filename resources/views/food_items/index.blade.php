<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-4">Food Items - The Orange Bay</h1>
                    <a href="{{ route('food_items.create') }}" class="bg-orange-500 text-white px-4 py-2 rounded mb-4 inline-block">Add New Food Item</a>
                    @if (session('success'))
                        <div class="bg-green-100 text-green-700 p-4 mb-4 rounded">
                            {{ session('success') }}
                        </div>
                    @endif
                    <table class="min-w-full border">
                        <thead class="bg-orange-100">
                            <tr>
                                <th class="border px-4 py-2">Name</th>
                                <th class="border px-4 py-2">Size</th>
                                <th class="border px-4 py-2">Price</th>
                                <th class="border px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($foodItems as $foodItem)
                                <tr>
                                    <td class="border px-4 py-2">{{ $foodItem->name }}</td>
                                    <td class="border px-4 py-2">{{ ucfirst($foodItem->size) }}</td>
                                    <td class="border px-4 py-2">Rs {{ number_format($foodItem->price, 2) }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('food_items.edit', $foodItem) }}" class="text-orange-500 hover:underline">Edit</a>
                                        <form action="{{ route('food_items.destroy', $foodItem) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-black hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>