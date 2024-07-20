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
use App\Http\Controllers\DanaRU\CadanganAgihanController;
use App\Http\Controllers\DanaRU\FinancialController;
use App\Http\Controllers\DanaRU\AgihanController;
use App\Http\Controllers\DanaRU\SearchController;
use App\Http\Controllers\DanaRU\MaintenanceController;
use App\Http\Controllers\DanaRU\MasterlistController as DruMasterlistController;
use App\Http\Controllers\DocGeneratorController;

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
Route::get('/', function () {
    return redirect(route('login'));
});
Route::middleware('guest')->group(function () {
    Route::name("login")->get("/login", [LoginController::class, "index"]);
    Route::name("login.post")->post("/login/post", [LoginController::class, "login"]);
    Route::name("request-access")->get("/request-access/{staff_id?}", [LoginController::class, "requestAccess"]);
    Route::name("request-access.post")->post("/request-access/post", [LoginController::class, "requestAccessPost"]);
});

Route::middleware(['auth'])->group(function () {
    Route::name("logout")->get("/logout", [LoginController::class, "logout"]);

    Route::resource('dashboard', DashboardController::class, ['except' => ['create', 'store', 'show', 'update', 'destroy']]);

    Route::name("data.")->prefix("data")->group(function () {
        Route::name("store")->post("store", [FileController::class, "store"]);
        Route::name("upload")->post("upload/{multiple?}", [FileController::class, "upload"]);
        Route::delete('revert', [FileController::class, 'revert'])->name('revert');
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
        Route::name("glossary")->get("glossary/{item?}", [MyRADashboardController::class, "glossary"]);
    });

    // Report Myra
    Route::name("report.")->prefix("report")->group(function () {
        Route::name("myra.index")->get("myra/{year?}", [MyRAReportController::class, "index"]);
        Route::name("myra.download")->get('myra/download/{masterlist}/{year}/{all?}', [MyRAReportController::class, 'downloadMasterlist']);
        Route::name("myra.glossary")->get("glossary/{year?}", [MyRAReportController::class, "glossary"]);
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

Route::name("dana-ru.")->prefix("dana-ru")->group(function () {
    Route::name('masterlist.')->prefix('masterlist')->group(function(){
        Route::name('allocation')->get('/allocation', [DruMasterlistController::class, 'allocationIndex']);
        Route::name('allocation.year')->get('/allocation/year/{year?}', [DruMasterlistController::class, 'allocationYearIndex']);
        Route::name("allocation.import")->get('/allocation/import/{id}', [DruMasterlistController::class, "allocationImport"]);
        Route::name("allocation.delete")->get('/allocation/delete/{id}', [DruMasterlistController::class, "allocationDelete"]);

        Route::name('expenses')->get('/expenses', [DruMasterlistController::class, 'expensesIndex']);
        Route::name('expenses.year')->get('/expenses/year/{year?}', [DruMasterlistController::class, 'expensesYearIndex']);
        Route::name("expenses.import")->get('/expenses/import/{id}', [DruMasterlistController::class, "expensesImport"]);
        Route::name("expenses.process")->get('/expenses/process/{type}/{year}', [DruMasterlistController::class, "expensesProcessData"]);
        Route::name("expenses.delete")->get('/expenses/delete/{id}', [DruMasterlistController::class, "expensesDelete"]);

        Route::name("process")->get('/process/{fund_type}/{type}/{year}', [DruMasterlistController::class, "processData"]);
    });
    Route::name('maintenance.')->prefix('maintenance')->group(function(){
        Route::name('tabung-induk')->get('/tabung-induk', [MaintenanceController::class, 'tabungIndukIndex']);
        Route::name('tabung-induk.create')->get('/tabung-induk/create', [MaintenanceController::class, 'tabungIndukCreate']);
        Route::name('tabung-induk.store')->post('/tabung-induk/store', [MaintenanceController::class, 'tabungIndukStore']);
        Route::name('tabung-induk.edit')->get('/tabung-induk/edit/{id}', [MaintenanceController::class, 'tabungIndukEdit']);
        Route::name('tabung-induk.update')->post('/tabung-induk/update/{id}', [MaintenanceController::class, 'tabungIndukUpdate']);
        Route::name('tabung-induk.delete')->get('/tabung-induk/delete/{id}', [MaintenanceController::class, 'tabungIndukDelete']);
        Route::name('tabung-induk.activate-all')->get('/tabung-induk/activate-all', [MaintenanceController::class, 'tabungIndukActivateAll']);
        Route::name('project')->get('/project/index/{year?}', [MaintenanceController::class, 'projectIndex']);
        Route::name('project.create')->get('/project/create/{year?}', [MaintenanceController::class, 'projectCreate']);
        Route::name('project.store')->post('/project/store', [MaintenanceController::class, 'projectStore']);
        Route::name('project.edit')->get('/project/edit/{id}', [MaintenanceController::class, 'projectEdit']);
        Route::name('project.update')->post('/project/update/{id}', [MaintenanceController::class, 'projectUpdate']);
        Route::name('project.delete')->get('/project/delete/{id}', [MaintenanceController::class, 'projectDelete']);
        Route::name('project.activate-all')->get('/project/activate-all/{year}', [MaintenanceController::class, 'projectActivateAll']);
        Route::name('project.duplicate')->get('/project/duplicate/{from_year}/{to_year}', [MaintenanceController::class, 'projectDuplicate']);
        Route::name('tabung-agihan')->get('/tabung-agihan', [MaintenanceController::class, 'tabungAgihanIndex']);
        Route::name('tabung-agihan.create')->get('/tabung-agihan/create', [MaintenanceController::class, 'tabungAgihanCreate']);
        Route::name('tabung-agihan.store')->post('/tabung-agihan/store', [MaintenanceController::class, 'tabungAgihanStore']);
        Route::name('tabung-agihan.edit')->get('/tabung-agihan/edit/{id}', [MaintenanceController::class, 'tabungAgihanEdit']);
        Route::name('tabung-agihan.update')->post('/tabung-agihan/update/{id}', [MaintenanceController::class, 'tabungAgihanUpdate']);
        Route::name('tabung-agihan.delete')->get('/tabung-agihan/delete/{id}', [MaintenanceController::class, 'tabungAgihanDelete']);
        Route::name('tabung-agihan.activate-all')->get('/tabung-agihan/activate-all', [MaintenanceController::class, 'tabungAgihanActivateAll']);
        Route::name('asas-agihan')->get('/asas-agihan', [MaintenanceController::class, 'asasAgihanIndex']);
        Route::name('asas-agihan.create')->get('/asas-agihan/create', [MaintenanceController::class, 'asasAgihanCreate']);
        Route::name('asas-agihan.store')->post('/asas-agihan/store', [MaintenanceController::class, 'asasAgihanStore']);
        Route::name('asas-agihan.edit')->get('/asas-agihan/edit/{id}', [MaintenanceController::class, 'asasAgihanEdit']);
        Route::name('asas-agihan.update')->post('/asas-agihan/update/{id}', [MaintenanceController::class, 'asasAgihanUpdate']);
        Route::name('asas-agihan.delete')->get('/asas-agihan/delete/{id}', [MaintenanceController::class, 'asasAgihanDelete']);
        Route::name('kpi')->get('/kpi', [MaintenanceController::class, 'kpiIndex']);
        Route::name('kpi.create')->get('/kpi/create', [MaintenanceController::class, 'kpiCreate']);
        Route::name('kpi.store')->post('/kpi/store', [MaintenanceController::class, 'kpiStore']);
        Route::name('kpi.edit')->get('/kpi/edit/{id}', [MaintenanceController::class, 'kpiEdit']);
        Route::name('kpi.update')->post('/kpi/update/{id}', [MaintenanceController::class, 'kpiUpdate']);
        Route::name('kpi.delete')->get('/kpi/delete/{id}', [MaintenanceController::class, 'kpiDelete']);
        Route::name('faculty')->get('/faculty', [MaintenanceController::class, 'facultyIndex']);
        Route::name('faculty.create')->get('/faculty/create/{original_code?}/{short?}', [MaintenanceController::class, 'facultyCreate']);
        Route::name('faculty.store')->post('/faculty/store', [MaintenanceController::class, 'facultyStore']);
        Route::name('faculty.edit')->get('/faculty/edit/{id}', [MaintenanceController::class, 'facultyEdit']);
        Route::name('faculty.update')->post('/faculty/update/{id}', [MaintenanceController::class, 'facultyUpdate']);
        Route::name('faculty.delete')->get('/faculty/delete/{id}', [MaintenanceController::class, 'facultyDelete']);
    });
    Route::name('cadangan-agihan.')->prefix('cadangan-agihan')->group(function(){
        Route::name('index')->get('/index/{year?}/{tab?}', [CadanganAgihanController::class, 'index']);
        Route::name('form')->get('/form/{year?}/{id?}', [CadanganAgihanController::class, 'form']);
        Route::name('store-plan')->post('/store-plan/{year?}', [CadanganAgihanController::class, 'storePlan']);
        Route::name('store')->post('/store/{year?}', [CadanganAgihanController::class, 'store']);
        Route::name("delete-plan")->get('/delete-plan/{id}', [CadanganAgihanController::class, "deletePlan"]);
        Route::name("verification")->post('/verification/{id}/{type}', [CadanganAgihanController::class, "verification"]);
        Route::name("verification.post")->post("/verification/post", [CadanganAgihanController::class, "verificationPost"]);
        Route::name("file.download")->get('file/download/{id}', [CadanganAgihanController::class, 'downloadFile']);
    });
    Route::name('kewangan.')->prefix('kewangan')->group(function(){
        Route::name('overall')->get('/overall', [FinancialController::class, 'overall']);
        Route::name('pengesahan-agihan.index')->get('/pengesahan-agihan/index/{year?}', [FinancialController::class, 'pengesahanAgihanIndex']);
        Route::name('pengesahan-agihan.show')->get('/pengesahan-agihan/show/{plan_id}', [FinancialController::class, 'pengesahanAgihanShow']);
        Route::name('pengesahan-agihan.approve')->post('/pengesahan-agihan/approve/{plan_id}', [FinancialController::class, 'pengesahanAgihanSingleApprove']);
        Route::name('pengesahan-agihan.post')->post('/pengesahan-agihan/post', [FinancialController::class, 'pengesahanAgihanPost']);
        Route::name('agihan-program.index')->get('/agihan-program/index', [FinancialController::class, 'agihanProgramIndex']);
        Route::name('perbelanjaan.')->prefix('perbelanjaan')->group(function(){
            Route::name('program')->get('/program/{year?}', [FinancialController::class, 'program']);
            Route::name('program.show')->get('/program/show/{id}/{tab?}', [FinancialController::class, 'programShow']);
            Route::name("program.verification.post")->post("/program/verification/post/{id}", [FinancialController::class, "programVerificationPost"]);
            Route::name('sub-projek')->get('/sub-projek/{year?}', [FinancialController::class, 'subProject']);
        });
    });

    Route::name('senarai-agihan.')->prefix('senarai-agihan')->group(function(){
        Route::name('index')->get('/index/{year?}', [AgihanController::class, 'index']);
        Route::name('show')->get('/show/{plan_id}', [AgihanController::class, 'show']);
        Route::name('form')->get('/form/{year?}/{id?}/{tab?}', [AgihanController::class, 'form']);
        Route::name('declare')->post('/declare/{plan_id}', [AgihanController::class, 'declare']);
        Route::name('kpi-update')->post('/kpi-update/{plan_id}', [AgihanController::class, 'kpiUpdate']);
        Route::name('expenses-record')->get('/expenses-record/{plan_id}', [AgihanController::class, 'expensesRecord']);
    });

    Route::name('carian.')->prefix('carian')->group(function(){
        Route::name('index')->get('/', [SearchController::class, 'index']);
        Route::name('allocation')->get('/allocation', [SearchController::class, 'allocationList']);
        Route::name('expenses')->get('/expenses', [SearchController::class, 'expensesList']);
    });

    // });
});

Route::name('doc-generator.')->prefix('doc-generator')->group(function () {
    Route::name('kertas-kerja')->get('/kertas-kerja/{plan_id}', [DocGeneratorController::class, 'KertasKerja']);
    Route::name('lampiran-a')->get('/lampiran-a/{plan_id}', [DocGeneratorController::class, 'LampiranA']);
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
    Route::name("getSchool")->get('getSchool/{faculty_id}', [AjaxController::class, 'getSchool']);
    Route::name("getProjectList")->get('getProjectList/{program_id}/{year}', [AjaxController::class, 'getProjectList']);
    Route::name("approveDruDistributionPlanForm")->post('approve-distribution-plan', [AjaxController::class, 'approveDruDistributionPlanForm']);
    Route::name("updateUtmFinRefNo")->post('update-utmfin-refno', [AjaxController::class, 'updateUtmFinRefNo']);
    Route::name("addDistFund")->post('add-dist-fund', [AjaxController::class, 'addDistFund']);
});
