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

                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title-wrap bar-success">
                                            <h4 class="card-title">Attendance and departure request</h4>
                                        </div>
                                    </div>
                                    <div class="card-body collapse show">
                                        <div class="card-block card-dashboard">
                                            <p class="card-text">DataTables has most features enabled by default,
                                                so all you need to do to use it with your own ables is to call the
                                                construction</p>
                                            <h5>today is: {{ date('y-m-d') }}</h5>

                                            <div class="row">

                                                <div class=" col-md-6">
                                                    <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                                        <form action="{{ route('Search_attendances') }}" method="POST"
                                                            role="search" autocomplete="off">
                                                            {{ csrf_field() }}
                                                            <div class="search-form">
                                                                <label>Employee Name :
                                                                    <div class="col-lg-4" id="start_at">
                                                                        {{-- <label for="exampleFormControlSelect1">من
                                                                            تاريخ</label> --}}
                                                                        <input class="form-control fc-datepicker"
                                                                            value="{{ $start_at ?? '' }}" name="start_at"
                                                                            placeholder="YYYY-MM-DD" type="date">
                                                                    </div>

                                                                    <div class="col-lg-4" id="end_at">
                                                                        {{-- <label for="exampleFormControlSelect1">الي
                                                                            تاريخ</label> --}}

                                                                        <input class="form-control fc-datepicker"
                                                                            name="end_at" value="{{ $end_at ?? '' }}"
                                                                            placeholder="YYYY-MM-DD" type="date">


                                                                    </div>
                                                                    <button type="submit" class="btn btn-sm btn-primary"
                                                                        style="float: right;">Search</button>
                                                                </label>
                                                            </div>
                                                        </form>
                                                    </div>


                                                </div>


                                                <div class=" col-md-6 ">
                                                    <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                                        <form action="{{ route('search') }}" method="GET">
                                                            <div class="search-form">
                                                                <label>Employee Name :
                                                                    <input type="search" id="search-text" name="query"
                                                                        class="form-control" placeholder="Search">
                                                                    <button type="submit" class="btn btn-sm btn-primary"
                                                                        style="float: right;">Search</button>
                                                                </label>
                                                            </div>
                                                        </form>
                                                    </div>


                                                </div>






                                            </div>
                                            <table class="table table-striped table-bordered zero-configuration mt-40">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        {{-- <th>Section Name</th> --}}
                                                        <th>Name</th>
                                                        <th>Date </th>
                                                        <th>Attendance date</th>
                                                        <th>check-out date</th>
                                                        <th>status</th>
                                                        <th>controles</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($attendances->count() > 0)
                                                        <?php $i = 0; ?>
                                                        @foreach ($attendances as $attendance)
                                                            <?php $i++; ?>

                                                            <tr>
                                                                <td>{{ $i }}</td>
                                                                {{-- <td>{{ $attendance->section->section_name }}</td> --}}
                                                                <td>
                                                                    {{ \App\Models\Employeer::where('id', $attendance->employer_id)->value('first_name') }}

                                                                    {{-- {{ $attendance->employer->first_name }} --}}
                                                                </td>
                                                                <td>{{ $attendance->today }}</td>

                                                                <td>{{ date("h:i a", strtotime($attendance->start_time)) }}</td>
                                                                <td>{{ date("h:i a", strtotime($attendance->end_time)) }}</td>


                                                                <td>

                                                                    @if ($attendance->status == 'attendance')
                                                                        <span
                                                                            class="badge badge-success">{{ $attendance->status }}</span>
                                                                    @else
                                                                        <span
                                                                            class="badge badge-danger">{{ $attendance->status }}</span>
                                                                    @endif
                                                                </td>

                                                                <td>
                                                                    <a href="{{ route('Attendance.edit', $attendance->id) }}"
                                                                        data-toggle="tooltip" title="edit"
                                                                        class="float-left btn btn-sm btn-outline-warning"
                                                                        data-placement="button"><i
                                                                            class="icon-edit"></i></a>

                                                                    <form class="float-left ml-2"
                                                                        action="{{ route('Attendance.destroy', $attendance->id) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <a href="#" data-toggle="tooltip"
                                                                            title="delete" data-id="{{ $attendance->id }}"
                                                                            class="dlBtn btn btn-danger mr-1"
                                                                            data-placement="button"><i
                                                                                class="icon-trash"></i></a>

                                                                    </form>

                                                                </td>


                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <div class="alert alert-danger m-1">
                                                            there is no data......
                                                        </div>
                                                    @endif

                                                    </yr>
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                    <div class="card-header">
                                        <div class="card-title-wrap bar-success">
                                            <h4 class="card-title">Request A Form</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="px-3">



                                            <form class="form form-horizontal" action="{{ route('Attendance.store') }}"
                                                method="post">
                                                @csrf
                                                <div class="form-body">


                                                    {{-- <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="projectinput7">Employee
                                                            Name : </label>
                                                        <div class="col-md-9">
                                                            <select name="section_id" id="section_id"
                                                                class="form-control SlectBox"
                                                                onclick="console.log($(this).val())">
                                                                <!--placeholder-->
                                                                <option value="" selected disabled>حدد القسم</option>
                                                                @foreach ($sections as $section)
                                                                    <option value="{{ $section->id }}">
                                                                        {{ $section->section_name }}</option>
                                                                @endforeach
                                                            </select>


                                                            @error('section_id')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div> --}}


                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="">Employee
                                                            Name : </label>
                                                        <div class="col-md-9">
                                                            <select id="employer_id" name="employer_id"
                                                                class="form-control">
                                                                @foreach ($employers as $employer)
                                                                    <option value="{{ $employer->id }}">
                                                                        {{ $employer->first_name }}</option>
                                                                @endforeach
                                                            </select>


                                                            @error('employer_id')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>



                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="projectinput9">Date:
                                                        </label>
                                                        <div class="col-md-9">
                                                            <div class="position-relative has-icon-left">
                                                                <input type="date" id="timesheetinput3"
                                                                    class="form-control" name="today">



                                                                @error('today')
                                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror


                                                                <div class="form-control-position">
                                                                    <i class="ft-message-square"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class=" row">
                                                    <div class="col-md-12">
                                                        <div class=" row form-group">
                                                            <label class="col-md-3 label-control">Start time: </label>
                                                            <div class="position-relative has-icon-left col-lg-9">
                                                                <input type="time" id="timesheetinput5"
                                                                    class="form-control" name="start_time">



                                                                @error('start_time')
                                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror

                                                                <div class="form-control-position">
                                                                    <i class="ft-clock"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class=" row form-group">
                                                            <label class="col-md-3 label-control">End time: </label>
                                                            <div class="position-relative has-icon-left col-lg-9">
                                                                <input type="time" id="timesheetinput6"
                                                                    class="form-control" name="end_time">



                                                                @error('end_time')
                                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror

                                                                <div class="form-control-position">
                                                                    <i class="ft-clock"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>








                                                <div class="col-md-12">
                                                    <div class=" row form-group">
                                                        <label class="col-md-3 label-control">status: </label>
                                                        <div class="position-relative has-icon-left col-lg-9">

                                                            {{-- @if (isset(\App\Models\Employeer::join('attendances','attendances.employer_id','=','employeers.id')->where('today', date('y-m-d'))->first()->employer_id)); --}}
                                                            {{-- ::where('today', date('y-m-d'))->first()->employer_id)) --}}


                                                                <select name="status"
                                                                    class="form-control show-tick">
                                                                    <option value="" disabled>-- status --</option>
                                                                    <option value="attendance"
                                                                        {{ old('status') == 'attendance' ? 'selected' : '' }}
                                                                        >
                                                                        attendance
                                                                    </option>
                                                                    <option value="upsent"
                                                                        {{ old('status') == 'upsent' ? 'selected' : '' }}
                                                                        >
                                                                        upsant
                                                                    </option>
                                                                </select>
                                                            {{-- @else
                                                                <select name="status [{{ $employer->id }}]"
                                                                    class="form-control show-tick">
                                                                    <option value="" disabled>-- status --</option>
                                                                    <option value="attendance"
                                                                        {{ old('status') == 'attendance' ? 'selected' : '' }}>
                                                                        attendance
                                                                    </option>
                                                                    <option value="upsent"
                                                                        {{ old('status') == 'upsent' ? 'selected' : '' }}>
                                                                        upsant
                                                                    </option>
                                                                </select>
                                                            @endif --}}

                                                            @error('status')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                              

                                        </div>
                                    </div>
                                </div>
                            </div>




                            <div class="form-actions">
                                <button type="button" class="btn btn-danger mr-1">
                                    <i class="icon-trash"></i> Cancel
                                </button>
                                <button type="submit" class="btn btn-success">
                                    <i class="icon-note"></i> Save
                                </button>
                            </div>

                            </form>
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
        <p class="clearfix text-muted text-center px-2"><span>Copyright &copy; 2021 <a href="#" id="pixinventLink"
                    target="_blank" class="text-bold-800 primary darken-2">Pioneer solutions </a>,
                All rights reserved. </span></p>
    </footer>

    </div>
@endsection
@section('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    {{-- //// DELETE SECTION --}}
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.dlBtn').click(function(e) {
            var form = $(this).closest('form');
            var dataID = $(this).data('id');
            e.preventDefault();

            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    form.submit();
                    if (willDelete) {
                        swal("Poof! Your imaginary file has been deleted!", {
                            icon: "success",
                        });
                    } else {
                        swal("Your imaginary file is safe!");
                    }
                });
        })
    </script>
@endsection
