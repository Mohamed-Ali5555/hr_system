@extends('backend.layouts.master')
@section('content')
    <div class="main-panel">
        <div class="main-content">
            <div class="content-wrapper">
                <div class="container-fluid">
                    <!-- Zero configuration table -->
                    <section id="configuration">
                        <div class="row">



                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title-wrap bar-success">
                                            <h4 class="card-title">Employees Information</h4>
                                        </div>
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
                                    <div class="card-body collapse show">
                                        <div class="card-block card-dashboard">

                                            <div class="row">
                                              
                                                <div class="col-lg-1"></div>
                                             
                                                <div class="col-md-12">

                                                    <form action="{{ route('section.update', $section->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('patch')

                                                        <div class="col-lg-12 col-md-12">
                                                            <div class="form-group">
                                                                <label for="">Section Name <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" class="form-control"
                                                                    placeholder="name" name="section_name"
                                                                    value="{{ $section->section_name }}">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12 col-md-12">
                                                            <div class="form-group">
                                                                <label for="">photo</label>

                                                                <div class="input-group">
                                                                    <span class="input-group-btn">
                                                                        <a id="lfm" data-input="thumbnail"
                                                                            data-preview="holder" class="btn btn-primary">
                                                                            <i class="fa fa-picture-o"></i> Choose
                                                                        </a>
                                                                    </span>
                                                                    <input id="thumbnail" class="form-control"
                                                                        type="text" name="photo"
                                                                        value="{{ $section->photo }}">
                                                                </div>
                                                                <div id="holder"
                                                                    style="margin-top:15px;max-height:100px;"></div>


                                                            </div>
                                                        </div>
                                            
                                                  <div class="col-lg-12 col-md-12">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>


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
                    All rights reserved.
                </span></p>
        </footer>

    </div>
@endsection
@section('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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
