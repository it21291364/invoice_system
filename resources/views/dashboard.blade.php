<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            The Orange Bay - Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-4">Welcome to The Orange Bay Billing System</h1>
                    <a href="{{ route('food_items.index') }}" class="bg-orange-500 text-white px-4 py-2 rounded">Manage Food Items</a>
                    <a href="{{ route('orders.create') }}" class="bg-orange-500 text-white px-4 py-2 rounded">Create New Order</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>