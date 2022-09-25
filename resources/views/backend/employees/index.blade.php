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
                                            <h4 class="card-title">Employees Information</h4>
                                        </div>
                                    </div>
                                    <div class="card-body collapse show">
                                        <div class="card-block card-dashboard">
                                            <p class="card-text">DataTables has most features enabled by default,
                                                so all you need to do to use it with your own ables is to call the
                                                construction</p>
                                            <p>
                                                When customizing DataTables for your own usage, you might find that the
                                                default position of the feature elements (filter input etc) is not quite to
                                                your liking. To address this issue DataTables takes inspiration from the CSS
                                                3 Advanced Layout Module and provides the dom initialization parameter which
                                                can be set to indicate where you wish particular features to appear in the
                                                DOM
                                            </p>
                                            <div class="row">
                                                <div class="col-sm-12 col-md-3">
                                                    <div class="dataTables_length" id="DataTables_Table_0_length">
                                                        <label>Show
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
                                                <div class="col-sm-12 col-md-3">
                                                    <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                                        <label>Search:<input type="search"
                                                                class="form-control form-control-sm" placeholder=""
                                                                aria-controls="DataTables_Table_0"></label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-1"></div>
                                                <div class="col-lg-3"><button id="addRow" class="btn btn-primary mb-2">
                                                        <i class="ft-plus"></i>&nbsp;
                                                        <a href="{{ route('employees.create') }}"> Add new
                                                            Employee</a></button></div>
                                            </div>

                                           <div class="col-lg-3"><button  class="btn btn-danger mb-2">
                                                        <i class="ft-file-download"></i>&nbsp;
                                                        <a href="{{ route('employees.excel') }}"> Add excel 
                                                            Employee</a></button></div>
                                            <table
                                                class="table table-striped table-bordered zero-configuration table-responsive">
                                                <thead>

                                                    <tr>
                                                        <th>S.N</th>
                                                        <th>photo</th>

                                                        <th>Name</th>
                                                        <th>address</th>

                                                        <th>email</th>
                                                        <th>phone</th>
                                                        <th>Date of birth</th>
                                                        <th>Type</th>

                                                        <th>Date Of contact</th>

                                                        <th>Start time</th>

                                                        <th>check-out date</th>
                                                        <th>Salary</th>
                                                        <th> National id</th>

                                                        <th>Nationality</th>
                                                        <th>section name</th>
                                                        <th>status</th>
                                                        <th>note</th>
                                                        <th>controls</th>


                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($employers->count() > 0)
                                                        <?php $i = 0; ?>
                                                        @foreach ($employers as $employer)
                                                            <?php $i++; ?>
                                                            <tr>
                                                                <td>{{ $i }}</td>
                                                                <td><img src="{{ $employer->photo }}" alt="employer image"
                                                                        style="max-height:107px; width:166px;"></td>

                                                                <td>{{ $employer->first_name }}</td>
                                                                <td>{{ $employer->address }}</td>
                                                                <td>{{ $employer->email }}</td>
                                                                <td>{{ $employer->phone }}</td>
                                                                <td>{{ $employer->date }}</td>
                                                                <td>
                                                                    @if ($employer->type == 'mail')
                                                                        <span
                                                                            class="badge badge-success">{{ $employer->type }}</span>
                                                                    @else
                                                                        <span
                                                                            class="badge badge-danger">{{ $employer->type }}</span>
                                                                    @endif
                                                                </td>
                                                                <td>{{ $employer->date_of_contact }}</td>
                                                                <td>{{ $employer->start_time }}</td>
                                                                <td>{{ $employer->end_time }}</td>
                                                                <td>${{ number_format($employer->salary, 2) }}</td>
                                                                <td>{{ $employer->national_id }}</td>
                                                                <td>{{ $employer->nationality }}</td>
                                                                <td> {{ $employer->section->section_name }}</td>
                                                                <td>
                                                                    <input type="checkbox" name="toogle"
                                                                        value="{{ $employer->id }}"
                                                                        data-toggle="switchbutton"
                                                                        {{ $employer->status == 'mail' ? 'checked' : '' }}
                                                                        data-onlabel="active" data-offlabel="femail"
                                                                        data-size="sm"data-onstyle="success"
                                                                        data-offstyle="danger">
                                                                </td>
                                                                <td> {{ $employer->note }}</td>

                                                                <td>
                                                                    <a href="{{ route('employees.edit', $employer->id) }}"
                                                                        data-toggle="tooltip" title="edit"
                                                                        class="float-left btn btn-sm btn-outline-warning"
                                                                        data-placement="button"><i
                                                                            class="icon-edit"></i></a>

                                                                    <form class="float-left ml-2"
                                                                        action="{{ route('employees.destroy', $employer->id) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <a href="#" data-toggle="tooltip"
                                                                            title="delete" data-id="{{ $employer->id }}"
                                                                            class="dlBtn btn btn-sm btn-outline-danger"
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
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
        </div>

        <footer class="footer footer-static footer-light">
            <p class="clearfix text-muted text-center px-2"><span>Copyright &copy; 2021 <a href="#" id="pixinventLink"
                        target="_blank" class="text-bold-800 primary darken-2">Pioneer solutions </a>, All rights reserved.
                </span></p>
        </footer>

    </div>


@endsection
@section('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    

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
