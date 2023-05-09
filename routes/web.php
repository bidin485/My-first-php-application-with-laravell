<?php

use App\Http\Controllers\BedController;
use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\FacilitiesController;
use App\Http\Controllers\HostelBookingController;
use App\Http\Controllers\HostelRoomController;
use App\Http\Controllers\HostelRoomTypeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TenantController;

Route::get('/', function () {return redirect('sign-in');})->middleware('guest');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('sign-up', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('sign-up', [RegisterController::class, 'store'])->middleware('guest');
Route::get('sign-in', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('sign-in', [SessionsController::class, 'store'])->middleware('guest');
Route::post('verify', [SessionsController::class, 'show'])->middleware('guest');
Route::post('reset-password', [SessionsController::class, 'update'])->middleware('guest')->name('password.update');
Route::get('verify', function () {
	return view('sessions.password.verify');
})->middleware('guest')->name('verify');
Route::get('/reset-password/{token}', function ($token) {
	return view('sessions.password.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('sign-out', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');
Route::get('profile', [ProfileController::class, 'create'])->middleware('auth')->name('profile');
Route::post('user-profile', [ProfileController::class, 'update'])->middleware('auth');

//Hostel Room Routes
Route::get('hostel-rooms', [HostelRoomController::class, 'index'])->middleware('auth')->name('hostel-room');
Route::get('hostel-rooms/create', [HostelRoomController::class, 'create'])->middleware('auth')->name('hostel-rooms.create');
Route::get('hostel-rooms/{id}', [HostelRoomController::class, 'show'])->middleware('auth')->name('hostel-room.show');
Route::post('hostel-rooms/create', [HostelRoomController::class, 'store'])->middleware('auth');
Route::get('hostel-rooms/{id}/edit', [HostelRoomController::class, 'edit'])->middleware('auth')->name('hostel-room.edit');
Route::delete('hostel-rooms/{id}', [HostelRoomController::class, 'destroy'])->middleware('auth')->name('hostel-room.destroy');
Route::put('hostel-rooms/{id}', [HostelRoomController::class, 'update'])->middleware('auth')->name('hostel-room.update');


//Hostel Room Types/Categories
Route::get('categories', [HostelRoomTypeController::class, 'index'])->middleware('auth')->name('hostel-room-categories');
Route::get('categories/create', [HostelRoomTypeController::class, 'create'])->middleware('auth')->name('hostel-room-categories.create');
Route::get('categories/{id}', [HostelRoomTypeController::class, 'show'])->middleware('auth')->name('hostel-room-categories.show');
Route::get('categories/{id}/create', [HostelRoomTypeController::class, 'category_create'])->middleware('auth')->name('hostel-room-categories.category_create');
Route::post('categories/{id}/create', [HostelRoomTypeController::class, 'category_store'])->middleware('auth')->name('hostel-room-categories.category_store');
Route::post('categories/create', [HostelRoomTypeController::class, 'store'])->middleware('auth');
Route::get('categories/{id}/edit', [HostelRoomTypeController::class, 'edit'])->middleware('auth')->name('hostel-room-categories.edit');
Route::delete('categories/{id}', [HostelRoomTypeController::class, 'destroy'])->middleware('auth')->name('hostel-room-categories.destroy');
Route::put('categories/{id}', [HostelRoomTypeController::class, 'update'])->middleware('auth')->name('hostel-room-categories.update');

// Staff Routes
Route::get('staff', [StaffController::class, 'index'])->middleware('auth')->name('staff');
Route::get('staff/create', [StaffController::class, 'create'])->middleware('auth')->name('staff.create');
Route::post('staff/create', [StaffController::class, 'store'])->middleware('auth');
Route::get('staff/{id}/edit', [StaffController::class, 'edit'])->middleware('auth')->name('staff.edit');
Route::delete('staff/{id}', [StaffController::class, 'destroy'])->middleware('auth')->name('staff.destroy');
Route::put('staff/{id}', [StaffController::class, 'update'])->middleware('auth')->name('staff.update');


// Tenant Routes
Route::get('tenant', [TenantController::class, 'index'])->middleware('auth')->name('tenant');
Route::get('tenant/create', [TenantController::class, 'create'])->middleware('auth')->name('tenant.create');
Route::post('tenant/create', [TenantController::class, 'store'])->middleware('auth');
Route::get('tenant/{id}/edit', [TenantController::class, 'edit'])->middleware('auth')->name('tenant.edit');
Route::delete('tenant/{id}', [TenantController::class, 'destroy'])->middleware('auth')->name('tenant.destroy');
Route::put('tenant/{id}', [TenantController::class, 'update'])->middleware('auth')->name('tenant.update');

// bed Routes
Route::get('bed', [BedController::class, 'index'])->middleware('auth')->name('bed');
Route::get('bed/create', [BedController::class, 'create'])->middleware('auth')->name('bed.create');
Route::post('bed/create', [BedController::class, 'store'])->middleware('auth');
Route::get('bed/{id}/edit', [BedController::class, 'edit'])->middleware('auth')->name('bed.edit');
Route::delete('bed/{id}', [BedController::class, 'destroy'])->middleware('auth')->name('bed.destroy');
Route::put('bed/{id}', [BedController::class, 'update'])->middleware('auth')->name('bed.update');


// hostel_booking Routes
Route::get('hostel_booking', [HostelBookingController::class, 'index'])->middleware('auth')->name('hostel_booking');
Route::get('hostel_booking/select-category', [HostelBookingController::class, 'select_category'])->middleware('auth')->name('hostel_booking.select-category');
Route::get('hostel_booking/{id}', [HostelBookingController::class, 'show'])->middleware('auth')->name('hostel_booking.show');
Route::get('hostel_booking/{category}/select-room', [HostelBookingController::class, 'select_room'])->middleware('auth')->name('hostel_booking.select-room');
Route::get('hostel_booking/{category}/select-room/{id}/create', [HostelBookingController::class, 'create'])->middleware('auth')->name('hostel_booking.create');
Route::post('hostel_booking/{category}/select-room/{id}/create', [HostelBookingController::class, 'store'])->middleware('auth');
Route::get('hostel_booking/{id}/edit', [HostelBookingController::class, 'edit'])->middleware('auth')->name('hostel_booking.edit');
Route::delete('hostel_booking/{id}', [HostelBookingController::class, 'destroy'])->middleware('auth')->name('hostel_booking.destroy');
Route::put('hostel_booking/{id}', [HostelBookingController::class, 'update'])->middleware('auth')->name('hostel_booking.update');


// facilities routes
Route::get('facilities', [FacilitiesController::class, 'index'])->middleware('auth')->name('facilities');
Route::get('facilities/create', [FacilitiesController::class, 'create'])->middleware('auth')->name('facilities.create');
Route::post('facilities/create', [FacilitiesController::class, 'store'])->middleware('auth');
Route::get('facilities/show/{id}', [FacilitiesController::class, 'show'])->middleware('auth')->name('facilities.show');
Route::get('facilities/{id}/edit', [FacilitiesController::class, 'edit'])->middleware('auth')->name('facilities.edit');
Route::post('facilities/store', [FacilitiesController::class, 'store'])->middleware('auth')->name('facilities.store');
Route::delete('facilities/{id}', [FacilitiesController::class, 'destroy'])->middleware('auth')->name('facilities.destroy');
Route::put('facilities/{id}', [FacilitiesController::class, 'update'])->middleware('auth')->name('facilities.update');


// Expenses routes
Route::get('expenses', [ExpensesController::class, 'index'])->middleware('auth')->name('expenses');
Route::get('expenses/create', [ExpensesController::class, 'create'])->middleware('auth')->name('expenses.create');
Route::get('expenses/show/{id}', [ExpensesController::class, 'show'])->middleware('auth')->name('expenses.show');
Route::delete('expenses/{id}', [ExpensesController::class, 'destroy'])->middleware('auth')->name('expenses.destroy');




//General Page Routes
Route::group(['middleware' => 'auth'], function () {
	Route::get('tables', function () {
		return view('pages.tables');
	})->name('tables');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('static-sign-in', function () {
		return view('pages.static-sign-in');
	})->name('static-sign-in');

	Route::get('static-sign-up', function () {
		return view('pages.static-sign-up');
	})->name('static-sign-up');

	Route::get('user-management', function () {
		return view('pages.laravel-examples.user-management');
	})->name('user-management');

	Route::get('user-profile', function () {
		return view('pages.laravel-examples.user-profile');
	})->name('user-profile');
});

