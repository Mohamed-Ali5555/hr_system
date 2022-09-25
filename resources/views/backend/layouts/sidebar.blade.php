  <div data-active-color="white" data-background-color="black" data-image="../app-assets/img/sidebar-bg/01.jpg"
      class="app-sidebar">
      <div class="sidebar-header">
          <div class="logo clearfix">
              <a href="index.html" class="logo-text float-left">
                  <div class="logo-img"><img src="../app-assets/img/logo.png" alt="" /></div>
                  <span class="text align-middle">Hr System</span>
              </a>
              <a id="sidebarToggle" href="javascript:;" class="nav-toggle d-none d-sm-none d-md-none d-lg-block"></a><a
                  id="sidebarClose" href="javascript:;" class="nav-close d-block d-md-block d-lg-none d-xl-none">
              </a>
          </div>
      </div>
      <div class="sidebar-content">
          <div class="nav-container">
              <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
                 @can('Dashboard')
                  <li class="nav-item home"><a href="{{ route('admin') }}"><i class="icon-home"></i><span data-i18n=""
                              class="menu-title">Dashboard</span></a>
                  </li>
                  @endcan
                  @can('sections')
                      <li class="has-sub nav-item">
                          <a href="#"><i class="icon-users"></i><span data-i18n="" class="menu-title">
                                  sections</span></a>
                          <ul class="menu-content">
                              <li><a href="{{ route('section.index') }}" class="menu-item"> <i class="icon-bar"></i>
                                      sections</a>
                              </li>
                              
                          </ul>
                      </li>
                  @endcan
                  @can('employers')
                      <li class="has-sub nav-item">
                          <a href="#"><i class="icon-users"></i><span data-i18n="" class="menu-title">
                                  Employees</span></a>
                          <ul class="menu-content">
                              <li><a href="{{ route('employees.index') }}" class="menu-item"> <i class="icon-bar"></i>
                                      Employees Statistics</a>
                              </li>
                              <li class=" nav-item"><a href="{{ route('employees.create') }}"><i class="icon-note"></i><span
                                          data-i18n="" class="menu-title">Add Employee</span></a>
                              </li>
                          </ul>
                      </li>
                  @endcan

     @can('attendance')
                      <li class=" nav-item"><a href="{{ route('Attendance.index') }}"><i class="icon-support"></i><span
                                  data-i18n="" class="menu-title">
                                  Attendance</span></a>
                      </li>
                  @endcan

                  @can('general_setting')
                      <li class="has-sub nav-item">
                          <a href="#"><i class="icon-pie-chart"></i><span data-i18n="" class="menu-title"> General
                                  Settings</span></a>
                          <ul class="menu-content">
                            
                              @can('official_holidays')
                                  <li><a href="{{ route('official_holidays.index') }}" class="menu-item"><i
                                          class="icon-note"></i>official_holidays</a>
                                  </li>
                              @endcan
                          </ul>
                      </li>
                  @endcan
                  {{-- <li class=" nav-item"><a href="{{ route('addition_and_discount.index') }}"><i class="icon-pie-chart"></i><span data-i18n="" class="menu-title">
                        General Settings</span></a>
                     </li> --}}

             
                  @can('salary_report')
                      <li class=" nav-item"><a href="{{ route('salary_reports.index') }}"><i class="icon-layers"></i><span
                                  data-i18n="" class="menu-title">Salary report</span></a>
                      </li>
                  @endcan



                  {{-- @can('users') --}}
                      <li class=" nav-item"><a href="{{ route('users.index') }}"><i class="icon-users"></i><span
                                  data-i18n="" class="menu-title">Users</span></a>
                      </li>
                  {{-- @endcan --}}
                  {{-- @can('roles') --}}
                      <li class=" nav-item"><a href="{{ route('roles.index') }}"><i class="icon-equalizer"></i><span
                                  data-i18n="" class="menu-title">Permissions</span></a>
                      </li>
                  {{-- @endcan --}}
                  @can('archeve')
                      <li class=" nav-item"><a href="{{ route('archevis_reports') }}"><i class="icon-equalizer"></i><span
                                  data-i18n="" class="menu-title">archeve</span></a>
                      </li>
                  @endcan

              </ul>
          </div>
      </div>
      <div class="sidebar-background"></div>
  </div>
