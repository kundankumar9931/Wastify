<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtpVerificationController extends Controller
{
    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|string',
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        if ($user->otp === $request->otp && now()->lessThanOrEqualTo($user->otp_expires_at)) {
            $user->email_verified_at = now();
            $user->otp = null;
            $user->otp_expires_at = null;
            $user->save();

            return redirect()->route('dashboard');
        }

        return back()->withErrors(['otp' => 'The provided OTP is invalid or has expired.']);
    }
}
