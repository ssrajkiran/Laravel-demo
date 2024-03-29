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
                        <li class="breadcrumb-item active" aria-current="page">Company list</li>
                        <div class="m-r-5">
                            <a href="{{ route('comapny_create') }}"> <button type="button"
                                    class="btn btn-outline-primary btn-uppercase waves-effect waves-button waves-light"
                                    style="margin-left:700px;">
                                    <i class="fa fa-plus m-r-5"></i> Create Company
                                </button>
                            </a>
                        </div>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- end::page header -->

        <div class="card">

            <div class="card-body">
                <h6 class="card-title"><u>CompanyList</u></h6>
                @include('flash_message')
                @yield('content')

                <div class="form-row">
                    <div class="table-responsive" style="overflow-x: auto; overflow-y: scroll; max-height: 400px;">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">SI</th>

                                    <th scope="col">Company Name</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">City/Town</th>
                                    <th scope="col">State</th>
                                    <th scope="col">Country</th>
                                    <th scope="col">Status</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($company as $company)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>

                                        <td><u><a
                                                    href="{{ url('Setup_company_edit/' . $company->id) }}">{{ $company->company_name }}</u></a>
                                        </td>
                                        <td>{{ $company->location }}</td>
                                        <td>{{ $company->city }}</td>
                                        <td>{{ $company->state }}</td>
                                        <td>{{ $company->country }}</td>
                                        <td>{{ $company->status }}</td>

                                        {{-- <td>



                                   <a href="{{url('Setup_company_delete/'.$company->id)}}"> <i class="ti-trash" onclick="return confirm('Are You Sure')"></i> </td>
                                   </a> --}}
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
