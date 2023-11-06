<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
// Show all orders
    public function index()
    {
        $orders = Order::with(['client', 'vehicle'])->latest()->paginate(6);
        return view('orders.index', compact('orders'));
    }

    // Display a single order
    public function show(Order $order)
    {
        $order->load(['client', 'vehicle', 'items']);
        return view('orders.show', compact('order'));
    }

    // Show form to create a new order
    public function create()
    {
        $clients = Client::all();
        $vehicles = Vehicle::all();
        return view('orders.create', compact('clients', 'vehicles'));
    }

    // Store a new order
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'order_number' => 'required|unique:orders,order_number',
            'date' => 'required|date',
            'status' => 'required|string',
            'estimated_start' => 'nullable|date',
            'estimated_end' => 'nullable|date|after_or_equal:estimated_start',
            'client_id' => 'nullable|exists:clients,id',
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'items' => 'required|array',
            'items.*.line_number' => 'required|numeric',
            'items.*.product_code' => 'required',
            'items.*.product_name' => 'required',
            'items.*.quantity' => 'required|numeric',
            'items.*.unit' => 'required',
            'items.*.price_ex_vat' => 'required|numeric',
            'items.*.total_ex_vat' => 'required|numeric',
            'items.*.total_inc_vat' => 'required|numeric',
            'total_ex_vat' => 'required|numeric',
            'vat' => 'required|numeric',
            'total_inc_vat' => 'required|numeric',
        ]);

        $order = Order::create($formFields);
        $order->items()->createMany($request->items);

        return redirect('/orders')->with('message', 'Order created successfully!');
    }

    // Show form to edit an order
    public function edit(Order $order)
    {
        $order->load(['client', 'vehicle', 'items']);
        $clients = Client::all();
        $vehicles = Vehicle::all();
        return view('orders.edit', compact('order', 'clients', 'vehicles'));
    }

    // Update the order
    public function update(Request $request, Order $order)
    {
        if ($order->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'order_number' => 'required|unique:orders,order_number',
            'date' => 'required|date',
            'status' => 'required|string',
            'estimated_start' => 'nullable|date',
            'estimated_end' => 'nullable|date|after_or_equal:estimated_start',
            'client_id' => 'nullable|exists:clients,id',
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'items' => 'required|array',
            'items.*.line_number' => 'required|numeric',
            'items.*.product_code' => 'required',
            'items.*.product_name' => 'required',
            'items.*.quantity' => 'required|numeric',
            'items.*.unit' => 'required',
            'items.*.price_ex_vat' => 'required|numeric',
            'items.*.total_ex_vat' => 'required|numeric',
            'items.*.total_inc_vat' => 'required|numeric',
            'total_ex_vat' => 'required|numeric',
            'vat' => 'required|numeric',
            'total_inc_vat' => 'required|numeric',
        ]);

        $order->update($formFields);

        return back()->with('message', 'Order updated successfully!');
    }

    // Delete an order
    public function destroy(Order $order)
    {
        if ($order->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $order->delete();
        return redirect('/orders')->with('message', 'Order deleted successfully!');
    }
}
