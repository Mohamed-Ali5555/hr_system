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

                                                        <th>Name</th>
                                                        <th>Date </th>

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

                                                                <td>{{ $official_holiday->name }}</td>
                                                                <td>{{ $official_holiday->date }}</td>


                                                                <td>
                                                                    <a type="button" class="btn btn-primary"
                                                                        data-toggle="modal"
                                                                        data-target="#staticBackdrop{{ $official_holiday->id }}"
                                                                        data-backdrop="false"><i class="icon-edit"></i>edit</a>

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


                                                                <!-- Modal -->
                                                                <div class="modal fade"
                                                                    id="staticBackdrop{{ $official_holiday->id }}"
                                                                    data-backdrop="static" data-keyboard="false"
                                                                    tabindex="-1" aria-labelledby="staticBackdropLabel"
                                                                    aria-hidden="true" style="background: rgba(0,0,0,0.5);">
                                                          
                                                                    <div class="modal-dialog">
                                                                        <form
                                                                            action="{{ route('official_holidays.update', $official_holiday->id) }}"
                                                                            method="post">
                                                                            @csrf
                                                                            @method('patch')

                                                                            <div class="modal-content">

                                                                                <div class="modal-header mt-4">
                                                                                    <h5 class="modal-title"
                                                                                        id="staticBackdropLabel">
                                                                                        edit official_holidays</h5>
                                                                                    <button type="button" class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                        <span
                                                                                            aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>


                                                                                <div class="col-md-12">
                                                                                    {{-- ################################# --}}
                                                                                    @if ($errors->any())
                                                                                        <div class="alert alert-danger">
                                                                                            <ul>
                                                                                                @foreach ($errors->all() as $error)
                                                                                                    <li>{{ $error }}
                                                                                                    </li>
                                                                                                @endforeach
                                                                                            </ul>
                                                                                        </div>
                                                                                    @endif
                                                                                    {{-- ########################### --}}
                                                                                </div>


                                                                                <div class="modal-body">
                                                                                    <label> name</label>
                                                                                    <input class="form-control"
                                                                                        name="name"
                                                                                        placeholder="name of section"
                                                                                        value="{{ $official_holiday->name }}">
                                                                                </div>





                                                                                <label class="col-md-3 label-control"
                                                                                    for="projectinput9">Date:
                                                                                </label>
                                                                                <div class="col-md-12">
                                                                                    <div
                                                                                        class="position-relative has-icon-left">
                                                                                        <input type="date"
                                                                                            id="timesheetinput3"
                                                                                            class="form-control"
                                                                                            name="date"value="{{ $official_holiday->date }}">



                                                                                        @error('date')
                                                                                            <div class="alert alert-danger">
                                                                                                {{ $message }}</div>
                                                                                        @enderror


                                                                                    </div>
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
                                                        <label class="col-md-3 label-control" for="">
                                                            Name : </label>
                                                        <div class="col-md-9">
                                                            <input type="text" id="timesheetinput3"
                                                                class="form-control" name="name">

                                                            @error('name')
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
                                                                    class="form-control" name="date">



                                                                @error('date')
                                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror


                                                                <div class="form-control-position">
                                                                    <i class="ft-message-square"></i>
                                                                </div>
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
            <p class="clearfix text-muted text-center px-2"><span>Copyright &copy; 2021 <a href="#"
                        id="pixinventLink" target="_blank" class="text-bold-800 primary darken-2">Pioneer solutions </a>,
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
