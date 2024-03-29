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
                        <li class="breadcrumb-item active" aria-current="page">Company Create</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- end::page header -->

        <form action="{{ route('setup_company_store') }}" method="POST">
            @csrf
            <div class="card">

                <div class="card-body">
                    <h6 class="card-title"><u>Company</u></h6>
                    @include('flash_message')
                    @yield('content')


                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label>Company Name<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="company_name" pattern="[ .a-zA-Z]+"
                                title="Only letters and spaces are allowed" value="{{ old('company_name') }}" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Location<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" pattern="[ .a-zA-Z]+"
                                title="Only letters and spaces are allowed" name="location" value="{{ old('location') }}"
                                required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Address<span style="color: red;">*</span></label>
                            <textarea class="form-control" id="exampleFormControl" rows="3" name="address" pattern="[ .a-zA-Z0-9]+"
                                title="Only letters, spaces, and numbers are allowed" required>{{ old('address') }}</textarea>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label>City/Town<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="city" pattern="[ .a-zA-Z]+"
                                title="Only letters and spaces are allowed" value="{{ old('city') }}" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>State<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="state" pattern="[ .a-zA-Z]+"
                                title="Only letters and spaces are allowed" value="{{ old('state') }}" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Country<span style="color: red;">*</span></label>
                            <select class="form-control" id="country" name="country" required>
                                <option value="">Select Country</option>
                                @foreach ($countries as $country)
                                <option {{ old('country') == $country ? 'selected' : '' }}>{{ $country }}
                                      
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        

                    </div>
                  
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label>Pin/Post Code<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" value="{{ old('pincode') }}"
                                onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="6"
                                name="pincode" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Telephone</label>
                            <input type="text" class="form-control" value="{{ old('telephone') }}" autocomplete="off"
                                name="telephone" >
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Mobile<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" value="{{ old('mobile') }}" pattern="^[6-9]\d{9}$"
                                autocomplete="off" onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                name="mobile" required >
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label>Website</label>
                            <input type="text" class="form-control" name="website" value="{{ old('website') }}"
                                >
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Status<span style="color: red;">*</span></label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="" selected>-- Select Status --</option>
                                <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="In-Active" {{ old('status') == 'In-Active' ? 'selected' : '' }}>In-Active</option>
                                <option value="Pause" {{ old('status') == 'Pause' ? 'selected' : '' }}>Pause</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                    </div>

                    <button class="btn btn-success" type="submit"
                        style="position: relative;left: 700px;">Submit</button>
                    <a href="{{ route('comapny_list') }}" class="btn btn-warning float-left">Cancel</a>
                </div>
            </div>
        </form>
    </div>
@endsection
