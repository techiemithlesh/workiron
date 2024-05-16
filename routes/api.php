<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\InspectionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [AuthController::class, 'login']);
Route::post('submit-inspection', [InspectionController::class, 'submitInspectionNewTest']);
Route::get('get-inspection/{id}', [InspectionController::class, 'getInspectionsDetails']);
Route::post('update-inspection', [InspectionController::class, 'updateInspectionsDetails']);

Route::middleware('auth:api')->group(function () {

    Route::get('get-inspections', [InspectionController::class, 'getInspections']);
    Route::post('upload-images', [InspectionController::class, 'uploadImages']);
});
