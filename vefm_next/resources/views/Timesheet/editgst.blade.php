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
                        <li class="breadcrumb-item " aria-current="page">GST Master</li>
                        <li class="breadcrumb-item active" aria-current="page">GST Master Edit</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- end::page header -->
        <form action="{{ url('update_gst/'.$gst->id)}}" method="POST">
            @csrf

            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"><u>GST MASTER</u></h6>

                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-md-3 mb-3">
                                    <label>Customer</label>
                                    <select class="form-control" id="customer_id" name="customer_id" readonly>
                                        <option>Select Customer</option>
                                        @foreach ($customers as  $customer)
                                            <option value="{{ $customer->id }}" @if ($customer->id == $gst->customer_id) selected @endif>{{ $customer->customer_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label>State</label>
                                    <select class="form-control" id="state" name="state" disabled required>
                                        <option value="">Select State</option>
                                        @foreach ($state as $state)
                                            <option value="{{ $state->state }}" {{ $gst->state == $state->state ? 'selected' : '' }}>
                                                {{ $state->state }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label>GST Number</label>
                                    <input type="text" class="form-control" id="gst_number" name="gst_number" value="{{ $gst->gst_number }}" disabled required>
                                    <small id="gst_number_message"></small> <!-- Placeholder for the message -->
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>PAN Number</label>
                                    <input type="text" class="form-control" id="pan_number" name="pan_number" value="{{ $gst->pan_number }}" disabled required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-3 mb-3">
                                    <button id="editButton" class="btn btn-primary" type="button">Edit</button>
                                    <button id="updateButton" class="btn btn-success form-control" style="display: none;" type="submit">Update</button>
                                    <a href="{{ route('gstmaster') }}" class="btn btn-warning">Cancel</a>
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
    <script>
        $(document).ready(function () {
            $('#editButton').click(function () {
                $(this).hide();
                $('#updateButton').show();
                $('#customer_id, #state, #gst_number,#pan_number').prop('disabled', false);
            });
        });
    </script>
@endpush
