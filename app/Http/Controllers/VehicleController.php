<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    // Display a listing of vehicles
    public function index()
    {
        return view('vehicles.index', [
            'vehicles' => Vehicle::latest()->paginate(12),
            'totalVehicles' => $this->getTotalVehiclesCount(),
            'vehiclesLast24Hours' => $this->getLast24HoursCount(),
            'vehiclesLast7Days' => $this->getLast7DaysCount(),
            'vehiclesLast31Days' => $this->getLast31DaysCount()
        ]);

    }

    // Show the form for creating a new vehicle
    public function create()
    {
        $clients = Client::all(); // Fetch all clients
        return view('vehicles.create', compact('clients'));
    }

    // Store a newly created vehicle in storage
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'client_id' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'mileage' => 'required|integer',
            'first_registration' => 'required|date',
            'license_plate' => 'required',
            'description' => 'string',
            'vin' => 'required|unique:vehicles'
        ]);

        Vehicle::create($validatedData);
        return redirect()->route('vehicles.index')->with('success', 'Vehicle created successfully.');
    }

    // Display the specified vehicle
    public function show(Vehicle $vehicle)
    {
        $clients = Client::all();
        $orders = $vehicle->orders()->paginate(10);
        return view('vehicles.show', compact('vehicle', 'clients', 'orders'));
    }

    // Show the form for editing the specified vehicle
    public function edit(Vehicle $vehicle)
    {
        $clients = Client::all(); // Assuming you have a Client model
        return view('vehicles.edit', compact('vehicle', 'clients'));
    }

    // Update the specified vehicle in storage
    public function update(Request $request, Vehicle $vehicle)
    {
        $validatedData = $request->validate([
            'client_id' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'mileage' => 'required|integer',
            'first_registration' => 'required|date',
            'license_plate' => 'required',
            'description' => 'string',
            'status' => 'string',
            'vin' => 'required|unique:vehicles,vin,' . $vehicle->id,
        ]);

        $vehicle->update($validatedData);
        return redirect()->route('vehicles.index')->with('success', 'Vehicle updated successfully.');
    }

    // Remove the specified vehicle from storage
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route('vehicles.index')->with('success', 'Vehicle deleted successfully.');
    }

    public function getTotalVehiclesCount()
    {
        return Vehicle::count();
    }

    // Function to get the count of vehicles added in the last 24 hours
    public function getLast24HoursCount()
    {
        $date = Carbon::now()->subDay();
        return Vehicle::where('created_at', '>=', $date)->count();
    }

    // Function to get the count of vehicles added in the last 7 days
    public function getLast7DaysCount()
    {
        $date = Carbon::now()->subDays(7);
        return Vehicle::where('created_at', '>=', $date)->count();
    }

    // Function to get the count of vehicles added in the last 31 days
    public function getLast31DaysCount()
    {
        $date = Carbon::now()->subDays(31);
        return Vehicle::where('created_at', '>=', $date)->count();
    }
}
