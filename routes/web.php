<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\HouseholdController;
use App\Http\Controllers\GarbageBinRequestController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\TruckController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\OtpVerificationController;

Route::post('/email/verify/otp', [OtpVerificationController::class, 'verify'])
    ->middleware(['auth'])
    ->name('otp.verify');

Route::get('/', function () {
    return view('homepage');
});

Route::get('/homepage', function () {
    return view('homepage');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\RoleDashboardsController::class, 'index'])->name('dashboard');
});

Route::get('auth/google', [GoogleController::class, 'googlepage']);
Route::get('auth/google/callback', [GoogleController::class, 'googlecallback']);
Route::get('/home', [HomeController::class, 'index']);

// ─── User-facing routes (auth required) ───────────────────────────────────────
Route::middleware(['auth'])->group(function () {

    // Schedule routes (user)
    Route::get('/schedule', [ScheduleController::class, 'create'])->name('user.schedule.create');
    Route::post('/schedule', [ScheduleController::class, 'store'])->name('user.schedule.store');

    // Complaint routes (user)
    Route::get('/complaint/create', [ComplaintController::class, 'create'])->name('complaint.create');
    Route::post('/complaint', [ComplaintController::class, 'store'])->name('complaint.store');

    // Feedback routes (user)
    Route::get('/feedback/create', [FeedbackController::class, 'create'])->name('feedback.create');
    Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

    // Household routes (user)
    Route::get('/household/create', [HouseholdController::class, 'create'])->name('household.create');
    Route::post('/household', [HouseholdController::class, 'store'])->name('household.store');

    // Garbage Bin Request routes (user)
    Route::get('/garbage_bin_requests', [GarbageBinRequestController::class, 'index'])->name('garbage_bin_requests.index');
    Route::get('/garbage_bin_requests/create', [GarbageBinRequestController::class, 'create'])->name('garbage_bin_requests.create');
    Route::post('/garbage_bin_requests', [GarbageBinRequestController::class, 'store'])->name('garbage_bin_requests.store');

    // Payment routes (user)
    Route::get('/payment/create', [PaymentController::class, 'create'])->name('payment.create');
    Route::post('/payment', [PaymentController::class, 'store'])->name('payment.store');
    Route::get('/payment/confirmation', [PaymentController::class, 'confirmation'])->name('payment.confirmation');
    Route::post('/payment/razorpay', [PaymentController::class, 'processRazorpay'])->name('payment.razorpay');

    // Subscription routes (user)
    Route::get('/subscription/create', [SubscriptionController::class, 'create'])->name('subscription.create');
    Route::post('/subscription', [SubscriptionController::class, 'store'])->name('subscription.store');
});

// ─── Admin routes ─────────────────────────────────────────────────────────────
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Manage Users (resource gives: users.index, users.create, users.store, users.edit, users.update, users.destroy)
    Route::resource('users', AdminController::class)->except(['show']);

    // Payments
    Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');

    // Subscriptions
    Route::get('/subscription', [SubscriptionController::class, 'index'])->name('subscription.index');

    // Schedules
    Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule.index');

    // Feedback
    Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');

    // Households
    Route::get('/household', [HouseholdController::class, 'index'])->name('household.index');
    Route::post('/household/{id}/assign-truck', [HouseholdController::class, 'assignTruck'])->name('household.assign_truck');

    // Complaints
    Route::get('/complaints', [ComplaintController::class, 'index'])->name('complaint.index');

    // Garbage bin requests
    Route::get('/garbage_bin_requests', [GarbageBinRequestController::class, 'index'])->name('garbage_bin_requests.index');

    // Tracking
    Route::get('/tracking', [TruckController::class, 'tracking'])->name('tracking.index');

    // Employees (CRUD)
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/employees/{id}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::put('/employees/{id}', [EmployeeController::class, 'update'])->name('employees.update');
    Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');

    // Trucks (CRUD)
    Route::get('/trucks', [TruckController::class, 'index'])->name('trucks.index');
    Route::get('/trucks/create', [TruckController::class, 'create'])->name('trucks.create');
    Route::post('/trucks', [TruckController::class, 'store'])->name('trucks.store');
    Route::get('/trucks/{id}/edit', [TruckController::class, 'edit'])->name('trucks.edit');
    Route::put('/trucks/{id}', [TruckController::class, 'update'])->name('trucks.update');
    Route::delete('/trucks/{id}', [TruckController::class, 'destroy'])->name('trucks.destroy');

    // Assignments (CRUD)
    Route::get('/assignments', [AssignmentController::class, 'index'])->name('assignments.index');
    Route::get('/assignments/create', [AssignmentController::class, 'create'])->name('assignments.create');
    Route::post('/assignments', [AssignmentController::class, 'store'])->name('assignments.store');
    Route::delete('/assignments/{id}', [AssignmentController::class, 'destroy'])->name('assignments.destroy');
});

// ─── Worker routes ─────────────────────────────────────────────────────────────
Route::middleware(['auth', 'worker'])->prefix('worker')->name('worker.')->group(function () {
    Route::get('/dashboard', function () {
        // Fetch the employee record for the logged-in worker
        $employee = \App\Models\Employee::where('user_id', auth()->user()->id)->first();
        
        $assignedTrucks = collect();
        $assignedHouseholdsCount = 0;
        $completedStopsCount = 0;
        
        if ($employee) {
            // Fetch the assigned trucks for this employee
            $assignedTrucks = \App\Models\EmployeeTruck::with('truck')
                                ->where('employee_id', $employee->id)
                                ->get();
                                
            $truckIds = $assignedTrucks->pluck('truck_id');
            $assignedHouseholdsCount = \App\Models\Household::whereIn('truck_id', $truckIds)->count();
            
            // Count collections performed today by this worker
            $completedStopsCount = \App\Models\CollectionLog::where('employee_id', $employee->id)
                                    ->whereDate('collected_at', \Carbon\Carbon::today())
                                    ->count();
        }

        // Real pending pickups = Total Assigned - Completed Today
        $pendingPickupsCount = max(0, $assignedHouseholdsCount - $completedStopsCount);

        return view('collector.dashboard', compact('assignedTrucks', 'assignedHouseholdsCount', 'completedStopsCount', 'pendingPickupsCount'));
    })->name('dashboard');

    Route::get('/tracking', function () {
        return view('tracking.worker');
    })->name('tracking.index');

    Route::post('/routes/collect', [\App\Http\Controllers\WorkerRouteController::class, 'markCollected'])->name('routes.collect');

    Route::get('/assignments', [AssignmentController::class, 'index'])->name('assignments.index');
    Route::post('/assignments', [AssignmentController::class, 'store'])->name('assignments.store');
    Route::delete('/assignments/{id}', [AssignmentController::class, 'destroy'])->name('assignments.destroy');

    Route::get('/trucks', [TruckController::class, 'index'])->name('trucks.index');
    Route::post('/trucks', [TruckController::class, 'store'])->name('trucks.store');
    Route::get('/trucks/{id}/edit', [TruckController::class, 'edit'])->name('trucks.edit');
    Route::put('/trucks/{id}', [TruckController::class, 'update'])->name('trucks.update');
    Route::delete('/trucks/{id}', [TruckController::class, 'destroy'])->name('trucks.destroy');

    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/employees/{id}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::put('/employees/{id}', [EmployeeController::class, 'update'])->name('employees.update');
    Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');

    // Worker Issues
    Route::get('/issues', [\App\Http\Controllers\WorkerIssueController::class, 'index'])->name('issues.index');
    Route::post('/issues', [\App\Http\Controllers\WorkerIssueController::class, 'store'])->name('issues.store');

    // Worker Profile & Password Change
    Route::get('/profile', [\App\Http\Controllers\WorkerProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/send-otp', [\App\Http\Controllers\WorkerProfileController::class, 'sendOtp'])->name('profile.sendOtp');
    Route::post('/profile/change-password', [\App\Http\Controllers\WorkerProfileController::class, 'changePassword'])->name('profile.changePassword');

    // Worker Assigned Routes
    Route::get('/routes', [\App\Http\Controllers\WorkerRouteController::class, 'index'])->name('routes.index');
});

// ─── Public routes ─────────────────────────────────────────────────────────────
Route::get('/tracking', [TrackingController::class, 'index'])->name('tracking.index');

Route::get('/stripe/{cost}', [StripePaymentController::class, 'stripe'])->name('stripe');
Route::post('/stripe', [StripePaymentController::class, 'stripePost'])->name('stripe.post');