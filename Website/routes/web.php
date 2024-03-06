<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ProductController;
use App\Mail\Hellomail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
   
    return view('Welcome');
});

Route::controller(AuthController::class)->group(function () {

    Route::get('/', 'homepage')->name('Back');

    Route::get('/register_page', 'register_page')->name('Auth.register_page');

    Route::post('/register', 'registration')->name('Auth.registration');

    Route::post('/dashboard', 'dashboard')->name('dashboard');

    Route::post('/dashboard', 'login')->name('Auth.login');

    Route::get('/login_page', 'logout')->name('Auth.logout');

    Route::get('/login', 'login_page')->name('Auth.login_page');

    Route::get('/dashboard', 'Dashboard')->name('dashboard');

    Route::get('/users','index');

});

Route::post('/index', [ProductController::class, 'getFilteredProducts'])->name('getFilteredProducts');

//Listing the user 
Route::get('/index', [AuthController::class, 'index'])->name('index');
Route::get('/get-details/{id}', [AuthController::class, 'getDetails'])->name('get-details');


Route::get('/products', [ProductController::class, 'index']);
Route::get('/get-products', [ProductController::class, 'getProducts']);

Route::controller(ProductController::class)->group(function () {

    Route::get('/products', 'index')->name('Product.list');

    Route::post('products/store', 'store')->name('Product.store');

    Route::get('products/create', 'create')->name('Product.create');

    Route::get('products/{product}', 'show')->name('Product.show');

    Route::delete('products/{product}', 'destroy')->name('Product.destroy');

    Route::get('products/{product}/edit', 'edit')->name('Product.edit');

    Route::put('products/{product}', 'update')->name('Product.update');
});

