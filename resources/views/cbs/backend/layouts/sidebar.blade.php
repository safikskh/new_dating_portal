<!-- Developed By CBS -->
    <!-- Sidemenu -->
    <div class="main-sidebar main-sidebar-sticky side-menu">
        <div class="sidemenu-logo">
            <a class="main-logo" href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('cbs/backend/img/logo/logo-light.png') }}" class="header-brand-img desktop-logo" alt="logo">
                <img src="{{ asset('cbs/backend/img/logo/icon.png') }}" class="header-brand-img icon-logo" alt="logo">
                <img src="{{ asset('cbs/backend/img/logo/logo-light.png') }}" class="header-brand-img desktop-logo theme-logo" style="height:40px">
                <img src="{{ asset('cbs/backend/img/logo/icon.png') }}" class="header-brand-img icon-logo theme-logo" alt="logo">
            </a>
        </div>
        <div class="main-sidebar-body">
            <ul class="nav">
                <li class="nav-label">Dashboard</li>
                <li class="nav-item" >
                    <a class="nav-link {{ Request::is('admin') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}"><i class="fa fa-desktop"></i><span class="sidemenu-label">Dashboard</span></a>
                </li>
                <li class="nav-label">Administration</li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/users') ? 'active' : '' }}" href="{{ route('users.index') }}"><i class="fa fa-users"></i><span class="sidemenu-label">User</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/announcement') ? 'active' : '' }}" href="{{ route('announcement.index') }}"><i class="fa fa-bullhorn"></i><span class="sidemenu-label">Announcement</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/reported-statuses') ? 'active' : '' }}" href="{{route('reported-status.index')}}"><i class="fa fa-flag"></i><span class="sidemenu-label">Reported Status</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/settings') ? 'active' : '' }}" href="{{route('admin.settings')}}"><i class="fa fa-cog"></i><span class="sidemenu-label">Settings</span></a>
                </li>
                <li class="nav-label">Chat Zone</li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/region') ? 'active' : '' }}" href="{{ route('region.index') }}"><i class="fa fa-globe"></i><span class="sidemenu-label">Region</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/chatroom') ? 'active' : '' }}" href="{{ route('chatroom.index') }}"><i class="fa fa-comments"></i><span class="sidemenu-label">Chatroom</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/promocode') ? 'active' : '' }}" href="{{ route('promocode.index') }}"><i class="fa fa-gift"></i><span class="sidemenu-label">Promo Code</span></a>
                </li>
                <li class="nav-label">Customer zone</li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/customers') ? 'active' : '' }}" href="{{ route('customers.list') }}"><i class="fa fa-users"></i><span class="sidemenu-label">All Members</span></a>
                </li>
            </ul>
        </div>
    </div>
    <!-- End Sidemenu -->
<!-- Developed By CBS -->