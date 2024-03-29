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
                        <li class="breadcrumb-item " aria-current="page">Engineer</li>
                        <li class="breadcrumb-item active" aria-current="page">Engineer Create</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- end::page header -->
        <form action="{{ route('engineers_store') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"><u>Engineer</u></h6>
                    @include('flash_message')
                    @yield('content')

                    <div class="card">
                        <div class="card-body">
                            {{-- <h6 class="card-title">Collection Details</h6> --}}

                            <div class="form-row">
                                <input type="hidden" id="old_division" value="{{ old('division') }}">
                                <input type="hidden" id="old_unit" value="{{ old('unit') }}">
                                <input type="hidden" id="old_region" value="{{ old('region') }}">

                                <div class="col-md-3 mb-3">
                                    <label for="company">Company</label>
                                    @if ($company->isEmpty())
                                        <input type="text" class="form-control" id="company" name="company"
                                            value="No Company Exists" readonly>
                                    @else
                                        <select class="form-control" id="company" name="company" disabled>
                                            @foreach ($company as $company)
                                                <option value="{{ $company->id }}" {{ $loop->first ? 'selected' : '' }}>
                                                    {{ $company->company_name }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="company_id" id="company_id"
                                            value="{{ $company->first()->id }}">
                                    @endif
                                </div>


                                <div class="col-md-3 mb-3">
                                    <label>Division<span style="color: red;">*</span></label>
                                    <select class="form-control" id="division" name="division" required>
                                        <option>Select Division</option>
                                        @foreach ($divisions as $division)
                                            <option value="{{ $division->id }}"
                                                {{ old('division') == $division->id ? 'selected' : '' }}>
                                                {{ $division->division_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>Unit<span style="color: red;">*</span></label>
                                    <select class="form-control" id="unit" name="unit" required>
                                        <option value="">-- Select Unit --</option>
                                        <!-- You can populate options dynamically based on selected division using JavaScript -->
                                    </select>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>Region<span style="color: red;">*</span></label>
                                    <select class="form-control" id="region" name="region" required>
                                        <option value="">-- Select Region --</option>
                                        <!-- You can populate options dynamically based on selected unit using JavaScript -->
                                    </select>
                                </div>

                            </div>

                            <div class="form-row">

                                <div class="col-md-3 mb-3">
                                    <label>Employee Type<span style="color: red;">*</span></label>
                                    <select class="form-control" id="person_role" name="person_role" required>
                                        <option selected disabled>-- Select Employee Type --</option>
                                        <option value="staff" {{ old('person_role') == 'staff' ? 'selected' : '' }}>Staff
                                        </option>
                                        <option value="engineer" {{ old('person_role') == 'engineer' ? 'selected' : '' }}>
                                            Engineer</option>
                                    </select>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>Engineer Ecode<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" name="engineer_ecode" id="engineer_ecode"
                                        autocomplete="off" value="{{ old('engineer_ecode') }}" required>
                                    <span id="engineer_ecode_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>Engineer Name<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" pattern="[ .a-zA-Z]+" autocomplete="off"
                                        onkeyup="this.value = this.value.toUpperCase();" name="engineer_name"
                                        value="{{ old('engineer_name') }}" required>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>Engineer Designation<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" pattern="[ .a-zA-Z]+" autocomplete="off"
                                        onkeyup="this.value = this.value.toUpperCase();" name="engineer_designation"
                                        value="{{ old('engineer_designation') }}" required>
                                </div>

                            </div>

                            <div class="form-row">

                                <div class="col-md-3 mb-3">
                                    <label>Email ID<span style="color: red;">*</span></label>
                                    <input type="email" class="form-control" name="email_id" id="email_id"
                                        pattern="[^@\s]+@[^@\s]+\.[^@\s]+" autocomplete="off"
                                        value="{{ old('email_id') }}" required>
                                    <span id="email_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>Mobile Number<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" pattern="^[6-9]\d{9}$" autocomplete="off"
                                        onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                        name="mobile_number" value="{{ old('mobile_number') }}" required>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>DOJ<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" name="doj" id="doj"
                                        autocomplete="off" value="{{ old('doj') }}" required>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>DOP<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" name="dop" id="dop"
                                        autocomplete="off" value="{{ old('dop') }}" required>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>Experience (in years)<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" name="experience" id="experience"
                                        value="{{ old('experience') }}" readonly>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>YOCC<span style="color: red;">*</span></label>
                                    <select class="form-control" id="yocc" name="yocc" required>
                                        <option value="">-- Select Year --</option>
                                        <!-- Year options will be dynamically populated here -->
                                    </select>
                                </div>

                                <!-- Add hidden input field to store the old value -->
                                <input type="hidden" id="old_yocc" value="{{ old('yocc') }}">


                                <div class="col-md-3 mb-3">
                                    <label>Eligible Allowances<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" autocomplete="off"
                                        onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                        name="eligible_allowance" id="eligible_allowance"
                                        value="{{ old('eligible_allowance') }}" required>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>Per Day Allowances<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" autocomplete="off"
                                        onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                        name="perday_allowance" id="perday_allowance"
                                        value="{{ old('perday_allowance') }}" required>
                                </div>

                            </div>
                            <div class="form-row">

                                <div class="col-md-3 mb-3">
                                    <label>Bank Name<span style="color: red;">*</span></label>
                                    <select class="form-control" id="bank_name" name="bank_name" required>
                                        <option>Select Bank</option>
                                        @foreach ($bank as $bankOption)
                                            <option value="{{ $bankOption->bank_name }}"
                                                {{ old('bank_name') == $bankOption->bank_name ? 'selected' : '' }}>
                                                {{ $bankOption->bank_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>Account Number<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" autocomplete="off" name="account_number"
                                        id="account_number" value="{{ old('account_number') }}" required>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>IFSC Code<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" autocomplete="off" name="ifsc_code"
                                        id="ifsc_code" value="{{ old('ifsc_code') }}" required>
                                </div>


                            </div>

                        </div>

                        <div>

                            <a href="{{ route('Setup_engineer_list') }}" class="btn btn-warning">Cancel</a>
                            <button class="btn btn-success" type="submit"
                                style="position: relative;left: 700px;">Submit</button>

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
                    $('#doj, #dop').change(function() {
                        var doj = $('#doj').val();
                        var dop = $('#dop').val();

                        if (doj && dop) {
                            var experience = calculateExperience(doj, dop);
                            $('#experience').val(experience);
                        }
                    });
                        $('#doj, #dop').daterangepicker({
                            singleDatePicker: true,
                            showDropdowns: true,
                            autoclose: true,
                            format: 'DD-MM-YYYY',
                            changeMonth: true,
                            changeYear: true,
                            yearRange: '1950:' + new Date().getFullYear().toString(),
                            autoUpdateInput: false // Prevents the date from being automatically updated in the input field
                        });

                        // Handle apply event to set the selected date in the input field
                        $('#doj, #dop').on('apply.daterangepicker', function(ev, picker) {
                            $(this).val(picker.startDate.format('DD-MM-YYYY'));
                        });

                        // Handle cancel event to clear the input field if the date is cleared
                        $('#doj, #dop').on('cancel.daterangepicker', function(ev, picker) {
                            $(this).val('');
                        });
                    });



                    $(document).ready(function() {
                        // Get the current year
                        var currentYear = new Date().getFullYear();
                        var selectYear = $('#yocc');

                        // Populate the dropdown with a range of years
                        for (var year = 2030; year >= 1950; year--) {
                            selectYear.append($('<option>', {
                                value: year,
                                text: year
                            }));
                        }

                        // Set the selected option based on the old value
                        var oldYocc = $('#old_yocc').val();
                        if (oldYocc) {
                            selectYear.val(oldYocc);
                        }
                    });

                    $(document).ready(function() {
                        $('#engineer_ecode').on('input', function() {
                            var engineer_ecode = $(this).val();

                            $.ajax({
                                url: "{{ url('/check_unique_engineer_ecode') }}",
                                type: "POST",
                                data: {
                                    engineer_ecode: engineer_ecode,
                                    _token: '{{ csrf_token() }}'
                                },
                                dataType: 'json',
                                success: function(response) {
                                    if (!response.unique) {
                                        $('#engineer_ecode_error').text(
                                            'Engineer Ecode already exists');
                                    } else {
                                        $('#engineer_ecode_error').text('');
                                    }
                                },
                                error: function() {
                                    $('#engineer_ecode_error').text(
                                        'Error occurred while checking Engineer Ecode ID');
                                }
                            });
                        });
                    });



                    function calculateExperience(doj, dop) {
                        var dateOfJoining = new Date(doj);
                        var dateOfPromotion = new Date(dop);

                        // Calculate the difference in milliseconds
                        var differenceInTime = dateOfPromotion.getTime() - dateOfJoining.getTime();

                        // Calculate the difference in days
                        var differenceInDays = differenceInTime / (1000 * 3600 * 24);

                        // Calculate years of experience
                        var years = Math.floor(differenceInDays / 365);

                        // Calculate remaining days
                        var remainingDays = differenceInDays % 365;

                        // Calculate months
                        var months = Math.floor(remainingDays / 30);

                        // Construct the experience string
                        var experience = years + ' years, ' + months + ' months';

                        return experience;
                    }

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
                                    unitDropdown.empty().append(
                                        '<option value="">-- Select Unit --</option>');
                                    $.each(result.units, function(key, value) {
                                        unitDropdown.append('<option value="' + value.id +
                                            '">' + value
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
                                    regionDropdown.empty().append(
                                        '<option value="">-- Select Region --</option>');
                                    $.each(result.regions, function(key, value) {
                                        regionDropdown.append('<option value="' + value.id +
                                            '">' + value
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
                        $('#email_id').on('input', function() {
                            var email = $(this).val();

                            $.ajax({
                                url: "{{ url('/check_engineer_email') }}",
                                type: "POST",
                                data: {
                                    email: email,
                                    _token: '{{ csrf_token() }}'
                                },
                                dataType: 'json',
                                success: function(response) {
                                    if (!response.unique) {
                                        $('#email_error').text('Email ID already exists');
                                    } else {
                                        $('#email_error').text('');
                                    }
                                },
                                error: function() {
                                    $('#email_error').text(
                                        'Error occurred while checking Email ID');
                                }
                            });
                        });
                    });
    </script>
@endpush
