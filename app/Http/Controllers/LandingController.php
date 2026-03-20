<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $members = User::where('role', 'member')->get();
        return view('landing', compact('members'));
    }
}