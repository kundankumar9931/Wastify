<?php
namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::all();
        return view('schedule.index', compact('schedules'));
    }

    public function create()
    {
        return view('schedule.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pickup_date' => 'required|date',
        ]);

        // Fetch the first registered household for the logged-in user
        $household = \App\Models\Household::where('user_id', auth()->id())->first();
        
        \Illuminate\Support\Facades\Log::info('Scheduling attempt by user: ' . auth()->id());
        \Illuminate\Support\Facades\Log::info('Household found by explicit query: ' . ($household ? $household->id : 'NONE'));

        if (!$household) {
            return redirect()->route('household.create')->with('error', 'Please register your PG/House location first before scheduling a pickup.');
        }

        // Create a new schedule
        Schedule::create([
            'household_id' => $household->id,
            'pickup_date' => $request->pickup_date,
        ]);

        return redirect()->route('dashboard')->with('success', 'Pickup scheduled successfully!');
    }

}
