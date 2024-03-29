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
                        <li class="breadcrumb-item active" aria-current="page">GST Master</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- end::page header -->
        <div class="card">
            <div class="card-body">
                <h6 class="card-title"><u>GST MASTER</u></h6>
                @include('flash_message')
                @yield('content')

                <form method="POST" action="{{ route('store_gst') }}">
                    @csrf
                    <div class="form-row">

                        <div class="col-md-3 mb-3">
                            <label>Customer</label>
                            <select class="form-control" id="customer_id" name="customer_id" required>
                                <option>Select Customer</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->customer_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>State</label>
                            <select class="form-control" id="state" name="state" required>
                                <option>Select State</option>
                                @foreach ($state as $stateItem)
                                    <option value="{{ $stateItem->state }}" {{ old('state') == $stateItem->state ? 'selected' : '' }}>
                                        {{ $stateItem->state }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-md-3 mb-3">
                            <label>GST Number</label>
                            <input type="text" class="form-control" id="gst_number" name="gst_number"value="{{ old('gst_number') }}" required>
                            <small id="gst_number_message"></small> <!-- Placeholder for the message -->
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>PAN Number</label>
                            <input type="text" class="form-control" id="pan_number" name="pan_number" value="{{ old('pan_number') }}" required >
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <button class="btn btn-success form-control" type="submit">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="customerDetails">
                        <thead>
                            <tr>
                                <th scope="col">SI</th>
                                <th scope="col">State</th>
                                <th scope="col">GST Number</th>
                                <th scope="col">Pan Number</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Table body content will be dynamically populated here -->

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Function to fetch and display GST details based on selected customer
        function fetchGSTDetails(customerId) {
            $.ajax({
                url: "{{ route('fetch_gst_details') }}",
                type: "GET",
                data: {
                    customer_id: customerId
                },
                success: function(response) {
                    var gstdetails = response.gstdetails;
                    var tableBody = '';

                    gstdetails.forEach(function(detail, index) {
                        tableBody += '<tr> ';
                        tableBody += '<td> ' + (index + 1) + '</td>';
                        tableBody += '<td>' + detail.state + '</td>';
                        tableBody += '<td> <u> <a href="' + getEditGSTPageURL(detail.id) + '">' + detail.gst_number + '</a></u></td>';
                        tableBody += '<td>' + detail.pan_number + '</td>';
                        tableBody += '<td> <a href="' + getDeleteGSTPageURL(detail.id) + '"> <i class="ti-trash" onclick="return confirm(\'Are You Sure?\')"></i></a></td>';

                        tableBody += '</tr>';
                    });


                    $('#customerDetails tbody').html(tableBody);
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
            function getEditGSTPageURL(customerId) {
            return "{{ url('editgst_page') }}/" + customerId;
}
function getDeleteGSTPageURL(detailId) {
    return "{{ url('gst_delete') }}/" + detailId;
}
        }

        // Event listener for dropdown change
        $('#customer_id').on('change', function() {
            var customerId = $(this).val();
            fetchGSTDetails(customerId);
        });

        $(document).ready(function() {
            $('#gst_number').on('input', function() {
                var gstNumber = $(this).val();
                if (gstNumber.trim() !== '') {
                    checkGSTNumber(gstNumber);
                }
            });
        });

        function checkGSTNumber(gstNumber) {
            $.ajax({
                url: "{{ route('check_gst_number') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    gst_number: gstNumber
                },
                success: function(response) {
                    if (response.exists) {
                        $('#gst_number_message').text('GST number already exists').addClass('text-danger');
                    } else {
                        $('#gst_number_message').text('');
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }



    </script>
@endpush
