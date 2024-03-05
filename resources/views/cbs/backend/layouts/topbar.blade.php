<!-- Developed By CBS -->
    <!-- Topbar-->
      <div class="main-header side-header sticky">
          <div class="container-fluid">
              <div class="main-header-left">
                  <a class="main-logo d-lg-none" href="{{ route('admin.dashboard') }}">
                      <img src="{{ asset('cbs/backend/img/logo/logo-light.png') }}" class="header-brand-img desktop-logo" alt="logo">
                      <img src="{{ asset('cbs/backend/img/logo/icon.png') }}" class="header-brand-img icon-logo" alt="logo">
                      <img src="{{ asset('cbs/backend/img/logo/logo-light.png') }}" class="header-brand-img desktop-logo theme-logo"  style="height:40px">
                      <img src="{{ asset('cbs/backend/img/logo/icon.png') }}" class="header-brand-img icon-logo theme-logo" alt="logo">
                  </a>
                  <a class="main-header-menu-icon" href="#" id="mainSidebarToggle"><span></span></a>
              </div>
              <div class="main-header-right">
                  <div class="dropdown d-md-flex">
                        <a style="color:red; border:2px solid red; border-radius:50%; padding: 5px; text-align: center;" class="nav-link icon full-screen-link" href="{{ route('logout') }}"
                              onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fe fe-power"></i>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                        </form>
                  </div>
              </div>
          </div>
      </div>
    <!-- Topbar-->
<!-- Developed By CBS -->