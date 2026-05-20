<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Employee;
use App\Models\User;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class WorkerProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $employee = Employee::where('user_id', $user->id)->first();
        
        return view('worker.profile', compact('user', 'employee'));
    }

    public function sendOtp()
    {
        $user = Auth::user();
        
        // Generate a 6 digit OTP
        $otp = rand(100000, 999999);
        
        $user->otp = $otp;
        $user->otp_expires_at = now()->addMinutes(10);
        $user->save();

        Mail::to($user->email)->send(new OtpMail($otp));

        return response()->json(['success' => true, 'message' => 'OTP sent successfully to your email.']);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if ($user->otp == $request->otp && now()->lessThanOrEqualTo($user->otp_expires_at)) {
            $user->password = Hash::make($request->new_password);
            $user->otp = null;
            $user->otp_expires_at = null;
            $user->save();

            return redirect()->route('worker.profile.index')->with('success', 'Password changed successfully!');
        }

        return redirect()->back()->with('error', 'Invalid or expired OTP.');
    }
}
