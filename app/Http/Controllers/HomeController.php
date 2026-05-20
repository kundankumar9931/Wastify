<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        \Illuminate\Support\Facades\Log::info('HomeController hit for user ' . auth()->id());
        return redirect()->route('dashboard');
    }
}
