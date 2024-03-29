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
                        <li class="breadcrumb-item active" aria-current="page">PO Master List</li>
                    </ol>
                </nav>
            </div>
            <div>
                <button type="button" class="btn btn-outline-primary btn-uppercase waves-effect waves-button waves-light" onclick="location.href='{{ route('pomaster_create') }}'">
                    <i class="fa fa-plus"></i> &nbsp Create PO 
                </button>
            </div>
        </div>
        <!-- end::page header -->

        @include('flash_message')
        @yield('content')


        <div class="card">
            <div class="card-body">
                <h6 class="card-title"><u>PO Master List</u></h6>
                <div class="form-row">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">SI</th>
                                    <th scope="col">Division</th>
                                    <th scope="col">Unit Ref</th>
                                    <th scope="col">Region</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Project Site</th>
                                    <th scope="col">PO Number</th>
                                    <th scope="col">PO Date</th>
                                    <th scope="col">PO Value</th>
                                    <th scope="col">Consumed</th>
                                    <th scope="col">Balance</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pomasters as $index => $pomaster)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $pomaster->division->division_name }}</td>
                                        <td>{{ $pomaster->unit->unit }}</td>
                                        <td>{{ $pomaster->region->region_name }}</td>
                                        <td>{{ $pomaster->customer_id ? $pomaster->customer->customer_name : 'N/A' }}</td>
                                        <td>{{ $pomaster->project_site }}</td>
                                        <td><u> <a href="{{url('Setup_pomaster_edit/'.$pomaster->id)}}">{{ $pomaster->po_number }}</u></td>
                                        <td>{{ $pomaster->po_date }}</td>
                                        <td>{{ $pomaster->po_value }}</td>
                                        <td>{{ $pomaster->consumed }}</td>
                                        <td>{{ $pomaster->balance }}</td>
                                        <td>

                                            <a href="{{url('Setup_pomaster_delete/'.$pomaster->id)}}"><i class="ti-trash"  onclick="return confirm('Are You Sure')"></i></a>
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
