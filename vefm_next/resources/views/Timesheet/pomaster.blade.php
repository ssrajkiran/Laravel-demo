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
                        <li class="breadcrumb-item active" aria-current="page">PO Master</li>
                        <li class="breadcrumb-item active" aria-current="page">PO Master Create</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- end::page header -->
        <form action="{{ route('setup_pomaster_store') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"><u>PO Master</u></h6>
                    @include('flash_message')
                    @yield('content')


                    <div class="card">
                        <div class="card-body">
                            {{-- <h6 class="card-title">Collection Details</h6> --}}
                            <input type="hidden" id="old_division" value="{{ old('division') }}">
                            <input type="hidden" id="old_unit" value="{{ old('unit') }}">
                            <input type="hidden" id="old_region" value="{{ old('region') }}">
                            <div class="form-row">
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

                                <div class="col-md-3 mb-3">
                                    <label>Customer<span style="color: red;">*</span></label>
                                    <select class="form-control" id="customer" name="customer" pattern="[ .a-zA-Z]+"
                                    title="Only letters and spaces are allowed" required>
                                        <option>Select Customer</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}"
                                                {{ old('customer') == $customer->id ? 'selected' : '' }}>
                                                {{ $customer->customer_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>



                            </div>

                            <div class="form-row">

                                <div class="col-md-3 mb-3">
                                    <label>Project Site<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" name="project_site" pattern="[ .a-zA-Z]+"
                                           title="Only letters and spaces are allowed" value="{{ old('project_site') }}" autocomplete="off" required>
                                </div>
                                

                                <div class="col-md-3 mb-3">
                                    <label>PO Number<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" name="po_number"  onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"
                                        value="{{ old('po_number') ? strtoupper(old('po_number')) : '' }}" required>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>PO Date<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" name="po_date" id="po_date"
                                        value="{{ old('po_date') }}" autocomplete="off" required>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>PO Value<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" name="po_value" id="po_value" value="{{ old('po_value') }}"
                                        onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 46" required>
                                </div>
                                <div class="col-md-3 mb-3" style="display: none;">
                                    <label>PO Value<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" name="consumed" id="consumed" value="0"
                                        onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 46" required>
                                </div>
                                

                            </div>

                            <div class="form-row">


                                <div class="col-md-3 mb-3">
                                    <label>Balance</label>
                                    <input type="text" class="form-control" id="balance" name="balance" value=""
                                        readonly>
                                </div>

                            </div>
                            <div>

                                <a href="{{ route('pomaster_list') }}" class="btn btn-warning float-left">Cancel</a>
                                <button class="btn btn-success" type="submit"
                                    style="position: relative;left: 700px;">Submit</button>

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

        function calculateBalance() {
            var poValue = parseFloat(document.getElementById('po_value').value) || 0;
            var consumed = parseFloat(document.getElementById('consumed').value) || 0;
            var balance = poValue - consumed;
            document.getElementById('balance').value = balance.toFixed(2);
        }

        // Event listeners to trigger balance calculation
        document.getElementById('po_value').addEventListener('input', calculateBalance);
        document.getElementById('consumed').addEventListener('input', calculateBalance);

        // Calculate balance initially when the page loads
        calculateBalance();

        $(document).ready(function() {
            $('#po_date').select2();

            function calculateBalance() {
                var poValue = parseFloat($('#po_value').val()) || 0;
                var consumed = parseFloat($('#consumed').val()) || 0;

                var balance = poValue - consumed;
                $('#balance').val(balance);
            }

            $('#po_value, #consumed').on('input', function() {
                calculateBalance();
            });

            calculateBalance();
        });


        $(document).ready(function() {
    $('#po_date').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        autoclose: true,
        zIndex: 2048,
        format: 'DD-MM-YYYY',
        changeMonth: true,
        changeYear: true,
        locale: {
            format: 'DD-MM-YYYY',
            zIndex: 2048,
        },
        yearRange: '1950:' + new Date().getFullYear().toString(),
        autoUpdateInput: false // Prevents the date from being automatically updated in the input field
    });

    // Clear the input field when the date is cleared
    $('#po_date').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY'));
    });

    // Clear the input field when the date is cleared
    $('#po_date').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });
});


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
            $('#po_date').select2();

            // Function to calculate remaining balance
            function calculateBalance() {
                var poValue = parseFloat($('#po_value').val()) ||
                0; // Get PO value, default to 0 if empty or invalid
                var consumed = parseFloat($('#consumed').val()) ||
                0; // Get consumed value, default to 0 if empty or invalid

                // Calculate remaining balance
                var balance = poValue - consumed;

                // Update balance input field
                $('#balance').val(balance);
            }

            // Add event listeners to PO value and consumed value input fields
            $('#po_value, #consumed').on('input', function() {
                calculateBalance(); // Call the function to calculate remaining balance
            });

            // Call the function initially to calculate balance based on initial values
            calculateBalance();
        });
    </script>
@endpush
