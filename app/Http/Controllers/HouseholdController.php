<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Household;
use Illuminate\Support\Facades\Log;
class HouseholdController extends Controller
{
    public function index()
    {
        $household = Household::with('truck')->get();
        $trucks = \App\Models\Truck::all();
        
        return view('household.index', compact('household', 'trucks'));
    }
    public function create()
    {
        return view('household.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'household_name' => 'required|string|max:255',
            'location' => 'required|string',
        ]);

        Household::create([
            'user_id' => auth()->id(), // Assuming user is logged in
            'household_name' => $request->household_name,
            'location' => $request->location,
        ]);

        return redirect()->route('dashboard')->with('success', 'Location registered successfully! You can now schedule pickups.');
    }

    public function assignTruck(Request $request, $id)
    {
        $request->validate([
            'truck_id' => 'required|exists:trucks,id'
        ]);

        $household = Household::findOrFail($id);
        $household->truck_id = $request->truck_id;
        $household->save();

        return back()->with('success', 'Truck assigned to household successfully.');
    }
}
