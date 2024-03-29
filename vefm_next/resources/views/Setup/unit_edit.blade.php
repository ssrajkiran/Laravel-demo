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
                        <li class="breadcrumb-item " aria-current="page">Unit</li>
                        <li class="breadcrumb-item active" aria-current="page">Unit Edit</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- end::page header -->
        <form action="{{ url('Setup_unitupdate/' . $unit->id) }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"><u>Unit</u></h6>
                    @include('flash_message')
                    @yield('content')
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">



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
                                    <label>Division</label>
                                    <select class="form-control" id="" name="division" disabled>
                                        <option selected value="{{ $unit->division->id }}">
                                            {{ $unit->division->division_name }}
                                        </option>
                                        @foreach ($division as $division)
                                            <option value="{{ $division->id }}">{{ $division->division_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>Unit<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" name="unit" value="{{ $unit->unit }}"
                                        pattern="[ .a-zA-Z0-9]+" title="Only letters, spaces, and numbers are allowed"
                                        disabled required>
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
                    <a href="{{ route('unit_create') }}" class="btn btn-warning">Cancel</a>
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
                $('select[name="division"], input[name="unit"]').prop('disabled', false);
            });
        });
    </script>
@endpush
