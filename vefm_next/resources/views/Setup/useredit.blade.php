@extends('layout.template')
@section('content')
    <div class="container">

        <!-- begin::page header -->
        <div class="page-header d-md-flex align-items-center justify-content-between">
            <div>
                <h4>Modules</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        {{-- <li class="breadcrumb-item"><a href="#">Business Management System</a></li> --}}
                        <li class="breadcrumb-item"><a href="#">Setup</a></li>
                        <li class="breadcrumb-item " aria-current="page">User</li>
                        <li class="breadcrumb-item active" aria-current="page">User Edit</li>
                    </ol>
                </nav>
            </div>
            <button id="editButton" class="btn btn-primary " type="button">Edit</button>
        </div>
    </div>

    </div>

    <!-- end::page header -->
    <form action="{{ route('updateuser', $user->id) }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-body">
                <h6 class="card-title"><u>User</u></h6>
                @include('flash_message')
                @yield('content')

                <div class="card">
                    <div class="card-body">
                        {{-- <h6 class="card-title">Collection Details</h6> --}}

                        <div class="form-row">
                            <div class="col-md-3 mb-3">
                                <label>Division<span style="color: red;">*</span></label>
                                <select class="form-control" id="division" name="division" required disabled>
                                    <option selected value="{{ $user->division->id }}">{{ $user->division->division_name }}
                                    </option>
                                    @foreach ($divisions as $division)
                                        <option value="{{ $division->id }}">{{ $division->division_name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="col-md-3 mb-3">
                                <label>Unit<span style="color: red;">*</span></label>
                                <select class="form-control" id="unit" name="unit" disabled required>
                                    <option selected value="{{ $user->unit->id }}">{{ $user->unit->unit }}</option>
                                    <!-- Add other default options here if needed -->
                                </select>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Region<span style="color: red;">*</span></label>
                                <select class="form-control" id="region" name="region"  required disabled>
                                    <option selected value="{{ $user->region->id }}">{{ $user->region->region_name }}
                                    </option>
                                    <!-- Add other default options here if needed -->
                                </select>
                            </div>


                            <div class="col-md-3 mb-3">
                                <label>User ID </label>
                                <input type="text" class="form-control" name="user_id" value="{{ $user->user_id }}"
                                    readonly>
                            </div>

                        </div>
                        <div class="form-row">

                            <div class="col-md-3 mb-3">
                                <label>User Name<span style="color: red;">*</span></label>
                                <input type="text" class="form-control" name="user_name" value="{{ $user->name }}"
                                pattern="[ .a-zA-Z]+" title="Only letters and spaces are allowed" disabled required>
                            </div>



                            <div class="col-md-3 mb-3">
                                <label>Designation<span style="color: red;">*</span></label>
                                <input type="text" class="form-control" name="designation"
                                pattern="[ .a-zA-Z]+" title="Only letters and spaces are allowed"  value="{{ $user->designation }}" disabled required>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Email ID<span style="color: red;">*</span></label>
                                <input type="text" class="form-control" name="email_id" id="email_id" value="{{ $user->email_id }}"
                                pattern="[^@\s]+@[^@\s]+\.[^@\s]+"  disabled required>
                                    <span id="email_error" class="text-danger"></span>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Mobile Number<span style="color: red;">*</span></label>
                                <input type="text" class="form-control" name="mobile_number"
                                pattern="^[6-9]\d{9}$" onkeypress='return event.charCode >= 48 && event.charCode <= 57'  value="{{ $user->mobile_number }}" disabled required>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Status<span style="color: red;">*</span></label>
                                <select class="form-control " id="status" name="status" disabled required>
                                    <option selected value="{{$user->status}}">{{$user->status}}</option>
                                    <option disabled>-- Select Status --</option>
                                    <option value ="active">Active</option>
                                    <option value ="Pause">Pause</option>
                                </select>
                            </div>

                        </div>

                        <div class="col-md-3 mb-3" style="padding-top:26px;">
                            <!-- Cancel button with route -->
                            <a href="{{ route('Setup_user_list') }}" class="btn btn-warning float-left">Cancel</a>
                            <button id="updateButton" class="btn btn-success float-right"
                                style="display: none; position: relative;left: 700px;" type="submit">Update</button>
                        </div>

                    </div>





                </div>
            </div>

        </div>
        </div>
    </form>
    </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        'use strict';
        $(document).ready(function() {
            $('#client_id,#country').select2();
        });
        $('#enquiry_due_date,#enquiry_received_date').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            autoclose: true,
            zIndex: 2048,
            format: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            locale: {
                format: 'DD-MM-YYYY',
                zIndex: 2048,
            },
            yearRange: '1950:' + new Date().getFullYear().toString()
        });
        $(document).ready(function() {

            $('input, textarea, select').prop('disabled', true);
            $('#editButton').click(function() {
                $('input, textarea, select').prop('disabled', function(_, val) {
                    return !val;
                });
                $("#editButton").hide();
                $("#updateButton").show(); // Show the update button
            });
        });

        $(document).ready(function () {
    var oldEmail = $('#email_id').val(); // Store the old email ID when the page loads

    $('#email_id').on('input', function () {
        var newEmail = $(this).val();

        // Check if the new email ID is different from the old one
        if (newEmail !== oldEmail) {
            $.ajax({
                url: "{{ url('/check_unique_email') }}",
                type: "POST",
                data: {
                    email: newEmail,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function (response) {
                    if (!response.unique) {
                        $('#email_error').text('Email already exists');
                    } else {
                        $('#email_error').text('');
                    }
                },
                error: function () {
                    $('#email_error').text('Error occurred while checking email');
                }
            });
        } else {
            // If the new email ID is the same as the old one, clear the error message
            $('#email_error').text('');
        }
    });
});



        $(document).ready(function () {
        $('#division').on('change', function () {
            var divisionId = $(this).val();

            $.ajax({
                url: "{{ url('/Setup_unit_fetch') }}",
                type: "POST",
                data: {
                    division: divisionId,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#unit').empty().append('<option value="">-- Select Unit --</option>');
                    $.each(result.units, function (key, value) {
                        $('#unit').append('<option value="' + value.id + '">' + value.unit + '</option>');
                    });
                }
            });
        });

        $('#unit').on('change', function () {
            var unitId = $(this).val();

            $.ajax({
                url: "{{ url('/fetch_regions') }}",
                type: "POST",
                data: {
                    unit: unitId,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#region').empty().append('<option value="">-- Select Region --</option>');
                    $.each(result.regions, function (key, value) {
                        $('#region').append('<option value="' + value.id + '">' + value.region_name + '</option>');
                    });
                }
            });
        });
    });

    </script>
@endpush
