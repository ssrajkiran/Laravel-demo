<?php

namespace App\Http\Controllers;

use App\Models\Setup_Company;
use App\Models\Setup_Division;
use App\Models\Setup_Unit;
use App\Models\Setup_Region;
use App\Models\Setup_Customer;
use App\Models\Setup_Po;
use App\Models\SetupGst;
use App\Models\Setup_Details;
use Illuminate\Http\Request;

class TimesheetController extends Controller
{

    public function pomaster_create()
    {
        try {
            $divisions = Setup_Division::where('flag', 0)->get();
            $units = [];
            $regions = [];
            $customers = Setup_Customer::where('flag', 0)->get();

            return view('Timesheet.pomaster', compact('divisions', 'units', 'regions', 'customers'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error occurred while fetching data: ' . $e->getMessage());
        }
    }


    public function pomaster_list()
    {
        try {
            $pomasters = Setup_Po::where('flag', 0)->get();
            return view('Timesheet.pomasterlist', compact('pomasters'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error occurred while fetching PO masters: ' . $e->getMessage());
        }
    }


    public function getUnitsByDivision($divisionId)
    {
        try {
            $units = Setup_Unit::where('division_id', $divisionId)->get();
            return response()->json(['units' => $units]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error occurred while fetching units: ' . $e->getMessage()], 500);
        }
    }


    public function pomaster_edit($id)
    {
        try {
            $pomaster = Setup_Po::findOrFail($id);
            $divisions = Setup_Division::where('flag', 0)->get();
            $customers = Setup_Customer::where('flag', 0)->get();
            $units = Setup_Unit::where('flag', 0)->get();
            $region = Setup_Region::where('flag', 0)->get();
            return view('Timesheet.pomaster_edit', compact('pomaster', 'divisions', 'customers', 'units', 'region'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error occurred while editing PO master: ' . $e->getMessage());
        }
    }


    public function pomaster_delete($id)
    {
        try {
            $pomaster = Setup_Po::findOrFail($id);
            $pomaster->update([
                'flag' => 1,
                'updated_at' => now(),
            ]);
            return redirect()->back()->with('delete', 'Deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error occurred while deleting PO master: ' . $e->getMessage());
        }
    }


    public function pomaster_update(Request $request, $id)
    {
        try {
            // Find the PO being updated
            $po = Setup_Po::findOrFail($id);

            // Check if the updated po_number already exists for another PO
            $existingPo = Setup_Po::where('po_number', $request->input('po_number'))
                ->where('id', '!=', $id)
                ->first();

            if ($existingPo) {
                return redirect()->route('pomaster_list')->with('info', "PO number already exists for another PO.");
            }

            // Update the PO
            $po->update([
                'project_site' => $request->input('project_site'),
                'po_number' => $request->input('po_number'),
                'po_date' => $request->input('po_date'),
                'po_value' => $request->input('po_value'),
                'consumed' => $request->input('consumed'),
                'balance' => $request->input('balance'),
            ]);

            return redirect()->route('pomaster_list')->with('info', "PO Master updated successfully.");
        } catch (\Exception $e) {
            return redirect()->route('pomaster_list')->with('error', "Error occurred while updating PO Master: " . $e->getMessage());
        }
    }



    public function pomaster_store(Request $request)
    {
        // try {
            // Check if PO already exists
            $existingPO = Setup_PO::where('po_number', $request->po_number)
                ->where('po_date', $request->po_date)
                ->where('project_site', $request->project_site)
                ->where('flag', 0)
                ->exists();

            if ($existingPO) {
                return redirect()->route('pomaster_create')->withInput()->with('warning', 'PO already exists.');
            }

            // Create a new PO record
            $po = new Setup_PO();
            $po->division_id = $request->division;
            $po->unit_id = $request->unit;
            $po->region_id = $request->region;
            $po->customer_id = $request->customer;
            $po->po_number =  $request->input('po_number');
            $po->po_date =  $request->input('po_date');
            $po->po_value =  $request->input('po_value');
            $po->consumed =  $request->input('consumed');
            $po->balance = $request->input('balance');
            $po->project_site = $request->input('project_site');
            $po->flag = 0;
            $po->save();

            // Redirect back with success message
            return redirect()->route('pomaster_list')->with('success', 'PO Master added successfully');
        // } catch (\Exception $e) {
            // // Handle the exception
            // return redirect()->route('pomaster_create')->withInput()->with('error', 'Failed to add PO Master: ' . $e->getMessage());
    //   }
    }



    // public function fetchUnits(Request $request)
    // {
    //     $divisionId = $request->input('division');

    //     $units = Unit::where('division_id', $divisionId)->get();

    //     return response()->json(['units' => $units]);
    // }

    // public function fetchCustomers(Request $request)
    // {
    //     try {
    //         $divisionId = $request->input('division');
    //         $regionId = $request->input('region');
    //         $unitId = $request->input('unit');

    //         // Fetch customers based on the provided IDs
    //         $customers = Setup_Customer::where('division_id', $divisionId)
    //             ->where('region_id', $regionId)
    //             ->where('unit_id', $unitId)
    //             ->get();

    //         // Return customers as JSON response
    //         return response()->json(['customers' => $customers]);
    //     } catch (\Exception $e) {
    //         // Handle the exception
    //         return response()->json(['error' => 'Failed to fetch customers: ' . $e->getMessage()], 500);
    //     }
    // }


    ///////////////////////////////////////////////////--> SETUP-CUSTOMER --> //////////////////////////////////////////////////

    //CUSTOMER-LIST
    public function customer_list()
    {
        try {
            $customers = Setup_Customer::where('flag', 0)->get();
            return view('Timesheet.customerlist', compact('customers'));
        } catch (\Exception $e) {
            return back()->with('error', 'Error occurred while fetching customer list: ' . $e->getMessage());
        }
    }


    //CUSTOMER-CREATE
    public function customer_create()
    {
        try {
            $companies = Setup_Company::all();
            return view('Timesheet.customer', compact('companies'));
        } catch (\Exception $e) {
            return back()->with('error', 'Error occurred while fetching companies: ' . $e->getMessage());
        }
    }


    //CUSTOMER-STORE
    public function customer_store(Request $request)
    {
        try {
            $customer = Setup_Customer::where('email_id', $request->input('email_id'))
                ->where('tin_no', $request->input('tin_no'))
                ->where('tan_no', $request->input('tan_no'))
                ->where('tds_percentage', $request->input('tds_percentage'))
                ->exists();

            if ($customer instanceof Setup_Customer) {
                // Update the division's flag to 0
                $customer->flag = 0;
                $customer->save();

                return redirect()->route('setup_customer_create')->with('info', 'Customer updated successfully.');
            }

            $customerExists = Setup_Customer::where('email_id', $request->input('email_id'))
                ->where('tin_no', $request->input('tin_no'))
                ->where('tan_no', $request->input('tan_no'))
                ->where('tds_percentage', $request->input('tds_percentage'))
                ->exists();

            if ($customerExists) {
                return redirect()->route('setup_customer_create')->withInput()->with('warning', 'Customer already exists.');
            }

            $customer = new Setup_Customer();
            // Set the attributes of the customer

            $customer->customer_name = $request->input('customer_name');
            $customer->contact_person_name = $request->input('contact_person_name');
            $customer->contact_number = $request->input('contact_number');
            $customer->email_id = $request->input('email_id');
            $customer->door_flat_no_build_name = $request->input('door_flat_no_build_name');
            $customer->road_street_name = $request->input('road_street_name');
            $customer->area = $request->input('area');
            $customer->city = $request->input('city');
            $customer->state = $request->input('state');
            $customer->pincode = $request->input('pincode');
            $customer->tin_no = $request->input('tin_no');
            $customer->tan_no = $request->input('tan_no');
            $customer->pan_no = $request->input('pan_no');
            $customer->tds_percentage = $request->input('tds_percentage');
            $customer->service_tax_exemption = $request->input('service_tax_exemption');
            $customer->flag = 0;
            $customer->company_id = 1;
            // Save the customer
            $customer->save();

            // Redirect to a route after successful submission
            return redirect()->route('customer_list')->with('success', 'Customer created successfully!');
        } catch (\Exception $e) {

            return redirect()->route('setup_customer_create')->withInput()->with('error', 'Failed error');
        }
    }


    //CUSTOMER-DELETE
    public function customer_delete($id)
    {
        try {
            $customer = Setup_Customer::find($id);

            if (!$customer) {
                return redirect()->route('customer_list')->with('warning', 'Customer not found.');
            }

            $customer->update([
                'flag' => 1,
                'updated_at' => now(),
            ]);

            return redirect()->route('customer_list')->with('delete', 'Customer deleted successfully');
        } catch (\Exception $e) {
            // Log or handle the exception as needed
            return redirect()->route('customer_list')->with('error', 'Failed to delete customer. Please try again.');
        }
    }

    //CUSTOMER-EDIT
    public function customer_edit($id)
    {
        try {
            $customer = Setup_Customer::find($id);

            if (!$customer) {
                return redirect()->route('customer_list')->with('warning', 'Customer not found.');
            }

            return view('Timesheet.customeredit', compact('customer'));
        } catch (\Exception $e) {
            // Log or handle the exception as needed
            return redirect()->route('customer_list')->with('error', 'Failed to fetch customer details. Please try again.');
        }
    }


    //CUSTOMER-UPDATE
    public function customer_update(Request $request, $id)
    {
        try {
            // Find the customer by ID
            $customer = Setup_Customer::findOrFail($id);

            // Check if a customer with the same details already exists
            $existingCustomer = Setup_Customer::where([

                'tin_no' => $request->tin_no,
                'tan_no' => $request->tan_no,
                'pan_no' => $request->pan_no,
            ])->where('id', '!=', $id)->exists();

            // If the customer already exists, redirect back with an error message
            if ($existingCustomer) {
                return redirect()->back()->withInput()->with('info', 'Customer already exists');
            }

            // Update customer data
            $customer->update($request->all());

            // Redirect back with success message or do whatever needed
            return redirect()->back()->with('info', 'Customer updated successfully');
        } catch (\Exception $e) {
            // Handle the exception
            return redirect()->back()->with('error', 'Failed to update customer. Please try again.');
        }
    }

    ///Gst
    public function setup_gstmaster()
    {
        $customers = Setup_Customer::where('flag', true)->get();
        $state = Setup_Details::get('state');
        return view('Timesheet.gstmaster', compact('customers', 'state'));
    }

    public function storegst(Request $request)
    {
        // Retrieve form data
        $formData = $request->only([
            'customer_id',
            'state',
            'gst_number',
            'pan_number',
        ]);

        // Check if the GST number already exists
        $existingGST = SetupGst::where('gst_number', $formData['gst_number'])->exists();

        // If the GST number already exists, redirect back with an error message
        if ($existingGST) {
            return redirect()->back()->withInput()->with('error', 'GST number already exists.');
        }

        // Create a new GST record
        $newGST = SetupGst::create($formData);

        // Redirect to a route after successful submission
        return redirect()->route('customer_list')->with('success', 'GST created successfully!');
    }


    public function index()
    {
        // Fetch all customers for the dropdown
        $customers = Setup_Customer::all();

        // Initially, set $gstdetails to an empty array
        $gstdetails = [];

        // Check if a customer is selected
        if (request()->has('customer_id')) {
            // Fetch the selected customer
            $selectedCustomer = Setup_Customer::findOrFail(request()->input('customer_id'));

            // Fetch the GST details for the selected customer
            $gstdetails = SetupGst::where('customer_id', $selectedCustomer->id)->get();
        }

        return view('Timesheet.index', compact('customers', 'gstdetails'));
    }
    public function fetchGstDetails(Request $request)
    {
        $customerId = $request->input('customer_id');
        $gstdetails = SetupGst::where('customer_id', $customerId)->where('flag', true)->get();

        return response()->json(['gstdetails' => $gstdetails]);
    }

    public function checkGSTNumber(Request $request)
    {
        $gstNumber = $request->input('gst_number');

        $exists = SetupGst::where('gst_number', $gstNumber)->exists();

        return response()->json(['exists' => $exists]);
    }



    public function update_gst(Request $request, $id)
    {
        // Find the GST record by ID
        $gst = SetupGst::findOrFail($id);

        // Update the GST record with the new data
        $gst->update([
            'customer_id' => $request->customer_id,
            'state' => $request->state,
            'gst_number' => $request->gst_number,
            'pan_number' => $request->pan_number,
        ]);

        // Redirect back with success message
        return redirect()->route('gstmaster')->with('info', 'GST Master details updated successfully.');
    }



    public function edit_gst_page($id)
    {
        $gst = SetupGst::find($id);
        $state = Setup_Details::get('state');
        $customers = Setup_Customer::where('flag', true)->get();
        return view('Timesheet.editgst', compact(['gst', 'customers', 'state']));
    }



    public function gst_delete($id)
    {

        $division = SetupGst::find($id);
        $division->update([
            'flag' => 0,
            'updated_at' => now(),
        ]);
        return redirect()->route('gstmaster')->with('delete', 'GST Deleted Sucessfully');
    }
}
