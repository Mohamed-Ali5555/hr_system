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
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title-wrap bar-success">
                                            <h4 class="card-title">Attendance and departure request</h4>
                                        </div>
                                    </div>

                                    <div class="card-header">
                                        <div class="card-title-wrap bar-success">
                                            <h4 class="card-title">Request A Form</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="px-3">



                                            <form class="form form-horizontal"
                                                action="{{ route('Attendance.update', $attendances->id) }}" method="post">
                                                @csrf
                                                @method('patch')

                                                <div class="form-body">


                                                    {{-- <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="projectinput7">Employee
                                                            Name : </label>
                                                        <div class="col-md-9">
                                                            <select name="section_id" id="section_id"
                                                                class="form-control SlectBox"
                                                                onclick="console.log($(this).val())">
                                                                <!--placeholder-->

                                                                <option value="{{ $attendances->section->id }}">
                                                                    {{ $attendances->section->section_name }}
                                                                </option>


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
                                                                <option value="" disabled>-- Employers --</option>

                                                                @foreach (\App\Models\Employeer::get() as $employer)
                                                                    <option value="{{ $employer->id }}"
                                                                        {{ $employer->id == $attendances->employer_id ? 'selected' : '' }}>
                                                                        {{ $employer->first_name }}</option>
                                                                @endforeach
                                                                </option>
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
                                                                    class="form-control" name="date"
                                                                    value="{{ $attendances->absent_date }}">

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
                                                            <label class="col-md-3 label-control">attendance_time: </label>
                                                            <div class="position-relative has-icon-left col-lg-9">
                                                                <input type="time" id="timesheetinput5"
                                                                    class="form-control" name="attendance_time"
                                                                    value="{{ $attendances->attendance_time }}">

                                                                @error('attendance_time')
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
                                                            <label class="col-md-3 label-control">depature_time: </label>
                                                            <div class="position-relative has-icon-left col-lg-9">
                                                                <input type="time" id="timesheetinput6"
                                                                    class="form-control" name="depature_time"
                                                                    value="{{ $attendances->depature_time }}">

                                                                @error('depature_time')
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
                                                            <select name="value_status" class="form-control show-tick">
                                                                <option value="" disabled>-- status --</option>
                                                                <option value="1"
                                                                    {{ $attendances->status == 'attendance' ? 'selected' : '' }}>
                                                                    attendance
                                                                </option>
                                                                <option value="2"
                                                                    {{ $attendances->status == 'upsent' ? 'selected' : '' }}>
                                                                    upsent
                                                                </option>
                                                            </select>

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
    <script>
        $(document).ready(function() {
            $('select[id="section_id"]').on('change', function() {
                {{-- alert('ssss'); --}}
                // ---------------------------------------------------------
                var SectionId = $(this).val();
                {{-- alert(SectionId); --}}
                var path = "{{ URL::to('section') }}/" + SectionId;
                if (SectionId) {
                    $.ajax({

                        url: path,
                        type: "GET",
                        dataType: "json",
                        // _token: '{{ csrf_token() }}',

                        success: function(data) {
                            $('select[id="employer"]').empty();
                            $.each(data, function(key, value) {
                                $('select[id="employer"]').append('<option value="' +
                                    value + '">' + value + '</option>');
                            });
                        },
                    });

                } else {
                    console.log('AJAX load did not work');
                }
                // ---------------------------------------------------------

            });
        });
    </script>
@endsection
