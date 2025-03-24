<?php

namespace App\Http\Controllers;

use App\Models\FoodItem;
use Illuminate\Http\Request;

class FoodItemController extends Controller
{
    // Display all food items
    public function index()
    {
        $foodItems = FoodItem::all();
        return view('food_items.index', compact('foodItems'));
    }

    // Show the form to create a new food item
    public function create()
    {
        return view('food_items.create');
    }

    // Store a new food item
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'size' => 'required|in:default,full,half',
            'price' => 'required|numeric|min:0',
        ]);

        FoodItem::create($validated);

        return redirect()->route('food_items.index')->with('success', 'Food item added successfully.');
    }

    // Show the form to edit a food item
    public function edit(FoodItem $foodItem)
    {
        return view('food_items.edit', compact('foodItem'));
    }

    // Update a food item
    public function update(Request $request, FoodItem $foodItem)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'size' => 'required|in:default,full,half',
            'price' => 'required|numeric|min:0',
        ]);

        $foodItem->update($validated);

        return redirect()->route('food_items.index')->with('success', 'Food item updated successfully.');
    }

    // Delete a food item
    public function destroy(FoodItem $foodItem)
    {
        $foodItem->delete();
        return redirect()->route('food_items.index')->with('success', 'Food item deleted successfully.');
    }
}