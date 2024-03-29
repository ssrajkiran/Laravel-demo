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
                        <li class="breadcrumb-item active" aria-current="page">Customerlist</li>
                    </ol>
                </nav>
            </div>
            <div>
                <button type="button" class="btn btn-outline-primary btn-uppercase waves-effect waves-button waves-light"
                    onclick="location.href='{{ route('setup_customer_create') }}'">
                    <i class="fa fa-plus"></i> &nbsp Create Customer
                </button>
            </div>
        </div>
        <!-- end::page header -->

        <div class="card">
            <div class="card-body">
                <h6 class="card-title"><u>CustomerList</u></h6>
                @include('flash_message')
                @yield('content')

                <div class="form-row">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">SI</th>

                                    <th scope="col">Customer Name</th>
                                    <th scope="col">Contact Number</th>
                                    <th scope="col">Door No/Flat no/Build Name</th>
                                    <th scope="col">City</th>
                                    <th scope="col">Road/Street Name</th>
                                    <th scope="col">Area</th>
                                    <th scope="col">Pincode</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">TIN No</th>
                                    <th scope="col">TAN NO</th>
                                    <th scope="col">PAN No</th>
                                    <th scope="col">Service Tax Exemption</th>
                                    <th scope="col">TDS %</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $customer)
                                    <tr>
                                        <td> {{ $loop->iteration }}</td>
                                        <td><u> <a
                                                    href="{{ url('Setup_customer_edit/' . $customer->id) }}">{{ $customer->customer_name }}</u>
                                        </td>
                                        <td>{{ $customer->contact_number }}</td>
                                        <td>{{ $customer->door_flat_no_build_name }}</td>
                                        <td>{{ $customer->city }}</td>
                                        <td>{{ $customer->road_street_name }}</td>
                                        <td>{{ $customer->area }}</td>
                                        <td>{{ $customer->pincode }}</td>
                                        <td>{{ $customer->email_id }}</td>
                                        <td>{{ $customer->tin_no }}</td>
                                        <td>{{ $customer->tan_no }}</td>
                                        <td>{{ $customer->service_tax_exemption }}</td>
                                        <td>{{ $customer->tds_percentage }}</td>

                                        <td>{{ $customer->gst_number }}</td>

                                        <td>

                                            <a href="{{ url('Setup_customer_delete/' . $customer->id) }}"> <i
                                                    class="ti-trash" onclick="return confirm('Are You Sure')"></i></a>
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
@endsection
