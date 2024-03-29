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
                        <li class="breadcrumb-item " aria-current="page">Engineer</li>
                        <li class="breadcrumb-item active" aria-current="page">Engineer List</li>
                    </ol>
                </nav>
            </div>
            <div>
                <button type="button" class="btn btn-outline-primary btn-uppercase waves-effect waves-button waves-light" onclick="location.href='{{ route('Setup_engineer') }}'">
                    <i class="fa fa-plus"></i> &nbsp Create Engineer
                </button>
            </div>
        </div>
        <!-- end::page header -->

        <div class="card">
            <div class="card-body">
                <h6 class="card-title"><u>Engineer List</u></h6>
                @include('flash_message')
                @yield('content')

                <div class="form-row">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">SI</th>
                                    <th scope="col">Engineer Ecode</th>
                                    <th scope="col">Engineer Name</th>
                                    <th scope="col">Engineer Designation</th>
                                    <th scope="col">Email ID</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($engineer as $engineer)
                                <tr>
                                    <td> {{ $loop->iteration }}</td>
                                    <td><u> <a href="{{url('Setup_engineer_edit/'.$engineer->id)}}">{{ $engineer->engineer_ecode }}</u></td>
                                    <td>{{ $engineer->engineer_name }}</u></td>
                                    <td>{{ $engineer->engineer_designation }}</td>
                                    <td>{{ $engineer->email_id }}</td>
                                    <td>
                                        <a href="{{url ('Setup_engineerdelete/'.$engineer->id)}}"> <i class="ti-trash"  onclick="return confirm('Are You Sure')"></i></a>
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
