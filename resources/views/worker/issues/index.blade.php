@extends('layouts.worker')

@section('content')
<div class="container" style="padding: 20px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 style="margin: 0; color: #2c3e50;">Issue Reports</h1>
        <p style="color: #7f8c8d; margin: 0; font-weight: 500;">Report operational problems</p>
    </div>

    <div class="row" style="display: flex; gap: 20px; flex-wrap: wrap;">
        <!-- New Issue Form -->
        <div style="flex: 1 1 300px;">
            <div class="card" style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                <h3 style="margin-top: 0;">Submit New Issue</h3>
                <form action="{{ route('worker.issues.store') }}" method="POST">
                    @csrf
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #555;">Issue Type:</label>
                        <select name="issue_type" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                            <option value="">Select an issue type</option>
                            <option value="Truck Breakdown">Truck Breakdown</option>
                            <option value="Road Blocked / Inaccessible">Road Blocked / Inaccessible</option>
                            <option value="Bin Damaged">Bin Damaged</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #555;">Description:</label>
                        <textarea name="description" rows="4" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;" placeholder="Describe the problem in detail..."></textarea>
                    </div>
                    <button type="submit" style="background: #2e7d32; color: #fff; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; width: 100%;">
                        Submit Report
                    </button>
                </form>
            </div>
        </div>

        <!-- Past Issues List -->
        <div style="flex: 2 1 500px;">
            <div class="card" style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                <h3 style="margin-top: 0;">My Recent Reports</h3>
                
                @if($issues->count() > 0)
                    <div style="display: flex; flex-direction: column; gap: 15px;">
                        @foreach($issues as $issue)
                            <div style="border: 1px solid #eee; padding: 15px; border-radius: 8px; border-left: 4px solid {{ $issue->status == 'Pending' ? '#f39c12' : '#27ae60' }};">
                                <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                    <strong>{{ $issue->issue_type }}</strong>
                                    <span style="font-size: 0.85rem; color: #7f8c8d;">{{ $issue->created_at->format('M d, Y h:i A') }}</span>
                                </div>
                                <p style="margin: 0; color: #555; font-size: 0.95rem;">{{ $issue->description }}</p>
                                <div style="margin-top: 10px; font-size: 0.85rem; font-weight: bold; color: {{ $issue->status == 'Pending' ? '#f39c12' : '#27ae60' }};">
                                    Status: {{ $issue->status }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state" style="text-align: center; padding: 40px 20px;">
                        <i class="fas fa-clipboard-check" style="font-size: 40px; color: #ccc; margin-bottom: 10px;"></i>
                        <p style="color: #7f8c8d;">You haven't reported any issues yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
