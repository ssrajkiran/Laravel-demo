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
                        <li class="breadcrumb-item " aria-current="page">Region</li>
                        <li class="breadcrumb-item active" aria-current="page">Region Edit</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- end::page header -->
        <form action="{{ url('Setup_regionupdate/' . $region->id) }}" method="POST">
            @csrf

            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"><u>Region</u></h6>
                    @include('flash_message')
                    @yield('content')
                    <div class="card">
                        <div class="card-body">
                            {{-- <h6 class="card-title">Collection Details</h6> --}}

                            <div class="form-row">

                                <div class="col-md-2 mb-3">
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

                                <div class="col-md-2 mb-3">
                                    <label>Division</label>
                                    <select class="form-control" id="division" name="division" readonly>
                                        <option value="{{ $region->division->id }}">{{ $region->division->division_name }}
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-2 mb-3">
                                    <label>Unit</label>
                                    <select class="form-control" id="unit" name="unit" readonly>
                                        <option selected value="{{ $region->units->id }}">{{ $region->units->unit }}
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-2 mb-3">
                                    <label>Region<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" name="region"
                                        value="{{ $region->region_name }}" disabled required>
                                </div>

                                <div class="col-md-2 mb-3">
                                    <label>Region Code<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" name="region_code"
                                        value="{{ $region->region_code }}" pattern="[ .a-zA-Z]+"
                                        title="Only letters and spaces are allowed" disabled required>
                                </div>

                                <div class="col-md-2 mb-3">
                                    <label>Invoice Code<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" name="invoice_code"
                                        value="{{ $region->invoice_code }}" pattern="[ .a-zA-Z]+"
                                        title="Only letters and spaces are allowed" disabled required>
                                </div>

                                <div class="col-md-3 mb-3" style="padding-top:26px;">
                                    <!-- Edit button -->
                                    <button id="editButton" class="btn btn-primary" type="button">Edit</button>
                                    <!-- Update button (initially hidden) -->
                                    <button id="updateButton" class="btn btn-success form-control" style="display: none;"
                                        type="submit">Update</button>
                                    <a href="{{ route('region_create') }}" class="btn btn-warning">Cancel</a>
                                </div>
                            </div>



                        </div>
                    </div>

                </div>
            </div>
        </form>
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
                $('#division, #unit, input[name="region"], input[name="region_code"], input[name="invoice_code"]')
                    .prop('disabled', false);
            });
        });
    </script>
@endpush
