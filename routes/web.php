<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;

use App\Http\Controllers\Expert\OverviewController as ExpertOverviewController;

use App\Http\Controllers\MyRA\OverviewController as MyRAOverviewController;

use App\Http\Controllers\Output\AnalysisController;
use App\Http\Controllers\AjaxController;
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

// UTM Expert
Route::name("expert.")->prefix("expert")->group(function () {
});
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
});
// Output Analysis
Route::name("output.")->prefix("output")->group(function () {
});

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
// Project Management
Route::name('management.')->prefix('management')->group(function () {
    Route::name('year')->get('year', [FacultyAchievementController::class, "by_year"]);
    Route::name('active')->get('active', [FacultyAchievementController::class, "active_grant"]);
    Route::name('all')->get('all', [FacultyAchievementController::class, "all_grant"]);
    Route::name('activity')->get('activity', [ResearchProcessController::class, "activity"]);
    Route::name('talent')->get('talent', [ResearchProcessController::class, "talent"]);
});
Route::name('ajax.')->prefix('ajax')->group(function () {
    Route::name("grant-mestec")->post('grant-mestec/', [AjaxController::class, 'getGrantMestec']);
});
