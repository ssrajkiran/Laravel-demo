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
                        <li class="breadcrumb-item active" aria-current="page">Region</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- end::page header -->
	<form action="{{ route('setup_region_store') }}" method="POST">
		@csrf
        <div class="card">
            <div class="card-body">
                <h6 class="card-title"><u>Region</u></h6>
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
                            <div class="col-md-2 mb-3">
                                <label>Division<span style="color: red;">*</span></label>
                                @if ($division->isEmpty())
                                    <input type="text" class="form-control" value="No Division Exists" readonly>
                                @else
                                    <select class="form-control" id="division" name="division" value ="{{ old('division') }}" required>
                                        <option value="">Select Division</option>
                                        @foreach ($division->sortBy('division_name') as $div)
                                            <option value="{{ $div->id }}" {{ old('division') == $div->id ? 'selected' : '' }}>
                                                {{ $div->division_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="division_id" id="division_id" value="{{ old('division_id') ?? $division->first()->id }}">
                                @endif
                            </div>




                             <div class="col-md-2 mb-3">
                                <label>Unit<span style="color: red;">*</span></label>
                                <select class="form-control" id="unit" name="unit" required>
                                    <option value="">-- Select Unit --</option>
                                </select>

                            </div>


                        <div class="col-md-2 mb-3">
                            <label >Region<span style="color: red;">*</span></label>
                            <input type="text" class="form-control"  name="region" value="{{ old('region') }}"  pattern="[ .a-zA-Z]+" title="Only letters and spaces are allowed" required>
                       </div>


                       <div class="col-md-2 mb-3">
                        <label >Region Code<span style="color: red;">*</span></label>
                        <input type="text" class="form-control"  name="region_code"  value="{{ old('region_code') }}"   pattern="[ .a-zA-Z]+" title="Only letters and spaces are allowed" required>
                   </div>

                   <div class="col-md-2 mb-3">
                    <label >Invoice Code<span style="color: red;">*</span></label>
                    <input type="text" class="form-control"  name="invoice_code" value="{{ old('invoice_code') }}"   pattern="[ .a-zA-Z]+" title="Only letters and spaces are allowed" required >
               </div>
               <div class="mb-2">
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-warning form-control" type="reset" style="position: relative;left: 150px;">Cancel</button>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-success form-control" type="submit" style="position: relative;left: 700px;">Submit</button>
                    </div>
                </div>
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
                                            <th scope="col">Region</th>
                                            <th scope="col">Region Code</th>
                                            <th scope="col">Invoice Code</th>
                                            <th scope="col">Action</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($region as  $region)


                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            @if ($region->company)
                                            <td>{{$region->company->company_name}}</td>
                                            @else
                                            <td>No Company</td>
                                            @endif

                                            @if ($region->division)

                                            <td>{{$region->division->division_name}}</td>
                                            @else
                                            <td>No Division</td>
                                            @endif
                                            @if ($region->units)
                                            <td>{{$region->units->unit}}</td>
                                            @else
                                            <td>No Unit</td>
                                            @endif
                                            <td><u><a href="{{url('Setup_region_edit/'.$region->id)}}">{{$region->region_name}}</u></td>
                                            <td>{{$region->region_code}}</td>
                                            <td>{{$region->invoice_code}}</td>
                                            <td>

                                                <a href="{{url('Setup_region_delete/'.$region->id)}}"><i class="ti-trash" onclick="return confirm('Are You Sure');"></i></a>

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
@push('scripts')
<script type="text/javascript">
$(document).ready(function () {
    // Function to fetch units based on division
    function fetchUnits(divisionId) {
        $.ajax({
            url: "{{ url('/Setup_unit_fetch') }}",
            type: "POST",
            data: {
                division: divisionId,
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function (result) {
                var unitDropdown = $('#unit');
                unitDropdown.empty().append('<option value="">-- Select Unit --</option>');
                $.each(result.units, function (key, value) {
                    unitDropdown.append('<option value="' + value.id + '">' + value.unit + '</option>');
                });

                // Set selected option based on old input value
                var oldUnit = "{{ old('unit') }}";
                if (oldUnit) {
                    unitDropdown.val(oldUnit);
                }
            }
        });
    }

    // Fetch units when division dropdown changes
    $('#division').on('change', function () {
        var divisionId = $(this).val();
        fetchUnits(divisionId);
    });

    // Fetch units on page load if division is pre-selected
    var initialDivisionId = $('#division').val();
    if (initialDivisionId) {
        fetchUnits(initialDivisionId);
    }
});


</script>

@endpush

