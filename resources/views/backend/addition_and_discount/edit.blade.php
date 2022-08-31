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
                                            <h4 class="card-title" id="horz-layout-basic">General Settings Form <bold><i>Edit addition and discount </i></bold> </h4>
                                        </div>
                                        <p class="mb-0">This is the basic horizontal form with labels on left and cost
                                            estimation form is the default position.</p>
                                    </div>
                                    <div class="card-body">
                                        <div class="px-3">
                                            <form class="form form-horizontal"
                                                action="{{ route('addition_and_discount.update',$addition_and_discounts->id) }}" method="post">
                                                @csrf
                                                        @method('patch')
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
                                                                name="hour_price" placeholder="hour price" value="{{ $addition_and_discounts->hour_price }}">

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
                                                                name="addition" placeholder="write number of addition hour" value="{{ $addition_and_discounts->addition }}">

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
                                                                onChange="javascript:myFunction()" value="{{ $addition_and_discounts->discount }}">

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
                                                                name="total" readonly value="{{ $addition_and_discounts->total }}">

                                                        </div>
                                                    </div>

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
                                                            <select id="employer_id" name="employer_id" class="form-control" >
                                                                     @foreach ($employers as $employer)
                                                                    <option value="{{ $employer->id }}" {{$employer->id==$addition_and_discounts->employer_id? 'selected' : ''}}>
                                                                        {{ $employer->first_name }}</option>
                                                                @endforeach


                                                            </select>


                                                            @error('employer_id')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>


                                                    @php 
                                                     $days = json_decode($addition_and_discounts->week_holiday);
                                                    @endphp 

                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="projectinput7">Weekly
                                                            Holidays: </label>
                                                        <div class="col-md-9">

                                                            <input type="checkbox" id="vehicle1" name="week_holiday[]"
                                                                value="Satrday" {{  str_contains($addition_and_discounts->week_holiday,'Satrday') ? 'checked':''  }}>
                                                            <label for="sat"> Satrday</label><br>
                                                            <input type="checkbox" id="vehicle2"name="week_holiday[]"  
                                                                value="Sunday"  {{  str_contains($addition_and_discounts->week_holiday,'Sunday') ? 'checked':''  }}>
                                                            <label for="sun"> Sunday</label><br>
                                                            <input type="checkbox" id="vehicle3" name="week_holiday[]"
                                                                value="Monday"  {{  str_contains($addition_and_discounts->week_holiday,'Monday') ? 'checked':''  }}>
                                                            <label for="mon"> Monday</label><br>
                                                            <input type="checkbox" id="vehicle3" name="week_holiday[]"
                                                               value="thirthday" {{  str_contains($addition_and_discounts->week_holiday,'thirthday') ? 'checked':''  }}>
                                                            <label for="mon"> thirthday</label><br>
                                                            <input type="checkbox" id="vehicle2" name="week_holiday[]"
                                                               value="Tuesday"  {{  str_contains($addition_and_discounts->week_holiday,'Tuesday') ? 'checked':''  }}>
                                                            <label for="sun"> Tuesday</label><br>
                                                            <input type="checkbox" id="Tue" name="week_holiday[]"
                                                               value="Turthday"  {{  str_contains($addition_and_discounts->week_holiday,'Turthday') ? 'checked':''  }}>
                                                            <label for="sun"> Turthday</label><br>
                                                            <input type="checkbox" id="Tue" name="week_holiday[]"
                                                                value="Friday" {{  str_contains($addition_and_discounts->week_holiday,'Friday') ? 'checked':''  }}>
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
