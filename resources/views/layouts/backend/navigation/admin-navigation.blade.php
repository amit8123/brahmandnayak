<!-- sidebar -->
<aside class="admin-sidebar" id="admin-sidebar">
    <a href="{{ route('admin.dashboard') }}" class="admin-brand">
        <span class="brand-icon"><i class="fas fa-om"></i></span>
        <span>
            <span class="brand-title d-block">BSSSP Mandir</span>
            <span class="brand-sub">Admin Panel</span>
        </span>
    </a>

    <div class="menu-label">Main</div>
    <ul class="admin-menu">
        <li>
            <a class="menu-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-home"></i> Dashboard
            </a>
        </li>
    </ul>

    <div class="menu-label">Website Content</div>
    <ul class="admin-menu">
        <li>
            <a class="menu-link {{ request()->is('admin/slider*') ? 'active' : '' }}" href="{{ route('admin.slider.index') }}">
                <i class="fas fa-images"></i> Home Slider
            </a>
        </li>
        <li>
            <a class="menu-link {{ request()->is('admin/GalleryCategory*') ? 'active' : '' }}" href="{{ route('admin.GalleryCategory.index') }}">
                <i class="fas fa-folder-open"></i> Gallery Category
            </a>
        </li>
        <li>
            <a class="menu-link {{ request()->is('admin/gallery*') ? 'active' : '' }}" href="{{ route('admin.gallery.index') }}">
                <i class="fas fa-camera"></i> Photo Gallery
            </a>
        </li>
        <li>
            <a class="menu-link {{ request()->is('admin/upkram*') ? 'active' : '' }}" href="{{ route('admin.upkram.index') }}">
                <i class="fas fa-calendar-alt"></i> Upkram (Events)
            </a>
        </li>
    </ul>

    <div class="menu-label">People</div>
    <ul class="admin-menu">
        <li>
            <a class="menu-link {{ request()->is('admin/trusty*') ? 'active' : '' }}" href="{{ route('admin.trusty.index') }}">
                <i class="fas fa-users"></i> Trustees
            </a>
        </li>
        <li>
            <a class="menu-link {{ request()->is('admin/manager*') ? 'active' : '' }}" href="{{ route('admin.manager.index') }}">
                <i class="fas fa-user-tie"></i> Managers
            </a>
        </li>
    </ul>

    <div class="menu-label">Donations &amp; Messages</div>
    <ul class="admin-menu">
        <li>
            <a class="menu-link {{ request()->is('admin/donorList*') ? 'active' : '' }}" href="{{ route('admin.donorList.index') }}">
                <i class="fas fa-hand-holding-heart"></i> Donor List
            </a>
        </li>
        <li>
            <a class="menu-link {{ request()->is('admin/feedback*') ? 'active' : '' }}" href="{{ route('admin.feedback.index') }}">
                <i class="fas fa-comments"></i> Feedback / Enquiries
            </a>
        </li>
    </ul>

    <div class="menu-label">Other</div>
    <ul class="admin-menu">
        <li>
            <a class="menu-link" href="{{ route('home') }}" target="_blank">
                <i class="fas fa-globe"></i> View Website
            </a>
        </li>
        <li>
            <a class="menu-link" href="{{ route('logout') }}">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </li>
    </ul>
</aside>
<!-- /sidebar -->

<!-- main wrapper opens here, closed in master -->
<div class="admin-main">
<!-- topbar -->
<header class="admin-topbar">
    <button type="button" class="sidebar-toggle" id="sidebar-toggle" aria-label="Menu"><i class="fas fa-bars"></i></button>
    <h2 class="page-heading">@yield('sub-title', 'Dashboard')</h2>
    <div class="topbar-right">
        <div class="user-chip">
            <span class="avatar">{{ strtoupper(mb_substr(Auth::user()->name, 0, 1)) }}</span>
            <span class="user-text">
                <span class="user-name d-block">{{ Auth::user()->name }}</span>
                <span class="user-role">{{ ucfirst(Auth::user()->role) }}</span>
            </span>
        </div>
        <a class="btn-topbar" href="{{ route('home') }}" target="_blank"><i class="fas fa-globe"></i> <span class="btn-text">Website</span></a>
        <a class="btn-topbar logout" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> <span class="btn-text">Logout</span></a>
    </div>
</header>
<!-- /topbar -->
<div class="admin-content">
