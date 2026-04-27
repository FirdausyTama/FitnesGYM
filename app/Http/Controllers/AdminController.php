<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_members' => User::where('role', 'member')->count(),
            'active_members' => User::where('role', 'member')->count(), // Placeholder logic
            'today_visitors' => 24, // Placeholder
        ];
        
        return view('dashbor.dashboard', compact('stats'));
    }
}
