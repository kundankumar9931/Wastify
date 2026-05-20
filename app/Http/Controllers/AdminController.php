<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Payment;
use App\Models\Subscription;
use App\Models\Household;
use App\Models\Schedule;

class AdminController extends Controller
{
    /**
     * Admin overview dashboard with stats.
     */
    public function dashboard()
    {
        Log::info('Admin dashboard hit by user: ' . auth()->id());
        $stats = [
            'users'         => User::where('role', 'user')->count(),
            'workers'       => User::where('role', 'worker')->count(),
            'households'    => Household::count(),
            'schedules'     => Schedule::count(),
            'subscriptions' => Subscription::where('status', 'active')->count(),
            'payments'      => Payment::where('status', 'completed')->count(),
        ];
        $recentPayments     = Payment::with('user')->latest()->take(5)->get();
        $recentSubscriptions = Subscription::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentPayments', 'recentSubscriptions'));
    }

    /**
     * List all users (Manage Users page).
     */
    public function index()
    {
        $users = User::all();
        return view('pages.index', compact('users'));
    }

    public function create()
    {
        return view('pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role'     => 'required|in:user,worker,admin',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'role'     => $request->role,
            'phoneNo'  => $request->phoneNo,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('pages.edit', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->except(['password', '_token', '_method']));
        return redirect()->route('admin.users.index')->with('success', 'User updated.');
    }

    public function destroy(string $id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted.');
    }
}
