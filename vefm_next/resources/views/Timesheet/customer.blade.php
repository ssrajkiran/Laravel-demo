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
                        <li class="breadcrumb-item active" aria-current="page">Customer</li>
                        <li class="breadcrumb-item active" aria-current="page">Customer Create</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- end::page header -->
        <form action="{{ route('setup_customer_store') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"><u>Customer</u></h6>
                    @include('flash_message')
                    @yield('content')

                    <div class="form-row">




                        <div class="col-md-3 mb-3">
                            <label>Customer Name<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" pattern="[ .a-zA-Z]+"
                                onkeyup="this.value = this.value.toUpperCase();" name="customer_name"
                                value="{{ old('customer_name') }}" required>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Contact Person Name<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="contact_person_name"
                                value="{{ old('contact_person_name') }}"
                                pattern="[ .a-zA-Z]+"onkeyup="this.value = this.value.toUpperCase();"
                                title="Only letters and spaces are allowed" required>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Contact Number<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" pattern="^[6-9]\d{9}$"
                                onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="contact_number"
                                value="{{ old('contact_number') }}" required>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Email<span style="color: red;">*</span></label>
                            <input type="email" class="form-control" name="email_id" id="email_id"
                                value="{{ old('email') }}" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" required>
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <label>Door No/Flat no/Build Name<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="door_flat_no_build_name"
                                value="{{ old('door_flat_no_build_name') }}" required>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Road/Street Name<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="road_street_name"
                                value="{{ old('road_street_name') }}" required>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Area<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="area" value="{{ old('area') }}" required>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>City<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="city" value="{{ old('city') }}" required>
                        </div>

                    </div>

                    <div class="form-row">

                        <div class="col-md-3 mb-3">
                            <label>State<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="state" pattern="[ .a-zA-Z]+"
                                title="Only letters and spaces are allowed" value="{{ old('state') }}" required>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Pincode<span style="color: red;">*</span></label>
                            <input type="text" class="form-control"
                                onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="6"
                                name="pincode" value="{{ old('pincode') }}" required>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>TIN No<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="tin_no" value="{{ old('tin_no') }}" required>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>TAN NO<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="tan_no" value="{{ old('tan_no') }}"
                                required>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>PAN No</label>
                            <input type="text" class="form-control" name="pan_no" value="{{ old('pan_no') }}">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>TDS %<span style="color: red;">*</span></label>
                            <select class="form-control" id="tds_percentage" name="tds_percentage" required>
                                <option value="">Select option</option>
                                <option value="0" {{ old('tds_percentage') == '0' ? 'selected' : '' }}>0</option>
                                <option value="1" {{ old('tds_percentage') == '1' ? 'selected' : '' }}>1</option>
                                <option value="2" {{ old('tds_percentage') == '2' ? 'selected' : '' }}>2</option>
                                <option value="10" {{ old('tds_percentage') == '10' ? 'selected' : '' }}>10</option>
                            </select>
                        </div>


                        <div class="col-md-5 mb-5">
                            <label>Service Tax Exemption<span style="color: red; ">*</span></label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="service_tax_exemption"
                                    id="service_tax_exemption_yes" value="Yes"
                                    {{ old('service_tax_exemption') == 'Yes' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="service_tax_exemption_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="service_tax_exemption"
                                    id="service_tax_exemption_no" value="No"
                                    {{ old('service_tax_exemption') == 'No' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="service_tax_exemption_no">No</label>
                            </div>
                        </div>


                    </div>



                    <button class="btn btn-success" type="submit" style="position: relative;left: 700px;">Submit
                    </button>
                    <a href="{{ route('customer_list') }}" class="btn btn-warning float-left">Cancel</a>
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
            $('#gst_number').on('input', function() {
                var gstNumber = $(this).val();
                if (gstNumber.trim() !== '') {
                    checkGSTNumber(gstNumber);
                }
            });
        });

        function checkGSTNumber(gstNumber) {
            $.ajax({
                url: "{{ route('check_gst_number') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    gst_number: gstNumber
                },
                success: function(response) {
                    if (response.exists) {
                        $('#gst_number_message').text('GST number already exists').addClass('text-danger');
                    } else {
                        $('#gst_number_message').text('');
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }
    </script>
@endpush
