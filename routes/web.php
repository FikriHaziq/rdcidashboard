<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MyRA\DashboardController as MyRADashboardController;

// OLD
use App\Http\Controllers\Grant\OverviewController as GrantOverviewController;
use App\Http\Controllers\Grant\FacultyAchievementController;

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

Route::name("login")->get("/", [LoginController::class, "index"]); 
Route::resource('dashboard', DashboardController::class, ['except' => ['create', 'store', 'show', 'update', 'destroy']]);

// Dashboard Grant
Route::name("grant.")->prefix("grant")->group(function () {
    Route::name("overview")->get("overview", [GrantOverviewController::class, "index"]);
    Route::name('faculty-year')->get('faculty-year/{year?}', [FacultyAchievementController::class, "by_year"]);
    Route::name('faculty-active')->get('faculty-active', [FacultyAchievementController::class, "active_grant"]);
    Route::name('faculty-all')->get('faculty-all', [FacultyAchievementController::class, "all_grant"]);
    Route::name('proposal')->get('proposal', [GrantOverviewController::class, "proposal"]);
    Route::name('proposal.file')->get('proposal/file', [GrantOverviewController::class, "proposalFile"]);
    Route::name('myra')->get('myra', [GrantOverviewController::class, "myra"]);
    Route::name('myra.file')->get('myra/file', [GrantOverviewController::class, "myRAFile"]);
});

// UTM MyRA
Route::name("myra.")->prefix("myra")->group(function () {
    Route::name("index")->get("overview", [MyRADashboardController::class, "index"]);
    Route::name("emyra")->get("emyra", [MyRADashboardController::class, "emyra"]);
    Route::name("section-b")->get("section-b", [MyRADashboardController::class, "sectionB"]);
    Route::name("section-c")->get("section-c", [MyRADashboardController::class, "sectionC"]);
    Route::name("section-d")->get("section-d", [MyRADashboardController::class, "sectionD"]);
    Route::name("section-f")->get("section-f", [MyRADashboardController::class, "sectionF"]);
    Route::name("section-g")->get("section-g", [MyRADashboardController::class, "sectionG"]);
    Route::name("section-h")->get("section-h", [MyRADashboardController::class, "sectionH"]);
});

// Grant Folder
// Route::resource('active-grant', ActiveGrantController::class, ['except' => ['create', 'store', 'destroy']]);
// Route::resource('overall-secured', GrantSecuredController::class, ['except' => ['create', 'store', 'destroy']]);
// Route::resource('staff-cohort', ActiveStaffController::class, ['except' => ['create', 'store', 'destroy']]);
// // Grant - Monitoring
// // Route::resource('monitoring', GrantMonitoringController::class, ['except' => ['index', 'create', 'store', 'show', 'update', 'destroy']]);
// Route::name('monitoring.')->prefix('monitoring')->group(function () {
//     Route::name('received')->get('received', [GrantMonitoringController::class, "received"]);
//     Route::name('progress')->get('progress', [GrantMonitoringController::class, "progress"]);
//     Route::name('report')->get('report', [GrantMonitoringController::class, "report"]);
//     Route::name('detailed')->get('detailed', [GrantMonitoringController::class, "detailed"]);
// });
// // Project Management
// Route::name('management.')->prefix('management')->group(function () {
//     Route::name('year')->get('year', [FacultyAchievementController::class, "by_year"]);
//     Route::name('active')->get('active', [FacultyAchievementController::class, "active_grant"]);
//     Route::name('all')->get('all', [FacultyAchievementController::class, "all_grant"]);
//     Route::name('activity')->get('activity', [ResearchProcessController::class, "activity"]);
//     Route::name('talent')->get('talent', [ResearchProcessController::class, "talent"]);
// });

Route::name('ajax.')->prefix('ajax')->group(function () {
    Route::name("grant-mestec")->post('grant-mestec/', [AjaxController::class, 'getGrantMestec']);
});
