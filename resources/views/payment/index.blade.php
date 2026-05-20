@extends('admin.home')

@section('content')
<div class="container-fluid" style="padding: 20px;">
    <h2 class="mb-4">Payment Transactions</h2>
    
    <div class="card shadow">
        <div class="card-body">
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payment as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <strong>{{ $item->user->name ?? 'N/A' }}</strong><br>
                            <small>{{ $item->user->email ?? 'N/A' }}</small>
                        </td>
                        <td>₹{{ number_format($item->amount, 2) }}</td>
                        <td>{{ $item->method ?? 'Razorpay' }}</td>
                        <td>
                            <span class="badge badge-{{ $item->status == 'completed' ? 'success' : 'warning' }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td>{{ $item->paymentDate ? \Carbon\Carbon::parse($item->paymentDate)->format('d M Y, h:i A') : $item->created_at->format('d M Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @if($payment->isEmpty())
                <p class="text-center mt-4">No payments recorded yet.</p>
            @endif
        </div>
    </div>
</div>
@endsection
