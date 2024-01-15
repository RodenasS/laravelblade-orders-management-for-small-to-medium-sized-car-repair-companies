<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = Vehicle::query();

        if ($request->filled('make')) {
            $query->where(function ($subQuery) use ($request) {
                $subQuery->where('brand', 'like', '%' . $request->input('make') . '%')
                    ->orWhere('model', 'like', '%' . $request->input('make') . '%');
            });
        }

        if ($request->filled('number_plate')) {
            $query->where('license_plate', 'like', '%' . $request->input('number_plate') . '%');
        }

        if ($request->filled('client_name')) {
            $query->whereHas('client', function ($subQuery) use ($request) {
                $subQuery->where('name', 'like', '%' . $request->input('client_name') . '%');
            });
        }

        if ($request->filled('vin')) {
            $query->where('vin', 'like', '%' . $request->input('vin') . '%');
        }

        $vehicles = $query->latest()->paginate(12);

        return view('vehicles.index', [
            'vehicles' => $vehicles,
            'totalVehicles' => $this->getTotalVehiclesCount(),
            'vehiclesLast24Hours' => $this->getLast24HoursCount(),
            'vehiclesLast7Days' => $this->getLast7DaysCount(),
            'vehiclesLast31Days' => $this->getLast31DaysCount()
        ]);
    }

    public function create()
    {
        $clients = Client::all();
        return view('vehicles.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'client_id' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'first_registration' => 'required|date',
            'license_plate' => 'required',
            'description' => 'string',
            'vin' => 'required|unique:vehicles'
        ]);

        $vehicle = Vehicle::create($validatedData);
        $licensePlate = $vehicle->license_plate;
        return redirect()->route('vehicles.index')->with('message', "Sėkmingai pridėjote automobilio <strong>$licensePlate</strong> informaciją!");
    }

    public function show(Vehicle $vehicle)
    {
        $clients = Client::all();
        $orders = $vehicle->orders()->paginate(10);
        return view('vehicles.show', compact('vehicle', 'clients', 'orders'));
    }

    public function edit(Vehicle $vehicle)
    {
        $clients = Client::all();
        return view('vehicles.edit', compact('vehicle', 'clients'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $validatedData = $request->validate([
            'client_id' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'first_registration' => 'required|date',
            'license_plate' => 'required',
            'description' => 'string',
            'status' => 'string',
            'vin' => 'required|unique:vehicles,vin,' . $vehicle->id,
        ]);

        $vehicle->update($validatedData);
        $licensePlate = $vehicle->license_plate;
        return redirect()->route('vehicles.index')->with('message', "Sėkmingai atnaujinote automobilio <strong>$licensePlate</strong> informaciją!");
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        $licensePlate = $vehicle->license_plate;
        return redirect()->route('vehicles.index')->with('message', "Sėkmingai ištrynėte automobilio <strong>$licensePlate</strong> informaciją!");
    }

    public function getTotalVehiclesCount()
    {
        return Vehicle::count();
    }

    public function getLast24HoursCount()
    {
        $date = Carbon::now()->subDay();
        return Vehicle::where('created_at', '>=', $date)->count();
    }

    public function getLast7DaysCount()
    {
        $date = Carbon::now()->subDays(7);
        return Vehicle::where('created_at', '>=', $date)->count();
    }

    public function getLast31DaysCount()
    {
        $date = Carbon::now()->subDays(31);
        return Vehicle::where('created_at', '>=', $date)->count();
    }
}
