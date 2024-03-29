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
                        <li class="breadcrumb-item active" aria-current="page">Division</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- end::page header -->
        <form action="{{ route('setup_division_store') }}" method="POST">
            @csrf
            <div class="card">
                @include('flash_message')
                @yield('content')
                <div class="card-body">
                    <h6 class="card-title"><u>Division</u></h6>



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
                                    <label for="division">Division<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" autocomplete="off"
                                        value="{{ old('division') }}" id="division" pattern="[ .a-zA-Z0-9]+"
                                        title="Only letters, spaces, and numbers are allowed" name="division" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="division_code">Division Code <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" autocomplete="off"
                                        value="{{ old('division_code') }}" id="division_code" pattern="[ .a-zA-Z0-9]+"
                                        title="Only letters, spaces, and numbers are allowed" name="division_code" required>
                                </div>

                                <div class="col-md-3 mb-3" style="padding-top:26px;">
                                    <button class="btn btn-success form-control" type="submit">submit</button>
                                    <button class="btn btn-warning" type="reset">Cancel</button>
                                </div>

                            </div>

                            <div class="form-row">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">SI</th>
                                                <th scope="col">Company</th>
                                                <th scope="col">Division</th>
                                                <th scope="col">Division Code</th>
                                                <th scope="col">Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($divisions as $division)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $division->company ? $division->company->company_name : 'N/A' }}
                                                    </td>
                                                    <td><u><a
                                                                href="{{ url('Setup_division_edit/' . $division->id) }}">{{ $division->division_name }}</u>
                                                    </td>
                                                    <td>{{ $division->division_code }}</td>
                                                    <td>
                                                        <a href="{{ url('Setup_division_delete/' . $division->id) }}"><i
                                                                class="ti-trash"
                                                                onclick="return confirm('Are You Sure')"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
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
    </script>
@endpush
