@extends('layouts.template')
@section('content')
    <div class="container">

        <!-- begin::page header -->
        <div class="page-header d-md-flex align-items-center justify-content-between">
            <div>
                <h4>Modules</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb"><li class="breadcrumb-item"><a href="#">Timesheet</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Timesheet Create</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- end::page header -->
	<form action="{{ url('/timesheetstore') }}" method="POST">
		@csrf
        <div class="card">
            <div class="card-body">
                <h6 class="card-title"><u>Front End Details</u></h6>
                <div class="form-row">
                    <div class="col-md-3 mb-3">
                        <label >Current Date</label>
                        <input type="text" class="form-control form-control-sm"  name="created_date" id="enquiry_due_date">
                    </div>
                    <div class="col-md-3 mb-3">
                       <label >Timesheet Date<span style="color: red">* </span></label>
                       <input type="text" class="form-control form-control-sm"  name="timesheet_date" id="timesheet_date">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label >Company </label>
                        <select class="form-control form-control-sm" id="comp" name="company_code">
                            <option selected disabled>Select...</option>
                            @foreach ($companies as $company)
                            <option value="{{ $company->comp_code}}" selected>{{ $company->company_name}}</option>
                            @endforeach
                          </select>

                     </div>

                     <div class="col-md-3 mb-3">
                        <label >Division</label>
                        <select class="form-control form-control-sm" id="division" name="division">
                            <option selected disabled>Select...</option>
                            @foreach($divisions as $data)
                    <option value="{{$data->id}}">{{$data->division_name}}
                    </option>
                    @endforeach
                          </select>
                   </div>
                </div>

                <div class="form-row">
                    <div class="col-md-3 mb-3">
                    <label >Unit Ref</label>
                        <select class="form-control form-control-sm" id="unit" name="unit_ref">
                        <option selected disabled>Select...</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label >Region / Division</label>
                        <select class="form-control form-control-sm" id="region" name="com_region">
                            <option selected disabled>Select...</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label >Job Type<span style="color: red">* </span></label>
                        <select class="form-control form-control-sm" id="job_type" name="job_type" required>
                            <option disabled selected >Select Job type</option>
                            <option value="Short time Job" >Short time Job</option>
                            <option value="Ongoing Job" >Ongoing Job</option>
                            <option value="Internal Invoice" >Internal Invoice</option>
                        </select>
                   </div>
                   <div class="col-md-3 mb-3">
                    <label >Job Number<span style="color: red">* </span></label>
                    <div class="input-group">
                            <input type="text" class="form-control form-control-sm"  id="regioncode" name="jobno" readonly>
                        <input type="text" class="form-control form-control-sm" id="job_number">
                            <input type="text" class="form-control form-control-sm"  id="financial_year"  readonly>
                    </div>
                </div>
                </div>

                    <div class="form-row">

                        <div class="col-md-3 mb-3">
                            <label >Customer Name<span style="color: red">* </span></label>
                            <select class="form-control form-control-sm" id="cust" name="cust">
                             <option selected disabled>Select...</option>
                             @foreach($clients as $client)
							<option value="{{$client->id}}">{{$client->client_name}}
							</option>
							@endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Customer Contact Name</label>
                            <input type="text" class="form-control form-control-sm"  name="cust_contactname">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Mail</label>
                            <input type="text" class="form-control form-control-sm"  name="cust_mail">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Mobile No</label>
                            <input type="text" class="form-control form-control-sm"  name="cust_mobile">
                        </div>
                </div>

                <div class="form-row">
                    <div class="col-md-9 mb-3">
                        <label>Customer Address</label>
                        <textarea type="text" class="form-control form-control-sm"  id="cust_address" name="cust_address"></textarea>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Ultimate Client</label>
                        <input type="text" class="form-control form-control-sm"  name="ultimate_client">
                    </div>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-body">
                <h6 class="card-title"><u>Project Details</u></h6>
                <div class="form-row">
                    <div class="col-md-3 mb-3">
                        <label >Project Site<span style="color: red">* </span></label>

                        <select class="form-control form-control-sm" name="project_site" id="project_site">
                            <option selected disabled>Select...</option>
                            @foreach($sites as $site)
                           <option value="{{$site->id}}">{{$site->site}}
                           </option>
                           @endforeach
                           </select>
                    </div>
                    <div class="col-md-3 mb-3">
                       <label >Industry Type</label>
                       <input type="text" class="form-control form-control-sm"  name="project_sector">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label >Contact Person At Site </label>
                        <input type="text" class="form-control form-control-sm"  name="contact_person">
                     </div>
                     <div class="col-md-3 mb-3">
                        <label >Contact Number</label>
                        <input type="text" class="form-control form-control-sm"  name="contact_num">
                    </div>
                </div>


                <div class="form-row">

                    <div class="col-md-3 mb-3">
                       <label >Project Start Date </label>
                       <input type="text" class="form-control form-control-sm"  name="project_startdate" id="enquiry_due_date">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label >Project End Date </label>
                        <input type="text" class="form-control form-control-sm"  name="project_enddate" id="enquiry_due_date">
                     </div>
                     <div class="col-md-6 mb-3">
                        <label>Project / Invoice Description</label>
                        <textarea class="form-control form-control-sm" id="exampleFormControl" name="project_desc" rows="3"></textarea>
                   </div>
                </div>
              </div>
         </div>


        <div class="card">
            <div class="card-body">
                <h6 class="card-title"><u>PO Details</u></h6>
                <div class="form-row">
                    <div class="col-md-3 mb-3">
                        <label >PO Number</label>
                        <select type="text" class="form-control form-control-sm"  name="po_number" id="purchaseorder">
                        <option selected disabled>Select...</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                       <label >PO Peroid From</label>
                       <input type="text" class="form-control form-control-sm"  name="po_period_from" id="enquiry_due_date">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label >PO Period To</label>
                        <input type="text" class="form-control form-control-sm"  name="po_period_to" id="enquiry_due_date">
                     </div>
                     <div class="col-md-3 mb-3">
                        <label >PO Date </label>
                        <input type="text" class="form-control form-control-sm"  name="po_date" id="po_date">
                     </div>
                </div>


                <div class="form-row">
                     <div class="col-md-3 mb-3">
                        <label>PO Value</label>
                        <input type="text" class="form-control form-control-sm"  name="po_value" id="po_value">
                     </div>
                     <div class="col-md-3 mb-3">
                        <label>Projected Revenue</label>
                        <input type="text" class="form-control form-control-sm"  name="project_reveneu">
                   </div>
                   <div class="col-md-3 mb-3">
                    <label>Invoice Type<span style="color: red">* </span></label>
                    <select name="invoicetype" id="invoicetype" class="form-control form-control-sm" required >
                        <option disabled selected>Select Invoice Type</option>
                        <option value="ARC">ARC</option>
                        <option value="Lumpsum">Lumpsum</option>
                        <option value="Per Day Rate">Per Day Rate</option>
                        <option value="Testing Charges">Testing Charges</option>
                        <option value="Reimbursement">Reimbursement</option>
                    </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label >PO Remarks</label>
                        <textarea class="form-control form-control-sm" id="" name="po_remarks" rows="3"></textarea>
                    </div>
                </div>

                    <div class="form-row">
                        <div class="col-md-5 mt-1">
                        </div>
                        <div class="col-md-2 mt-1">
                            <button type="button" id="show" class="btn btn-sm btn-success btn-top">Add Engineer</button>
                        </div>
                        <div class="col-md-5 mt-1">
                        </div>
                    </div>
              </div>
         </div>


         <div class="card" style="display:none" id="site">
            <div class="card-body">
                <h6 class="card-title"><u>Add Engineer</u></h6>
                <div class="card-body">
                    <table id="" style="width:100%;"class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>SI</th>
                            <th>Engr Code</th>
                            <th>Engr Name</th>
                            <th>Engr Designation</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody id="clonedInput" class="clonedInput">
                        <tr>
                            <td>1</td>
                            <td><select class="col-md-4" name="rt1[]" id="ecode" class="form-control form-control-sm">
                                <option selected disabled>Select...</option>
                                @foreach($engineers as $engr)
							<option value="{{$engr->id}}">{{$engr->ecode}}</option>
							@endforeach
                                </select>
                            </td>
                            <td><input type="text" id="engr_name" name="engr_name"  class="form-control form-control-sm" autocomplete="off" readonly /></td>
                            <td><input type="text" id="engr_designation" name="engr_designation"  class="form-control form-control-sm" autocomplete="off" readonly /></td>
                        </tr>
                        </tbody>

                    </table>
                </div>

                <button class="btn btn-sm btn-success" id="addBtn" type="button" onclick="createClone()"style="position: relative;left: 800px;">Add Engineer</button>
		        <!--<button class="btn btn-sm btn-warning" type="button" style="position: relative;left: 50px;">Cancel</button>-->

              </div>
         </div>

	</form>
  </div>
</div>

@endsection
@push('scripts')
<script type="text/javascript">

'use strict';

$('#enquiry_due_date,#enquiry_received_date,#timesheet_date').daterangepicker({
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

$('#division,#cust,#unit,#region,#ecode,#comp,#job_type,#purchaseorder,#project_site').select2();

$('#division').change(function(event) {
        var division = $('#division').val();
		//alert(division);
        $.ajax({
            type: "GET",
            url: "{{ url('/getunits') }}",
            data: {
                division: division
            },
            success: function(data) {
                $("#unit").html(data);
            },
            error: function(exception) {
                // alert('Something Error');
            }
        });
    });


    $('#unit').change(function(event) {
        var unit = $('#unit').val();
		//alert(unit);
        $.ajax({
            type: "GET",
            url: "{{ url('/getregions') }}",
            data: {
                unit: unit
            },
            success: function(data) {
                $("#region").html(data);
            },
            error: function(exception) {
                // alert('Something Error');
            }
        });
    });

    $('#region').change(function(event) {
        var region = $('#region').val();
		//alert(region);
        $.ajax({
            type: "GET",
            url: "{{ url('/getregioncode') }}",
            data: {
                region: region
            },
            dataType: 'json',
            success: function(data) {
                $("#regioncode").val(data.regioncode);
                $("#job_number").val(data.jobno);
            },
            error: function(exception) {
                // alert('Something Error');
            }
        });
    });


    $('#cust').change(function(event) {
        var cust = $('#cust').val();
		//alert(cust);
        $.ajax({
            type: "GET",
            url: "{{ url('/getpos') }}",
            data: {
                cust: cust
            },
            success: function(data) {
                $("#purchaseorder").html(data);
            },
            error: function(exception) {
                // alert('Something Error');
            }
        });
    });



});

        $('#cust').change(function(event) {
            var cust = $('#cust').val();
            //alert(cust);

            $.ajax({
                type: "GET",
			  url: "{{ url('/get_cust_detail') }}",
                data: {
                    cust: cust
                },
                dataType: 'json',
                success: function(data) {

                    $("#cust_address").val(data.cust_details);
                },
                error: function(exception) {
                    alert('Something Error');
                }

            });
        });

        $('#ecode').change(function(event) {
            var ecode = $('#ecode').val();
          //alert(ecode);
            $.ajax({
                type: "GET",
			  url: "{{ url('/get_engr_detail') }}",
                data: {
                    ecode: ecode
                },
                dataType: 'json',
                success: function(data) {

                    $("#engr_name").val(data.name);
                    $("#engr_designation").val(data.designation);
                },
                error: function(exception) {
                    alert('Something Error');
                }
            });
        });

        $('#purchaseorder').change(function(event) {
            var purchaseorder = $('#purchaseorder').val();
            //alert(purchaseorder);
            $.ajax({
                type: "GET",
			  url: "{{ url('/get_po_detail') }}",
                data: {
                    purchaseorder: purchaseorder
                },
                dataType: 'json',
                success: function(data) {
                    $("#po_date").val(data.po_date);
                    $("#po_value").val(data.po_value);
                },
                error: function(exception) {
                    alert('Something Error');
                }
            });
        });

        $('#timesheet_date').change(function(event) {
            var timesheet_date = $('#timesheet_date').val();
           //alert(timesheet_date);
            $.ajax({
                type: "GET",
			  url: "{{ url('/get_financial_year') }}",
                data: {
                    timesheet_date: timesheet_date
                },
                dataType: 'json',
                success: function(data) {
                    $("#financial_year").val(data.year);
                },
                error: function(exception) {
                    alert('Something Error');
                }
            });
        });

   //To hide add engineer part
     $(document).ready(function(){
        $("#show").click(function(){
          $("#site").toggle();
          $("#show").hide();
        });
      });

      //for add more than one engineer
    function createClone() {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
   /* $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });*/
    $.ajax({
        url: "{{ url('createclone') }}",
        method: 'post',
        data: {
            '_token': CSRF_TOKEN,
            'div_count': $('.clonedInput').length + 1
        },
        success: function(data) {
            var obj = JSON.parse(data);
            $('#clonedInput').append(obj);
        },
    });
}

function removedClone(id) {
    var r = confirm("Are you sure you want to delete?");
    if (r == true) {
        $(id).remove();
    }
}

</script>
@endpush





