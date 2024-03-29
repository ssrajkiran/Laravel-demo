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
                        <li class="breadcrumb-item " aria-current="page">User</li>
                        <li class="breadcrumb-item active" aria-current="page">Assign Rights</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- end::page header -->
	<form action="" method="POST">
		@csrf
        <div class="card">
            <div class="card-body">
                <h6 class="card-title"><u>Assign Rights</u></h6>
                @include('flash_message')
               @yield('content')


                <div class="card">
                    <div class="card-body">
                        {{-- <h6 class="card-title">Collection Details</h6> --}}

                        <div class="form-row">

                            <div class="col-md-2 mb-3">
                                <label for="company">Company</label>
                                @if ($company->isEmpty())
                                    <input type="text" class="form-control" id="company" name="company" value="No Company Exists" readonly>
                                @else
                                    <select class="form-control" id="company" name="company" disabled>
                                        @foreach ($company as $company)
                                            <option value="{{ $company->id }}" {{ $loop->first ? 'selected' : '' }}>{{ $company->company_name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="company_id" id="company_id" value="{{ $company->first()->id }}">
                                @endif
                            </div>

                            <div class="col-md-2 mb-2">
                                <label>Division<span style="color: red;">*</span></label>
                                <select class="form-control" id="division" name="division" required>
                                    <option>Select Division</option>
                                    @foreach ($division as  $division)
                                        <option value="{{$division->id}}">{{$division->division_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2 mb-2">
                                <label>Unit<span style="color: red;">*</span></label>
                                <select class="form-control" id="unit" name="unit" required>
                                    <option value="">-- Select Unit --</option>
                                </select>
                            </div>

                            <div class="col-md-2 mb-2">
                                <label>Region<span style="color: red;">*</span></label>
                                <select class="form-control" id="region" name="region" required>
                                    <option value="">-- Select Region --</option>
                                </select>
                            </div>

                            <div class="col-md-2 mb-2">
                                <label>User ID<span style="color: red;">*</span></label>
                                <select class="form-control" id="user_id" name="user_id" required>
                                    <option value="">-- Select UserID --</option>
                                </select>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-5">
                                <label>Details</label>
                                <input type="text" class="form-control" id="user_details" name="user_details" readonly>
                            </div>
                        </div>


                    <div>

                        <button class="btn btn-warning form-control" type="submit">Cancel</button>
                        <button class="btn btn-success" type="submit" style="position: relative;left: 700px;">View Rights</button>

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
    $(document).ready(function () {
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


    $(document).ready(function () {
        $('#division').on('change', function () {
            var divisionId = $(this).val();

            $.ajax({
                url: "{{ url('/Setup_unit_fetch') }}",
                type: "POST",
                data: {
                    division: divisionId,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#unit').empty().append('<option value="">-- Select Unit --</option>');
                    $.each(result.units, function (key, value) {
                        $('#unit').append('<option value="' + value.id + '">' + value.unit + '</option>');
                    });
                }
            });
        });

        $('#unit').on('change', function () {
            var unitId = $(this).val();

            $.ajax({
                url: "{{ url('/fetch_regions') }}",
                type: "POST",
                data: {
                    unit: unitId,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#region').empty().append('<option value="">-- Select Region --</option>');
                    $.each(result.regions, function (key, value) {
                        $('#region').append('<option value="' + value.id + '">' + value.region_name + '</option>');
                    });
                }
            });
        });

        $('#division, #unit, #region').on('change', function () {
        var divisionId = $('#division').val();
        var unitId = $('#unit').val();
        var regionId = $('#region').val();

        fetchUsers(divisionId, unitId, regionId);
    });

    function fetchUsers(divisionId, unitId, regionId) {
        $.ajax({
            url: "{{ url('/fetch_users_id') }}",
            type: "POST",
            data: {
                division: divisionId,
                unit: unitId,
                region: regionId,
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function (result) {
                $('#user_id').empty().append('<option value="">-- Select User ID --</option>');
                $.each(result.users, function (key, value) {
                    $('#user_id').append('<option value="' + value.id + '">' + value.user_id + '</option>');
                });
            }
        });
    }

    $(document).ready(function () {
        $('#division, #unit, #region, #user_id').on('change', function () {
            var divisionId = $('#division').val();
            var unitId = $('#unit').val();
            var regionId = $('#region').val();
            var userId = $('#user_id').val();

            fetchUserData(divisionId, unitId, regionId, userId);
        });

        function fetchUserData(divisionId, unitId, regionId, userId) {
            $.ajax({
                url: "{{ url('/fetch_user_data') }}",
                type: "POST",
                data: {
                    division_id: divisionId,
                    unit_id: unitId,
                    region_id: regionId,
                    user_id: userId,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function (userData) {
                    if (userData) {
                        $('#user_details').val(userData.user_details);
                    } else {
                        $('#user_details').val('');
                    }
                },
                error: function () {
                    $('#user_details').val('');
                }
            });
        }
    });


    });

</script>
@endpush
