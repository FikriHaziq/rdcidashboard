<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\MasterlistController;
use App\Http\Controllers\Research\ManagementController as ManagementController;
use App\Http\Controllers\MyRA\DashboardController as MyRADashboardController;
use App\Http\Controllers\MyRA\RawDataController as RawDataController;
use App\Http\Controllers\MyRA\ReportController as MyRAReportController;

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
Route::name("login.post")->post("/login/post", [LoginController::class, "login"]);
Route::name("logout")->get("/logout", [LoginController::class, "logout"]);
Route::middleware(['auth'])->group(function () {
    Route::resource('dashboard', DashboardController::class, ['except' => ['create', 'store', 'show', 'update', 'destroy']]);

    Route::name("data.")->prefix("data")->group(function () {
        Route::name("store")->post("store", [FileController::class, "store"]);
        Route::name("upload")->post("upload", [FileController::class, "upload"]);
    });
    // Dashboard Grant
    Route::name("grant.")->prefix("grant")->group(function () {
        Route::name("overview")->get("overview", [GrantOverviewController::class, "index"]);
        Route::name('faculty-year')->get('faculty-year/{year?}', [FacultyAchievementController::class, "by_year"]);
        // Route::name('faculty-year.file')->get('faculty_year/file', [FacultyAchievementController::class, "by_year_file"]);
        Route::name('faculty-active')->get('faculty-active', [FacultyAchievementController::class, "active_grant"]);
        // Route::name('faculty-active.file')->get('faculty-active/file', [FacultyAchievementController::class, "active_grant_file"]);
        Route::name('faculty-all')->get('faculty-all', [FacultyAchievementController::class, "all_grant"]);
        // Route::name('faculty-all.file')->get('faculty-all/file', [FacultyAchievementController::class, "all_grant_file"]);
        Route::name('proposal')->get('proposal', [GrantOverviewController::class, "proposal"]);
        // Route::name('proposal.file')->get('proposal/file', [GrantOverviewController::class, "proposalFile"]);
        Route::name('myra')->get('myra', [GrantOverviewController::class, "myra"]);
        // Route::name('myra.file')->get('myra/file', [GrantOverviewController::class, "myRAFile"]);
    });

    Route::name('research.')->prefix('research')->group(function () {
        Route::name('management.')->prefix('management')->group(function () {
            Route::name('proposal')->get('proposal', [ManagementController::class, 'proposalManagement']);
            Route::name('grant')->get('grant', [ManagementController::class, 'grantManagement']);
            Route::name('activity')->get('activity', [ManagementController::class, 'activityManagement']);
            Route::name('raro-appointment')->get('raro-appointment', [ManagementController::class, 'raroAppointment']);
            Route::name('grasra-appointment')->get('grasra-appointment', [ManagementController::class, 'graSraAppointment']);
            Route::name('wages-claim')->get('wages-claim', [ManagementController::class, 'wagesClaimManagement']);
            Route::name('rmarm-distribution')->get('rmarm-distribution', [ManagementController::class, 'grantDistribution']);
            Route::name('action-list')->get('action-list', [ManagementController::class, 'listOfAction']);
        });
    });

    // UTM MyRA
    Route::name("myra.")->prefix("myra")->group(function () {
        Route::name("index")->get("overview", [MyRADashboardController::class, "index"]);
        Route::name("info.staff")->get("staff-info", [MyRADashboardController::class, "staffInfo"]);
        Route::name("info.student")->get("student-info", [MyRADashboardController::class, "studentInfo"]);
        Route::name("emyra")->get("emyra", [MyRADashboardController::class, "emyra"]);
        Route::name("section-b")->get("section-b/{tabs?}", [MyRADashboardController::class, "sectionB"]);
        Route::name("section-c")->get("section-c/{tabs?}", [MyRADashboardController::class, "sectionC"]);
        Route::name("section-d")->get("section-d/{tabs?}", [MyRADashboardController::class, "sectionD"]);
        Route::name("section-e")->get("section-e", [MyRADashboardController::class, "sectionE"]);
        Route::name("section-f")->get("section-f/{tabs?}", [MyRADashboardController::class, "sectionF"]);
        Route::name("section-g")->get("section-g/{tabs?}", [MyRADashboardController::class, "sectionG"]);
        Route::name("section-h")->get("section-h", [MyRADashboardController::class, "sectionH"]);
    });

    // Report Myra
    Route::name("report.")->prefix("report")->group(function () {
        Route::name("myra.index")->get("myra/{year?}", [MyRAReportController::class, "index"]);
        Route::name("myra.download")->get('myra/download/{masterlist}/{year}/{faculty?}', [MyRAReportController::class, 'downloadMasterlist']);
    });
});

Route::middleware(['auth', 'user-role:super_admin'])->group(function () {
    Route::name("masterlist.")->prefix("masterlist")->group(function () {
        Route::name("myra.")->prefix("myra")->group(function () {
            Route::name('index')->get('/index/{year?}', [MasterlistController::class, 'myra_index']);
            Route::name("list")->get('/list/{module}/{year}', [MasterlistController::class, "myra_list"]);
            Route::name("import.")->get('/import/{id}', [MasterlistController::class, "myra_import"]);
            Route::name("delete.")->get('/delete/{id}', [MasterlistController::class, "myra_delete"]);
        });
        Route::name("project-management.")->prefix("project-management")->group(function () {
            Route::name('index')->get('/index/{year?}', [MasterlistController::class, 'pm_index']);
            Route::name("list")->get('/list/{module}/{year}', [MasterlistController::class, "pm_list"]);
            Route::name("import.")->get('/import/{id}', [MasterlistController::class, "pm_import"]);
            Route::name("delete.")->get('/delete/{id}', [MasterlistController::class, "pm_delete"]);
        });
    });
    Route::name("myra.")->prefix("myra")->group(function () {

        Route::name('self-assessment.')->prefix('self-assessment')->group(function(){
            Route::name('section-a')->get('section-a/{year?}', [RawDataController::class, 'sectionA']);
            Route::name('section-b')->get('section-b/{year?}', [RawDataController::class, 'sectionB']);
            Route::name('section-c')->get('section-c/{year?}', [RawDataController::class, 'sectionC']);
            Route::name('section-d')->get('section-d/{year?}', [RawDataController::class, 'sectionD']);
            Route::name('section-e')->get('section-e/{year?}', [RawDataController::class, 'sectionE']);
            Route::name('section-f')->get('section-f/{year?}', [RawDataController::class, 'sectionF']);
            Route::name('section-g')->get('section-g/{year?}', [RawDataController::class, 'sectionG']);
            Route::name('section-h')->get('section-h/{year?}', [RawDataController::class, 'sectionH']);
            Route::name('summary')->get('summary/{year?}', [RawDataController::class, 'summary']);
        });
    });
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
    Route::name("selectData")->get('select/data/{id}', [AjaxController::class, 'selectData']);
    Route::name("updateMyraData")->post('update-myra-data', [AjaxController::class, 'updateMyraMark']);
});
