

    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item mr-auto"><a class="navbar-brand" href="{{ route('admin_dashboard') }}">
            <div class="brand-logo">
            </div>
          </li>
          <li class="nav-item nav-toggle">
            <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
              <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
            </a>
          </li>
        </ul>
      </div>
      <div class="shadow-bottom"></div>
      <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
          <li class="{{ $active_link == 'dashboard' ? 'active ' : '' }}nav-item"><a class="d-flex align-items-center" href="{{ route('admin_dashboard') }}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboard">Dashboard</span></a>
          </li>
          <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Apps &amp; Pages</span><i data-feather="more-horizontal"></i>
          </li>
          <!-- <li class=" nav-item"><a class="d-flex align-items-center" href="app-email.html"><i data-feather="mail"></i><span class="menu-title text-truncate" data-i18n="Email">Email</span></a>
          </li> -->
          <li class="{{ $active_link == 'products' ? 'active ' : '' }}nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="package"></i><span class="menu-title text-truncate" data-i18n="Products">Products</span></a>
            <ul class="menu-content">
              <li><a class="d-flex align-items-center" href="{{ route('products') }}"><i data-feather="list"></i><span class="menu-item text-truncate" data-i18n="List">List</span></a>
              </li>
            </ul>
          </li>
          <li class="{{ $active_link == 'dispatchers' ? 'active ' : '' }}nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="package"></i><span class="menu-title text-truncate" data-i18n="Dispatchers">Dispatchers</span></a>
            <ul class="menu-content">
              <li><a class="d-flex align-items-center" href="{{ route('dispatchers') }}"><i data-feather="list"></i><span class="menu-item text-truncate" data-i18n="List">List</span></a>
              </li>
            </ul>
          </li>
          <li class="{{ $active_link == 'company_infos' ? 'active ' : '' }}nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="package"></i><span class="menu-title text-truncate" data-i18n="Company info">Company info</span></a>
            <ul class="menu-content">
              <li><a class="d-flex align-items-center" href="{{ route('company_infos') }}"><i data-feather="list"></i><span class="menu-item text-truncate" data-i18n="List">List</span></a>
              </li>
            </ul>
          </li>
          <li class="{{ $active_link == 'users' ? 'active ' : '' }}nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="package"></i><span class="menu-title text-truncate" data-i18n="Users">Users</span></a>
            <ul class="menu-content">
              <li><a class="d-flex align-items-center" href="{{ route('users') }}"><i data-feather="list"></i><span class="menu-item text-truncate" data-i18n="List">List</span></a>
              </li>
            </ul>
          </li>
          <li class="{{ $active_link == 'orders' ? 'active ' : '' }}nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="package"></i><span class="menu-title text-truncate" data-i18n="Orders">Orders</span></a>
            <ul class="menu-content">
              <li><a class="d-flex align-items-center" href="{{ route('orders') }}"><i data-feather="list"></i><span class="menu-item text-truncate" data-i18n="List">List</span></a>
              </li>
            </ul>
          </li>
          <li class=" nav-item"><a class="d-flex align-items-center" href="{{ route('admin_logout') }}"><i data-feather="log-out"></i><span class="menu-title text-truncate" data-i18n="Logout">Logout</span></a>
          </li>
        </ul>
      </div>
    </div>
    <!-- END: Main Menu-->
