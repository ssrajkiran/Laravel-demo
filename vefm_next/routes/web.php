<?php

use App\Http\Controllers\BudgetController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SetupController;
use App\Http\Controllers\TimesheetController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


//Setup Company
Route::get('/Setup_company_list', [SetupController::class,'company_list'])->name('comapny_list');
Route::get('/Setup_company_edit/{id}', [SetupController::class,'company_edit'])->name('company_edit');
Route::get('/Setup_company', [SetupController::class,'company_create'])->name('comapny_create');
Route::post('/Setup_company_update/{id}', [SetupController::class,'company_update']);
Route::post('/Setup_company_store', [SetupController::class,'company_store'])->name('setup_company_store');
Route::get('/Setup_company_delete/{id}', [SetupController::class,'company_destroy']);



//Setup division

Route::get('/Setup_division', [SetupController::class,'division_create'])->name('division_create');
Route::post('/Setup_division_store', [SetupController::class,'division_store'])->name('setup_division_store');
Route::get('/Setup_division_edit/{id}', [SetupController::class,'division_edit']);
Route::post('/Setup_division_update/{id}', [SetupController::class,'division_update']);
Route::get('/Setup_division_delete/{id}', [SetupController::class,'division_delete']);



//Setup unit

Route::get('/Setup_unit',[SetupController::class,'unit_create'])->name('unit_create');
Route::post('/Setup_unit_store',[SetupController::class,'unit_store'])->name('unit_store');
Route::get('/Setup_unitedit/{id}',[SetupController::class,'unit_edit']);
Route::post('/Setup_unitupdate/{id}',[SetupController::class,'unit_update']);
Route::get('/Setup_unitdelete/{id}',[SetupController::class,'unit_delete']);



//Setup region

Route::get('/Setup_region',[SetupController::class,'region_create'])->name('region_create');
Route::post('/Setup_unit_fetch',[SetupController::class,'fetchUnits']);
Route::post('/Setup_region_store',[SetupController::class,'Setup_region_store'])->name('setup_region_store');
Route::get('/Setup_region_edit/{id}',[SetupController::class,'region_edit']);
Route::post('/Setup_regionupdate/{id}',[SetupController::class,'region_update']);
Route::get('/Setup_region_delete/{id}',[SetupController::class,'region_delete']);
Route::post('/fetch_regions', [SetupController::class, 'fetchRegions']);


//Setup POMaster

Route::get('/Setup_pomaster',[TimesheetController::class,'pomaster_create'])->name('pomaster_create');
Route::get('/Setup_pomaster_list',[TimesheetController::class,'pomaster_list'])->name('pomaster_list');

Route::post('/Setup_po_store', [TimesheetController::class, 'pomaster_store'])->name('setup_pomaster_store');
Route::post('/fetch_customers', [TimesheetController::class, 'fetchCustomers']);
Route::get('/Setup_pomaster_edit/{id}',[TimesheetController::class,'pomaster_edit']);
Route::post('/Setup_pomaster_update/{id}',[TimesheetController::class,'pomaster_update'])->name('updatepomaster');
Route::get('/Setup_pomaster_delete/{id}',[TimesheetController::class,'pomaster_delete']);
//Setup Customer

Route::get('/Setup_customerlist',[TimesheetController::class,'customer_list'])->name('customer_list');
Route::get('/Setup_customer_create',[TimesheetController::class,'customer_create'])->name('setup_customer_create');
Route::post('/Setup_customer_store', [TimesheetController::class, 'customer_store'])->name('setup_customer_store');
Route::post('/Setup_customer_update/{id}',[TimesheetController::class,'customer_update'])->name('setup_customer_update');
Route::get('/Setup_customer_delete/{id}',[TimesheetController::class,'customer_delete']);
Route::get('/Setup_customer_edit/{id}',[TimesheetController::class,'customer_edit']);
Route::post('/fetch_customers', [TimesheetController::class, 'fetchCustomers'])->name('fetch_customers');

//Setup User
Route::get('/Setup_user',[SetupController::class,'user_create_page'])->name('user_createpage');
Route::post('/check_smart_user_id', [SetupController::class, 'checkSmartUserID'])->name('check_smart_user_id');
Route::post('/setup_user_store', [SetupController::class, 'user_store'])->name('setup_user_store');
Route::get('/Setup_user_list',[SetupController::class,'user_list'])->name('Setup_user_list');
Route::get('/Setup_user_edit/{id}',[SetupController::class,'user_edit'])->name('user_edit');
Route::post('/Setup_user_update/{id}',[SetupController::class,'user_update'])->name('updateuser');
Route::get('/Setup_user_delete/{id}',[SetupController::class,'user_delete']);
Route::get('/Setup_assignrights_page',[SetupController::class,'assign_right_page']);
Route::post('/fetch_users_id', [SetupController::class, 'fetchUsersid'])->name('fetch_users_id');
Route::post('/fetch_user_data', [SetupController::class,'fetchUserdetails']);

//Check Unique
Route::post('/check_unique_user_id', [SetupController::class,'checkUniqueUserId']);
Route::post('/check_unique_email', [SetupController::class,'checkUniqueEmail']);



//Setup GST
Route::get('/Setup_gstmaster', [TimesheetController::class,'setup_gstmaster'])->name('gstmaster');
Route::get('/gst', [TimesheetController::class, 'index'])->name('gst.index');
Route::post('/store_gst', [TimesheetController::class, 'storegst'])->name('store_gst');
Route::post('/check_gst_number', [TimesheetController::class, 'checkGSTNumber'])->name('check_gst_number');
Route::get('/gst/fetch', [TimesheetController::class, 'fetchGstDetails'])->name('fetch_gst_details');
////////////////////////////////
Route::get('/editgst_page/{id}', [TimesheetController::class, 'edit_gst_page'])->name('edit_gst_page');
Route::post('/update_gst/{id}', [TimesheetController::class, 'update_gst']);
Route::get('/gst_delete/{id}',[TimesheetController::class,'gst_delete']);
////////////////////////////////

//Setup Engineer
Route::get('/Setup_engineer', [BudgetController::class,'Setup_engineer'])->name('Setup_engineer');
Route::post('/Setup_engineer_store', [BudgetController::class, 'engineer_save'])->name('engineers_store');
Route::post('/check_unique_engineer_ecode', [BudgetController::class,'checkUniqueEngineerId']);
Route::get('/Setup_engineer_list',[BudgetController::class,'engineer_list'])->name('Setup_engineer_list');
Route::get('/Setup_engineer_edit/{id}', [BudgetController::class, 'edit_engineer_page'])->name('edit_engineer');
Route::post('/update_engineer/{id}', [BudgetController::class, 'update_engineer']);
Route::get('/Setup_engineerdelete/{id}', [BudgetController::class, 'delete_engineer']);
Route::post('/check_engineer_email', [BudgetController::class, 'checkEngineerEmail'])->name('check_engineer_email');
