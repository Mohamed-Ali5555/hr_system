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
                                            <h4 class="card-title">addition_and_discounts and departure request</h4>
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
                                                        {{-- <th>Section Name</th> --}}
                                                        <th>employer</th>
                                                        <th>hour_price</th>
                                                        <th>addition </th>
                                                        <th>discount </th>
                                                        <th>total</th>
                                                        <th>week_holiday</th>

                                                        <th>controles</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($addition_and_discounts->count() > 0)
                                                        <?php $i = 0; ?>
                                                        @foreach ($addition_and_discounts as $addition_and_discount)
                                                            <?php $i++; ?>

                                                            <tr>
                                                                <td>{{ $i }}</td>
                                                                {{-- <td>{{ $addition_and_discount->section->section_name }}</td> --}}
                                                                <td>{{ $addition_and_discount->employer->first_name}}</td>

                                                                <td>{{ $addition_and_discount->hour_price }}</td>
                                                                <td>{{ $addition_and_discount->addition }}</td>
                                                                <td>{{ $addition_and_discount->discount }}</td>
                                                                <td>{{ $addition_and_discount->total }}</td>
                                                                <td>{{ $addition_and_discount->week_holiday }}</td>




                                                                <td>
                                                                    <a href="{{ route('addition_and_discount.edit', $addition_and_discount->id) }}"
                                                                        data-toggle="tooltip" title="edit"
                                                                        class="float-left btn btn-sm btn-outline-warning"
                                                                        data-placement="button"><i
                                                                            class="icon-edit"></i></a>

                                                                    <form class="float-left ml-2"
                                                                        action="{{ route('addition_and_discount.destroy', $addition_and_discount->id) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <a href="#" data-toggle="tooltip"
                                                                            title="delete" data-id="{{ $addition_and_discount->id }}"
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
