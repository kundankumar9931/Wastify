@extends('layouts.worker')

@section('content')
<div class="container" style="padding: 20px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 style="margin: 0; color: #2c3e50;">Assigned Routes</h1>
        <p style="color: #7f8c8d; margin: 0; font-weight: 500;">Households scheduled for your trucks</p>
    </div>

    <div class="card" style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
        @if($households->count() > 0)
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
                @foreach($households as $household)
                <div style="border: 1px solid #eaeaea; border-radius: 8px; overflow: hidden; transition: transform 0.2s, box-shadow 0.2s; background: #fafafa;">
                    <div style="background: #2e7d32; color: white; padding: 10px 15px; display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-weight: bold;"><i class="fas fa-home" style="margin-right: 8px;"></i>{{ $household->household_name }}</span>
                        <span style="background: rgba(255,255,255,0.2); padding: 3px 8px; border-radius: 4px; font-size: 0.8rem;">ID: {{ $household->id }}</span>
                    </div>
                    <div style="padding: 15px;">
                        <p style="margin: 0 0 10px 0; color: #555;">
                            <i class="fas fa-map-marker-alt" style="color: #e74c3c; width: 20px; text-align: center;"></i> 
                            {{ $household->location }}
                        </p>
                        <p style="margin: 0; color: #555; font-size: 0.9rem;">
                            <i class="fas fa-truck" style="color: #3498db; width: 20px; text-align: center;"></i> 
                            Assigned to: <strong>{{ $household->truck->name }} ({{ $household->truck->registration_number }})</strong>
                        </p>
                    </div>
                    <div style="border-top: 1px solid #eaeaea; padding: 10px 15px; background: #fff; text-align: right;">
                        @if($household->collected_today)
                            <button disabled style="background: #27ae60; color: white; border: none; padding: 5px 15px; border-radius: 4px; font-size: 0.85rem; cursor: default;">
                                <i class="fas fa-check-double" style="margin-right: 5px;"></i> Collected Today
                            </button>
                        @else
                            <form action="{{ route('worker.routes.collect') }}" method="POST" onsubmit="return confirm('Confirm Pickup Collection?\n\nHousehold: {{ $household->household_name }}\nTruck: {{ $household->truck->name }}')">
                                @csrf
                                <input type="hidden" name="household_id" value="{{ $household->id }}">
                                <input type="hidden" name="truck_id" value="{{ $household->truck_id }}">
                                <button type="submit" style="background: #f39c12; color: white; border: none; padding: 5px 15px; border-radius: 4px; cursor: pointer; font-size: 0.85rem;">
                                    <i class="fas fa-check" style="margin-right: 5px;"></i> Mark Collected
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="empty-state" style="text-align: center; padding: 40px 20px;">
                <i class="fas fa-map-marked-alt" style="font-size: 40px; color: #ccc; margin-bottom: 10px;"></i>
                <h3 style="margin-top: 0; color: #555;">No Households Assigned</h3>
                <p style="color: #7f8c8d;">There are currently no households assigned to your trucks. Check back later.</p>
            </div>
        @endif
    </div>
</div>
@endsection
