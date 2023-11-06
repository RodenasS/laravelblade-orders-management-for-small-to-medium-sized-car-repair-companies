<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        return view('clients.index', [
            'clients' => Client::latest()->filter(request(['tag', 'search']))->paginate(10)
        ]);

    }

    public function show(Client $client)
    {
        return view('clients.show', [
            'client' => $client
        ]);

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

        return redirect('/')->with('message', 'Client created successfully!');
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

        return back()->with('message', 'Client updated successfully!');
    }

    // Delete Client
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect('/clients')->with('message','Client deleted successfully!');
    }
}
