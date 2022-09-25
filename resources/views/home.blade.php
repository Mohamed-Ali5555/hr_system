{{-- @extends('backend.layouts.master') --}}

    @include('backend.layouts.head')
                @include('backend.layouts.sidebar')

{{-- @section('content') --}}
     <div class="main-panel">
            <div class="main-content">
               <div class="content-wrapper">
                  <div class="container-fluid">
                     <section id="minimal-statistics-bg">
                        <div class="row">
                           <div class="col-12 mt-3 mb-1">
                              <h2 class="content-header"> Welcome in Pioneer-solutions Dashboard .. </h2>
                              <p class="content-sub-header">Statistics on minimal cards with background color.</p>
                           </div>
                        </div>
                        <section id="basic-carousel">
                           <div class="row">
                              <div class="col-md-12 col-sm-12">
                                 <div class="card">
                                    <div class="card-body">
                                       <div class="card-block">
                                          <div id="carousel-example-caption" class="carousel slide" data-ride="carousel">
                                             <ol class="carousel-indicators">
                                                <li data-target="#carousel-example-caption" data-slide-to="0" class="active"></li>
                                                <li data-target="#carousel-example-caption" data-slide-to="1"></li>
                                                <li data-target="#carousel-example-caption" data-slide-to="2"></li>
                                             </ol>
                                             <div class="carousel-inner" role="listbox">
                                                <div class="carousel-item active">
                                                   <img src="{{asset('backend/assets/img/slide.PNG')}}" alt="First slide">
                                                </div>
                                                <div class="carousel-item">
                                                   <img src="{{asset('backend/assets/img/slide2.PNG')}}" alt="Second slide">
                                                </div>
                                                <div class="carousel-item">
                                                   <img src="{{asset('backend/assets/img/slide3.PNG')}}" alt="Third slide">
                                                </div>
                                             </div>
                                             <a class="carousel-control-prev" href="#carousel-example-caption" role="button" data-slide="prev">
                                             <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                             <span class="sr-only">Previous</span>
                                             </a>
                                             <a class="carousel-control-next" href="#carousel-example-caption" role="button" data-slide="next">
                                             <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                             <span class="sr-only">Next</span>
                                             </a>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </section>
                        <!-- Basic Carousel end -->
                        <div class="row match-height">
                           <div class="col-xl-3 col-lg-6 col-12">
                              <div class="card bg-success" style="height: 145px;">
                                 <div class="card-body">
                                    <div class="px-3 py-3">
                                       <div class="row text-white">
                                          <div class="col-6">
                                             <h1><i class="fa fa-usd background-round text-white p-2 font-medium-3"></i></h1>
                                             <h4 class="pt-1 m-0 text-white">100 % <i class="fa fa-long-arrow-up"></i></h4>
                                          </div>
                                          <div class="col-6 text-right pl-0">
                                             <h4 class="text-white mb-2">Employees</h4>
                                             <span>  {{ \App\Models\Employeer::count() }}</span>
                                             <br>
                                             <span>Grate</span>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-xl-3 col-lg-6 col-12">
                              <div class="card bg-danger" style="height: 145px;">
                                 <div class="card-body">
                                    <div class="px-3 py-3">
                                       <div class="row text-white">
                                          <div class="col-6">
                                             <h1><i class="fa fa-star-o background-round text-white p-2 font-medium-3"></i></h1>
                                             <h4 class="pt-1 m-0 text-white">
                                                                       @php
                                    $count_all = \App\Models\User::count();
                                    $count_user= \App\Models\User::where('roles_name','user')->count();
                                    if($count_user==0){
                                        echo $count_user= 0;
                                    }else{
                                        echo $count_user= $count_user/ $count_all *100;
                                    }
                                    @endphp
                                    %
                                     <i class="fa fa-long-arrow-down"></i></h4>
                                          </div>
                                          <div class="col-6 text-right pl-0">
                                             <h4 class="text-white mb-2">Users</h4>
                                             <span>  {{ number_format(\App\Models\User::where('roles_name', 'user')->count()) }}</span>
                                             <br>
                                             <span>Average</span>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-xl-3 col-lg-6 col-12">
                              <div class="card bg-info" style="height: 145px;">
                                 <div class="card-body">
                                    <div class="px-3 py-3">
                                       <div class="row text-white">
                                          <div class="col-6">
                                             <h1><i class="fa fa-line-chart background-round text-white p-2 font-medium-3"></i></h1>
                                             <h4 class="pt-1 m-0 text-white">


                                                     @php
                                    $count_all = \App\Models\Attendance::count();
                                    $count_attendance = \App\Models\Attendance::where('status','attendance')->count();
                                    if($count_attendance ==0){
                                        echo $count_attendance = 0;
                                    }else{
                                        echo $count_attendance = number_format($count_attendance / $count_all *100);
                                    }
                                    @endphp

                                           %
                                             
                                             
                                             <i class="fa fa-long-arrow-up"></i></h4>
                                          </div>
                                          <div class="col-6 text-right pl-0">
                                             <h4 class="text-white mb-2">Attendance </h4>
                                             <span>  {{ number_format(\App\Models\Attendance::where('status', 'attendance')->count()) }}</span>
                                             <br>
                                             <span>Good</span>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-xl-3 col-lg-6 col-12">
                              <div class="card bg-warning" style="height: 145px;">
                                 <div class="card-body">
                                    <div class="px-3 py-3">
                                       <div class="row text-white">
                                          <div class="col-6">
                                             <h1><i class="fa fa-rocket background-round text-white p-2 font-medium-3"></i></h1>
                                             <h4 class="pt-1 m-0 text-white">
                                                     @php
                                    $count_all = \App\Models\Attendance::count();
                                    $count_attendance = \App\Models\Attendance::where('status','upsent')->count();
                                    if($count_attendance ==0){
                                        echo $count_attendance = 0;
                                    }else{
                                        echo $count_attendance = number_format($count_attendance / $count_all *100);
                                    }
                                    @endphp

                                           %<i class="fa fa-long-arrow-up"></i></h4>
                                          </div>
                                          <div class="col-6 text-right pl-0">
                                             <h4 class="text-white">upsent</h4>
                                             <span>  {{ number_format(\App\Models\Attendance::where('status', 'upsent')->count()) }}</span>
                                             <br>
                                             <span>Grate</span>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </section>
                     <!--Statistics cards Starts-->
                     <div class="row match-height">
                        <div class="col-12 col-md-8" id="recent-sales">
                           <div class="card">
                              <div class="card-header">
                                 <div class="card-title-wrap bar-primary">
                                    <h4 class="card-title">Recent Activites</h4>
                                 </div>
                                 <a class="heading-elements-toggle">
                                 <i class="la la-ellipsis-v font-medium-3"></i>
                                 </a>
                              </div>
                              <div class="card-content mt-1">
                                 <div class="table-responsive">
                                 <?php $employers = \App\Models\Employeer::orderBy('id','DESC')->get(); ?>

                              
                                    <table class="table table-hover table-xl mb-0" id="recent-orders">
                                       <thead>
                                          <tr>
                                             <th class="border-top-0">Emplyee id </th>
                                             <th class="border-top-0">Employee Name </th>
                                             <th class="border-top-0">Date </th>
                                             <th class="border-top-0">Attendance date</th>
                                             <th class="border-top-0">check-out date</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                           @if ($employers->count() > 0)
                                                        <?php $i = 0; ?>
                                                        @foreach ($employers as $employer)
                                                            <?php $i++; ?>
                                        
                                          <tr>
                                             <td>
                                                <button class="btn btn-sm btn-outline-success round mb-0" type="button">#{{ $i }}</button>
                                             </td>
                                      
                                      
                                                       
                                                            

                                                                <td>{{ $employer->first_name }}</td>
                                                              
                                                              
                                                                <td>{{ $employer->date }}</td>
                                                        
                                                               
                                                                <td>{{ $employer->start_time }}</td>
                                                                <td>{{ $employer->end_time }}</td>
                                                    

                                                        

                                                            </tr>
                                                        @endforeach
                                                    @endif
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-xl-4 col-lg-12 col-12">
                           <div class="card">
                              <div class="card-header">
                                 <div class="card-title-wrap bar-warning">
                                    <h4 class="card-title">Statistics</h4>
                                 </div>
                              </div>
                              <div class="card-body">
                                 <p class="font-medium-2 text-muted text-center pb-2">Last 24 hours</p>
                                 <div id="Stack-bar-chart" class="height-300 Stackbarchart mb-2">				
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <footer class="footer footer-static footer-light">
               <p class="clearfix text-muted text-center px-2"><span>Copyright  &copy; 2020 <a href="#" id="pixinventLink" target="_blank" class="text-bold-800 primary darken-2">Pioneer-solutions</a>, All rights reserved. </span></p>
            </footer>
         </div>


         <aside id="notification-sidebar" class="notification-sidebar d-none d-sm-none d-md-block">
         <a class="notification-sidebar-close"><i class="ft-x font-medium-3"></i></a>
         <div class="side-nav notification-sidebar-content">
            <div class="row">
               <div class="col-12 mt-1">
                  <ul class="nav nav-tabs">
                     <li class="nav-item"><a id="base-tab1" data-toggle="tab" aria-controls="base-tab1" href="#activity-tab" aria-expanded="true" class="nav-link active"><strong>Activity</strong></a></li>
                     <li class="nav-item"><a id="base-tab2" data-toggle="tab" aria-controls="base-tab2" href="#settings-tab" aria-expanded="false" class="nav-link"><strong>Settings</strong></a></li>
                  </ul>
                  <div class="tab-content">
                     <div id="activity-tab" role="tabpanel" aria-expanded="true" aria-labelledby="base-tab1" class="tab-pane active">
                        <div id="activity-timeline" class="col-12 timeline-left">
                           <h6 class="mt-1 mb-3 text-bold-400">RECENT ACTIVITY</h6>
                           <div class="timeline">
                              <ul class="list-unstyled base-timeline activity-timeline ml-0">
                                 <li>
                                    <div class="timeline-icon bg-danger"><i class="ft-shopping-cart"></i></div>
                                    <div class="base-timeline-info"><a href="#" class="text-uppercase text-danger">Update</a><span class="d-block">Jim Doe Purchased new equipments for zonal office.</span></div>
                                    <small class="text-muted">just now</small>
                                 </li>
                                 <li>
                                    <div class="timeline-icon bg-primary"><i class="fa fa-plane"></i></div>
                                    <div class="base-timeline-info"><a href="#" class="text-uppercase text-primary">Added</a><span class="d-block">Your Next flight for USA will be on 15th August 2015.</span></div>
                                    <small class="text-muted">25 hours ago</small>
                                 </li>
                                 <li>
                                    <div class="timeline-icon bg-dark"><i class="ft-mic"></i></div>
                                    <div class="base-timeline-info"><a href="#" class="text-uppercase text-dark">Assined</a><span class="d-block">Natalya Parker Send you a voice mail for next conference.</span></div>
                                    <small class="text-muted">15 days ago</small>
                                 </li>
                                 <li>
                                    <div class="timeline-icon bg-warning"><i class="ft-map-pin"></i></div>
                                    <div class="base-timeline-info"><a href="#" class="text-uppercase text-warning">New</a><span class="d-block">Jessy Jay open a new store at S.G Road.</span></div>
                                    <small class="text-muted">20 days ago</small>
                                 </li>
                                 <li>
                                    <div class="timeline-icon bg-primary"><i class="ft-inbox"></i></div>
                                    <div class="base-timeline-info"><a href="#" class="text-uppercase text-primary">Added</a><span class="d-block">voice mail for conference.</span></div>
                                    <small class="text-muted">2 Week Ago</small>
                                 </li>
                                 <li>
                                    <div class="timeline-icon bg-danger"><i class="ft-mic"></i></div>
                                    <div class="base-timeline-info"><a href="#" class="text-uppercase text-danger">Update</a><span class="d-block">Natalya Parker Jessy Jay open a new store at S.G Road.</span></div>
                                    <small class="text-muted">1 Month Ago</small>
                                 </li>
                                 <li>
                                    <div class="timeline-icon bg-dark"><i class="ft-inbox"></i></div>
                                    <div class="base-timeline-info"><a href="#" class="text-uppercase text-dark">Assined</a><span class="d-block">Natalya Parker Send you a voice mail for Updated conference.</span></div>
                                    <small class="text-muted">1 Month ago</small>
                                 </li>
                                 <li>
                                    <div class="timeline-icon bg-warning"><i class="ft-map-pin"></i></div>
                                    <div class="base-timeline-info"><a href="#" class="text-uppercase text-warning">New</a><span class="d-block">Started New project with Jessie Lee.</span></div>
                                    <small class="text-muted">2 Month ago</small>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                     <div id="settings-tab" aria-labelledby="base-tab2" class="tab-pane">
                        <div id="settings" class="col-12">
                           <h6 class="mt-1 mb-3 text-bold-400">GENERAL SETTINGS</h6>
                           <ul class="list-unstyled">
                              <li>
                                 <div class="togglebutton">
                                    <div class="switch">
                                       <span class="text-bold-500">Notifications</span>
                                       <div class="float-right">
                                          <div class="form-group">
                                             <div class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
                                                <input id="notifications1" checked="checked" type="checkbox" class="custom-control-input">
                                                <label for="notifications1" class="custom-control-label"></label>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <p>Use checkboxes when looking for yes or no answers.</p>
                              </li>
                              <li>
                                 <div class="togglebutton">
                                    <div class="switch">
                                       <span class="text-bold-500">Show recent activity</span>
                                       <div class="float-right">
                                          <div class="form-group">
                                             <div class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
                                                <input id="recent-activity1" checked="checked" type="checkbox" class="custom-control-input">
                                                <label for="recent-activity1" class="custom-control-label"></label>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <p>The for attribute is necessary to bind our custom checkbox with the input.</p>
                              </li>
                              <li>
                                 <div class="togglebutton">
                                    <div class="switch">
                                       <span class="text-bold-500">Notifications</span>
                                       <div class="float-right">
                                          <div class="form-group">
                                             <div class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
                                                <input id="notifications2" type="checkbox" class="custom-control-input">
                                                <label for="notifications2" class="custom-control-label"></label>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <p>Use checkboxes when looking for yes or no answers.</p>
                              </li>
                              <li>
                                 <div class="togglebutton">
                                    <div class="switch">
                                       <span class="text-bold-500">Show recent activity</span>
                                       <div class="float-right">
                                          <div class="form-group">
                                             <div class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
                                                <input id="recent-activity2" type="checkbox" class="custom-control-input">
                                                <label for="recent-activity2" class="custom-control-label"></label>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <p>The for attribute is necessary to bind our custom checkbox with the input.</p>
                              </li>
                              <li>
                                 <div class="togglebutton">
                                    <div class="switch">
                                       <span class="text-bold-500">Show your emails</span>
                                       <div class="float-right">
                                          <div class="form-group">
                                             <div class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
                                                <input id="show-emails" type="checkbox" class="custom-control-input">
                                                <label for="show-emails" class="custom-control-label"></label>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <p>Use checkboxes when looking for yes or no answers.</p>
                              </li>
                              <li>
                                 <div class="togglebutton">
                                    <div class="switch">
                                       <span class="text-bold-500">Show Task statistics</span>
                                       <div class="float-right">
                                          <div class="form-group">
                                             <div class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
                                                <input id="show-stats" checked="checked" type="checkbox" class="custom-control-input">
                                                <label for="show-stats" class="custom-control-label"></label>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <p>The for attribute is necessary to bind our custom checkbox with the input.</p>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </aside>


{{-- @endsection --}}