<?php

namespace App\Http\Controllers;

use App\Models\Setup_Company;
use App\Models\Setup_Division;
use App\Models\Setup_Unit;
use App\Models\Setup_Region;
use App\Models\Setup_Customer;
use App\Models\Setup_User;
use App\Models\SetupGst;
use App\Models\Setup_Details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SetupController extends Controller
{

    public function company_create()
    {
        try {
            // Retrieve unique country values using groupBy
            // Fetch unique country names from the `Setup_Details` table
            $countries = Setup_Details::groupBy('country')->pluck('country');


            return view('Setup.company', compact('countries'));
        } catch (\Exception $e) {
            // Log the exception or handle it as per your application's requirements
            return redirect()->back()->with('error', 'Error occurred while fetching setup details: ' . $e->getMessage());
        }
    }



    public function company_store(Request $request)
    {
        try {
            // Check if the company with the same name already exists
            $existingCompany = Setup_Company::where('company_name', $request->input('company_name'))
                ->where('website', $request->input('website'))
                ->exists();

            // If the company already exists, redirect back with the input data
            if ($existingCompany) {
                return redirect()->route('comapny_create')->withInput()->with('warning', 'Company already exists.');
            }

            // If the company does not exist, create it
            Setup_Company::create([
                'id' => $request->input('company_code'),
                'company_name' => $request->input('company_name'),
                'location' => $request->input('location'),
                'address' => $request->input('address'),
                'city' => $request->input('city'),
                'state' => $request->input('state'),
                'country' => $request->input('country'),
                'pincode' => $request->input('pincode'),
                'telephone' => $request->input('telephone'),
                'mobile' => $request->input('mobile'),
                'website' => $request->input('website'),
                'status' => $request->input('status'),
            ]);

            return redirect()->route('comapny_list')->with('success', 'Company Created Successfully');
        } catch (\Exception $e) {
            // Handle exceptions
            return redirect()->back()->withInput()->with('error', 'Error occurred while creating company: ' . $e->getMessage());
        }
    }

    public function company_list()
    {
        try {
            $company = Setup_Company::orderBy('id', 'desc')->paginate(10);


            return view('setup.companylist', compact('company'));
        } catch (\Exception $e) {
            // Handle exceptions
            return view('Setup.company')->with('error', 'Error occurred while fetching company list: ' . $e->getMessage());
        }
    }


    public function company_edit($id)
    {
        try {
            $company = Setup_Company::findOrFail($id);
            $countries = Setup_Details::groupBy('country')->pluck('country');
            return view('Setup.company_edit', compact('company', 'countries'));
        } catch (\Exception $e) {
            // Handle exceptions
            return redirect()->back()->with('error', 'Error occurred while fetching company details: ' . $e->getMessage());
        }
    }

    public function company_update(Request $request, $id)
    {
        try {
            $company = Setup_Company::findOrFail($id);

            if ($company->company_name != $request->input('company_name')) {
                $existingCompany = Setup_Company::where('company_name', $request->input('company_name'))->first();

                if ($existingCompany && $existingCompany->id != $id) {
                    return redirect()->back()->withInput()->withErrors(['company_name' => 'The company name already exists.']);
                }
            }

            $company->update([
                'company_name' => $request->input('company_name'),
                'location' => $request->input('location'),
                'address' => $request->input('address'),
                'city' => $request->input('city'),
                'state' => $request->input('state'),
                'country' => $request->input('country'),
                'pincode' => $request->input('pincode'),
                'telephone' => $request->input('telephone'),
                'mobile' => $request->input('mobile'),
                'website' => $request->input('website'),
                'status' => $request->input('status')
            ]);

            return redirect()->route('company_edit', ['id' => $id])->with('info', 'Company Updated Successfully');
        } catch (\Exception $e) {
            // Handle exceptions
            return redirect()->back()->withInput()->with('error', 'Error occurred while updating company: ' . $e->getMessage());
        }
    }


    // public function company_destroy($id)
    // {
    //     try {
    //         $company = Setup_Company::findOrFail($id);
    //         $company->delete();
    //         return redirect()->route('comapny_list')->with('delete', 'Company Deleted Successfully');
    //     } catch (\Exception $e) {
    //         // Handle exceptions
    //         return redirect()->back()->with('error', 'Error occurred while deleting company: ' . $e->getMessage());
    //     }
    // }


    ///////////////////////////////////////////////////--> SETUP-DIVISION --> ////////////////////////////////////////////////////

    //DIVISION-CREATE_PAGE
    public function division_create()
    {
        try {
            $divisions = Setup_Division::with('company')->where('flag', 0)->orderBy('id', 'desc')->get();
            $companies = Setup_Company::where('flag', 0)->get();
            return view('Setup.division', compact('divisions', 'companies'));
        } catch (\Exception $e) {
            // Handle exceptions
            return redirect()->back()->with('error', 'Error occurred while fetching division details: ' . $e->getMessage());
        }
    }

    //DIVISION-CREATE
    public function division_store(Request $request)
    {
        try {
            // Check if a division with the provided name, code, and flag 1 exists
            $division = Setup_Division::where('division_name', $request->input('division'))
                ->where('division_code', $request->input('division_code'))
                ->where('flag', 1)
                ->first();


            if ($division instanceof Setup_Division) {
                // Update the division's flag to 0
                $division->flag = 0;
                $division->company_id = $request->input('company_id');
                $division->save();

                return redirect()->route('division_create')->with('info', 'Division updated successfully.');
            }

            // Check if a division with the provided name exists
            $divisionExists = Setup_Division::where('division_name', $request->input('division'))
                ->where('flag', 0)
                ->exists();

            if ($divisionExists) {
                return redirect()->route('division_create')->withInput()->with('warning', 'Division already exists.');
            }

            // Create a new division
            Setup_Division::create([
                'company_id' => $request->input('company_id'),
                'division_name' => $request->input('division'),
                'division_code' => $request->input('division_code'),

            ]);

            return redirect()->route('division_create')->with('success', 'Division Created Successfully');
        } catch (\Exception $e) {
            return redirect()->route('division_create')->withInput()->with('error', 'Failed to create division: ' . $e->getMessage());
        }
    }



    //DIVISION-EDIT
    public function division_edit($id)
    {
        try {
            $division = Setup_Division::findOrFail($id);
            $companies = Setup_Company::all();
            return view('Setup.division_edit', compact('division', 'companies'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error occurred while fetching division details: ' . $e->getMessage());
        }
    }


    //DIVISION-UPDATE
    public function division_update(Request $request, $id)
    {
        try {
            // Find the division being updated
            $division = Setup_Division::find($id);

            // Check if there's another division with the same details and flag set to 0
            $existingDivision = Setup_Division::where('division_name', $request->input('division'))
                ->where('division_code', $request->input('division_code'))
                ->where('flag', 0)
                ->first();

            if ($existingDivision) {
                // Redirect back with a warning message if a division with the same details and flag 0 exists
                return redirect()->back()->with('warning', 'Division already exists.');
            }

            // Update the division being edited
            $division->update([
                'company_id' => $request->input('company_id'),
                'division_name' => $request->input('division'),
                'division_code' => $request->input('division_code'),
                'flag' => 0,
            ]);

            // Redirect back to the creation page with a success message
            return redirect()->back()->with('info', 'Division Updated Successfully');
        } catch (\Exception $e) {
            return redirect()->route('division_create')->withInput()->with('error', 'Failed to update division: ' . $e->getMessage());
        }
    }

    //DIVISION-DELETE
    public function division_delete($id)
    {
        try {
            // Check if the division is linked to units or regions where the flag is 0
            $linkedUnits = Setup_Unit::where('division_id', $id)->where('flag', 0)->exists();
            $linkedRegions = Setup_Region::where('division_id', $id)->where('flag', 0)->exists();

            // If linked records exist in either units or regions where the flag is 0, prevent deletion
            if ($linkedUnits || $linkedRegions) {
                return redirect()->route('division_create')->with('warning', 'Division is linked to units or regions.');
            }

            // If no linked records exist, proceed with deleting the division
            $division = setup_Division::find($id);
            $division->update([
                'flag' => 1,
                'updated_at' => now(),
            ]);

            return redirect()->route('division_create')->with('delete', 'Division Deleted Successfully');
        } catch (\Exception $e) {
            return redirect()->route('division_create')->with('error', 'Failed to delete division: ' . $e->getMessage());
        }
    }


    ///////////////////////////////////////////////////--> SETUP-UNIT --> //////////////////////////////////////////////////

    //UNIT-CREATE_PAGE
    public function unit_create()
    {
        try {
            // Retrieve divisions where flag is true
            $division = setup_Division::where('flag', 0)->get();

            // Retrieve companies
            $company = Setup_Company::all();

            // Retrieve units where flag is 0
            $unit = setup_Unit::where('flag', 0)->orderBy('id', 'desc')->get();

            return view('Setup.unit', compact('division', 'company', 'unit'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error occurred while fetching unit details: ' . $e->getMessage());
        }
    }

    //UNIT-CREATE
    public function unit_store(Request $request)
    {
        try {


            // Check if a unit with the provided name and division ID exists with flag 1
            $unit = Setup_Unit::where('unit', $request->input('unit'))
                ->where('division_id', $request->input('division'))
                ->where('flag', 1)
                ->first();

            if ($unit instanceof Setup_Unit) {
                // Update the unit's flag to 0
                $unit->flag = 0;
                $unit->save();

                return redirect()->route('unit_create')->with('info', 'Unit updated successfully.');
            }

            // Check if a unit with the provided name and division ID exists with flag 0
            $unitExists = Setup_Unit::where('unit', $request->input('unit'))
                ->where('division_id', $request->input('division'))
                ->where('flag', 0)
                ->exists();

            if ($unitExists) {
                // Redirect with a message indicating that the unit already exists
                return redirect()->route('unit_create')->withInput()->with('info', 'Unit already exists.');
            }

            // Create a new unit
            Setup_Unit::create([
                'company_id' => $request->input('company_id'),
                'division_id' => $request->input('division'),
                'unit' => $request->input('unit'),
                'invoice_code' => $request->input('invoice_code'),
                'flag' => 0, // Set flag to 1 for new units
            ]);

            return redirect()->route('unit_create')->with('success', 'Unit Created Successfully');
        } catch (\Exception $e) {
            return redirect()->route('unit_create')->withInput()->with('error', 'Failed to create unit: ' . $e->getMessage());
        }
    }


    //UNIT-EDIT
    public function unit_edit($id)
    {
        $division = setup_Division::all();
        $unit = setup_Unit::find($id);
        $company = Setup_Company::all();
        return view('Setup.unit_edit', compact(['unit', 'division','company']));
    }

    //UNIT-UPDATE
    public function unit_update(Request $request, $id)
    {
        try {
            // Find the unit being updated
            $unit = Setup_Unit::find($id);

            // Check if there's another unit with the same details within the specified division
            $Unit = Setup_Unit::where('division_id', $request->division)
                ->where('unit', $request->input('unit'))
                ->where('flag', 0) // Exclude the current unit being updated
                ->first();

            // Check the flag of the existing unit
            if ($Unit) {
                
                return redirect()->back()->with('warning', 'Unit already exists.');
            }

            $existingUnit = Setup_Unit::where('division_id', $request->division)
                ->where('unit', $request->input('unit'))
                ->where('flag', 1) // Exclude the current unit being updated
                ->exists();

                if ($existingUnit) {
                    $unit->update([

                        'company_id' => $request->input('company_id'),
                        'division_id' => $request->input('division'),
                        'unit' => $request->input('unit'),
                        'flag' => 0,
                        'updated_at'=>now(),
                    ]);
                
                    return redirect()->back()->with('warning', 'Unit Updated Successfully.');
                }

            // Update the unit
            $unit->update([
                'company_id' => $request->input('company_id'),
                'division_id' => $request->input('division'),
                'unit' => $request->input('unit'),
            ]);

            // Redirect back to the unit create page with a success message
            return redirect()->back()->with('info', 'Unit has been updated successfully');
        } catch (\Exception $e) {
            // Redirect back with an error message
            return redirect()->route('unit_create')->with('error', 'Failed to update unit: ' . $e->getMessage());
        }
    }


    //UNIT-DELETE
    public function unit_delete($id)
    {
        try {
            $unit = Setup_Unit::find($id);
           
            // Check if the division is linked to units or regions where the flag is 0
            $linkeddivision = Setup_Region::where('unit_id', $id)->where('flag', 0)->exists();

            // If linked records exist in either units or regions where the flag is 0, prevent deletion
            if ($linkeddivision) {
                return redirect()->route('unit_create')->with('warning', 'Unit is linked to Division');
            }

            // If no linked records exist, proceed with deleting the division
            $unit = Setup_Unit::find($id);
            $unit->update([
                'flag' => 1,
                'updated_at' => now(),
            ]);

            return redirect()->route('unit_create')->with('delete', 'Unit Deleted Successfully');
        } catch (\Exception $e) {
            return redirect()->route('unit_create')->with('error', 'Failed to delete Unit: ' . $e->getMessage());
        }
    }

    ///////////////////////////////////////////////////--> SETUP-REGION --> //////////////////////////////////////////////////

    //REGION-CREATE_PAGE
    public function region_create()
    {
        try {
            // Retrieve companies, divisions, units, and regions
            $company = Setup_Company::all();
            $division = setup_Division::where('flag', 0)->get();
            $unit = setup_Unit::where('flag', 0)->get();
            $region = setup_Region::where('flag', 0)->orderBy('id', 'desc')->get();

            // Return the view with the retrieved data
            return view('Setup.region', compact('company', 'division', 'unit', 'region'));
        } catch (\Exception $e) {
            // Handle exceptions
            return redirect()->back()->with('error', 'Error occurred while fetching region details: ' . $e->getMessage());
        }
    }

    //REGION-FETCHUNIT
    public function fetchUnits(Request $request)
    {
        try {
            // Retrieve the division ID from the request
            $divisionId = $request->input('division');

            // Fetch units based on the division ID
            $units = Setup_Unit::where('division_id', $divisionId)->get();

            // Return JSON response with the fetched units
            return response()->json(['units' => $units]);
        } catch (\Exception $e) {
            // Handle exceptions
            return response()->json(['error' => 'Error occurred while fetching units: ' . $e->getMessage()], 500);
        }
    }


    //REGION-CREATE
    public function Setup_region_store(Request $request)
    {
        try {

            // Check if the region already exists
            $region = Setup_Region::where('region_name', $request->input('region'))
                ->where('division_id', $request->input('division'))
                ->where('flag', 1)
                ->first();

            if ($region instanceof Setup_Region) {
                // Update the division's flag to 0
                $region->flag = 0;
                $region->save();

                return redirect()->route('region_create')->with('info', 'Region updated successfully.');
            }

            // Check if a division with the provided name exists
            $regionExists = Setup_Region::where('region_name', $request->input('region'))
                ->where('division_id', $request->input('division'))
                ->where('flag', 0)
                ->exists();

            if ($regionExists) {
                return redirect()->route('region_create')->withInput()->with('warning', 'Region already exists.');
            }
            // If the region does not exist, create it
            Setup_Region::create([
                'company_id' => $request->input('company_id'),
                'division_id' => $request->division,
                'unit_id' => $request->unit,
                'region_name' => $request->input('region'),
                'region_code' => $request->input('region_code'),
                'invoice_code' => $request->input('invoice_code'),
                'flag' => 0 // Set flag to true when creating a new region
            ]);

            // Redirect back to the region create page with a success message
            return redirect()->route('region_create')->with('success', "Region Created Successfully");
        } catch (\Exception $e) {
            // Redirect back with an error message
            return redirect()->route('region_create')->withInput()->with('error', 'Failed to create region: ' . $e->getMessage());
        }
    }


    //REGION-EDIT

    public function region_edit($id)
    {
        try {
            $region = Setup_Region::find($id);
            $company = Setup_Company::all();
            return view('Setup.region_edit', compact('company', 'region'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function region_update(Request $request, $id)
    {
        try {
            // Find the region being updated
            $region = Setup_Region::find($id);

            if (!$region) {
                throw new \Exception("Region not found.");
            }

            // Check if the updated region already exists excluding the current region being updated
            $existingRegion = Setup_Region::where('region_name', $request->input('region'))
                ->where('division_id', $request->input('division'))
                ->where('flag', 0)
                ->first();

            // Check the flag of the existing region
            if ($existingRegion) {
                // Redirect back with a warning message if flag is true
                return redirect()->back()->with('warning', 'Region already exists.');
            }

            // Update the region
            $region->update([
                'company_id' => $request->input('company_id'),
                'division_id' => $request->division,
                'unit_id' => $request->unit,
                'region_name' => $request->input('region'),
                'region_code' => $request->input('region_code'),
                'invoice_code' => $request->input('invoice_code'),
            ]);

            // Redirect back to the region create page with a success message
            return redirect()->back()->with('info', "Region Updated Successfully");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function fetchRegions(Request $request)
    {
        $unitId = $request->input('unit');

        $regions = Setup_Region::where('unit_id', $unitId)->where('flag', 0)->get();

        return response()->json(['regions' => $regions]);
    }


    //REGION-DELETE
    public function region_delete($id)
    {
        try {
            $region = setup_Region::find($id);
            
            // Check if the division is linked to units or regions where the flag is 0
         

            // If linked records exist in either units or regions where the flag is 0, prevent deletion
            // if ($linkeddivision || $linkedunit) {
            //     return redirect()->route('region_create')->with('warning', 'Unit is linked to Division or regions so cannot be deleted.');
            // }

            $region->update([
                'flag' => 1,
                'updated_at' => now(),
            ]);
            return redirect()->route('region_create')->with('delete', "Region Deleted Successfully");
        } catch (\Exception $e) {
            return redirect()->route('region_create')->with('error', 'Failed to delete Region: ' . $e->getMessage());
        }
    }



    ///////////////////////////////////////////////////--> SETUP-POMASTER --> //////////////////////////////////////////////////



    ///////////////////////////////////////////////////--> SETUP-USER --> //////////////////////////////////////////////////

    //USER-DATA
    public function fetchUserData(Request $request)
    {
        try {
            $divisionId = $request->input('division');
            $unitId = $request->input('unit');
            $regionId = $request->input('region');

            $userData = Setup_User::where('division_id', $divisionId)
                ->where('unit_id', $unitId)
                ->where('region_id', $regionId)
                ->first();

            if ($userData) {
                $userData = [
                    'divisionId' => $divisionId,
                    'userData' => $userData,
                    'unitId' => $unitId,
                    'regionId' => $regionId
                ];
                return response()->json($userData);
            } else {
                return response()->json(['delete' => 'User not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error fetching user data: ' . $e->getMessage()], 500);
        }
    }



    //USER-FETCHID
    public function fetchUsersid(Request $request)
    {
        try {
            $divisionId = $request->input('division');
            $unitId = $request->input('unit');
            $regionId = $request->input('region');

            $query = Setup_User::query();

            if ($divisionId) {
                $query->where('division_id', $divisionId);
            }

            if ($unitId) {
                $query->where('unit_id', $unitId);
            }

            if ($regionId) {
                $query->where('region_id', $regionId);
            }

            $users = $query->get(['id', 'user_id']);

            return response()->json(['users' => $users]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error fetching user data: ' . $e->getMessage()], 500);
        }
    }


    //USER-CREATE_PAGE
    public function user_create_page()
    {
        try {
            $company = Setup_Company::where('flag', 0)->get();
            $division = Setup_Division::where('flag', 0)->get();
            $unit = Setup_Unit::where('flag', 0)->get();
            $region = Setup_Region::where('flag', 0)->get();
            return view('Setup.adduser', compact(['company', 'division', 'unit', 'region']));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error occurred while fetching data: ' . $e->getMessage());
        }
    }

    //USER-UNIQUEID
    public function checkUniqueUserId(Request $request)
    {
        try {
            $userId = $request->user_id;

            $user = Setup_User::where('user_id', 'VE' . $userId)->first();

            if ($user) {
                return response()->json(['unique' => false]);
            } else {
                return response()->json(['unique' => true]);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while checking the unique user ID: ' . $e->getMessage()], 500);
        }
    }

    //USER-UNIQUEEMAIL
    public function checkUniqueEmail(Request $request)
    {
        try {
            $email = $request->email;

            $user = Setup_User::where('email_id', $email)->first();

            if ($user) {
                return response()->json(['unique' => false]);
            } else {
                return response()->json(['unique' => true]);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while checking the unique email: ' . $e->getMessage()], 500);
        }
    }


    //USER-CREATE
    public function user_store(Request $request)
    {
        try {
    
            // Check if the user already exists
            $user = Setup_User::where('email_id', $request->input('email_id'))
                ->where('user_id', $request->input('user_id'))
                ->where('flag', 1)
                ->first();

            // If the user already exists, redirect back with an error message
            if ($user instanceof Setup_User) {
                // Update the division's flag to 0
                $user->flag = 0;
                $user->save();

                return redirect()->route('Setup_user_list')->with('info', 'User updated successfully.');
            }

            $usermail = Setup_User::where('email_id', $request->input('email_id'))->exists();
            if ($usermail) {
                return redirect()->route('user_createpage')->withInput()->with('warning', 'User Mail already exists.');
            }
            $userExists = Setup_User::where('email_id', $request->input('email_id'))
                ->where('user_id', $request->input('user_id'))
                ->where('flag', 0)
                ->exists();

            if ($userExists) {
                return redirect()->route('user_createpage')->withInput()->with('warning', 'User already exists.');
            }

            // If the user does not exist, create it
            Setup_User::create([

                'personrole' => $request->input('person_role'),
                'division_id' => $request->division,
                'unit_id' => $request->unit,
                'region_id' => $request->region,
                'user_id' => 'VE-' . $request->input('user_id'),
                'password' => $request->input('password'),
                'hash_password' => Hash::make($request->input('password')),
                'name' => $request->input('name'),
                'designation' => $request->input('designation'),
                'email_id' => $request->input('email_id'),
                'mobile_number' => $request->input('mobile_number'),
                'status' => 'active',
                'flag' => 0
            ]);

            // Redirect back to the user create page with a success message
            return redirect()->route('Setup_user_list')->with('success', "User Created Successfully");
        } catch (\Exception $e) {
            // Handle any exceptions
            return redirect()->back()->withInput()->with('error', 'An error occurred. Please try again.');
        }
    }

    //USER=LIST
    public function user_list()
    {
        try {
            $user = Setup_User::where('flag', 0)->orderBy('id', 'desc')->get();
            return view('Setup.userlist', compact('user'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while fetching user list: ' . $e->getMessage());
        }
    }


    //USER-EDIT_PAGE
    public function user_edit($id)
    {
        try {
            $user = Setup_User::find($id);
            if (!$user) {
                throw new \Exception('User not found.');
            }

            $divisions = Setup_Division::where('flag', 0)->get();
            return view('Setup.useredit', compact('user', 'divisions'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to fetch user details: ' . $e->getMessage());
        }
    }


    //USER-ASSIGNPAGE
    public function assign_right_page()
    {
        try {
            $company = Setup_Company::where('flag', 0)->get();
            $division = Setup_Division::where('flag', 0)->get();
            return view('Setup.assignrights', compact('division', 'company'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to load assign rights page: ' . $e->getMessage());
        }
    }

    //USER-DELETE
    public function user_delete($id)
    {
        try {
            $user = Setup_User::find($id);
            $divisionId = $user->division_id;
            $unitId = $user->unit_id;
            $regionId = $user->region_id;

            $linkedregionId = Setup_Region::where('id', $regionId)->where('flag', 0)->exists();
            // Check if a division with the retrieved ID and flag 0 exists
            $linkedDivision = Setup_Division::where('id', $divisionId)->where('flag', 0)->exists();
            $unitId = Setup_Unit::where('id', $unitId)->where('flag', 0)->exists();

            // If linked records exist in either units or regions where the flag is 0, prevent deletion
            if ($linkedDivision || $unitId || $linkedregionId) {
                return redirect()->route('Setup_user_list')->with('warning', 'User is linked to Division or regions so cannot be deleted.');
            }

            $user = Setup_User::find($id);
            $user->update([
                'flag' => 0,
                'updated_at' => now(),
            ]);

            return redirect()->back()->with('delete', 'Deleted successful');
        } catch (\Exception $e) {
            return redirect()->route('Setup_user_list')->with('error', 'Failed to delete Region: ' . $e->getMessage());
        }
    }

    public function user_update(Request $request, $id)
    {
        try {
            // Find the User by ID
            $user = Setup_User::findOrFail($id);
    
            // Check if the email ID is being changed
            if ($user->email_id != $request->input('email_id')) {
                // Check if the new email ID already exists
                $existingUser = Setup_User::where('email_id', $request->input('email_id'))->exists();
                if ($existingUser) {
                    // Redirect back with a warning message if email ID already exists
                    return redirect()->back()->with('warning', 'User with the provided email ID already exists.');
                }
            }
    
            // Update user data
            $user->update($request->all());
    
            // Redirect back with success message
            return redirect()->back()->with('info', 'User updated successfully');
        } catch (\Exception $e) {
            // Handle the exception
            return back()->withInput()->withErrors(['error' => 'Failed to update user. Please try again.']);
        }
    }
    

    //USER-FETCHUSER
    public function fetchUserdetails(Request $request)
    {
        $user = Setup_User::find($request->user_id);
        $division = Setup_Division::find($request->division_id);
        $unit = Setup_Unit::find($request->unit_id);
        $region = Setup_Region::find($request->region_id);

        if ($user && $division && $unit && $region) {
            $userData = $user->name . ' - ' . $user->designation . ' (' . $division->division_name . ', ' . $unit->unit . ', ' . $region->region_name . ')';
            return response()->json(['user_details' => $userData]);
        } else {
            return response()->json(['error' => 'Data not found'], 404);
        }
    }


    ///////////////////////////////////////////////////--> SETUP-GSTMASTER --> //////////////////////////////////////////////////
    public function setup_gstmaster()
    {
        $customers = Setup_Customer::where('flag', true)->get();
        $state = Setup_Details::get('state');
        return view('Setup.gstmaster', compact('customers', 'state'));
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

        return view('gst.index', compact('customers', 'gstdetails'));
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
        return view('Setup.editgst', compact(['gst', 'customers', 'state']));
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
