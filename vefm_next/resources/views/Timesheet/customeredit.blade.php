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
                        <li class="breadcrumb-item"><a href="#">Customer</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Customer Edit</li>
                    </ol>
                </nav>
            </div>
            <button id="editButton" class="btn btn-primary " type="button">Edit</button>
        </div>
    </div>
    </div>
    <!-- end::page header -->
    <form action="{{ url('Setup_customer_update/' . $customer->id) }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-body">
                <h6 class="card-title"><u>Customer</u></h6>
                @include('flash_message')
                @yield('content')

                <div class="form-row">
                    <div class="col-md-3 mb-3">
                        <label>Customer_name<span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="customer_name"
                            value="{{ $customer->customer_name }}" disabled required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Contact Person Name<span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="contact_person_name"
                            value="{{ $customer->contact_person_name }}" pattern="[ .a-zA-Z]+"
                            title="Only letters and spaces are allowed" disabled required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Contact Number<span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="contact_number"
                            value="{{ $customer->contact_number }}" disabled required>
                    </div>
                    <div class="col-md-3  mb-3">
                        <label>Door No/Flat no/Build Name<span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="door_flat_no_build_name"
                            value="{{ $customer->door_flat_no_build_name }}"disabled required>
                    </div>

                </div>

                <div class="form-row">

                    <div class="col-md-3 mb-3">
                        <label>City<span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="city" value="{{ $customer->city }}" disabled
                            required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Road/Street Name<span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="road_street_name"
                            value="{{ $customer->road_street_name }}" disabled required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Area<span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="area" value="{{ $customer->area }} " disabled
                            required>
                    </div>
                    <div class="col-md-3  mb-3">
                        <label>Pincode<span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="pincode" value="{{ $customer->pincode }}" disabled
                            required>
                    </div>

                </div>

                <div class="form-row">
                    <div class="col-md-3 mb-3">
                        <label>State<span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="state" value="{{ $customer->state }}"disabled
                            required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Email<span style="color: red;">*</span></label>
                        <input type="email" class="form-control" name="email" value="{{ $customer->email_id }}"disabled
                            required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>TIN No<span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="tin_no" value="{{ $customer->tin_no }}"disabled
                            required>
                    </div>
                    <div class="col-md-3  mb-3">
                        <label>TAN NO<span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="tan_no" value="{{ $customer->tan_no }}" disabled
                            required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>PAN No</label>
                        <input type="text" class="form-control" name="pan_no" value="{{ $customer->pan_no }}"
                            disabled>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>TDS %<span style="color: red;">*</span></label>
                        <select class="form-control" id="tds_percentage" name="tds_percentage" required>
                            <option>Select option</option>
                            <option value="0" {{ $customer->tds_percentage == 0 ? 'selected' : '' }}>0</option>
                            <option value="1" {{ $customer->tds_percentage == 1 ? 'selected' : '' }}>1</option>
                            <option value="2" {{ $customer->tds_percentage == 2 ? 'selected' : '' }}>2</option>
                            <option value="10" {{ $customer->tds_percentage == 10 ? 'selected' : '' }}>10</option>
                        </select>
                    </div>
                    
                    <div class="col-md-3 mb-3">
                        <label>Service Tax Exemption<span style="color: red;">*</span></label>
                        <input type="radio" name="service_tax_exemption" id="service_tax_exemption_yes" value="Yes"
                            {{ $customer->service_tax_exemption == 'Yes' ? 'checked' : '' }}> Yes
                        <input type="radio" name="service_tax_exemption" id="service_tax_exemption_no" value="No"
                            {{ $customer->service_tax_exemption == 'No' ? 'checked' : '' }}> No
                    </div>
                </div>



            </div>

            <div class="col-md-3 mb-3" style="padding-top:26px;">
                <!-- Cancel button with route -->
                <a href="{{ route('customer_list') }}" class="btn btn-warning float-left">Cancel</a>
                <button id="updateButton" class="btn btn-success float-right"
                    style="display: none; position: relative;left: 700px;" type="submit">Update</button>
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
    </script>
@endpush
