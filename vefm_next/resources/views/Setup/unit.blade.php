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
                        <li class="breadcrumb-item active" aria-current="page">Unit</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- end::page header -->
        <form action="{{ route('unit_store') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"><u>Unit</u></h6>
                    @include('flash_message')
                    @yield('content')


                    <div class="card">
                        <div class="card-body">
                            {{-- <h6 class="card-title">Collection Details</h6> --}}

                            <div class="form-row">

                                <div class="col-md-3 mb-3">
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

                                <div class="col-md-3 mb-3">
                                    <label>Division<span style="color: red;">*</span></label>
                                    <select class="form-control form-control-sm" id="division" name="division" required>
                                        <option value="">Select Division</option>
                                        @foreach ($division as $division)
                                            <option value="{{ $division->id }}" @if(old('division') == $division->id) selected @endif>
                                                {{ $division->division_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="col-md-3 mb-3">
                                    <label>BU<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" name="unit" value="{{ old('unit') }}" pattern="[ .a-zA-Z0-9]+" title="Only letters, spaces, and numbers are allowed" required>
                                </div>

                                <div class="col-md-3 mb-3" style="padding-top: 26px;">

                                    <button class="btn btn-success form-control" type="submit">Submit</button>
                                    <button class="btn btn-warning" type="reset">Cancel</button>


                                </div>

                            </div>

                            <div class="form-row">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">SI</th>
                                                <th scope="col">Company</th>
                                                <th scope="col">Division</th>
                                                <th scope="col">Unit</th>
                                                <th scope="col">Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>



                                            @foreach ($unit as $unit)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    @if ($unit->company)
                                                        <td>{{ $unit->company->company_name }}</td>
                                                    @else
                                                        <td>No Company</td>
                                                    @endif

                                                    @if ($unit->division)
                                                        <td>{{ $unit->division->division_name }}</td>
                                                    @else
                                                        <td>No Division</td>
                                                    @endif

                                                    <td><u><a
                                                                href="{{ url('Setup_unitedit/' . $unit->id) }}">{{ $unit->unit }}</u>
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('Setup_unitdelete/' . $unit->id) }}"><i
                                                                class="ti-trash" onclick="return confirm('Are You Sure')">
                                                            </i></a>
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
            </div>
        </form>
    </div>
    </div>
@endsection
