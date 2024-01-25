<ul class="sidebar navbar-nav">
    <li class="nav-item active">
        <a class="nav-link" href="{{url('/admin')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-tasks"></i>
        <span>Admin Activities</span>
        </a>
        <div class="dropdown-menu bgstyle" aria-labelledby="pagesDropdown">
        <a class="dropdown-item" href="{{ route('users.index') }}">Users</a>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('region.index') }}">
        <i class="fas fa-fw fa-map"></i>
        <span>Region</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('chatroom.index') }}">
        <i class="fas fa-fw fa-users"></i>
        <span>Chatroom</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('promocode.index') }}">
        <i class="fas fa-fw fa-tags"></i>
        <span>Promo Code</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('announcement.index') }}">
        <i class="fas fa-bullhorn"></i>
        <span>Announcement</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('reported-status.index') }}">
        <i class="fas fa-bullhorn"></i>
        <span>Reported Status</span></a>
    </li>
</ul>
