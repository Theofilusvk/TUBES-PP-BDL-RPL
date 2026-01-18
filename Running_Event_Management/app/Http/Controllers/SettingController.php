<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        return view('dashboard.settings.index');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'NamaLengkap' => 'required|string|max:255',
            'Username' => 'required|string|max:50|unique:tr_pengguna,Username,' . $user->PenggunaID . ',PenggunaID',
            'Email' => 'required|string|email|max:100|unique:tr_pengguna,Email,' . $user->PenggunaID . ',PenggunaID',
            'NomorTelepon' => 'nullable|string|max:20',
            'Kota' => 'nullable|string|max:100', // Validating City
            'Gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user->NamaLengkap = $request->NamaLengkap;
        $user->Username = $request->Username;
        $user->Email = $request->Email; // Careful with email changes, usually requires verification
        $user->NomorTelepon = $request->NomorTelepon;
        $user->Kota = $request->Kota; // Updating City

        if ($request->hasFile('Gambar')) {
            // Delete old image if exists and not a placeholder (optional)
            if ($user->Gambar && file_exists(public_path($user->Gambar)) && !str_contains($user->Gambar, 'ui-avatars')) {
                // unlink(public_path($user->Gambar)); // Enable if you want to delete old
            }

            $imageName = time() . '.' . $request->Gambar->extension();
            $request->Gambar->move(public_path('uploads/profiles'), $imageName);
            $user->Gambar = '/uploads/profiles/' . $imageName;
        }

        $user->save();

        return redirect()->route('dashboard.settings')->with('success', 'Profile updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->Password)) {
            return back()->withErrors(['current_password' => 'The provided password does not match your current password.']);
        }

        $user->Password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('dashboard.settings')->with('success', 'Password updated successfully!');
    }
}
