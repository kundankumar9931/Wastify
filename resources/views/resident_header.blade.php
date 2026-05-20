<header class="header">
    <div class="logo">
        <a href="{{ route('dashboard') }}">Wastify</a>
    </div>
    
    <nav class="nav">
        @unless(request()->routeIs('dashboard'))
            <a href="javascript:history.back()" class="back-link">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        @endunless
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Home</a>
        <a href="{{ route('user.schedule.create') }}" class="{{ request()->routeIs('user.schedule.create') ? 'active' : '' }}">Scheduling</a>
        <a href="{{ route('subscription.create') }}" class="{{ request()->routeIs('subscription.create') ? 'active' : '' }}">Subscribe</a>
        <a href="{{ route('payment.create') }}" class="{{ request()->routeIs('payment.create') ? 'active' : '' }}">Payment</a>
        <a href="{{ route('feedback.create') }}" class="{{ request()->routeIs('feedback.create') ? 'active' : '' }}">Feedback</a>
        <a href="{{ route('tracking.index') }}" class="{{ request()->routeIs('tracking.index') ? 'active' : '' }}">Tracking</a>
    </nav>

    <div class="right-buttons">
        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
            @csrf
            <button type="submit" class="logout-button">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
        <button class="menu-button" onclick="toggleDropdownMenu()">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <div class="dropdown-menu">
        <a href="{{ route('dashboard') }}">Home</a>
        <a href="{{ route('user.schedule.create') }}">Scheduling</a>
        <a href="{{ route('subscription.create') }}">Subscribe</a>
        <a href="{{ route('payment.create') }}">Payment</a>
        <a href="{{ route('feedback.create') }}">Feedback</a>
        <a href="{{ route('tracking.index') }}">Tracking</a>
    </div>
</header>

<style>
    /* Ensure header stays on top and is properly styled */
    .header {
        z-index: 9999;
        height: 80px; /* Set fixed height */
        top: 0;
        left: 0;
    }
    .nav {
        display: flex;
        align-items: center;
    }
    .nav a.active {
        color: var(--primary, #28a745) !important;
        font-weight: 600;
    }
    .back-link {
        margin-right: 20px;
        color: #666 !important;
        font-weight: normal !important;
        font-size: 1.5rem;
    }
    .logout-button {
        background: none;
        border: none;
        color: black;
        font-size: 1.5rem;
        cursor: pointer;
        padding: 5px 10px;
        margin-right: 10px;
    }
    .logout-button:hover {
        color: black !important;
        background: none !important;
    }
</style>
