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
                                            <h4 class="card-title" id="horz-layout-basic">General Settings Form <bold>
                                                    <i>Edit addition and discount </i>
                                                </bold>
                                            </h4>
                                        </div>
                                        <p class="mb-0">This is the basic horizontal form with labels on left and cost
                                            estimation form is the default position.</p>
                                    </div>
                                    <div class="card-body">
                                        <div class="px-3">
                                            <form class="form form-horizontal"
                                                action="{{ route('official_holidays.update', $official_holidays->id) }}"
                                                method="post">
                                                @csrf
                                                @method('patch')
                                                <div class="form-body">
                                                    <h4 class="form-section">
                                                        <i class="icon-user"></i>General information
                                                    </h4>



                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="projectinput7">Section
                                                            Name : </label>
                                                        <div class="col-md-9">
                                                            <select name="section_id" id="section_id"
                                                                class="form-control SlectBox"
                                                                onclick="console.log($(this).val())">

                                                            
                                                                @foreach ($sections as $section)
                                                                    <option value="{{ $section->id }}"
                                                                    {{$section->id == $official_holidays->section_id ? 'selected' : '' }}>

                                                                        {{ $section->section_name }}</option>
                                                                    {{-- //there put section->id to get value by id and show value by name of id --}}
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
                                                                <option value="{{ $official_holidays->employer_id }}">
                                                                    {{ $official_holidays->employer_id }}</option>



                                                            </select>


                                                            @error('employer_id')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>


                                                    @php
                                                        $days = json_decode($official_holidays->week_holiday);
                                                    @endphp

                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="projectinput7">Weekly
                                                            Holidays: </label>
                                                        <div class="col-md-9">

                                                            <input type="checkbox" id="vehicle1" name="week_holiday[]"
                                                                value="Satrday"
                                                                {{ str_contains($official_holidays->week_holiday, 'Satrday') ? 'checked' : '' }}>
                                                            <label for="sat"> Satrday</label><br>
                                                            <input type="checkbox" id="vehicle2"name="week_holiday[]"
                                                                value="Sunday"
                                                                {{ str_contains($official_holidays->week_holiday, 'Sunday') ? 'checked' : '' }}>
                                                            <label for="sun"> Sunday</label><br>
                                                            <input type="checkbox" id="vehicle3" name="week_holiday[]"
                                                                value="Monday"
                                                                {{ str_contains($official_holidays->week_holiday, 'Monday') ? 'checked' : '' }}>
                                                            <label for="mon"> Monday</label><br>
                                                            <input type="checkbox" id="vehicle3" name="week_holiday[]"
                                                                value="thirthday"
                                                                {{ str_contains($official_holidays->week_holiday, 'thirthday') ? 'checked' : '' }}>
                                                            <label for="mon"> thirthday</label><br>
                                                            <input type="checkbox" id="vehicle2" name="week_holiday[]"
                                                                value="Tuesday"
                                                                {{ str_contains($official_holidays->week_holiday, 'Tuesday') ? 'checked' : '' }}>
                                                            <label for="sun"> Tuesday</label><br>
                                                            <input type="checkbox" id="Tue" name="week_holiday[]"
                                                                value="Turthday"
                                                                {{ str_contains($official_holidays->week_holiday, 'Turthday') ? 'checked' : '' }}>
                                                            <label for="sun"> Turthday</label><br>
                                                            <input type="checkbox" id="Tue" name="week_holiday[]"
                                                                value="Friday"
                                                                {{ str_contains($official_holidays->week_holiday, 'Friday') ? 'checked' : '' }}>
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


    {{-- ///////////////////////////////////////////////////////// --}}
@endsection
