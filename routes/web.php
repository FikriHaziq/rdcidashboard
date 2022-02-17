<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;

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
    Route::name('faculty-year')->get('faculty-year', [FacultyAchievementController::class, "by_year"]);
    Route::name('faculty-active')->get('faculty-active', [FacultyAchievementController::class, "active_grant"]);
    Route::name('faculty-all')->get('faculty-all', [FacultyAchievementController::class, "all_grant"]);
    Route::name('proposal')->get('proposal', [GrantOverviewController::class, "proposal"]);
    Route::name('myra')->get('myra', [GrantOverviewController::class, "myra"]);
});
