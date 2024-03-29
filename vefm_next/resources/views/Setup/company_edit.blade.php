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
                        <li class="breadcrumb-item"><a href="#">Company</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Company Edit</li>
                    </ol>
                </nav>

            </div>
            <button id="editButton" class="btn btn-primary " type="button">Edit</button>
        </div>
        <!-- end::page header -->
        <form action="{{ url('Setup_company_update/' . $company->id) }}" method="POST">
            @csrf
            <div class="card">

                <div class="card-body">
                    <h6 class="card-title"><u>Company</u></h6>
                    @include('flash_message')
                    @yield('content')

                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label>Company Name<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="company_name"
                                value="{{ $company->company_name }}" disabled required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Location<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="location" value="{{ $company->location }}"
                                disabled required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Address <span style="color: red;">*</span></label>
                            <textarea class="form-control" id="exampleFormControl" rows="3" name="address" disabled required>{{ $company->address }}</textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label>City/Town<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="city"
                                value="{{ old('city', $company->city) }}" disabled required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>State<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="state"
                                value="{{ old('state', $company->state) }}" disabled required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Country<span style="color: red;">*</span></label>
                            <select class="form-control" id="country" name="country" required>
                                <option value="">Select Country</option>
                                @foreach ($countries as $countryOption)
                                    <option value="{{ $countryOption }}" {{ old('country', $company->country) == $countryOption ? 'selected' : '' }}>
                                        {{ $countryOption }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        
                    </div>

                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label>Pin/Post Code<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" value="{{ $company->pincode }}" name="pincode"
                            onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="6"
                                disabled required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Telephone</label>
                            <input type="text" class="form-control" value="{{ $company->telephone }}" name="telephone"
                                disabled >
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Mobile<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" value="{{ $company->mobile }}" name="mobile"
                            pattern="^[6-9]\d{9}$"
                                autocomplete="off" onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                              required  disabled >
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label>Website</label>
                            <input type="text" class="form-control" value="{{ $company->website }}" name="website"
                                disabled >
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Status<span style="color: red;">*</span></label>
                            <select class="form-control " id="" name="status" disabled required>
                                <option selected value="{{ $company->status }}">{{ $company->status }}</option>
                                <option disabled>-- Select Status --</option>
                                <option value ="Active">Active</option>
                                <option value ="In-Active">In-Active</option>
                                <option value ="Pause">Pause</option>
                            </select>
                        </div>
                    </div>
                    <div>

                        <div class="col-md-3 mb-3" style="padding-top:26px;">
                            <!-- Cancel button with route -->
                            <a href="{{ route('comapny_list') }}" class="btn btn-warning float-left">Cancel</a>
                            <button id="updateButton" class="btn btn-success float-right"
                                style="display: none; position: relative;left: 700px;" type="submit">Update</button>
                        </div>



                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        'use strict';
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
    </script>
@endpush
