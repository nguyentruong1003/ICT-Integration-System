<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
      <img src="/images/ict-logo.png" alt="ICT Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{__('header.home_title')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/dist/img/logo-web.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          @if (checkPermission('admin.system.user.index'))
          <li class="nav-item @if (in_array(Route::currentRouteName(), ['admin.system.user.index', 'admin.system.audit.index', 'admin.system.role.index', 'admin.config.master.index'])) menu-open @endif">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-lock"></i>
              <p>
                {{__('data_field_name.system.admin_right')}}
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.system.user.index') }}" class="nav-link @if (Route::currentRouteName() == 'admin.system.user.index') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{__('data_field_name.user.management')}}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.system.role.index') }}" class="nav-link @if (Route::currentRouteName() == 'admin.system.role.index') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{__('data_field_name.role.management')}}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.system.audit.index') }}" class="nav-link @if (Route::currentRouteName() == 'admin.system.audit.index') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{__('data_field_name.audit.list')}}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.config.master-data.index') }}" class="nav-link @if (Route::currentRouteName() == 'admin.config.master-data.index') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Master Data</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          {{-- <li class="nav-item">
            <a href="{{ route('admin.employee.index') }}" class="nav-link @if (Route::currentRouteName() == 'admin.employee.index') active @endif">
              <i class="fas fa-user nav-icon"></i>
              <p>{{__('data_field_name.employee.management')}}</p>
            </a>
          </li> --}}

          <li class="nav-item">
            <a href="{{ route('admin.department.index') }}" class="nav-link @if (Route::currentRouteName() == 'admin.department.index') active @endif">
              <i class="fas fa-box nav-icon"></i>
              <p>{{__('data_field_name.department.management')}}</p>
            </a>
          </li>

          @if (checkPermission('admin.employee.index'))
          <li class="nav-item @if (in_array(Route::currentRouteName(), ['admin.employee.index'])) menu-open @endif">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                {{__('data_field_name.system.hrm')}}
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.employee.index') }}" class="nav-link @if (Route::currentRouteName() == 'admin.employee.index') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{__('data_field_name.employee.management')}}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Quản lý HĐLĐ</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Quản lý lương thưởng</p>
                </a>
              </li>
            </ul>
          </li>
          @endif

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Quản lý ngân sách
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lịch sử thay đổi ngân sách</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Quản lý HĐLĐ</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Quản lý lương thưởng</p>
                </a>
              </li>
            </ul>
          </li>

          {{-- <li class="nav-item">
            <a href="{{route('admin.config.master', [])}}" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Master data</p>
            </a>
          </li> --}}
          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>