<!-- Sidebar -->
<aside class="col-md-3 nav-sticky dashboard-sidebar">
    <!-- User Info Section -->
    <div class="user-info text-center p-3">
        <img src="{{ asset(Auth::guard('web')->user()->image) }}" alt="User Image" class="rounded-circle mb-2"
            style="width: 80px; height: 80px; object-fit: cover" />
        <h5 class="mb-0" style="color: #ff6f61">{{ Auth::guard('web')->user()->name }}</h5>
    </div>

    <!-- Sidebar Menu -->
    {{-- <div> --}}
        <div class="list-group profile-sidebar-menu">
            <a href="{{ route('frontend.dashboard.profile') }}"
                class="list-group-item list-group-item-action {{ request()->routeIs('frontend.dashboard.profile') ? 'active' : '' }} menu-item"
                data-section="profile">
                <i class="fas fa-user"></i> Profile
            </a>
            <a href="{{ route('frontend.dashboard.notification.index') }}"
                class="list-group-item list-group-item-action {{ request()->routeIs('frontend.dashboard.notification.index') ? 'active' : '' }} menu-item"
                data-section="notifications">
                <i class="fas fa-bell"></i> Notifications
            </a>
            <a href="{{ route('frontend.dashboard.setting') }}"
                class="list-group-item list-group-item-action {{ request()->routeIs('frontend.dashboard.setting') ? 'active' : '' }} menu-item"
                data-section="settings">
                <i class="fas fa-cog"></i> Settings
            </a>
            {{--
        </div> --}}
    </div>
</aside>