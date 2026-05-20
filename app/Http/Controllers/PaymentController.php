<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\User;
use App\Models\Subscription;
use Illuminate\Support\Facades\Log;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Session;
use Exception;

class PaymentController extends Controller
{
    public function create(Request $request)
    {
        $user = auth()->user();
        $userId = $user->id;
        
        // Prioritize plan/cost from request (passed from Subscribe page)
        $plan = $request->input('plan');
        $cost = $request->input('cost');

        // Fallback to latest subscription if not provided in request
        if (!$plan) {
            $subscription = Subscription::where('user_id', $userId)->latest()->first();
            $plan = $subscription ? $subscription->plan : 'Standard';
            $cost = ($plan === 'monthly') ? 100 : 1099;
        }

        // Get user location details
        $household = $user->households()->first();

        return view('payment.create', compact('user', 'plan', 'cost', 'household'));
    }

    public function processRazorpay(Request $request)
    {
        $input = $request->all();
        $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));

        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if (count($input) && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));
                
                // Save payment to database
                $userId = auth()->id();
                $subscription = Subscription::where('user_id', $userId)->latest()->first();

                Payment::create([
                    'user_id' => $userId,
                    'subscription_id' => $subscription ? $subscription->id : null,
                    'amount' => $payment['amount'] / 100,
                    'paymentDate' => now(),
                    'method' => 'Razorpay',
                    'status' => 'completed'
                ]);

                // Mark subscription as active
                if ($subscription) {
                    $subscription->update(['status' => 'active']);
                }

                return redirect()->route('dashboard')->with('success', 'Payment successful! Your subscription is now active.');

            } catch (Exception $e) {
                return redirect()->back()->with('error', $e->getMessage());
            }
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'subscription' => 'required|numeric',
            'paymentDate' => 'required|date',
            'method' => 'required|string',
        ]);

        $userId = auth()->id();
        $subscription = Subscription::where('user_id', $userId)->latest()->first();

        // If it's a cash payment, we can save it directly
        if ($request->method == 'cash') {
            Payment::create([
                'user_id' => $userId,
                'subscription_id' => $subscription ? $subscription->id : null,
                'amount' => $request->input('subscription'),
                'paymentDate' => $request->input('paymentDate'),
                'method' => 'Cash',
                'status' => 'completed'
            ]);

            // Mark subscription as active
            if ($subscription) {
                $subscription->update(['status' => 'active']);
            }

            return redirect()->route('dashboard')->with('success', 'Payment logged! Your subscription is now active.');
        }

        // For online payment, we would usually redirect to a payment page or initiate Razorpay
        return redirect()->back()->with('info', 'Please use the Razorpay option for online payments.');
    }

    public function index()
    {
        \Illuminate\Support\Facades\Log::info('Admin Payment Index hit');
        $payment = Payment::with('user')->get();
        \Illuminate\Support\Facades\Log::info('Payments found: ' . $payment->count());
        return view('payment.index', compact('payment'));
    }
}