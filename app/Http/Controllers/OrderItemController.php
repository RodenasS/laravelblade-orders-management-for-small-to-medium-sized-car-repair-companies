<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    // Display a listing of the order items
    public function index()
    {
        $orderItems = OrderItem::all();
        return view('orderItems.index', compact('orderItems'));
    }

    // Show the form for creating a new order item
    public function create()
    {
        return view('orderItems.create');
    }

    // Store a newly created order item in storage
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_code' => 'required',
            'product_name' => 'required',
            'quantity' => 'required|numeric',
            'unit' => 'required',
            'unit_price' => 'required|numeric',
            // add other fields as required
        ]);

        OrderItem::create($validatedData);
        return redirect()->route('orderItems.index')->with('success', 'Order item created successfully.');
    }

    // Display the specified order item
    public function show(OrderItem $orderItem)
    {
        return view('orderItems.show', compact('orderItem'));
    }

    // Show the form for editing the specified order item
    public function edit(OrderItem $orderItem)
    {
        return view('orderItems.edit', compact('orderItem'));
    }

    // Update the specified order item in storage
    public function update(Request $request, OrderItem $orderItem)
    {
        $validatedData = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_code' => 'required',
            'product_name' => 'required',
            'quantity' => 'required|numeric',
            'unit_price' => 'required|numeric',
            // add other fields as required
        ]);

        $orderItem->update($validatedData);
        return redirect()->route('orderItems.index')->with('success', 'Order item updated successfully.');
    }

    // Remove the specified order item from storage
    public function destroy(OrderItem $orderItem)
    {
        $orderItem->delete();
        return redirect()->route('orderItems.index')->with('success', 'Order item deleted successfully.');
    }
}
