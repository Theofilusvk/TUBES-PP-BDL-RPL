<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role; // Assuming Role model exists from 'ms_peran'

class AdminUserController extends Controller
{
    public function index()
    {
        // Fetch Users with Role info
        // Assuming 'PeranID' FK relation exists in User model: public function role() { return $this->belongsTo(Role::class, 'PeranID'); }
        // If not defined, we'll join manually or just fetch all.
        
        $users = User::paginate(20); // Basic pagination

        return view('admin.users', [
            'users' => $users
        ]);
    }
}
