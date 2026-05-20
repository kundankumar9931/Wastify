<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Employee;
use App\Models\EmployeeTruck;
use App\Models\Household;
use Illuminate\Support\Facades\Auth;

use App\Models\CollectionLog;
use Carbon\Carbon;

class WorkerRouteController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $employee = Employee::where('user_id', $user->id)->first();
        
        $households = collect();

        if ($employee) {
            $assignedTruckIds = EmployeeTruck::where('employee_id', $employee->id)->pluck('truck_id');
            
            // Fetch households assigned to these trucks
            $households = Household::with('truck')
                            ->whereIn('truck_id', $assignedTruckIds)
                            ->get();

            // Mark each household if it was collected today
            foreach ($households as $household) {
                $household->collected_today = CollectionLog::where('household_id', $household->id)
                    ->whereDate('collected_at', Carbon::today())
                    ->exists();
            }
        }

        return view('worker.routes.index', compact('households'));
    }

    public function markCollected(Request $request)
    {
        $request->validate([
            'household_id' => 'required|exists:households,id',
            'truck_id' => 'required|exists:trucks,id',
        ]);

        $user = Auth::user();
        $employee = Employee::where('user_id', $user->id)->first();

        if (!$employee) {
            return back()->with('error', 'Employee record not found.');
        }

        // Check if already collected today
        $alreadyCollected = CollectionLog::where('household_id', $request->household_id)
            ->whereDate('collected_at', Carbon::today())
            ->exists();

        if ($alreadyCollected) {
            return back()->with('info', 'This household has already been collected today.');
        }

        CollectionLog::create([
            'household_id' => $request->household_id,
            'truck_id' => $request->truck_id,
            'employee_id' => $employee->id,
            'collected_at' => now(),
        ]);

        return back()->with('success', 'Pickup collection confirmed and logged successfully!');
    }
}
