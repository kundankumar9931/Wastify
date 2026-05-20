@extends('layouts.worker')

@section('content')
<div class="container" style="padding: 20px;">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 style="margin: 0; color: #2c3e50;">Collector Overview</h1>
        <p style="color: #7f8c8d; margin: 0; font-weight: 500;">Welcome back, {{ auth()->user()->name }}</p>
    </div>

    <!-- Summary Cards -->
    <div class="summary-cards">
        <div class="summary-card">
            <div class="summary-icon">
                <i class="fas fa-truck"></i>
            </div>
            <div class="summary-details">
                <h3>{{ isset($assignedTrucks) ? $assignedTrucks->count() : 0 }}</h3>
                <p>Assigned Trucks</p>
            </div>
        </div>
        
        <div class="summary-card">
            <div class="summary-icon" style="background:#e3f2fd; color:#1976d2;">
                <i class="fas fa-route"></i>
            </div>
            <div class="summary-details">
                <h3>{{ $assignedHouseholdsCount }}</h3>
                <p>Today's Routes</p>
            </div>
        </div>
        
        <div class="summary-card">
            <div class="summary-icon" style="background:#fff3e0; color:#f57c00;">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="summary-details">
                <h3>{{ $completedStopsCount }}</h3>
                <p>Completed Stops</p>
            </div>
        </div>
        
        <div class="summary-card">
            <div class="summary-icon" style="background:#ffebee; color:#d32f2f;">
                <i class="fas fa-hourglass-half"></i>
            </div>
            <div class="summary-details">
                <h3>{{ $pendingPickupsCount }}</h3>
                <p>Pending Pickups</p>
            </div>
        </div>
    </div>

    <h2 style="margin-bottom: 20px; color: #34495e; font-size: 1.5rem; padding-bottom:10px; border-bottom: 2px solid #eaeaea;">My Active Assignments</h2>
    
    <div class="task-list">
        @if(isset($assignedTrucks) && $assignedTrucks->count() > 0)
            @foreach($assignedTrucks as $assignment)
            <div class="task-item">
                <div>
                    <div class="task-header">
                        <div class="task-icon">
                            <i class="fas fa-truck-pickup"></i>
                        </div>
                        <div class="task-info">
                            <h3>{{ $assignment->truck->name }}</h3>
                            <p><i class="fas fa-barcode" style="margin-right:5px;"></i> {{ $assignment->truck->registration_number }}</p>
                        </div>
                    </div>
                    <div style="background: #f8f9fa; padding: 10px; border-radius: 6px; font-size: 0.9rem; color: #555;">
                        <strong>Model:</strong> {{ $assignment->truck->model }}<br>
                        <strong>Status:</strong> <span style="color: #28a745; font-weight:bold;">Ready for duty</span>
                    </div>
                </div>
                <div class="task-actions">
                    <a href="{{ route('worker.tracking.index') }}" style="width: 100%; text-decoration: none;">
                        <button class="status-btn" style="width: 100%;"><i class="fas fa-play" style="margin-right:8px;"></i> Start Route</button>
                    </a>
                </div>
            </div>
            @endforeach
        @else
            <div class="empty-state">
                <i class="fas fa-clipboard-list"></i>
                <h3>No Active Assignments</h3>
                <p>No active assignments yet. Please contact your supervisor.</p>
            </div>
        @endif
    </div>

    <!-- Map Shortcut Card -->
    <div class="card" style="margin-top: 40px; width: 100%; background: #fff; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); overflow: hidden;">
        <img src="/Images/tracking.jpg" alt="My Route Map" style="height: 200px; width: 100%; object-fit: cover;">
        <div style="padding: 20px;">
            <h2 style="margin-top:0;">My Route Map</h2>
            <p style="color: #666; margin-bottom: 20px;">View your optimized navigation path for the Law Gate area and track your active progress.</p>
            <a href="{{ route('worker.tracking.index') }}" style="text-decoration:none;">
                <button style="background: #2e7d32; padding: 12px 20px; font-size:16px; color:white; border:none; border-radius:5px; cursor:pointer;"><i class="fas fa-map" style="margin-right:8px;"></i> Open Map</button>
            </a>
        </div>
    </div>
</div>
@endsection
