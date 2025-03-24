<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-4">Edit Food Item</h1>
                    <form action="{{ route('food_items.update', $foodItem) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" name="name" id="name" value="{{ $foodItem->name }}" class="mt-1 block w-full border-gray-300 rounded" required>
                            @error('name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="size" class="block text-sm font-medium text-gray-700">Size</label>
                            <select name="size" id="size" class="mt-1 block w-full border-gray-300 rounded" required>
                                <option value="default" {{ $foodItem->size == 'default' ? 'selected' : '' }}>Default</option>
                                <option value="full" {{ $foodItem->size == 'full' ? 'selected' : '' }}>Full</option>
                                <option value="half" {{ $foodItem->size == 'half' ? 'selected' : '' }}>Half</option>
                            </select>
                            @error('size')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                            <input type="number" step="0.01" name="price" id="price" value="{{ $foodItem->price }}" class="mt-1 block w-full border-gray-300 rounded" required>
                            @error('price')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>