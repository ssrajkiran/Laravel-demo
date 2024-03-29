@extends('layout.template')
@section('content')
    <div class="container">

        <!-- begin::page header -->
        <div class="page-header d-md-flex align-items-center justify-content-between">
            <div>
                <h4>Modules</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Setup</a></li>
                        <li class="breadcrumb-item"><a href="#">User</a></li>
                        <li class="breadcrumb-item active" aria-current="page">User Create</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- end::page header -->

        <form action="{{ route('setup_user_store') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"><u>User</u></h6>
                    @include('flash_message')
                    @yield('content')
                    <input type="hidden" id="old_division" value="{{ old('division') }}">
                    <input type="hidden" id="old_unit" value="{{ old('unit') }}">
                    <input type="hidden" id="old_region" value="{{ old('region') }}">

                    <div class="form-row">

                        <div class="col-md-3 mb-3">
                            <label>Name<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="name" id="name"
                                value="{{ old('name') }}" pattern="[ .a-zA-Z]+"
                                title="Only letters and spaces are allowed" required>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Person Role<span style="color: red;">*</span></label>
                            <select class="form-control" id="person_role" name="person_role" required>
                                <option value="" selected disabled>-- Select Role --</option>
                                <option value="all_division" {{ old('person_role') == 'all_division' ? 'selected' : '' }}>All Division</option>
                                <option value="super_user" {{ old('person_role') == 'super_user' ? 'selected' : '' }}>Super User</option>
                                <option value="user" {{ old('person_role') == 'user' ? 'selected' : '' }}>User</option>
                                <option value="unit_user" {{ old('person_role') == 'unit_user' ? 'selected' : '' }}>Unit User</option>
                                <option value="engineer" {{ old('person_role') == 'engineer' ? 'selected' : '' }}>Engineer</option>
                            </select>
                        </div>
                        
                        

                        <div class="col-md-3 mb-3">
                            <label>Division<span style="color: red;">*</span></label>
                            <select class="form-control" id="division" name="division" required>
                                <option value="" selected disabled>-- Select Division --</option>
                                @foreach ($division as $divisionItem)
                                    <option value="{{ $divisionItem->id }}" {{ old('division') == $divisionItem->id ? 'selected' : '' }}>
                                        {{ $divisionItem->division_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        

                        <div class="col-md-3 mb-3">
                            <label>Unit<span style="color: red;">*</span></label>
                            <select class="form-control" id="unit" name="unit" value="{{ old('unit') }}"
                                required>
                                <option value="">-- Select Unit --</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">

                        <div class="col-md-3 mb-3">
                            <label>Region<span style="color: red;">*</span></label>
                            <select class="form-control" id="region" name="region" value="{{ old('region') }}"
                                required>
                                <option value="">-- Select Region --</option>
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>User ID<span style="color: red;">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" id="user_id" value="VE-" name="user_id" readonly style="text-align: center;">

                                <input type="text" class="form-control" name="user_id"
                                    id="user_id"required>
                                </div>
                                <span id="user_id_error" class="text-danger"></span>

                        </div>

                        <div class="col-md-3 mb-3">
                            <label>User Password<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="password" id="password"
                              required>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Designation<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="designation" id="designation"
                                pattern="[ .a-zA-Z]+" title="Only letters and spaces are allowed"
                                value="{{ old('designation') }}" required>
                        </div>
                    </div>
                    <div class="form-row">


                        <div class="col-md-3 mb-3">
                            <label>Email<span style="color: red;">*</span></label>
                            <input type="email" class="form-control" name="email_id" id="email_id"
                                pattern="[^@\s]+@[^@\s]+\.[^@\s]+"  required>
                            <span id="email_error" class="text-danger"></span>
                        </div>


                        <div class="col-md-3 mb-3">
                            <label>Mobile Number<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="mobile_number"
                                id="mobile_number"pattern="^[6-9]\d{9}$"
                                onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                value="{{ old('mobile_number') }}" required>
                        </div>

                    </div>

                    <button class="btn btn-success" type="submit" style="position: relative;left: 700px;">Submit
                    </button>
                    <a href="{{ route('Setup_user_list') }}" class="btn btn-warning">Cancel</a>
                </div>





            </div>
    </div>
    </form>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        'use strict';
        $(document).ready(function() {
            // Function to fetch units based on division
            function fetchUnits(divisionId) {
                $.ajax({
                    url: "{{ url('/Setup_unit_fetch') }}",
                    type: "POST",
                    data: {
                        division: divisionId,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        var unitDropdown = $('#unit');
                        unitDropdown.empty().append('<option value="">-- Select Unit --</option>');
                        $.each(result.units, function(key, value) {
                            unitDropdown.append('<option value="' + value.id + '">' + value
                                .unit + '</option>');
                        });

                        // Set selected option based on old input value
                        var oldUnit = $('#old_unit').val();
                        if (oldUnit) {
                            unitDropdown.val(oldUnit);
                            // Fetch regions for the old unit
                            fetchRegions(oldUnit);
                        }
                    }
                });
            }

            // Function to fetch regions based on unit
            function fetchRegions(unitId) {
                $.ajax({
                    url: "{{ url('/fetch_regions') }}",
                    type: "POST",
                    data: {
                        unit: unitId,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        var regionDropdown = $('#region');
                        regionDropdown.empty().append('<option value="">-- Select Region --</option>');
                        $.each(result.regions, function(key, value) {
                            regionDropdown.append('<option value="' + value.id + '">' + value
                                .region_name + '</option>');
                        });

                        // Set selected option based on old input value
                        var oldRegion = $('#old_region').val();
                        if (oldRegion) {
                            regionDropdown.val(oldRegion);
                        }
                    }
                });
            }

            // Fetch units when division dropdown changes
            $('#division').on('change', function() {
                var divisionId = $(this).val();
                fetchUnits(divisionId);
            });

            // Fetch regions when unit dropdown changes
            $('#unit').on('change', function() {
                var unitId = $(this).val();
                fetchRegions(unitId);
            });

            // Call fetchUnits and fetchRegions on page load if old values are available
            var oldDivision = $('#old_division').val();
            if (oldDivision) {
                fetchUnits(oldDivision);
            }

            var oldUnit = $('#old_unit').val();
            if (oldUnit) {
                $('#unit').val(oldUnit).trigger('change');
            }

            var oldRegion = $('#old_region').val();
            if (oldRegion) {
                $('#region').val(oldRegion);
            }
        });

        $(document).ready(function() {
    // Function to check if the User ID already exists
    $('#user_id').on('input', function() {
        var userId = $(this).val();

        $.ajax({
            url: "{{ url('/check_unique_user_id') }}",
            type: "POST",
            data: {
                user_id: userId,
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function(response) {
                if (!response.unique) {
                    $('#user_id_error').text('User ID already exists');
                    disableSubmitButton(); // Disable submit button
                } else {
                    $('#user_id_error').text('');
                    enableSubmitButton(); // Enable submit button if no error
                }
            },
            error: function() {
                $('#user_id_error').text('Error occurred while checking User ID');
                disableSubmitButton(); // Disable submit button on error
            }
        });
    });

    // Function to enable submit button
    function enableSubmitButton() {
        var userIdError = $('#user_id_error').text();
        var emailError = $('#email_error').text();

        if (!userIdError && !emailError) {
            $('#submitButton').prop('disabled', false); // Enable submit button
        }
    }

    // Function to disable submit button
    function disableSubmitButton() {
        $('#submitButton').prop('disabled', true); // Disable submit button
    }

    // Function to check if the email already exists
    $('#email_id').on('input', function() {
        var email = $(this).val();

        $.ajax({
            url: "{{ url('/check_unique_email') }}",
            type: "POST",
            data: {
                email: email,
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function(response) {
                if (!response.unique) {
                    $('#email_error').text('Email already exists');
                    disableSubmitButton(); // Disable submit button
                } else {
                    $('#email_error').text('');
                    enableSubmitButton(); // Enable submit button if no error
                }
            },
            error: function() {
                $('#email_error').text('Error occurred while checking email');
                disableSubmitButton(); // Disable submit button on error
            }
        });
    });

    // Prevent form submission if there are errors
    $('#userForm').submit(function(event) {
        var userIdError = $('#user_id_error').text();
        var emailError = $('#email_error').text();

        if (userIdError || emailError) {
            event.preventDefault(); // Prevent form submission
            alert('Please fix the errors before submitting the form.');
        }
    });
});

    </script>

    </script>
@endpush
