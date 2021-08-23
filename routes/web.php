<?php

use Illuminate\Support\Facades\Route;

use Grant\ActiveGrantController;
use Grant\ActiveStaffController;
use Grant\GrantSecuredController;
use App\Http\Controllers\Grant\GrantMonitoringController;

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

Route::resource('/', DashboardController::class, ['except' => ['create', 'store', 'show', 'update', 'destroy']]);

// Grant Folder
Route::resource('active-grant', ActiveGrantController::class, ['except' => ['create', 'store', 'destroy']]);
Route::resource('overall-secured', GrantSecuredController::class, ['except' => ['create', 'store', 'destroy']]);
Route::resource('staff-cohort', ActiveStaffController::class, ['except' => ['create', 'store', 'destroy']]);
// Grant - Monitoring
// Route::resource('monitoring', GrantMonitoringController::class, ['except' => ['index', 'create', 'store', 'show', 'update', 'destroy']]);
Route::name('monitoring.')->prefix('monitoring')->group(function () {
    Route::name('received')->get('received', [GrantMonitoringController::class, "received"]);
    Route::name('progress')->get('progress', [GrantMonitoringController::class, "progress"]);
    Route::name('report')->get('report', [GrantMonitoringController::class, "report"]);
    Route::name('detailed')->get('detailed', [GrantMonitoringController::class, "detailed"]);
});
