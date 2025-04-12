<?php

namespace App\Http\Controllers;

use App\Models\FoodItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Display the create order form
    public function create()
    {
        $foodItems = FoodItem::all();
        return view('orders.create', compact('foodItems'));
    }

    // Save the order to the database
    public function store(Request $request)
    {
        $request->validate([
            'food_items' => 'required|array',
            'food_items.*.id' => 'required|exists:food_items,id',
            'food_items.*.quantity' => 'required|integer|min:1',
        ]);

        $totalAmount = 0;
        $order = Order::create(['total_amount' => 0]); // Placeholder total

        foreach ($request->food_items as $item) {
            $foodItem = FoodItem::find($item['id']);
            $price = $foodItem->price;
            $quantity = $item['quantity'];
            $subtotal = $price * $quantity;
            $totalAmount += $subtotal;

            OrderItem::create([
                'order_id' => $order->id,
                'food_item_id' => $foodItem->id,
                'quantity' => $quantity,
                'price' => $price,
            ]);
        }

        $order->update(['total_amount' => $totalAmount]);

        return redirect()->route('orders.show', $order)->with('success', 'Order created successfully.');
    }

    public function index()
    {
        $orders = Order::with('orderItems.foodItem')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(fn($order) => $order->created_at->format('Y-m-d'));
    
        return view('orders.index', compact('orders'));
    }
    

    // Display the order receipt
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    // OrderController.php

public function destroy(Order $order)
{
    // Optionally, if you need to delete related orderItems (if not handled by cascade), do that here.
    $order->delete();

    return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
}

}