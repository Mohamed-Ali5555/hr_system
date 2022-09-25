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
                                                <div class="col-lg-3">







                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#staticBackdrop" data-backdrop="false">
                                                        Add new section
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="staticBackdrop" data-backdrop="static"
                                                        data-keyboard="false" tabindex="-1"
                                                        aria-labelledby="staticBackdropLabel" aria-hidden="true"
                                                        style="background: rgba(0,0,0,0.5);">
                                                        <div class="modal-dialog">
                                                            <form action="{{ route('section.store') }}" method="post">
                                                                @csrf
                                                                <div class="modal-content">

                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="staticBackdropLabel">
                                                                            Modal title</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>


                                                                    <div class="col-md-12">
                                                                        {{-- ################################# --}}
                                                                        @if ($errors->any())
                                                                            <div class="alert alert-danger">
                                                                                <ul>
                                                                                    @foreach ($errors->all() as $error)
                                                                                        <li>{{ $error }}</li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            </div>
                                                                        @endif
                                                                        {{-- ########################### --}}
                                                                    </div>


                                                                    <div class="modal-body">
                                                                        <label>Section name</label>
                                                                        <input class="form-control" name="section_name"
                                                                            placeholder="name of section">
                                                                    </div>




                                                                    <div class="col-lg-12 col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="">photo</label>

                                                                            <div class="input-group">
                                                                                <span class="input-group-btn">
                                                                                    <a id="lfm" data-input="thumbnail"
                                                                                        data-preview="holder"
                                                                                        class="btn btn-primary">
                                                                                        <i class="fa fa-picture-o"></i>
                                                                                        Choose
                                                                                    </a>
                                                                                </span>
                                                                                <input id="thumbnail" class="form-control"
                                                                                    type="text" name="photo">
                                                                            </div>
                                                                            <div id="holder"
                                                                                style="margin-top:15px;max-height:100px;">
                                                                            </div>


                                                                        </div>
                                                                    </div>



                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">save</button>
                                                                    </div>

                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>








                                                </div>
                                                <table class="table table-striped table-bordered zero-configuration">
                                                    <thead>
                                                        <tr>
                                                            <th>S.N</th>
                                                            <th>photo</th>
                                                            <th>section name</th>
                                                            <th>controlles</th>


                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if ($sections->count() > 0)
                                                            <?php $i = 0; ?>
                                                            @foreach ($sections as $section)
                                                                <?php $i++; ?>
                                                                <tr>
                                                                    <td>{{ $i }}</td>
                                                                    <td><img src="{{ $section->photo }}"
                                                                            alt="category image"
                                                                            style="max-height:107px; width:166px;"></td>
                                                                    <td>{{ $section->section_name }}</td>

                                                                    <td>
                                                                        <a href="{{ route('section.edit', $section->id) }}"
                                                                            data-toggle="tooltip" title="edit"
                                                                            class="float-left btn btn-sm btn-outline-warning"
                                                                            data-placement="button"><i
                                                                                class="icon-edit"></i></a>

                                                                        <form class="float-left ml-2"
                                                                            action="{{ route('section.destroy', $section->id) }}"
                                                                            method="post">
                                                                            @csrf
                                                                            @method('delete')
                                                                            <a href="#" data-toggle="tooltip"
                                                                                title="delete"
                                                                                data-id="{{ $section->id }}"
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
            <p class="clearfix text-muted text-center px-2"><span>Copyright &copy; 2021 <a href="#"
                        id="pixinventLink" target="_blank" class="text-bold-800 primary darken-2">Pioneer solutions </a>,
                    All rights reserved.
                </span></p>
        </footer>

    </div>
@endsection
@section('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

    <script>
        $('#lfm').filemanager('image');
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
