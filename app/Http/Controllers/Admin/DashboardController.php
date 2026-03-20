<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Now pointing to the correct location: admin/dashboard.blade.php
        return view('admin.dashboard');
    }
}