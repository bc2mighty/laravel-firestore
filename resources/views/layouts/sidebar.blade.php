

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
          <li class="{{ $active_link == 'products' ? 'active ' : '' }}nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="package"></i><span class="menu-title text-truncate" data-i18n="Services">Products</span></a>
            <ul class="menu-content">
              <li><a class="d-flex align-items-center" href="{{ route('products') }}"><i data-feather="list"></i><span class="menu-item text-truncate" data-i18n="List">List</span></a>
              </li>
              <li><a class="d-flex align-items-center" href="{{ route('create_product') }}"><i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="Preview">Add</span></a>
              </li>
            </ul>
          </li>
          <li class=" nav-item"><a class="d-flex align-items-center" href="{{ route('admin_logout') }}"><i data-feather="log-out"></i><span class="menu-title text-truncate" data-i18n="Logout">Logout</span></a>
          </li>
        </ul>
      </div>
    </div>
    <!-- END: Main Menu-->
