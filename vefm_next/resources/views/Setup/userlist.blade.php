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
                        <li class="breadcrumb-item active" aria-current="page">User List</li>
                    </ol>
                </nav>
            </div>
            <div>
                <button type="button" class="btn btn-outline-primary btn-uppercase waves-effect waves-button waves-light" onclick="location.href='{{ route('user_createpage') }}'">
                    <i class="fa fa-plus"></i> &nbsp Create User
                </button>
            </div>
        </div>
        <!-- end::page header -->

        <div class="card">
            <div class="card-body">
                <h6 class="card-title"><u>UserList</u></h6>
                @include('flash_message')
                @yield('content')

                <div class="form-row">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">SI</th>
                                    <th scope="col">User ID</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Designation</th>
                                    <th scope="col">Email ID</th>
                                    <th scope="col">Mobile Number</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $user)
                                <tr>
                                    <td>  {{ $loop->iteration }}</td>
                                    <td> <u><a href="{{url('Setup_user_edit/'.$user->id)}}">{{ $user->user_id}}</u></td>
                                    <td>{{ $user->name}}</td>
                                    <td>{{ $user->designation}}</td>
                                    <td>{{ $user->email_id}}</td>
                                    <td>{{ $user->mobile_number}}</td>
                                    <td>

                                        <a href="{{url('Setup_user_delete/'.$user->id)}}"> <i class="ti-trash"  onclick="return confirm('Are You Sure')"></i></a>
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
