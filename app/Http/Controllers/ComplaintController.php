<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;

class ComplaintController extends Controller
{
    public function index()
    {
        $complaints = Complaint::all();
        return view('complaint.index', compact('complaints'));
    }

    public function create()
    {
        return view('complaint.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string',
            'location' => 'required|string',
        ]);

        Complaint::create([
            'user_id' => auth()->id(),
            'description' => $request->description,
            'location' => $request->location,
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Complaint reported successfully. Our team will check the bin shortly.');
    }
}
