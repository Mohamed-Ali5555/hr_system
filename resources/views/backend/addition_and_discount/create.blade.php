@extends('backend.layouts.master')
@section('content')
    <div class="main-panel">
        <div class="main-content">
            <div class="content-wrapper">
                <div class="container-fluid">
                    <section id="horizontal-form-layouts">

                        <div class="row">

                            <div class="col-lg-12">
                                @include('backend.layouts.notification')

                            </div>
							
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title-wrap bar-success">
                                            <h4 class="card-title" id="horz-layout-basic">General Settings Form </h4>
                                        </div>
                                        <p class="mb-0">This is the basic horizontal form with labels on left and cost
                                            estimation form is the default position.</p>
                                    </div>
                                    <div class="card-body">
                                        <div class="px-3">
                                            <form class="form form-horizontal"
                                                action="{{ route('addition_and_discount.store') }}" method="post">
                                                @csrf
                                                <div class="form-body">
                                                    <h4 class="form-section">
                                                        <i class="icon-user"></i>General information
                                                    </h4>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="projectinput1"> hour
                                                            price:
                                                        </label>
                                                        <div class="col-md-9">
                                                            <input type="number" id="hour_price" class="form-control"
                                                                name="hour_price" placeholder="hour price" value="200">

                                                            @error('hour_price')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror

                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="projectinput1">The extra:
                                                        </label>
                                                        <div class="col-md-9">
                                                            <input type="number" id="addition" class="form-control"
                                                                name="addition" placeholder="write number of addition hour">

                                                            @error('addition')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror

                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="projectinput2">
                                                            Discount: </label>
                                                        <div class="col-md-9">
                                                            <input type="number" id="discount" class="form-control"
                                                                name="discount" placeholder="write number of discount hours"
                                                                onChange="javascript:myFunction()">

                                                            @error('discount')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror

                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="projectinput2">
                                                            Total: </label>
                                                        <div class="col-md-9">
                                                            <input type="number" id="total" class="form-control"
                                                                name="total" readonly>

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
                    <!-- // Basic form layout section end -->
                </div>
            </div>
        </div>

        <footer class="footer footer-static footer-light">
            <p class="clearfix text-muted text-center px-2"><span>Copyright © 2021 <a href="#" id="pixinventLink"
                        target="_blank" class="text-bold-800 primary darken-2">Pioneer solutions </a>, All rights
                    reserved.
                </span></p>
        </footer>

    </div>
@endsection
@section('scripts')
  


    {{-- ///////////////////////////////////////////////////////// --}}

    <script>
        function myFunction() {


            var Addition = parseFloat(document.getElementById('addition').value); //نسبه الضريبه
            var Discount = parseFloat(document.getElementById('discount').value);


            var hour_price = parseFloat(document.getElementById('hour_price').value); // ظقيمة ضريبة القيمة المض

            {{-- if (Discount == '0' || Discount == '') {
                var total = (Addition * hour_price) - Discount;
            } else {
                var total = (Discount * hour_price) - Addition;
            } --}}


                              
                var total = (Addition * hour_price) - (Discount * hour_price);




            document.getElementById("total").value = total; //ارقام عشريه







        }
    </script>

    {{-- ///////////////////////////////////////////////////////// --}}
@endsection
