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
        $userName = auth()->user()->name;
        $clientController = new ClientController();
        $clientsLast24Hours = $clientController->getLast24HoursCount();
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
            $color = '';
            switch ($order->status) {
                case 'vykdomas':
                    $color = '#EEB76B';
                    break;
                case 'įvykdytas':
                    $color = '#346751';
                    break;
                case 'atšauktas':
                    $color = '#B42B51';
                    break;
            }
            return [
                'title' => $order->order_number . ' - ' . $vehicleInfo,
                'start' => $order->estimated_start,
                'end' => $order->estimated_end,
                'url' => route('orders.show', $order->id),
                'backgroundColor' => $color, // Set background color here
                'extendedProps' => [
                    'status' => $order->status,
                ],
            ];
        });
        return response()->json($orders);
    }
}
