<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;

use App\Http\Controllers\Expert\OverviewController as ExpertOverviewController;

use App\Http\Controllers\Research\OverviewController as ResearchOverviewController;
use App\Http\Controllers\Research\FacultyAchievementController;

use App\Http\Controllers\MyRA\OverviewController as MyRAOverviewController;

use App\Http\Controllers\Output\AnalysisController;

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
// UTM Research
Route::name("research.")->prefix("research")->group(function () {
    Route::name("overview")->get("overview", [ResearchOverviewController::class, "index"]);
    Route::name('faculty-year')->get('faculty-year', [FacultyAchievementController::class, "by_year"]);
    Route::name('faculty-active')->get('faculty-active', [FacultyAchievementController::class, "active_grant"]);
    Route::name('faculty-all')->get('faculty-all', [FacultyAchievementController::class, "all_grant"]);
    Route::name('proposal')->get('proposal', [ResearchOverviewController::class, "proposal"]);
    Route::name('myra')->get('myra', [ResearchOverviewController::class, "myra"]);
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
