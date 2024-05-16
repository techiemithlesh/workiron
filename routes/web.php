<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/users', [App\Http\Controllers\HomeController::class, 'users'])->name('users');
Route::get('/users/edit/{id}', [App\Http\Controllers\HomeController::class, 'editUser'])->name('edit-user');
Route::put('/users/update/{id}', [App\Http\Controllers\HomeController::class, 'updateUser'])->name('update-user');
Route::get('/users/create', [App\Http\Controllers\HomeController::class, 'createUser'])->name('create-user');
Route::post('/users/store', [App\Http\Controllers\HomeController::class, 'storeUser'])->name('store-user');
Route::delete('/users/delete/{id}', [App\Http\Controllers\HomeController::class, 'deleteUser'])->name('delete-user');

Route::get('/vehicle-inspections', [App\Http\Controllers\HomeController::class, 'vehicleInspections'])->name('vehicle-inspections');
Route::get('/vehicle-inspections/{id}', [App\Http\Controllers\HomeController::class, 'showVehicleInspection'])->name('show-vehicle-inspection');
Route::get('/vehicle-inspections/{id}/report', [App\Http\Controllers\HomeController::class, 'reportVehicleInspection'])->name('report-vehicle-inspection');
//Route::get('/pdf/view/{id}', [HomeController::class, 'testPdf'])->name('test-pdf');
Route::get('/pdf/view/{id}', [HomeController::class, 'testPdfView'])->name('test-pdf');


// SEARCH PDF
Route::get('/search-inspections', [HomeController::class, 'searchInspections'])->name('search-inspections');
Route::post('/send-pdf-email', [HomeController::class, 'sendPdfEmail'])->name('send-pdf-email');

// UPDATE PDF
Route::get('/pdf/update/{id}', [HomeController::class, 'editPdfById'])->name('edit.pdf');
Route::post('/update/pdf/{id}', [HomeController::class, 'updatePdf'])->name('update.pdf');
Route::get('/delete/inspections/{id}', [HomeController::class, 'deleteinspections'])->name('inspections-delete');


Route::post('/update/store', [HomeController::class, 'update'])->name('update-test');
Route::post('/removeCondition', [HomeController::class, 'removeCondition'])->name('removeCondition');

