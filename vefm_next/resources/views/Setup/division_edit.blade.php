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
                        <li class="breadcrumb-item " aria-current="page">Division</li>
                        <li class="breadcrumb-item active" aria-current="page">Division Edit</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- end::page header -->
        <form action="{{ url('Setup_division_update/' . $division->id) }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"><u>Division</u></h6>
                    @include('flash_message')
                    @yield('content')
                    <div class="card">
                        <div class="card-body">
                            {{-- <h6 class="card-title">Collection Details</h6> --}}

                            <div class="form-row">
                                <div class="col-md-3 mb-3">
                                    <label for="company">Company</label>
                                    @if ($companies->isEmpty())
                                        <input type="text" class="form-control" id="company" name="company"
                                            value="No Company Exists" readonly>
                                    @else
                                        <select class="form-control" id="company" name="company" disabled>
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->id }}" {{ $loop->first ? 'selected' : '' }}>
                                                    {{ $company->company_name }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="company_id" id="company_id"
                                            value="{{ $companies->first()->id }}">
                                    @endif
                                </div>


                                <div class="col-md-3 mb-3">
                                    <label>Division<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" name="division"
                                        value="{{ $division->division_name }}" readonly id="divisionInput" read>
                                    <!-- Disabled by default -->
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label>Division Code<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" name="division_code" pattern="[ .a-zA-Z0-9]+"
                                        title="Only letters, spaces, and numbers are allowed"
                                        value="{{ $division->division_code }}" disabled id="divisionCodeInput" required>
                                    <!-- Disabled by default -->
                                </div>

                                <div class="col-md-3 mb-3" style="padding-top:26px;">
                                    <!-- Edit button -->
                                    <button id="editButton" class="btn btn-primary" type="button">Edit</button>
                                    <!-- Update button (initially hidden) -->
                                    <button id="updateButton" class="btn btn-success form-control" style="display: none;"
                                        type="submit">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Cancel button with route -->
                    <a href="{{ route('division_create') }}" class="btn btn-warning">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#editButton').click(function() {
                // Hide the Edit button
                $(this).hide();
                // Show the Update button
                $('#updateButton').show();
                // Enable the disabled input fields
                $('input[name="division"], input[name="division_code"]').prop('disabled', false);
            });
        });

        // Initialize select2 and datepicker
        $('#client_id,#country').select2();
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
    </script>
@endpush
