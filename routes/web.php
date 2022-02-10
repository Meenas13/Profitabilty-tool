<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PermissionController;


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

Route::get('/', 'SsoController@index')->name('login');

// Route::get('/', [LoginController::class,'showLoginForm'])->name('login');
Route::get('login', 'SsoController@index')->name('login');

// Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
// Route::post('login', [LoginController::class, 'login']);
// Route::post('register', [RegisterController::class, 'register']);

Route::get('password/forget',  function () {
	return view('pages.forgot-password');
})->name('password.forget');

Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('sso-login', 'SsoController@index');
Route::get('sso-redirect', 'SsoController@redirect');
Route::get('sso-action', 'SsoController@action');
Route::get('message', 'SsoController@message');

Route::group(['middleware' => 'auth'], function () {

	// logout route
	Route::get('/logout', [LoginController::class, 'logout']);
	Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
	Route::get('/clear-cache', [DashboardController::class, 'clearCache']);

	//only those have manage_user permission will get access
	Route::group(['middleware' => 'can:manage_user'], function () {
		Route::get('/users', [UserController::class, 'index']);
		Route::get('/user/get-list', [UserController::class, 'getUserList']);
		Route::get('/user/create', [UserController::class, 'create']);
		Route::post('/user/create', [UserController::class, 'store'])->name('create-user');
		Route::get('/user/{id}', [UserController::class, 'edit']);
		Route::post('/user/update', [UserController::class, 'update']);
		Route::get('/user/delete/{id}', [UserController::class, 'delete']);
	});
	Route::get('/profile', [UserController::class, 'profile']);
	Route::post('/user-profile', [UserController::class, 'updateProfile'])->name('user-profile');

	//only those have manage_role permission will get access
	Route::group(['middleware' => 'can:manage_role|manage_user'], function () {
		Route::get('/roles', [RolesController::class, 'index']);
		Route::get('/role/get-list', [RolesController::class, 'getRoleList']);
		Route::post('/role/create', [RolesController::class, 'create']);
		Route::get('/role/edit/{id}', [RolesController::class, 'edit']);
		Route::post('/role/update', [RolesController::class, 'update']);
		Route::get('/role/delete/{id}', [RolesController::class, 'delete']);
	});

	//only those have manage_permission permission will get access
	Route::group(['middleware' => 'can:manage_permission|manage_user'], function () {
		Route::get('/permission/{id}', [PermissionController::class, 'index']);
		Route::post('/permission/create', [PermissionController::class, 'create']);
		Route::post('/permission/update', [PermissionController::class, 'update']);
		Route::get('/permission/delete/{id}', [PermissionController::class, 'delete']);
	});

	Route::post('/get_uniqueCustomer', [DashboardController::class, 'get_uniqueCustomer'])->name('get_uniqueCustomer');
	Route::get('/get_uniqueCustomer', [DashboardController::class, 'get_uniqueCustomer'])->name('get_uniqueCustomer');

	// Route::get('/bb_preRequestedData', [DashboardController::class, 'bb_preRequestedData'])->name('bb_preRequestedData');
	Route::get('/get_allUniqueCustomer', [DashboardController::class, 'get_allUniqueCustomer'])->name('get_allUniqueCustomer');

	Route::get('/customer', [DashboardController::class, 'customers'])->name('customer');
	//	Route::get('/customer-offer', function () { return view('customer.offer'); })->name('customer-offer'); 

	Route::post('/full_domainList', [DashboardController::class, 'full_domainList'])->name('full_domainList');


	Route::post('/customer-offer-data', [DashboardController::class, 'customersOffer'])->name('customer-offer-data');
	Route::get('/customer-offer-data', [DashboardController::class, 'customersOffer'])->name('customer-offer-data');
	Route::post('/forcasted-cal', [DashboardController::class, 'forecastedCal'])->name('forcasted-cal');
	Route::post('/insertCustomer', [DashboardController::class, 'insertCustomer'])->name('insertCustomer');
	Route::get('/nnnbp_screen', [DashboardController::class, 'nnnbp_screen'])->name('nnnbp_screen');
	// Route::post('/update_nnnbpSrc/{selected_src}/{buy_domain_no}', [DashboardController::class, 'update_nnnbpSrc'])->name('update_nnnbpSrc');
	Route::post('/update_nnnbpSrc', [DashboardController::class, 'update_nnnbpSrc'])->name('update_nnnbpSrc');

	Route::post('/calculate_backBonus', [DashboardController::class, 'calculate_backBonus'])->name('calculate_backBonus');

});
