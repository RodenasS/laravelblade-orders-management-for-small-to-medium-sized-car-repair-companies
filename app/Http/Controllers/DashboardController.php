<?php

namespace App\Http\Controllers;

use App\Http\Controllers\VehicleController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\OrderController;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userName = auth()->user()->name; // Get the name of the authenticated user

        // Create an instance of ClientController
        $clientController = new ClientController();

        // Call the non-static method to get the count of clients created in the last 24 hours
        $clientsLast24Hours = $clientController->getLast24HoursCount();

        // Similarly, create an instance of VehicleController and call the non-static method
        $vehicleController = new VehicleController();
        $vehiclesLast24Hours = $vehicleController->getLast24HoursCount();

        $orderController = new OrderController();
        $ordersLast24Hours = $orderController->getLast24HoursCount();

        $ordersInVykdomasStatus = Order::where('status', 'Vykdomas')->count();

        $orders = Order::where('status', 'Vykdomas')->latest()->paginate(6);

        return view('dashboard', compact('orders', 'ordersLast24Hours', 'clientsLast24Hours', 'vehiclesLast24Hours', 'ordersInVykdomasStatus', 'userName'));
    }

    public function calendarData()
    {
        $orders = Order::with('vehicle')->get()->map(function ($order) {
            $vehicleInfo = $order->vehicle ? $order->vehicle->brand . ' ' . $order->vehicle->model : 'No Vehicle';

            return [
                'title' => $order->order_number . ' - ' . $vehicleInfo,
                'start' => $order->estimated_start,
                'end' => $order->estimated_end,
                'url' => route('orders.show', $order->id),
                'status' => $order->status,
            ];
        });

        return response()->json($orders);
    }
}
