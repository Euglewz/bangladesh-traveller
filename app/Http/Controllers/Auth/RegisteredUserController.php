<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'string', 'max:20'],
            'dob' => ['required', 'date'],
            'bio' => ['required', 'string', 'min:50'],
            'profilePic' => ['required', 'image', 'max:10240'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $path = $request->file('profilePic')->store('profile-pictures', 'public');

        $user = User::create([
            'name' => $request->firstName.' '.$request->lastName,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'bio' => $request->bio,
            'profile_pic' => $path,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
