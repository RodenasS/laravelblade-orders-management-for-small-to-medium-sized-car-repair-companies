<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $query = Client::latest();
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('clientCode')) {
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
        $client = Client::create($formFields);
        $clientName = $client->name;
        return redirect('/clients')->with('message', "Sėkmingai sukūrėte naują klientą - <strong>$clientName</strong>!");
    }
    public function create()
    {
        return view('clients.create');
    }
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
        $clientName = $client->name;
        return redirect('/clients')->with('message', "Kliento <strong>$clientName</strong> informacija sėkmingai atnaujinta!");
    }
    public function destroy(Client $client)
    {
        $clientName = $client->name;
        $client->delete();
        return redirect('/clients')->with('message', "Klientas <strong>$clientName</strong> ištrintas sėkmingai!");
    }

    public function getTotalClientsCount()
    {
        return Client::count();
    }
    public function getLast24HoursCount()
    {
        $date = Carbon::now()->subDay();
        return Client::where('created_at', '>=', $date)->count();
    }
    public function getLast7DaysCount()
    {
        $date = Carbon::now()->subDays(7);
        return Client::where('created_at', '>=', $date)->count();
    }
    public function getLast31DaysCount()
    {
        $date = Carbon::now()->subDays(31);
        return Client::where('created_at', '>=', $date)->count();
    }
}
