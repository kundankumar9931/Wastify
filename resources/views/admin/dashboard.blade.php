@extends('admin.home')

@section('content')
<div style="padding: 10px 30px;">

    {{-- Stats Row --}}
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 30px;">
        <div style="background:#fff; border-radius:12px; padding:25px; box-shadow:0 2px 10px rgba(0,0,0,0.07); border-left: 4px solid #28a745;">
            <div style="font-size:2.2rem; font-weight:700; color:#28a745;">{{ $stats['users'] }}</div>
            <div style="color:#666; margin-top:5px;"><i class="fas fa-users"></i> Total Residents</div>
        </div>
        <div style="background:#fff; border-radius:12px; padding:25px; box-shadow:0 2px 10px rgba(0,0,0,0.07); border-left: 4px solid #007bff;">
            <div style="font-size:2.2rem; font-weight:700; color:#007bff;">{{ $stats['workers'] }}</div>
            <div style="color:#666; margin-top:5px;"><i class="fas fa-hard-hat"></i> Workers</div>
        </div>
        <div style="background:#fff; border-radius:12px; padding:25px; box-shadow:0 2px 10px rgba(0,0,0,0.07); border-left: 4px solid #fd7e14;">
            <div style="font-size:2.2rem; font-weight:700; color:#fd7e14;">{{ $stats['households'] }}</div>
            <div style="color:#666; margin-top:5px;"><i class="fas fa-home"></i> Registered Households</div>
        </div>
        <div style="background:#fff; border-radius:12px; padding:25px; box-shadow:0 2px 10px rgba(0,0,0,0.07); border-left: 4px solid #6f42c1;">
            <div style="font-size:2.2rem; font-weight:700; color:#6f42c1;">{{ $stats['schedules'] }}</div>
            <div style="color:#666; margin-top:5px;"><i class="fas fa-calendar-check"></i> Scheduled Pickups</div>
        </div>
        <div style="background:#fff; border-radius:12px; padding:25px; box-shadow:0 2px 10px rgba(0,0,0,0.07); border-left: 4px solid #17a2b8;">
            <div style="font-size:2.2rem; font-weight:700; color:#17a2b8;">{{ $stats['subscriptions'] }}</div>
            <div style="color:#666; margin-top:5px;"><i class="fas fa-check-circle"></i> Active Subscriptions</div>
        </div>
        <div style="background:#fff; border-radius:12px; padding:25px; box-shadow:0 2px 10px rgba(0,0,0,0.07); border-left: 4px solid #dc3545;">
            <div style="font-size:2.2rem; font-weight:700; color:#dc3545;">{{ $stats['payments'] }}</div>
            <div style="color:#666; margin-top:5px;"><i class="fas fa-rupee-sign"></i> Completed Payments</div>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 25px;">

        {{-- Recent Payments --}}
        <div style="background:#fff; border-radius:12px; padding:25px; box-shadow:0 2px 10px rgba(0,0,0,0.07);">
            <h5 style="margin-bottom:15px; font-weight:700;">Recent Payments</h5>
            <table class="table table-sm">
                <thead><tr>
                    <th>User</th><th>Amount</th><th>Method</th><th>Status</th>
                </tr></thead>
                <tbody>
                    @forelse($recentPayments as $p)
                    <tr>
                        <td>{{ $p->user->name ?? 'N/A' }}</td>
                        <td>₹{{ number_format($p->amount, 0) }}</td>
                        <td>{{ $p->method ?? 'Razorpay' }}</td>
                        <td><span class="badge badge-{{ $p->status=='completed'?'success':'warning' }}">{{ ucfirst($p->status) }}</span></td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center text-muted">No payments yet</td></tr>
                    @endforelse
                </tbody>
            </table>
            <a href="{{ route('admin.payment.index') }}" style="font-size:0.85rem;">View all →</a>
        </div>

        {{-- Recent Subscriptions --}}
        <div style="background:#fff; border-radius:12px; padding:25px; box-shadow:0 2px 10px rgba(0,0,0,0.07);">
            <h5 style="margin-bottom:15px; font-weight:700;">Recent Subscriptions</h5>
            <table class="table table-sm">
                <thead><tr>
                    <th>User</th><th>Plan</th><th>Status</th><th>Until</th>
                </tr></thead>
                <tbody>
                    @forelse($recentSubscriptions as $s)
                    <tr>
                        <td>{{ $s->user->name ?? 'N/A' }}</td>
                        <td>{{ ucfirst($s->plan) }}</td>
                        <td><span class="badge badge-{{ $s->status=='active'?'success':'warning' }}">{{ ucfirst($s->status) }}</span></td>
                        <td style="font-size:0.8rem;">{{ $s->end_date ? \Carbon\Carbon::parse($s->end_date)->format('d M Y') : 'N/A' }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center text-muted">No subscriptions yet</td></tr>
                    @endforelse
                </tbody>
            </table>
            <a href="{{ route('admin.subscription.index') }}" style="font-size:0.85rem;">View all →</a>
        </div>

    </div>
</div>
@endsection
