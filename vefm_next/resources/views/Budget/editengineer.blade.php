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
                    <li class="breadcrumb-item active" aria-current="page">Engineer Edit</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- end::page header -->
    <form action="{{ url('update_engineer/'.$engineer->id)}}" method="POST">
        @csrf
        <div class="card">
            <div class="card-body">
                <h6 class="card-title"><u>Unit</u></h6>

                <div class="card">
                    @include('flash_message')
                    @yield('content')
                    <div class="card-body">
                       
                        <div class="form-row">
                            <div class="col-md-3 mb-3">
                                <label>Engineer Ecode</label>
                                <input type="text" class="form-control" name="engineer_ecode" value="{{$engineer->engineer_ecode}}" readonly required>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Engineer Name</label>
                                <input type="text" class="form-control" name="engineer_name" value="{{$engineer->engineer_name}}" disabled required>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Engineer Designation</label>
                                <input type="text" class="form-control" name="engineer_designation" value="{{$engineer->engineer_designation}}" disabled required>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Email ID</label>
                                <input type="text" class="form-control" name="email_id" value="{{$engineer->email_id}}" disabled required>
                                <span id="email_error" class="text-danger"></span>
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
                <a href="{{ url('Setup_engineer_list')}}" class="btn btn-warning">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('#editButton').click(function () {
            // Hide the Edit button
            $(this).hide();
            // Show the Update button
            $('#updateButton').show();
            // Enable the disabled input fields
            $('input[name="engineer_name"],input[name="engineer_designation"],input[name="email_id"]').prop('disabled', false);
        });
    });

    
    $(document).ready(function() {
            $('#email_id').on('input', function() {
                var email = $(this).val();

                $.ajax({
                    url: "{{ url('/check_engineer_email') }}",
                    type: "POST",
                    data: {
                        email: email,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (!response.unique) {
                            $('#email_error').text('Email ID already exists');
                        } else {
                            $('#email_error').text('');
                        }
                    },
                    error: function() {
                        $('#email_error').text('Error occurred while checking Email ID');
                    }
                });
            });
        });
</script>
@endpush
