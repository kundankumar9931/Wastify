@extends('layouts.worker')

@section('content')
<div class="container" style="padding: 20px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 style="margin: 0; color: #2c3e50;">My Profile</h1>
        <p style="color: #7f8c8d; margin: 0; font-weight: 500;">Manage your details and security</p>
    </div>

    <div class="row" style="display: flex; gap: 20px; flex-wrap: wrap;">
        <!-- Employee Details Card -->
        <div style="flex: 1 1 300px;">
            <div class="card" style="background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); text-align: center;">
                <div style="width: 100px; height: 100px; background: #e8f5e9; color: #2e7d32; font-size: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                    <i class="fas fa-user-tie"></i>
                </div>
                <h2 style="margin: 0; color: #333;">{{ $user->name }}</h2>
                <p style="color: #666; font-size: 0.9rem; text-transform: uppercase; font-weight: 600; letter-spacing: 1px; margin-bottom: 20px;">Wastify Worker</p>
                
                <div style="text-align: left; background: #f8f9fa; padding: 15px; border-radius: 8px; margin-top: 20px;">
                    <div style="margin-bottom: 10px; border-bottom: 1px solid #eaeaea; padding-bottom: 10px;">
                        <span style="display:block; font-size:0.8rem; color:#888;">Email Address</span>
                        <strong>{{ $user->email }}</strong>
                    </div>
                    <div style="margin-bottom: 10px; border-bottom: 1px solid #eaeaea; padding-bottom: 10px;">
                        <span style="display:block; font-size:0.8rem; color:#888;">Phone Number</span>
                        <strong>{{ $employee ? $employee->phone : $user->phoneNo }}</strong>
                    </div>
                    <div>
                        <span style="display:block; font-size:0.8rem; color:#888;">Joined Date</span>
                        <strong>{{ $user->created_at->format('M d, Y') }}</strong>
                    </div>
                </div>
            </div>
        </div>

        <!-- Security / Password Change Card -->
        <div style="flex: 1 1 400px;">
            <div class="card" style="background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                <h3 style="margin-top: 0; border-bottom: 2px solid #eaeaea; padding-bottom: 10px;">Security Settings</h3>
                <p style="color: #555;">Need to change your password? Request an OTP to securely update your credentials.</p>

                <div id="otp-status"></div>

                <button id="request-otp-btn" style="background: #34495e; color: #fff; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; margin-bottom: 20px;">
                    <i class="fas fa-envelope" style="margin-right: 8px;"></i> Request OTP via Email
                </button>

                <form id="password-change-form" action="{{ route('worker.profile.changePassword') }}" method="POST" style="display: none; background: #f8f9fa; padding: 20px; border-radius: 8px; border: 1px dashed #ccc;">
                    @csrf
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #555;">Enter 6-digit OTP:</label>
                        <input type="text" name="otp" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 1.2rem; text-align: center; letter-spacing: 5px;" placeholder="------" maxlength="6">
                    </div>
                    
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #555;">New Password:</label>
                        <input type="password" name="new_password" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #555;">Confirm New Password:</label>
                        <input type="password" name="new_password_confirmation" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                    </div>

                    <button type="submit" style="background: #2e7d32; color: #fff; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; width: 100%;">
                        <i class="fas fa-lock" style="margin-right: 8px;"></i> Update Password
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('request-otp-btn').addEventListener('click', function() {
        var btn = this;
        var statusDiv = document.getElementById('otp-status');
        
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin" style="margin-right: 8px;"></i> Sending...';
        
        fetch('{{ route('worker.profile.sendOtp') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                statusDiv.innerHTML = '<div class="alert-success" style="padding: 10px; margin-bottom: 15px;">' + data.message + '</div>';
                document.getElementById('password-change-form').style.display = 'block';
                btn.style.display = 'none';
            } else {
                statusDiv.innerHTML = '<div class="alert-error" style="padding: 10px; margin-bottom: 15px;">Failed to send OTP. Try again.</div>';
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-envelope" style="margin-right: 8px;"></i> Request OTP via Email';
            }
        })
        .catch(error => {
            statusDiv.innerHTML = '<div class="alert-error" style="padding: 10px; margin-bottom: 15px;">An error occurred.</div>';
            btn.disabled = false;
            btn.innerHTML = '<i class="fas fa-envelope" style="margin-right: 8px;"></i> Request OTP via Email';
        });
    });
</script>
@endsection
