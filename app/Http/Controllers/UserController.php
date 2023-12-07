<?php

namespace App\Http\Controllers;

use App\Models\CompanyInformation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(12);

        return view('users.index', ['users' => $users]);
    }
    public function create() {
        return view('users.register');
    }
    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users','email')],
            'password' => 'required|confirmed|min:6',
            'role' => 'string',
        ]);
        $formFields['password'] = bcrypt($formFields['password']);
        $user = User::create($formFields);
        auth()->login($user);
        return redirect('/')->with('message','User created and logged in!');
    }

    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message',' You have been logged out!');
    }

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

        if (auth()->user()->isAdmin() || auth()->user()->id === $user->id) {
            $rules = [
                'name' => ['required', 'min:3'],
                'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
                'role' => 'string',
                'profile_picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the allowed file types and size
            ];

            if ($request->filled('password')) {
                $rules['password'] = 'required|confirmed|min:6';
            }

            $formFields = $request->validate($rules);

            if ($request->filled('password')) {
                $formFields['password'] = Hash::make($formFields['password']);
            } else {
                unset($formFields['password']);
            }

            if ($request->hasFile('profile_picture')) {
                $uploadedFile = $request->file('profile_picture');
                $path = $uploadedFile->store('profile_pictures', 'public'); // Adjust the storage path as needed
                $formFields['profile_picture'] = $path;
            } elseif ($request->has('remove_profile_picture')) {
                $formFields['profile_picture'] = null;
            }

            $user->update($formFields);

            if ($user->id === auth()->user()->id) {
                return redirect()->route('profile.edit')->with('message', 'Profile updated successfully!');
            } else {
                return redirect('/adminpanel')->with('message', 'Profile updated successfully for another user!');
            }
        } else {
            return redirect('/')->with('error', 'You are not authorized to update this profile.');
        }
    }

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
            $profilePictureUrl = $defaultProfilePicture;
        }

        return response()->json(['profile_picture_url' => $profilePictureUrl]);
    }

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

    public function showForgotPasswordForm()
    {
        return view('users.email');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $newPassword = Str::random(10);

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($newPassword);
        $user->save();
        $companyInformation = CompanyInformation::first();

        Mail::send('emails.password_reset', [
            'user' => $user,
            'newPassword' => $newPassword,
            'companyInformation' => $companyInformation,
        ], function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Slaptažodžio atstatymas')
                ->from(config('mail.from.address'), config('mail.from.name'));
        });


        return redirect('/login')->with('success', 'Your password has been reset. Check your email for the new password.');
    }
}
