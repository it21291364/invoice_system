<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">The Orange Bay — Dashboard</h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold text-orange-600 mb-12 text-center">
                👋 Welcome to The Orange Bay Billing System
            </h1>

            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <a href="{{ route('food_items.index') }}"
                   class="group bg-white shadow-lg rounded-xl p-6 flex flex-col items-center text-center transition transform hover:-translate-y-1 hover:shadow-2xl hover:bg-orange-500 hover:text-white">
                    <div class="text-5xl mb-4">🍽️</div>
                    <h3 class="text-xl font-semibold mb-2 group-hover:text-white">Manage Menu</h3>
                    <p class="text-gray-500 group-hover:text-gray-100">Add, edit & delete food items</p>
                </a>
            
                <a href="{{ route('orders.create') }}"
                   class="group bg-white shadow-lg rounded-xl p-6 flex flex-col items-center text-center transition transform hover:-translate-y-1 hover:shadow-2xl hover:bg-orange-500 hover:text-white">
                    <div class="text-5xl mb-4">🛒</div>
                    <h3 class="text-xl font-semibold mb-2 group-hover:text-white">New Order</h3>
                    <p class="text-gray-500 group-hover:text-gray-100">Create a new customer order</p>
                </a>
            
                <a href="{{ route('orders.index') }}"
                   class="group bg-white shadow-lg rounded-xl p-6 flex flex-col items-center text-center transition transform hover:-translate-y-1 hover:shadow-2xl hover:bg-orange-500 hover:text-white">
                    <div class="text-5xl mb-4">📊</div>
                    <h3 class="text-xl font-semibold mb-2 group-hover:text-white">View Orders</h3>
                    <p class="text-gray-500 group-hover:text-gray-100">See daily sales & order history</p>
                </a>
            </div>
            
        </div>
    </div>
</x-app-layout>
