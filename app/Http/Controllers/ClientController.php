<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        return view('clients.index', [
            'clients' => Client::latest()->filter(request(['tag', 'search']))->paginate(12),
            'totalClients' => $this->getTotalVehiclesCount(),
            'clientsLast24Hours' => $this->getLast24HoursCount(),
            'clientsLast7Days' => $this->getLast7DaysCount(),
            'clientsLast31Days' => $this->getLast31DaysCount()
        ]);

    }

    public function show(Client $client)
    {
        return view('clients.show', ['client' => $client]);

    }

    // Show Create Form

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => ['required', 'email'],
            'phone' => 'required|numeric',
            'description' => 'required',
        ]);

        Client::create($formFields);

        return redirect('/clients')->with('message', 'Client created successfully!');
    }

    // Create Client Data

    public function create()
    {
        return view('clients.create');
    }

    // Show Edit Form

    public function edit(Client $client)
    {
        return view('clients.edit', ['client'=> $client]);
    }

    public function update(Request $request, Client $client)
    {


        $formFields = $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => ['required', 'email'],
            'phone' => 'required|numeric',
            'description' => 'required',
        ]);

        $client->update($formFields);

        return redirect('/clients')->with('message', 'Client updated successfully!');
    }

    // Delete Client
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect('/clients')->with('message','Client deleted successfully!');
    }
    public function getTotalVehiclesCount()
    {
        return Client::count();
    }

    // Function to get the count of vehicles added in the last 24 hours
    public function getLast24HoursCount()
    {
        $date = Carbon::now()->subDay();
        return Client::where('created_at', '>=', $date)->count();
    }

    // Function to get the count of vehicles added in the last 7 days
    public function getLast7DaysCount()
    {
        $date = Carbon::now()->subDays(7);
        return Client::where('created_at', '>=', $date)->count();
    }

    // Function to get the count of vehicles added in the last 31 days
    public function getLast31DaysCount()
    {
        $date = Carbon::now()->subDays(31);
        return Client::where('created_at', '>=', $date)->count();
    }
}
