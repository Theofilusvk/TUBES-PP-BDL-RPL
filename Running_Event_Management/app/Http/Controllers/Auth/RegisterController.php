<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:tr_pengguna,Email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        // Generate a username from the name or email (since it's required by DB but not in form)
        // Simple logic: lowercase name + random number
        $username = strtolower(str_replace(' ', '', $request->name)) . rand(100, 999);

        // Create the user
        // PeranID 4 = Participant (based on DummyDataSeeder)
        $user = User::create([
            'NamaLengkap' => $request->name,
            'Username' => $username, 
            'Email' => $request->email,
            'Password' => Hash::make($request->password),
            'PeranID' => 4, 
        ]);

        // Auto-login
        Auth::login($user);

        // Redirect to dashboard
        return redirect()->intended(route('dashboard'));
    }
}
