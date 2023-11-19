<?php

namespace App\Http\Controllers;

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
        return view('dashboard');
    }

    public function calendarData()
    {
        $orders = Order::with('vehicle')->get()->map(function ($order) {
            $vehicleInfo = $order->vehicle ? $order->vehicle->brand . ' ' . $order->vehicle->model : 'No Vehicle';

            return [
                'title' => $order->order_number . ' - ' . $vehicleInfo,
                'start' => $order->estimated_start,
                'end' => $order->estimated_end,
                'url' => route('orders.show', $order->id)
            ];
        });

        return response()->json($orders);
    }
}
