@extends('backend.layouts.master')
@section('content')
    <div class="main-panel">
        <div class="main-content">
            <div class="content-wrapper">
                <div class="container-fluid">
                    <section id="horizontal-form-layouts">
                        <div class="row">
                            <div class="col-sm-12">
                                <h2 class="content-header">edit Employees Form</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title-wrap bar-success">
                                            <h4 class="card-title" id="horz-layout-basic">Employee Information</h4>
                                        </div>
                                        <p class="mb-0">This is the basic horizontal form with labels on left and cost
                                            estimation form is the default position.</p>
                                    </div>



                                    <div class="col-md-12">
                                        {{-- ################################# --}}
                                        {{-- @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif --}}
                                        {{-- ########################### --}}
                                    </div>



                                    <div class="card-body">
                                        <div class="px-3">

                                            <form class="form form-horizontal"
                                                action="{{ route('employees.update', $employer->id) }}" method="post">
                                                @csrf
                                                @method('patch')
                                                <div class="form-body">
                                                    <h4 class="form-section">
                                                        <i class="icon-user"></i> Personal Details
                                                    </h4>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="projectinput1">First
                                                            Name: </label>
                                                        <div class="col-md-9">
                                                            <input type="text" id="projectinput1" class="form-control"
                                                                name="first_name" value="{{ $employer->first_name }}">

                                                            @error('first_name')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="projectinput2">Address:
                                                        </label>
                                                        <div class="col-md-9">
                                                            <input type="text" id="projectinput2" class="form-control"
                                                                name="address" value="{{ $employer->address }}">

                                                            @error('address')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="projectinput3">E-mail:
                                                        </label>
                                                        <div class="col-md-9">
                                                            <input type="text" id="projectinput3" class="form-control"
                                                                name="email" value="{{ $employer->email }}">

                                                            @error('email')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="projectinput4">Contact
                                                            Number: </label>
                                                        <div class="col-md-9">
                                                            <input type="text" id="projectinput4" class="form-control"
                                                                name="phone" value="{{ $employer->phone }}">


                                                            @error('phone')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <h4 class="form-section">
                                                        <i class="icon-book-open"></i>Other Details
                                                    </h4>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="projectinput9">Date:
                                                        </label>
                                                        <div class="col-md-9">
                                                            <div class="position-relative has-icon-left">
                                                                <input type="date" id="timesheetinput3"
                                                                    class="form-control" name="date"
                                                                    value="{{ $employer->date }}">

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
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="projectinput9">Type: </label>
                                                    <div class="col-md-9">
                                                        <select id="projectinput7" name="type" class="form-control">
                                                            <option value="">-- Gender --</option>
                                                            <option value="mail"
                                                                {{ $employer->type == 'mail' ? 'selected' : '' }}>mail
                                                            </option>


                                                            <option value="femail"
                                                                {{ $employer->type == 'femail' ? 'selected' : '' }}>femail
                                                            </option>


                                                        </select>

                                                        @error('type')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="projectinput10">Date of
                                                        contract: </label>
                                                    <div class="col-md-9">
                                                        <input type="date" id="projectinput10" class="form-control"
                                                            name="date_of_contact"
                                                            value="{{ $employer->date_of_contact }}">


                                                        @error('date_of_contact')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class=" row">
                                                    <div class="col-md-12">
                                                        <div class=" row form-group">
                                                            <label class="col-md-3 label-control">Start time: </label>
                                                            <div class="position-relative has-icon-left col-lg-9">
                                                                <input type="time" id="start_time"
                                                                    class="form-control" name="start_time"
                                                                    value="{{ $employer->start_time }}">


                                                                <div class="form-control-position">
                                                                    <i class="ft-clock"></i>
                                                                </div>

                                                                @error('start_time')
                                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class=" row form-group">
                                                            <label class="col-md-3 label-control">End time: </label>
                                                            <div class="position-relative has-icon-left col-lg-9">
                                                                <input type="time" id="end_time" class="form-control"
                                                                    name="end_time" value="{{ $employer->end_time }}">




                                                                <div class="form-control-position">
                                                                    <i class="ft-clock"></i>
                                                                </div>

                                                                @error('end_time')
                                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>






                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="projectinput7">section:
                                                    </label>
                                                    <div class="col-md-9">
                                                        <select name="section_id" class="form-control show-tick">

                                                            @foreach (\App\Models\section::get() as $section)
                                                                <option value="{{ $section->id }}"
                                                                    {{ $section->id == $employer->section_id ? 'selected' : '' }}>
                                                                    {{ $section->section_name }}
                                                                    </option>
                                                            @endforeach
                                                          
                                                        </select>

                                                        @error('section_id')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>



                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="projectinput7">hour price:
                                                    </label>
                                                    <div class="col-md-9">
                                                        <input type="number" id="hour_price" class="form-control"
                                                            name="hour_price" value="{{ $employer->hour_price }}"
                                                            onChange="javascript:myFunction()">

                                                        @error('salary')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="projectinput7">Salary:
                                                    </label>
                                                    <div class="col-md-9">
                                                        <input type="text" id="salary" class="form-control"
                                                            name="salary" value="{{ $employer->salary }}" readonly>

                                                        @error('salary')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>



                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="projectinput11">National
                                                        ID: </label>
                                                    <div class="col-md-9">
                                                        <input type="text" id="projectinput11" class="form-control"
                                                            name="national_id" value="{{ $employer->national_id }}">


                                                        @error('national_id')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control"
                                                        for="projectinput12">Nationality: </label>
                                                    <div class="col-md-9">
                                                        <input type="text" id="projectinput12" class="form-control"
                                                            name="nationality" value="{{ $employer->nationality }}">

                                                        @error('nationality')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Select File: </label>
                                                    <div class="col-md-9">


                                                        <div class="input-group">
                                                            <span class="input-group-btn">
                                                                <a id="lfm" data-input="thumbnail"
                                                                    data-preview="holder" class="btn btn-primary">
                                                                    <i class="fa fa-picture-o"></i> Choose
                                                                </a>
                                                            </span>
                                                            <input id="thumbnail" class="form-control" type="text"
                                                                name="photo" value="{{ $employer->photo }}">



                                                        </div>


                                                        <div id="holder" style="margin-top:15px;max-height:100px;">
                                                        </div>

                                                        @error('photo')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="projectinput9">Notes:
                                                    </label>
                                                    <div class="col-md-9">
                                                        <textarea id="projectinput9" rows="5" class="form-control" name="note">{{ $employer->note }}</textarea>

                                                        @error('note')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
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
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>

    <footer class="footer footer-static footer-light">
        <p class="clearfix text-muted text-center px-2"><span>Copyright © 2021 <a href="#" id="pixinventLink"
                    target="_blank" class="text-bold-800 primary darken-2">Pioneer solutions </a>, All rights reserved.
            </span></p>
    </footer>
@endsection
@section('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

    <script>
        $('#lfm').filemanager('image');
    </script>




    {{-- ///////////////////////////////////////////////////////// --}}

    <script>
        function myFunction() {


            var start_time = parseFloat(document.getElementById('start_time').value); //نسبه الضريبه
            var end_time = parseFloat(document.getElementById('end_time').value);
            var hour_price = parseFloat(document.getElementById('hour_price').value); // ظقيمة ضريبة القيمة المض


            var full_time = end_time - start_time; // 6 hours example


            var salary = (full_time * hour_price * 22);

            // 6* 50 =300 *22 =6600


            document.getElementById("salary").value = salary; //ارقام عشريه







        }
    </script>

    {{-- ///////////////////////////////////////////////////////// --}}
@endsection
