<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // For now, redirect to events or show a generic dashboard
        return redirect()->route('dashboard.events');
    }
}
