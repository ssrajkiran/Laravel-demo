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
                        <li class="breadcrumb-item " aria-current="page">PO Master</li>
                        <li class="breadcrumb-item active" aria-current="page">PO Master Edit</li>
                    </ol>
                </nav>
            </div>
            <button id="editButton" class="btn btn-primary " type="button">Edit</button>
        </div>
    </div>
    </div>
    <!-- end::page header -->

    <form action="{{ route('updatepomaster', $pomaster->id) }}" method="POST">
        @csrf

        <div class="card">
            <div class="card-body">
                <h6 class="card-title"><u>Edit PO Master</u></h6>


                <div class="card">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-md-3 mb-3">
                                <label>Division<span style="color: red;">*</span></label>

                                <input type="text" class="form-control" name="division"
                                    value="{{ $pomaster->division->division_name }}" readonly>

                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Unit<span style="color: red;">*</span></label>
                                <input type="text" class="form-control" name="unit"
                                    value="{{ $pomaster->unit->unit }}" readonly>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Region<span style="color: red;">*</span></label>
                                <input type="text" class="form-control" name="unit"
                                    value="{{ $pomaster->region->region_name }}" readonly>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Customer<span style="color: red;">*</span></label>
                                <select class="form-control" id="customer" name="customer" readonly required>
                                    <option value="">Select Customer</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}"
                                            {{ $pomaster->customer_id == $customer->id ? 'selected' : '' }}>
                                            {{ $customer->customer_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-3 mb-3">
                                <label>Project Site<span style="color: red;">*</span></label>
                                <input type="text" class="form-control" name="project_site" pattern="[ .a-zA-Z]+"
                                    title="Only letters and spaces are allowed" value="{{ $pomaster->project_site }}"
                                    disabled required>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>PO Number<span style="color: red;">*</span></label>
                                <input type="text" class="form-control" name="po_number"
                                    onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"
                                    value="{{ $pomaster->po_number }}" disabled required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>PO Date<span style="color: red;">*</span></label>
                                <input type="text" class="form-control" name="po_date" id="po_date"
                                    value="{{ $pomaster->po_date }}" disabled required>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>PO Value<span style="color: red;">*</span></label>
                                <input type="text" class="form-control" name="po_value" id="po_value"
                                    value="{{ $pomaster->po_value }}"
                                    onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 46"
                                    required>
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="col-md-3 mb-3">
                                <label>Consumed<span style="color: red;">*</span></label>
                                <input type="text" class="form-control" name="consumed" id="consumed"
                                    value="{{ $pomaster->consumed }}"
                                    onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 46"
                                    required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Balance</label>
                                <input type="text" class="form-control" name="balance" id="balance"
                                    value="{{ $pomaster->balance }}" readonly>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3" style="padding-top:26px;">
                            <!-- Cancel button with route -->
                            <a href="{{ route('pomaster_list') }}" class="btn btn-warning float-left">Cancel</a>
                            <button id="updateButton" class="btn btn-success float-right"
                                style="display: none; position: relative;left: 700px;" type="submit">Update</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {

            $('input, textarea, select').prop('disabled', true);
            $('#editButton').click(function() {
                $('input, textarea, select').prop('disabled', function(_, val) {
                    return !val;
                });
                $("#editButton").hide();
                $("#updateButton").show(); // Show the update button
            });
        });


        $(document).ready(function() {
            $('#po_date').select2();
        });
        $('#po_date').daterangepicker({
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

        $(document).ready(function() {
            $('#po_date').select2();

            function calculateBalance() {
                var poValue = parseFloat($('#po_value').val()) || 0;
                var consumed = parseFloat($('#consumed').val()) || 0;

                // Ensure consumed value is not greater than poValue
                if (consumed > poValue) {
                    consumed = poValue;
                    $('#consumed').val(consumed);
                    $('#consumed-error').text('Consumed value cannot exceed PO value');
                } else {
                    $('#consumed-error').text('');
                }

                var balance = poValue - consumed;
                $('#balance').val(balance);
            }

            $('#po_value, #consumed').on('input', function() {
                calculateBalance();
            });

            $('#submitBtn').on('click', function(event) {
                var poValue = parseFloat($('#po_value').val()) || 0;
                var consumed = parseFloat($('#consumed').val()) || 0;

                if (consumed > poValue) {
                    event.preventDefault(); // Prevent form submission
                    $('#consumed-error').text('Consumed value cannot exceed PO value');
                }
            });

            calculateBalance();
        });



        function calculateBalance() {
            var poValue = parseFloat(document.getElementById('po_value').value) || 0;
            var consumed = parseFloat(document.getElementById('consumed').value) || 0;
            var balance = poValue - consumed;
            document.getElementById('balance').value = balance.toFixed(2);
        }

        // Event listeners to trigger balance calculation
        document.getElementById('po_value').addEventListener('input', calculateBalance);
        document.getElementById('consumed').addEventListener('input', calculateBalance);

        // Calculate balance initially when the page loads
        calculateBalance();

        $(document).ready(function() {
            $('#po_date').select2();

            function calculateBalance() {
                var poValue = parseFloat($('#po_value').val()) || 0;
                var consumed = parseFloat($('#consumed').val()) || 0;

                var balance = poValue - consumed;
                $('#balance').val(balance);
            }

            $('#po_value, #consumed').on('input', function() {
                calculateBalance();
            });

            calculateBalance();
        });
    </script>
@endpush
