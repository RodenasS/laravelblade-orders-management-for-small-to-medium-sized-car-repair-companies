<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $query = Client::latest();

        // Apply filters
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('clientCode')) {
            // Extract the numeric part from the client code
            $numericId = intval(substr($request->clientCode, 1));
            $query->where('id', $numericId);
        }
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }
        if ($request->filled('phone')) {
            $query->where('phone', 'like', '%' . $request->phone . '%');
        }

        $clients = $query->paginate(12);

        return view('clients.index', [
            'clients' => $clients,
            'totalClients' => $this->getTotalClientsCount(),
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
            'company_code' => 'required',
            'company_vat_code' => 'required',
            'email' => ['required', 'email'],
            'phone' => 'required|numeric',
            'address' => 'required',
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
            'company_code' => 'required',
            'company_vat_code' => 'required',
            'email' => ['required', 'email'],
            'phone' => 'required|numeric',
            'address' => 'required',
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
    public function getTotalClientsCount()
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
