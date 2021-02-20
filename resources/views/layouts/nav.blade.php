
    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">
      <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
          <ul class="nav navbar-nav d-xl-none">
            <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a></li>
          </ul>
          <h4>Hotel Management System</h4>
        </div>
        <ul class="nav navbar-nav align-items-center ml-auto">
          <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="user-nav d-sm-flex d-none"><span class="user-name font-weight-bolder">{{ session('full_name') }}</span><span class="user-status">Admin</span></div><span class="avatar"><img class="round" src="{{ asset('dashboard/app-assets/images/portrait/small/avatar-s-11.jpg') }}" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
              <a class="dropdown-item" href="{{ route('admin_dashboard') }}"><i class="mr-50" data-feather="command"></i> Dashboard</a>
              <a class="dropdown-item" href="{{ route('admin_logout') }}"><i class="mr-50" data-feather="log-out"></i> Logout</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>

