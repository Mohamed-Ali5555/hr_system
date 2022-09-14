@extends('backend.layouts.master')
@section('content')
    <div class="main-panel">
        <div class="main-content">
            <div class="content-wrapper">
                <div class="container-fluid">
                    <section class="invoice-template" id="print">
                        <div class="card">
                            <div class="card-body p-3">
                                <div id="invoice-template" class="card-block" >
                                    <!-- Invoice Company Details -->
                                    <div id="invoice-company-details" class="row">
                                        <div class="col-6 text-left">
                                            <img src="{{asset('backend/assets/img/logo.png')}}" alt="company logo" class="mb-2"
                                                width="70">
                                            <ul class="px-0 list-unstyled">
                                                <li class="text-bold-800">Pioneer Solutions Company </li>
                                                <li>Cairo,</li>
                                                <li>Naser City ,</li>
                                                <li>102 Makrim Ebid,</li>

                                            </ul>
                                        </div>
                                        <div class="col-6 text-right">
                                            <h2>INVOICE</h2>
                                            <p class="pb-3"># INV-001001</p>
                                            <ul class="px-0 list-unstyled">
                                                <li>Balance Due</li>
                                                <li class="lead text-bold-800">2100 $</li>
                                            </ul>
                                        </div>
                                    </div>

                                    <!--/ Invoice Customer Details -->
                                    <!-- Invoice Items Details -->
                                    <div id="invoice-items-details" class="pt-2">
                                        <div class="row">
                                            <table class="table table-striped table-bordered zero-configuration mt-40 table-responsive">
                                                <thead>
                                                    <tr>
                                                       <th>Id</th>
                                                        <th>Employee Name</th>
                                                        <th>section Name</th>
                                                        {{-- <th>Phone</th> --}}
                                                        <th>Salary</th>
                                                        <th>hour price</th>
                                                        <th> Discount hours</th>
                                                        <th> Addition hours</th>

                                                        {{-- <th>week_holiday days</th> --}}
                                                        <th> total</th>
                                                        <th>attendance days days</th>
                                                        <th>upsent days days</th>
                                                        <th> all Total</th>

                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    {{-- @if ($salary_reports->count() > 0)
                                                        <?php $i = 0; ?>
                                                        @foreach ($salary_reports as $salary_report) --}}
                                                            {{-- <?php $i++; ?> --}}
                                                            <tr>
                                                                <td>{{ $salary_reports->id }}</td>
                                                                 <td> {{ $salary_reports->employer->first_name }}</td>
                                                                <td> {{ $salary_reports->section->section_name }}</td>
                                                                {{-- <td> {{ $salary_reports->employer->phone }}</td> --}}

                                                                <td> {{ $salary_reports->employer->salary }}</td>
                                                                <td> {{ $salary_reports->hour_price }}</td>
                                                                <td> {{ $salary_reports->discount }}</td>
                                                                <td> {{ $salary_reports->addition }}</td>
                                                                {{-- <td> {{ $salary_reports->week_holiday }}</td> --}}
                                                                <td> {{ $salary_reports->total }}</td>
                                                                <td> {{ $salary_reports->attendance }}</td>
                                                                <td> {{ $salary_reports->upsent }}</td>

                                                                <td> {{ $salary_reports->all_total }}</td>




                                                            </tr>
                                                        {{-- @endforeach
                                                    @endif --}}




                                                </tbody>

                                            </table>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 text-left">
                                                <p class="lead">Payment Methods:</p>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <table class="table table-borderless table-sm">
                                                            <tbody>
                                                                <tr>
                                                                    <td>Bank name:</td>
                                                                    <td class="text-right">ABC Bank, USA</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Acc name:</td>
                                                                 <td class="text-right"> {{ $salary_reports->employer->first_name }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>IBAN:</td>
                                                                    <td class="text-right">FGS165461646546AA</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>SWIFT code:</td>
                                                                    <td class="text-right">BTNPP34</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <p class="lead">Total due</p>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td>Sub Total</td>
                                                                <td class="text-right">$ 14,900.00</td>
                                                            </tr>
                                                            <tr>
                                                                <td>TAX (12%)</td>
                                                                <td class="text-right">$ 1,788.00</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold-800">Total</td>
                                                                <td class="text-bold-800 text-right"> $ 16,688.00</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Payment Made</td>
                                                                <td class="pink text-right">(-) $ 4,688.00</td>
                                                            </tr>
                                                            <tr class="bg-grey bg-lighten-4">
                                                                <td class="text-bold-800">Balance Due</td>
                                                                <td class="text-bold-800 text-right">$ 12,000.00</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="text-center">
                                                    <p>Authorized person</p>
                                                    <img src="{{asset('backend/assets/img/pages/signature-scan.png')}}" alt="signature"
                                                        class="width-250">
                                                    <h6>{{\Auth::user()->name }}</h6>
                                                    <p class="text-muted">Managing Director</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Invoice Footer -->
                                    <div id="invoice-footer">
                                        <div class="row">
                                            <div class="col-md-9 col-sm-12">
                                                <h6>Terms &amp; Condition</h6>
                                                <p>You know, being a test pilot isn't always the healthiest business in the
                                                    world. We predict too
                                                    much for the next year and yet far too little for the next 10.</p>
                                            </div>
                                            <div class="col-md-3 col-sm-12 text-center">
                                                <button  class="btn btn-primary my-1"  onclick="printDiv()" id="print_div"><i
                                                        class="fa fa-paper-plane-o" ></i> print Invoice</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/ Invoice Footer -->
                                </div>
                            </div>
                        </div>
                    </section>
                    <!--Invoice template ends-->
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
 <script>
         {{-- alert ('fffff'); --}}
     function printDiv(){
         var printContents = document.getElementById('print').innerHTML;
           {{-- alert ('printContents'); --}}
         var originalContents = document.body.innerHTML;
         document.body.innerHTML = printContents;
         window.print();
         document.body.innerHTML = originalContents;
         location.reload();
     }
    
    
    </script>
@endsection