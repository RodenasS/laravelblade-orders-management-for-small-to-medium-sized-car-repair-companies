<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $orderItems = OrderItem::all();
        return view('orderItems.index', compact('orderItems'));
    }
    public function create()
    {
        return view('orderItems.create');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_code' => 'required',
            'product_name' => 'required',
            'quantity' => 'required|numeric',
            'unit' => 'required',
            'unit_price' => 'required|numeric',
        ]);
        OrderItem::create($validatedData);
        return redirect()->route('orderItems.index')->with('success', 'Order item created successfully.');
    }
    public function show(OrderItem $orderItem)
    {
        return view('orderItems.show', compact('orderItem'));
    }
    public function edit(OrderItem $orderItem)
    {
        return view('orderItems.edit', compact('orderItem'));
    }
    public function update(Request $request, OrderItem $orderItem)
    {
        $validatedData = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_code' => 'required',
            'product_name' => 'required',
            'quantity' => 'required|numeric',
            'unit_price' => 'required|numeric',
        ]);
        $orderItem->update($validatedData);
        return redirect()->route('orderItems.index')->with('success', 'Order item updated successfully.');
    }
    public function destroy(OrderItem $orderItem)
    {
        $orderItem->delete();
        return redirect()->route('orderItems.index')->with('success', 'Order item deleted successfully.');
    }
}
