<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt to log the user in using the 'web' guard
        // Note: verify your User model uses 'email' and 'password' columns standardy.
        // If your DB uses 'Email' and 'Password' (capitalized), Laravel might need adjustments in the Model or here.
        // User model shows: fillable ['Email', 'Password']. 
        // Eloquent usually expects 'email' and 'password' for Auth::attempt unless customized.
        // Let's check if we need to map the credentials.
        
        // The User model has 'Email' and 'Password' as fillable, but let's assume standard Auth works if mapped keys match DB columns.
        // However, Auth::attempt expects ['email' => $email, 'password' => $password]. 
        // If the DB column is 'Email', we pass ['Email' => $email, 'password' => $password].
        
        // NOTE: The User model showed `protected $fillable = [..., 'Email', 'Password', ...];`
        // Validation:
        $authCredentials = [
            'Email' => $credentials['email'],
            'password' => $credentials['password'] 
        ];

        if (Auth::attempt($authCredentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Redirection Logic
            $email = Auth::user()->Email; 
            
            // Specific Admin Email Check
            if ($email === '2472034@maranatha.ac.id') {
                return redirect()->intended(route('admin.dashboard'));
            }

            return redirect()->intended(route('dashboard'));
        }

        throw ValidationException::withMessages([
            'email' => trans('auth.failed'),
        ]);
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
