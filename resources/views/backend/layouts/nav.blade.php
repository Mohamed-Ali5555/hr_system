 <nav class="navbar navbar-expand-lg navbar-light bg-faded">
     <div class="container-fluid">
         <div class="navbar-header">
             <button type="button" data-toggle="collapse" class="navbar-toggle d-lg-none float-left"><span
                     class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span
                     class="icon-bar"></span><span class="icon-bar"></span></button><span
                 class="d-lg-none navbar-right navbar-collapse-toggle"><a class="open-navbar-container"><i
                         class="ft-more-vertical"></i></a></span>
             <a id="navbar-fullscreen" href="javascript:;" class="mr-2 display-inline-block apptogglefullscreen">
                 <i class="ft-maximize blue-grey darken-4 toggleClass"></i>
                 <p class="d-none">fullscreen</p>
             </a>
             <a class="ml-2 display-inline-block">
                 <i class="ft-shopping-cart blue-grey darken-4"></i>
                 <p class="d-none">cart</p>
             </a>
             <div class="dropdown ml-2 display-inline-block">
                 <a id="apps" href="#" data-toggle="dropdown"
                     class="nav-link position-relative dropdown-toggle"><i class="ft-edit blue-grey darken-4"></i><span
                         class="mx-1 blue-grey darken-4 text-bold-400">Apps</span></a>
                 <div class="apps dropdown-menu">
                     <div class="arrow_box"><a href="chat.html" class="dropdown-item py-1"><span>Chat</span></a><a
                             href="#" class="dropdown-item py-1"><span>TaskBoard</span></a><a href="#"
                             class="dropdown-item py-1"><span>Calendar</span></a></div>
                 </div>
             </div>
         </div>
         <div class="navbar-container">
             <div id="navbarSupportedContent" class="collapse navbar-collapse">
                 <ul class="navbar-nav">
                     <li class="nav-item mt-1 navbar-search text-left dropdown">
                         <a id="search" href="#" data-toggle="dropdown" class="nav-link dropdown-toggle"><i
                                 class="ft-search blue-grey darken-4"></i></a>
                         <div aria-labelledby="search" class="search dropdown-menu dropdown-menu-right">
                             <div class="arrow_box_right">
                                 <form role="search" class="navbar-form navbar-right">
                                     <div class="position-relative has-icon-right mb-0">
                                         <input id="navbar-search" type="text" placeholder="Search"
                                             class="form-control" />
                                         <div class="form-control-position navbar-search-close"><i class="ft-x"></i>
                                         </div>
                                     </div>
                                 </form>
                             </div>
                         </div>
                     </li>
                     <li class="dropdown nav-item mt-1">
                         <a id="dropdownBasic" href="#" data-toggle="dropdown"
                             class="nav-link position-relative dropdown-toggle"><i
                                 class="ft-flag blue-grey darken-4"></i><span
                                 class="selected-language d-none"></span></a>
                         <div class="dropdown-menu dropdown-menu-right">
                             <div class="arrow_box_right"><a href="javascript:;" class="dropdown-item py-1"><img
                                         src="../app-assets/img/flags/us.png" alt="English Flag"
                                         class="langimg" /><span> English</span></a><a href="javascript:;"
                                     class="dropdown-item py-1"><img src="../app-assets/img/flags/es.png"
                                         alt="Spanish Flag" class="langimg" /><span> Spanish</span></a><a
                                     href="javascript:;" class="dropdown-item py-1"><img
                                         src="../app-assets/img/flags/br.png" alt="Portuguese Flag"
                                         class="langimg" /><span> Portuguese</span></a><a href="javascript:;"
                                     class="dropdown-item"><img src="../app-assets/img/flags/de.png" alt="French Flag"
                                         class="langimg" /><span> French</span></a></div>
                         </div>
                     </li>
                     <li class="dropdown nav-item mt-1">
                         <a id="dropdownBasic2" href="#" data-toggle="dropdown"
                             class="nav-link position-relative dropdown-toggle">
                             <i class="ft-bell blue-grey darken-4"></i><span
                                 class="notification badge badge-pill badge-danger">

                                 {{ auth()->user()->unreadNotifications->count() }}

                             </span>
                             <p class="d-none">Notifications</p>
                         </a>
                         <div class="notification-dropdown dropdown-menu dropdown-menu-right">
                             <div class="arrow_box_right">
                                 <div class="" id="unreadNotifications">
                                      @if (auth()->user()->unreadNotifications->count() > 0)

                                     @foreach (auth()->user()->unreadNotifications as $notification)
                                         <a class="dropdown-item noti-container py-2"  href="{{ route('markNotification')  }} "><i
                                                 class="ft-share info float-left d-block font-medium-4 mt-2 mr-2"></i>


                                             <div class="dropdown-item-desc" href="{{ route('employees.index', $notification->data['id']) }}">

                                                 <div class=" mark-as-read" >
                                                     <b>
                                                         {{ $notification->data['title'] }}

                                                         {{ $notification->data['user'] }}

                                                     </b>
                                                 </div>

                                                 {{ $notification->created_at }}

                                             </div> 
                                              
                                         </a>
                                   @endforeach
                                   @else
                                            <div class="alert alert-danger m-1">
                                                            there is no data......
                                                        </div>
                                                        @endif
                                 </div>
                                 <a class="noti-footer primary text-center d-block border-top border-top-blue-grey border-top-lighten-4 text-bold-400 py-1"
                                     href="{{route('MarkAsRead_all')}}">Read
                                     All Notifications</a>
                             </div>
                         </div>
                     </li>
                     <li class="nav-item mt-1 d-none d-lg-block">
                         <a id="navbar-notification-sidebar" href="javascript:;"
                             class="nav-link position-relative notification-sidebar-toggle">
                             <i class="icon-equalizer blue-grey darken-4"></i>
                             <p class="d-none">Notifications Sidebar</p>
                         </a>
                     </li>
                     <li class="dropdown nav-item mr-0">
                         <a id="dropdownBasic3" href="#" data-toggle="dropdown"
                             class="nav-link position-relative dropdown-user-link dropdown-toggle">
                             <span class="avatar avatar-online"><img id="navbar-avatar"
                                     src="../app-assets/img/portrait/small/avatar-s-3.jpg" alt="avatar" /></span>
                             <p class="d-none">User Settings</p>
                         </a>
                         <div aria-labelledby="dropdownBasic3" class="dropdown-menu dropdown-menu-right">
                             <div class="arrow_box_right">
                                 <a href="user-profile-page.html" class="dropdown-item py-1"><i
                                         class="ft-edit mr-2"></i><span>My Profile</span></a><a href="chat.html"
                                     class="dropdown-item py-1"><i class="ft-message-circle mr-2"></i><span>My
                                         Chat</span></a><a href="javascript:;" class="dropdown-item py-1"><i
                                         class="ft-settings mr-2"></i><span>Settings</span></a>
                                 <div class="dropdown-divider"></div>





                                 {{-- <a href="javascript:;" class="dropdown-item">
                                 <i class="ft-power mr-2"></i><span>Logout</span></a> --}}




                                 <a class="dropdown-item" href="{{ route('logout') }}"
                                     onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                     <i class="ft-power mr-2"></i><span>Logout</span>
                                 </a>

                                 <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                     class="d-none">
                                     @csrf


                                 </form>








                             </div>
                         </div>
                     </li>
                 </ul>
             </div>
         </div>
     </div>
 </nav>
