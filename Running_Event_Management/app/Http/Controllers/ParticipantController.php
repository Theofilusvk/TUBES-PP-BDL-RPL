<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function index()
    {
        return view('dashboard.participants.index');
    }

    public function show($id)
    {
        return view('dashboard.participants.show');
    }
}
