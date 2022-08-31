@extends('backend.layouts.master')
@section('content')
    <div class="main-panel">
        <div class="main-content">
            <div class="content-wrapper">
                <div class="container-fluid">
                    <!-- Zero configuration table -->
                    <section id="configuration">
                        <div class="row">

                            <div class="col-lg-12">
                                @include('backend.layouts.notification')

                            </div>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title-wrap bar-success">
                                            <h4 class="card-title">Salary report</h4>
                                        </div>
                                    </div>
                                    <div class="card-body collapse show">
                                        <div class="card-block card-dashboard">
                                            <p class="card-text">DataTables has most features enabled by default,
                                                so all you need to do to use it with your own ables is to call the
                                                construction</p>

                                            <div class="row">
                                                <form action="{{ route('Search_salary') }}" method="POST" role="search"
                                                    autocomplete="off">
                                                    {{ csrf_field() }}
                                                    <div class="search-form">
                                                        <label>Employee Name :
                                                            <div class="col-lg-4" id="start_at">
                                                                {{-- <label for="exampleFormControlSelect1">من
                                                                            تاريخ</label> --}}
                                                                <input class=" fc-datepicker" value="{{ $start_at ?? '' }}"
                                                                    name="start_at" placeholder="YYYY-MM-DD" type="date">
                                                            </div>

                                                            <div class="col-lg-4" id="end_at">
                                                                {{-- <label for="exampleFormControlSelect1">الي
                                                                            تاريخ</label> --}}

                                                                <input class=" fc-datepicker" name="end_at"
                                                                    value="{{ $end_at ?? '' }}" placeholder="YYYY-MM-DD"
                                                                    type="date">


                                                            </div>
                                                            <button type="submit" class="btn btn-sm btn-primary"
                                                                style="float: right;">Search</button>
                                                        </label>
                                                    </div>
                                                </form>

                                            </div>
                                            <table class="table table-striped table-bordered zero-configuration mt-40">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Employee Name</th>
                                                        <th>Phone</th>
                                                        <th>Salary</th>
                                                        <th>Attendance days</th>
                                                        <th>Absent days</th>
                                                        <th>Overtime hours</th>
                                                        <th> Discount hours</th>
                                                        <th>Extra</th>
                                                        <th>
                                                            upsent days days</th>
                                                        <th>Total</th>

                                                    </tr>
                                                </thead>
                                                <tbody>



                                                    <?php

                 {{-- $status=\App\Models\Employeer::join('attendances','attendances.employer_id','=','employeers.id')->where('attendances.status','upsent')->get(); --}}










                                                  {{-- $status1 =  \App\Models\Attendance::selectRaw('id,employer_id , count(*) as attenense')
                    ->whereBetween('today', ["2022-08-01", "2022-08-31"])
                    ->where('status' , '=' , 'attendance')
                    ->groupBy('employer_id','id')
                    ->get(); --}}


    $salary_reports34 =  \App\Models\Attendance::selectRaw('employer_id , count(*) as attendance')
        ->whereBetween('today', ["2022-08-01", "2022-08-31"])
        ->where('status' , '=' , 'attendance')
        ->groupBy('employer_id')
        ->get();

   $salary_reports1 =  \App\Models\Attendance::selectRaw('employer_id , count(*) as attendance')
        ->whereBetween('today', ["2022-08-01", "2022-08-31"])
        ->where('status' , '=' , 'upsent')
        ->groupBy('employer_id')
        ->get();


          {{-- $status1 =  \App\Models\Attendance::select('id', 'employer_id')->where('status', 'upsent')->count(); --}}



                                                    {{-- $status = \App\Models\Attendance::where( 'status', 'upsent')->count(); --}}
                                                    
                                                    $week_holiday = \App\Models\salary_report::where('week_holiday')->count();
                                                    
                                                    ?>

                                                    @if ($salary_reports->count() > 0)
                                                        <?php $i = 0; ?>
                                                        @foreach ($salary_reports as $salary_report)
                                                            <?php $i++; ?>
                                                            <tr>
                                                                <td>{{ $i }}</td>
                                                                <td> {{ $salary_report->employer->first_name }}</td>
                                                                <td> {{ $salary_report->section->section_name }}</td>
                                                                <td> {{ $salary_report->employer->salary }}</td>
                                                                <td> {{ $salary_report->our_price }}</td>
                                                                <td> {{ $week_holiday }}</td>
                                                                <td> {{ $salary_report->total }}</td>
                                                                <td> {{ $salary_report->discount }}</td>
                                                                <td> {{ $salary_report->addition }}</td>
                                                                <td> {{ $salary_report->all_total }}</td>

                                                                <td>
                                                                    {{-- {{ $salary_report->attendance->status }} --}}
                                                                    {{-- @if ($salary_report->attendance->status == 'upsent')
                                                                        {{ \App\Models\Attendance::where('status', 'upsent')->count() }}
                                                                    @else
                                                                        mmm
                                                                    @endif --}}

                                                                    {{-- <p>{{ \App\Models\Attendance::where('id', $salary_report->attendance_id)->value('status', 'upsent')->count() }}
                                                                    </p> --}}


                                                                    {{-- {{$salary_reports34}} --}}



                                                                    {{-- {{ $status1 = \App\Models\Attendance::select('id', $salary_report->employer->id)->where('status', 'upsent')->count() }} --}}

                                                                    {{-- {{ $salary_report->status }} --}}
                                                                </td>

                                                                <td> {{ $salary_report->attendance }}</td>
                                                                <td> {{ $salary_report->upsent }}</td>


                                                                <td>
                                                                    {{-- <a href="{{ route('salary_reports.show', $salary_report->id) }}"
                                                                        data-toggle="tooltip" title="edit"
                                                                        class="float-left btn btn-sm btn-outline-warning"
                                                                        data-placement="button"><i
                                                                            class="icon-edit"></i></a> --}}




                                                                    <div class="dropdown">
                                                                        <button aria-expanded="false" aria-haspopup="true"
                                                                            class="btn ripple btn-primary btn-sm"
                                                                            data-toggle="dropdown" type="button">العمليات<i
                                                                                class="fas fa-caret-down ml-1"></i></button>
                                                                        <div class="dropdown-menu tx-13">


                                                                            {{-- <a href="{{ route('salary_reports.show', $salary_report->id) }}"
                                                                        data-toggle="tooltip" title="edit"
                                                                        class="float-left btn btn-sm btn-outline-warning"
                                                                        data-placement="button"><i
                                                                            class="icon-edit"></i></a> --}}



                                                                            {{-- @can('حذف قسم') --}}
                                                                            <a class=" dropdown-item modal-effect btn btn-sm btn-danger"
                                                                                data-effect="effect-scale"
                                                                                data-id="{{ $salary_report->id }}"
                                                                                data-toggle="modal"
                                                                                href="#modaldemo9_{{ $salary_report->id }}"
                                                                                title="حذف"><i
                                                                                    class="fa fa-trash"></i>delete</a>
                                                                            {{-- @endcan --}}




                                                                            {{-- @can('حذف قسم') --}}
                                                                            <a class=" dropdown-item modal-effect btn btn-sm btn-success"
                                                                                data-effect="effect-scale"
                                                                                data-id="{{ $salary_report->id }}"
                                                                                data-toggle="modal"
                                                                                href="#archive{{ $salary_report->id }}"
                                                                                title="حذف"><i
                                                                                    class="fa fa-trash"></i>return from
                                                                                archeve</a>
                                                                            {{-- @endcan --}}






                                                                        </div>
                                                                    </div>

                                                                </td>
                                                                <!-- delete -->







                                                            </tr>

                                                            <div class="modal fade"
                                                                id="modaldemo9_{{ $salary_report->id }}"
                                                                data-backdrop="static" data-keyboard="false" tabindex="-1"
                                                                aria-labelledby="staticBackdropLabel" aria-hidden="true"
                                                                style="background: rgba(0,0,0,0.5);">
                                                                <div class="modal-dialog">
                                                                    <form
                                                                        action="{{ route('archeve.destroy', $salary_report->id) }}"
                                                                        method="post">
                                                                        {{ method_field('delete') }}
                                                                        {{ csrf_field() }}
                                                                        <div class="modal-content">

                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="staticBackdropLabel">
                                                                                    Modal title</h5>
                                                                                <button type="button" class="close"
                                                                                    data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>





                                                                            <div class="modal-body">
                                                                                <p>هل انت متاكد من عملية الحذف ؟</p><br>
                                                                                <input type="text" name="report_id"
                                                                                    id="report_id"
                                                                                    value="{{ $salary_report->id }}">
                                                                                <input class="form-control"
                                                                                    name="room_type_name"
                                                                                    id="room_type_name"
                                                                                    value="{{ $salary_report->employer->first_name }}"
                                                                                    type="text" readonly>
                                                                            </div>








                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-dismiss="modal">Close</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">save</button>
                                                                            </div>

                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>


                                                            <!-- archeve salary_reports -->
                                                            <div class="modal fade" id="archive{{ $salary_report->id }}"
                                                                data-backdrop="static" data-keyboard="false"
                                                                tabindex="-1" aria-labelledby="staticBackdropLabel"
                                                                aria-hidden="true" style="background: rgba(0,0,0,0.5);">
                                                                <div class="modal-dialog">



                                                                    <div class="modal-content modal-content-demo">
                                                                        <div class="modal-header">
                                                                            <h6 class="modal-title">حذف القسم</h6><button
                                                                                aria-label="Close" class="close"
                                                                                data-dismiss="modal" type="button"><span
                                                                                    aria-hidden="true">&times;</span></button>
                                                                        </div>
                                                                        <form action="{{ route('archeve.update') }}"
                                                                            method="post">
                                                                            {{-- {{ method_field('patch') }} --}}
                                                                            {{ csrf_field() }}
                                                                            <div class="modal-body">
                                                                                <p>هل انت متاكد من عملية الارشفه ؟</p><br>
                                                                                <input type="text" name="report_id"
                                                                                    id="report_id"
                                                                                    value="{{ $salary_report->id }}">

                                                                                <input type="text" name="id_page"
                                                                                    id="id_page" value="2">

                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-dismiss="modal">الغاء</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-danger">تاكيد</button>
                                                                            </div>
                                                                    </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif

                                                    </yr>
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>










                    </section>

                </div>
            </div>
        </div>

        <footer class="footer footer-static footer-light">
            <p class="clearfix text-muted text-center px-2"><span>Copyright &copy; 2021 <a href="#"
                        id="pixinventLink" target="_blank" class="text-bold-800 primary darken-2">Pioneer solutions </a>,
                    All rights reserved.
                </span></p>
        </footer>

    </div>


@endsection
