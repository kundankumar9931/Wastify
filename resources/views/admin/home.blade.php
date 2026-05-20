<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Wastify</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/favicon_io/site.webmanifest">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tracking2.css') }}">
    @include('libraries.styles')
</head>
<body>
    <div class="header">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <input type="submit" value="Logout" class="logout-button">
        </form>
    </div>

<div class="sidebar">
    <button class="sidebar-close" onclick="closeSidebar()" style="margin-bottom: 10px;">
        <i class="fas fa-times"></i>
    </button>
    <h2>Admin Panel</h2>
    
    <ul class="sidebar-menu">
        <li>
            <a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt" style="margin-right:8px;"></i>Dashboard</a>
        </li>
        <li>
            <a href="{{ route('admin.users.index') }}"><i class="fas fa-users" style="margin-right:8px;"></i>Manage Users</a>
        </li>
        <li style="border-top:1px solid rgba(255,255,255,0.1); margin-top:10px; padding-top:10px;">
            <a href="{{ route('admin.payment.index') }}"><i class="fas fa-rupee-sign" style="margin-right:8px;"></i>View Payments</a>
        </li>
        <li>
            <a href="{{ route('admin.subscription.index') }}"><i class="fas fa-tag" style="margin-right:8px;"></i>View Subscriptions</a>
        </li>
        <li>
            <a href="{{ route('admin.schedule.index') }}"><i class="fas fa-calendar-check" style="margin-right:8px;"></i>Scheduled Pickups</a>
        </li>
        <li>
            <a href="{{ route('admin.feedback.index') }}"><i class="fas fa-comment-alt" style="margin-right:8px;"></i>Feedback</a>
        </li>
        <li>
            <a href="{{ route('admin.complaint.index') }}"><i class="fas fa-exclamation-triangle" style="margin-right:8px;"></i>Complaints</a>
        </li>
        <li>
            <a href="{{ route('admin.household.index') }}"><i class="fas fa-home" style="margin-right:8px;"></i>View Households</a>
        </li>
        <li>
            <a href="{{ route('admin.garbage_bin_requests.index') }}"><i class="fas fa-trash" style="margin-right:8px;"></i>Garbage Bin Requests</a>
        </li>
        <li style="border-top:1px solid rgba(255,255,255,0.1); margin-top:10px; padding-top:10px;">
            <a href="{{ route('admin.employees.index') }}"><i class="fas fa-id-badge" style="margin-right:8px;"></i>Employee Registration</a>
        </li>
        <li>
            <a href="{{ route('admin.trucks.index') }}"><i class="fas fa-truck" style="margin-right:8px;"></i>Truck Registration</a>
        </li>
        <li>
            <a href="{{ route('admin.assignments.index') }}"><i class="fas fa-tasks" style="margin-right:8px;"></i>Truck Assignments</a>
        </li>
        <li>
            <a href="{{ route('admin.tracking.index') }}"><i class="fas fa-map-marker-alt" style="margin-right:8px;"></i>Track Trucks</a>
        </li>
    </ul>
</div>

<button class="sidebar-toggle" onclick="toggleSidebar()">☰</button>

    <div class="main-content">
        @if(session('success'))
            <div style="background:#d4edda; color:#155724; padding:10px 20px; border-radius:8px; margin-bottom:15px; border:1px solid #c3e6cb;">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div style="background:#f8d7da; color:#721c24; padding:10px 20px; border-radius:8px; margin-bottom:15px; border:1px solid #f5c6cb;">
                {{ session('error') }}
            </div>
        @endif
        @yield('content')
    </div>
    @include('libraries.scripts')

<script>
    function toggleSidebar() {
        var sidebar = document.querySelector('.sidebar');
        sidebar.classList.toggle('collapsed');
    }

    function closeSidebar() {
        var sidebar = document.querySelector('.sidebar');
        if (sidebar) {
            sidebar.classList.toggle('collapsed');
        }
    }
</script>
</body>
</html>
