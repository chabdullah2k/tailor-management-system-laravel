<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\MeasurementFieldController;
use App\Http\Controllers\Admin\CustomersController;
use App\Http\Controllers\MeasurementController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ExpensesController;
use App\Http\Controllers\Admin\ContactsController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\MainOrderController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

	// <link rel="stylesheet" type="text/css" href="{{ asset('admin/asset/src/styles/order.css')}}">


Route::middleware('auth')->group(function () {
    Route::get('/mainorder', [MainOrderController::class, 'mainOrder'])->name('mainorder.index');
    Route::get('/mainorder/create', [MainOrderController::class, 'create'])->name('mainorder.create');
    Route::post('/mainorder/store', [MainOrderController::class, 'store'])->name('mainorder.store');
    Route::post('/mainorder/services', [MainOrderController::class, 'fetchServices'])->name('mainorder.services');
    Route::post('/mainorder/search-customer', [MainOrderController::class, 'searchCustomer'])->name('mainorder.searchCustomer');
    Route::post('/mainorder/measurements', [MainOrderController::class, 'fetchMeasurements'])->name('mainorder.measurements');
    Route::get('/mainorder/index', [MainOrderController::class, 'index'])->name('mainorder.index');
});


    Route::middleware('auth')->group(function () {
 Route::get('/index', [DashboardController::class, 'dashboardMetrics'])->name('index');

});

// Route::get('/admin/dashboard', function () {
//     return view('admin.index');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//measurement-fields
Route::group([ 'prefix' => 'measurement-fields',   'middleware' => 'auth'], function() {
    Route::get('/', [MeasurementFieldController::class, 'index'])->name('measurement_fields.index');
    Route::get('create', [MeasurementFieldController::class, 'create'])->name('measurement_fields.create');
    Route::post('store', [MeasurementFieldController::class, 'store'])->name('measurement_fields.store');
    Route::get('{measurementField}/edit', [MeasurementFieldController::class, 'edit'])->name('measurement_fields.edit');
    Route::put('{measurementField}', [MeasurementFieldController::class, 'update'])->name('measurement_fields.update');
    Route::delete('{measurementField}', [MeasurementFieldController::class, 'destroy'])->name('measurement_fields.destroy');
});
//measurement
Route::group([ 'prefix' => 'measurements',   'middleware' => 'auth'], function() {
    Route::get('/', [MeasurementController::class, 'index'])->name('measurements.index');
    Route::get('/create', [MeasurementController::class, 'create'])->name('measurements.create');
    Route::post('/', [MeasurementController::class, 'store'])->name('measurements.store');
    Route::get('/{measurement}/edit', [MeasurementController::class, 'edit'])->name('measurements.edit');
    Route::put('/{measurement}', [MeasurementController::class, 'update'])->name('measurements.update');
    Route::delete('/{measurement}', [MeasurementController::class, 'destroy'])->name('measurements.destroy');
});
Route::get('/measurement-fields/{service_id}', [MeasurementController::class, 'getMeasurementFields']);
//user
Route::group([ 'prefix' => 'user',   'middleware' => 'auth'], function() {
    Route::get('/', [UserController::class, 'index'])->name('user.index');
    Route::get('/create', [UserController::class, 'create'])->name('users.create');
     Route::post('/', [UserController::class, 'store'])->name('users.store');
     Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
     Route::put('/{user}', [UserController::class, 'update'])->name('users.update');
     Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});
//orders
Route::group([ 'prefix' => 'admin/orders',   'middleware' => 'auth'], function() {
    Route::get('/', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');
    Route::put('/{order}', [OrderController::class, 'update'])->name('orders.update');
    Route::delete('/{order}', [OrderController::class, 'softDelete'])->name('orders.destroy');
    Route::get('/restore', [OrderController::class, 'restoreView'])->name('orders.restore.view');
    Route::post('/{order}/restore', [OrderController::class, 'restore'])->name('orders.restore');
    Route::post('/{order}/force-delete', [OrderController::class, 'forceDelete'])->name('orders.force-delete');
});
//expenses
Route::group([ 'prefix' => 'admin/expenses', 'middleware' => 'auth'], function() {
    Route::get('/', [ExpensesController::class, 'index'])->name('expenses.index');
    Route::get('/create', [ExpensesController::class, 'create'])->name('expenses.create');
    Route::post('/', [ExpensesController::class, 'store'])->name('expenses.store');
    Route::get('/{expense}/edit', [ExpensesController::class, 'edit'])->name('expenses.edit');
    Route::put('/{expense}', [ExpensesController::class, 'update'])->name('expenses.update');
    Route::delete('/{expense}', [ExpensesController::class, 'destroy'])->name('expenses.destroy');
    Route::get('/restore', [ExpensesController::class, 'restoreView'])->name('expenses.restore.view');
    Route::post('/{expense}/restore', [ExpensesController::class, 'restore'])->name('expenses.restore');
    Route::post('/{expense}/force-delete', [ExpensesController::class, 'forceDelete'])->name('expenses.force-delete');
});
//contacts
Route::group([ 'prefix' => 'admin/contacts', 'middleware' => 'auth'], function() {
    Route::get('/', [ContactsController::class, 'index'])->name('contacts.index');
    Route::get('/create', [ContactsController::class, 'create'])->name('contacts.create');
    Route::post('/', [ContactsController::class, 'store'])->name('contacts.store');
    Route::get('/{contact}/edit', [ContactsController::class, 'edit'])->name('contacts.edit');
    Route::put('/{contact}', [ContactsController::class, 'update'])->name('contacts.update');
     Route::delete('/{contact}', [ContactsController::class, 'destroy'])->name('contacts.destroy');
     Route::get('/restore', [ContactsController::class, 'restoreView'])->name('contacts.restore.view');
     Route::post('/{contact}/restore', [ContactsController::class, 'restore'])->name('contacts.restore');
     Route::post('/{contact}/force-delete', [ContactsController::class, 'forceDelete'])->name('contacts.force-delete');
});

//customers
Route::group([ 'prefix' => 'admin/customers', 'middleware' => 'auth'], function() {
    Route::get('/', [CustomersController::class, 'index'])->name('customers.index');
    Route::get('/create', [CustomersController::class, 'create'])->name('customers.create');
    Route::post('/', [CustomersController::class, 'store'])->name('customers.store');
    Route::get('/{customer}/edit', [CustomersController::class, 'edit'])->name('customers.edit');
    Route::put('/{customer}', [CustomersController::class, 'update'])->name('customers.update');
     Route::delete('/{customer}', [CustomersController::class, 'destroy'])->name('customers.destroy');
     Route::get('/restore', [CustomersController::class, 'restoreView'])->name('customers.restore.view');
     Route::post('/{customer}/restore', [CustomersController::class, 'restore'])->name('customers.restore');
     Route::post('/{customer}/force-delete', [CustomersController::class, 'forceDelete'])->name('customers.force-delete');
});

//services
Route::group([ 'prefix' => 'admin/services', 'middleware' => 'auth'], function() {
    Route::get('/', [ServiceController::class, 'index'])->name('services.index');
    Route::get('/create', [ServiceController::class, 'create'])->name('services.create');
    Route::post('/', [ServiceController::class, 'store'])->name('services.store');
    Route::get('/{service}/edit', [ServiceController::class, 'edit'])->name('services.edit');
    Route::put('/{service}', [ServiceController::class, 'update'])->name('services.update');
     Route::delete('/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');
     Route::get('/service', [ServiceController::class, 'restoreView'])->name('services.restore.view');
     Route::post('/{service}/restore', [ServiceController::class, 'restore'])->name('services.restore');
     Route::post('/{service}/force-delete', [ServiceController::class, 'forceDelete'])->name('services.force-delete');
});

//reports
Route::group(['prefix' => 'admin/reports', 'middleware' => 'auth'], function () {
    Route::get('/', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/create', [ReportController::class, 'create'])->name('reports.create');
    Route::post('/', [ReportController::class, 'store'])->name('reports.store');
});




Route::middleware('auth')->group(function () {
    Route::get('/search', [CustomersController::class, 'search'])->name('customers.search');
    Route::get('/customers/{id}', [CustomersController::class, 'show'])->name('customers.show');
});

require __DIR__.'/auth.php';
