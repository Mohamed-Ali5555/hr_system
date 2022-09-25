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
                                            <h4 class="card-title">official_holidays and departure request</h4>
                                        </div>
                                    </div>
                                    <div class="card-body collapse show">
                                        <div class="card-block card-dashboard">
                                            <p class="card-text">DataTables has most features enabled by default,
                                                so all you need to do to use it with your own ables is to call the
                                                construction</p>

                                            <div class="row">
                                                <div class="col-sm-12 col-md-3">
                                                    <div class="dataTables_length" id="DataTables_Table_0_length">
                                                        <label>Show Date
                                                            <select name="DataTables_Table_0_length"
                                                                aria-controls="DataTables_Table_0"
                                                                class="form-control form-control-sm">
                                                                <option value="10">10</option>
                                                                <option value="25">25</option>
                                                                <option value="50">50</option>
                                                                <option value="100">
                                                                    100</option>
                                                            </select> </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-1"></div>
                                                <div class="col-sm-12 col-md-5">
                                                    <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                                        <label>Employee Name :<input type="search"
                                                                class="form-control form-control-sm" placeholder=""
                                                                aria-controls="DataTables_Table_0"></label>
                                                    </div>
                                                </div>


                                            </div>
                                            <table class="table table-striped table-bordered zero-configuration mt-40">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>

                                                        <th>Section Name</th>
                                                        <th>employer name </th>
                                                        <th>holidays name </th>
                                                        <th>controles</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($official_holidays->count() > 0)
                                                        <?php $i = 0; ?>
                                                        @foreach ($official_holidays as $official_holiday)
                                                            <?php $i++; ?>

                                                            <tr>
                                                                <td>{{ $i }}</td>

                                                                <td>{{ $official_holiday->section->section_name }}</td>
                                                                <td>{{ $official_holiday->employer_id }}</td>
                                                                <td>{{ $official_holiday->week_holiday }}</td>

                                                                <td>
                                                                    <a href="{{ route('official_holidays.edit', $official_holiday->id) }}"
                                                                        data-toggle="tooltip" title="edit"
                                                                        class="float-left btn btn-sm btn-outline-warning"
                                                                        data-placement="button"><i
                                                                            class="icon-edit"></i></a>

                                                                    <form class="float-left ml-2"
                                                                        action="{{ route('official_holidays.destroy', $official_holiday->id) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <a href="#" data-toggle="tooltip"
                                                                            title="delete"
                                                                            data-id="{{ $official_holiday->id }}"
                                                                            class="dlBtn btn btn-danger mr-1"
                                                                            data-placement="button"><i
                                                                                class="icon-trash"></i></a>

                                                                    </form>

                                                                </td>



                                                            </tr>
                                                        @endforeach
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



                                            <form class="form form-horizontal"
                                                action="{{ route('official_holidays.store') }}" method="post">
                                                @csrf
                                                <div class="form-body">





                                                    <div class="form-group row">
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
                                                    </div>


                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="">Employee
                                                            Name : </label>
                                                        <div class="col-md-9">
                                                            <select id="employer" name="employer_id" class="form-control">

                                                            </select>


                                                            @error('employer_id')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>



                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="projectinput7">Weekly
                                                            Holidays: </label>
                                                        <div class="col-md-9">

                                                            <input type="checkbox" id="vehicle1" name="week_holiday[]"
                                                                value="Satrday">
                                                            <label for="sat"> Satrday</label><br>
                                                            <input type="checkbox" id="vehicle2"
                                                                name="week_holiday[]"value="Sunday">
                                                            <label for="sun"> Sunday</label><br>
                                                            <input type="checkbox" id="vehicle3" name="week_holiday[]"
                                                                value="Monday">
                                                            <label for="mon"> Monday</label><br>
                                                            <input type="checkbox" id="vehicle3" name="week_holiday[]"
                                                                value="thirthday">
                                                            <label for="mon"> thirthday</label><br>
                                                            <input type="checkbox" id="vehicle2" name="week_holiday[]"
                                                                value="Tuesday">
                                                            <label for="sun"> Tuesday</label><br>
                                                            <input type="checkbox" id="Tue" name="week_holiday[]"
                                                                value="Turthday">
                                                            <label for="sun"> Turthday</label><br>
                                                            <input type="checkbox" id="Tue" name="week_holiday[]"
                                                                value="Friday">
                                                            <label for="Fri">Friday</label><br>

                                                            @error('week_holiday')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror

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
            <p class="clearfix text-muted text-center px-2"><span>Copyright &copy; 2021 <a href="#"
                        id="pixinventLink" target="_blank" class="text-bold-800 primary darken-2">Pioneer solutions </a>,
                    All rights reserved. </span></p>
        </footer>

    </div>
@endsection
@section('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}

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


            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                form.submit();
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })


        })
    </script>
@endsection


{{-- <form class="float-left ml-2"
                                                                        action="{{ route('official_holidays.destroy', $official_holiday->id) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <a href="#" data-toggle="tooltip"
                                                                            title="delete" data-id="{{ $official_holiday->id }}"
                                                                            class="dlBtn btn btn-sm btn-outline-danger"
                                                                            data-placement="button"><i
                                                                                class="icon-trash"></i></a>

                                                                    </form> --}}
