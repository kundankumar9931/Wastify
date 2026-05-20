<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleDashboardsController extends Controller
{
    public function index()
    {
        \Illuminate\Support\Facades\Log::info('RoleDashboardsController hit for user ' . Auth::id() . ' with role: ' . Auth::user()->role);
        $role = Auth::user()->role;

        switch ($role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'worker':
                return redirect()->route('worker.dashboard');
            case 'user':
            default:
                // Differentiate between resident and shopkeeper based on building type
                if (in_array(strtolower(Auth::user()->building_type), ['shop', 'cafe', 'restaurant', 'commercial'])) {
                    return view('shopkeeper.dashboard');
                }
                return view('dashboard');
        }
    }
}
