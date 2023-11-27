<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Pagination\Paginator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(12);

        return view('users.index', ['users' => $users]);
    }

    // Show register/create form
    public function create() {
        return view('users.register');
    }
    // Create new user
    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users','email')],
            'password' => 'required|confirmed|min:6',
            'role' => 'string',
        ]);
        // HASH Password
       // $formFields['password'] = bcrypt($formFields['password']);

        //Create User
        $user = User::create($formFields);

        // Login
        auth()->login($user);

        return redirect('/')->with('message','User created and logged in!');
    }

    // Logout
    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message',' You have been logged out!');
    }

    // Show login form
    public function login() {
        return view('users.login');
    }
    public function edit()
    {
        $user = auth()->user();
        return view('users.edit', compact('user'));
    }


    // Update user information
    public function update(Request $request)
    {
        $user = auth()->user();

        $rules = [
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'role' => 'string',
        ];

        // Check if a password input is provided
        if ($request->filled('password')) {
            $rules['password'] = ['nullable', 'confirmed', 'min:6'];
        }

        $formFields = $request->validate($rules);

        // Update user data except for the password if it's not provided
        if (!$request->filled('password')) {
            unset($formFields['password']);
        }

        // Update user data
        $user->update($formFields);

        return redirect()->route('profile.edit')->with('message', 'Profile updated successfully!');
    }


    // Show user details
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function viewProfile()
    {
        $user = auth()->user();
        return view('users.show', compact('user'));
    }

    // Delete user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/adminpanel')->with('message', 'User deleted successfully!');
    }

    // Authenticate user
    public function authenticate(Request $request) {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields)) {
            $request->session()->regenerate();
            return redirect('/')->with('message','You are now logged in!');
        };
        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }

}
