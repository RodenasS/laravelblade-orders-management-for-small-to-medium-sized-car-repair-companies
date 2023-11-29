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
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }


    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Check if the logged-in user is an admin or is editing their own profile
        if (auth()->user()->isAdmin() || auth()->user()->id === $user->id) {
            $rules = [
                'name' => ['required', 'min:3'],
                'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
                'role' => 'string',
                'profile_picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the allowed file types and size
            ];

            $formFields = $request->validate($rules);

            if ($request->hasFile('profile_picture')) {
                // Handle profile picture update
                $uploadedFile = $request->file('profile_picture');
                $path = $uploadedFile->store('profile_pictures', 'public'); // Adjust the storage path as needed
                $formFields['profile_picture'] = $path;
            } elseif ($request->has('remove_profile_picture')) {
                // Handle profile picture removal
                $formFields['profile_picture'] = null;
            }

            // Update user data
            $user->update($formFields);

            // Check if the updated user is the authenticated user
            if ($user->id === auth()->user()->id) {
                return redirect()->route('profile.edit')->with('message', 'Profile updated successfully!');
            } else {
                return redirect('/adminpanel')->with('message', 'Profile updated successfully for another user!');
            }
        } else {
            return redirect('/')->with('error', 'You are not authorized to update this profile.');
        }
    }


    // Show user details
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function editOwnProfile()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    // Delete user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/adminpanel')->with('message', 'User deleted successfully!');
    }
    public function getUserProfilePicture()
    {
        $user = auth()->user();
        $defaultProfilePicture = asset('assets/default-profile-picture.png');

        if ($user && $user->profile_picture) {
            $profilePictureUrl = asset('storage/' . $user->profile_picture);
        } else {
            // Use the default profile picture URL if the user has no picture
            $profilePictureUrl = $defaultProfilePicture;
        }

        return response()->json(['profile_picture_url' => $profilePictureUrl]);
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
