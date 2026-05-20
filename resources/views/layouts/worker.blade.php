<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Worker Dashboard | Wastify</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/favicon_io/site.webmanifest">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
    
    <!-- Reuse Admin Sidebar core, but add worker specific overrides -->
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/worker.css') }}">
    
    @include('libraries.styles')
    @yield('head')
</head>
<body class="worker-layout">
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
    <h2 class="worker-panel-title"><i class="fas fa-hard-hat" style="margin-right: 10px;"></i>Worker Panel</h2>
    
    <ul class="sidebar-menu">
        <li>
            <a href="{{ route('worker.dashboard') }}" class="{{ request()->routeIs('worker.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt" style="margin-right:8px;"></i>Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('worker.routes.index') }}" class="{{ request()->routeIs('worker.routes.*') ? 'active' : '' }}">
                <i class="fas fa-route" style="margin-right:8px;"></i>Assigned Routes
            </a>
        </li>
        <li>
            <a href="{{ route('worker.tracking.index') }}" class="{{ request()->routeIs('worker.tracking.index') ? 'active' : '' }}">
                <i class="fas fa-map-marked-alt" style="margin-right:8px;"></i>Route Map
            </a>
        </li>
        <li style="border-top:1px solid rgba(255,255,255,0.1); margin-top:10px; padding-top:10px;">
            <a href="#"><i class="fas fa-clipboard-check" style="margin-right:8px;"></i>Pickup Status</a>
        </li>
        <li>
            <a href="{{ route('worker.issues.index') }}" class="{{ request()->routeIs('worker.issues.*') ? 'active' : '' }}">
                <i class="fas fa-exclamation-triangle" style="margin-right:8px;"></i>Issue Reports
            </a>
        </li>
        <li>
            <a href="{{ route('worker.profile.index') }}" class="{{ request()->routeIs('worker.profile.*') ? 'active' : '' }}">
                <i class="fas fa-user-circle" style="margin-right:8px;"></i>My Profile
            </a>
        </li>
    </ul>
</div>

<button class="sidebar-toggle" onclick="toggleSidebar()">☰</button>

    <div class="main-content">
        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert-error">
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
