<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    // Display a listing of vehicles
    public function index()
    {
        $vehicles = Vehicle::all();
        return view('vehicles.index', compact('vehicles'));
    }

    // Show the form for creating a new vehicle
    public function create()
    {
        return view('vehicles.create');
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
            'vin' => 'required|unique:vehicles'
        ]);

        Vehicle::create($validatedData);
        return redirect()->route('vehicles.index')->with('success', 'Vehicle created successfully.');
    }

    // Display the specified vehicle
    public function show(Vehicle $vehicle)
    {
        return view('vehicles.show', compact('vehicle'));
    }

    // Show the form for editing the specified vehicle
    public function edit(Vehicle $vehicle)
    {
        return view('vehicles.edit', compact('vehicle'));
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
            'vin' => 'required|unique:vehicles,vin,' . $vehicle->id
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
}
