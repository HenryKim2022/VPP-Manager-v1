<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginPageController;

use App\Http\Controllers\UserPanels\Manage\EmployeeController;
use App\Http\Controllers\UserPanels\Manage\EmpUserLoginController;
use App\Http\Controllers\UserPanels\Manage\ClientUserLoginController;
use App\Http\Controllers\UserPanels\Manage\MonitoringController;
use App\Http\Controllers\UserPanels\Manage\WorksheetController;
use App\Http\Controllers\UserPanels\Manage\MyProfileController;
use App\Http\Controllers\UserPanels\Manage\OfficeRoleController;
use App\Http\Controllers\UserPanels\Manage\EngTeamController;
use App\Http\Controllers\UserPanels\Manage\ProjectsController;
/////////////////////////////////////////////////// <<<  END: USE CONTROLLER  >>> ///////////////////////////////////////////////


/////////////////////////////////////////////// <<<  START: ROUTES (NO USERGROUP) >>> ///////////////////////////////////////////
Route::get('/', [LoginPageController::class, 'index'])->name('login.page');
// Route::get('/', [LoginPageController::class, 'index'])->name('userPanels.dashboard');

//////////////////////////////////////////////// <<<  END: ROTES (NO USERGROUP) >>> /////////////////////////////////////////////





/////////////////////////////////////////////////// <<<  START: ROUTES (WITH USERGROUP) >>> //////////////////////////////////////
Route::prefix('')->name('login.')->middleware('NotLoggedIn')->group(function () {
    Route::get('/login', 'App\Http\Controllers\Auth\LoginPageController@showLogin')->name('page');
    Route::post('/login', 'App\Http\Controllers\Auth\LoginPageController@doLogin')->name('do');
});

Route::prefix('')->name('register.')->middleware('NotLoggedIn')->group(function () {
    Route::get('/register-emp', 'App\Http\Controllers\Auth\RegisterEmployeePageController@showRegister')->name('emp.page');
    Route::post('/register-emp', 'App\Http\Controllers\Auth\RegisterEmployeePageController@doRegister')->name('emp.do');
});

Route::prefix('')->name('register.')->middleware('NotLoggedIn')->group(function () {
    Route::get('/register-client', 'App\Http\Controllers\Auth\RegisterClientPageController@showRegister')->name('client.page');
    Route::post('/register-client', 'App\Http\Controllers\Auth\RegisterClientPageController@doRegister')->name('client.do');
});


Route::prefix('')->name('userPanels.')->middleware('auth')->group(function () {
    Route::get('/dashboard', 'App\Http\Controllers\UserPanels\Navigate\UserPanelController@index')->name('dashboard');
    Route::get('/logout', 'App\Http\Controllers\Auth\LoginPageController@doLogoutUPanel')->name('logout.redirect');
});



Route::middleware(['auth'])->group(function () {    // Note: Separated group coz somewhat wont work if using direct controller path (only /my-profile).
    Route::get('/my-profile', [MyProfileController::class, 'index'])->name('userPanels.myprofile');
});
Route::middleware('auth')->group(function () {
    // Route::get('/my-profile', [MyProfileController::class, 'index'])->name('userPanels.myprofile');
    // Route::post('/my-profile', [MyProfileController::class, 'index'])->name('userPanels.myprofile');
    Route::post('/my-profile/edit-acc-avatar', [MyProfileController::class, 'profile_edit_avatar'])->name('userPanels.avatar.edit');
    Route::post('/my-profile/edit-biodata', [MyProfileController::class, 'profile_edit_biodata'])->name('userPanels.biodata.edit');
    Route::post('/my-profile/edit-accdata', [MyProfileController::class, 'profile_edit_accdata'])->name('userPanels.accdata.edit');
    Route::get('/my-profile/edit-accdata', [MyProfileController::class, 'profile_edit_accdata'])->name('userPanels.accdata.edit');
    Route::get('/my-profile/load-biodata', [MyProfileController::class, 'profile_load_biodata'])->name('userPanels.biodata.load');
    Route::get('/my-profile/load-accdata', [MyProfileController::class, 'profile_load_accdata'])->name('userPanels.accdata.load');
});





Route::middleware('auth')->group(function () {
    Route::get('/m-emp', [EmployeeController::class, 'index'])->name('m.emp');
    Route::post('/m-emp/add', [EmployeeController::class, 'add_emp'])->name('m.emp.add');
    Route::post('/m-emp/edit', [EmployeeController::class, 'edit_emp'])->name('m.emp.edit');
    Route::post('/m-emp/delete', [EmployeeController::class, 'delete_emp'])->name('m.emp.del');
    Route::post('/m-emp/reset', [EmployeeController::class, 'reset_emp'])->name('m.emp.reset');
    Route::post('/m-emp/load', [EmployeeController::class, 'get_emp'])->name('m.emp.getemp');
    Route::get('/m-emp/load', [EmployeeController::class, 'get_emp'])->name('m.emp.getemp');
});


Route::middleware('auth')->group(function () {
    Route::get('/m-emp/roles', [OfficeRoleController::class, 'index'])->name('m.emp.roles');
    Route::post('/m-emp/roles/add', [OfficeRoleController::class, 'add_role'])->name('m.emp.roles.add');
    Route::post('/m-emp/roles/edit', [OfficeRoleController::class, 'edit_role'])->name('m.emp.roles.edit');
    Route::post('/m-emp/roles/delete', [OfficeRoleController::class, 'delete_role'])->name('m.emp.roles.del');
    Route::post('/m-emp/roles/reset', [OfficeRoleController::class, 'reset_role'])->name('m.emp.roles.reset');
    Route::post('/m-emp/roles/role/load', [OfficeRoleController::class, 'get_role'])->name('m.emp.roles.getrole');
    Route::get('/m-emp/roles/role/load', [OfficeRoleController::class, 'get_role'])->name('m.emp.roles.getrole');
});


Route::middleware('auth')->group(function () {
    Route::get('/m-emp/teams', [EngTeamController::class, 'index'])->name('m.emp.teams');
    Route::post('/m-emp/teams/add', [EngTeamController::class, 'add_team'])->name('m.emp.teams.add');
    Route::post('/m-emp/teams/edit', [EngTeamController::class, 'edit_team'])->name('m.emp.teams.edit');
    Route::post('/m-emp/teams/delete', [EngTeamController::class, 'delete_team'])->name('m.emp.teams.del');
    Route::post('/m-emp/teams/reset', [EngTeamController::class, 'reset_team'])->name('m.emp.teams.reset');
    Route::post('/m-emp/teams/team/load', [EngTeamController::class, 'get_team'])->name('m.emp.teams.getteam');
    Route::get('/m-emp/teams/team/load', [EngTeamController::class, 'get_team'])->name('m.emp.teams.getteam');
});


Route::middleware('auth')->group(function () {
    Route::get('/m-prj/projects-list', [ProjectsController::class, 'index'])->name('m.projects');
    Route::post('/m-prj/projects-list/add', [ProjectsController::class, 'add_project'])->name('m.projects.add');
    Route::post('/m-prj/projects-list/edit', [ProjectsController::class, 'edit_project'])->name('m.projects.edit');
    Route::post('/m-prj/projects-list/delete', [ProjectsController::class, 'delete_project'])->name('m.projects.del');
    Route::post('/m-prj/projects-list/reset', [ProjectsController::class, 'reset_project'])->name('m.projects.reset');
    Route::post('/m-prj/projects-list/load', [ProjectsController::class, 'get_project'])->name('m.projects.getprj');
    Route::get('/m-prj/projects-list/load', [ProjectsController::class, 'get_project'])->name('m.projects.getprj');
    // Route::post('/m-prj/projects-list/loadmondws', [ProjectsController::class, 'get_prjmondws'])->name('m.projects.navigate');
    Route::get('/m-prj/projects-list/loadmondws', [ProjectsController::class, 'get_prjmondws'])->name('m.projects.getprjmondws');
});


Route::middleware('auth')->group(function () {
    Route::post('/m-prj/m-monitoring-worksheet/mondws', [MonitoringController::class, 'index'])->name('m.mon.dws');
    // Route::get('/m-prj/m-monitoring-worksheet/mondws', [MonitoringController::class, 'index'])->name('m.mon.dws');
    Route::post('/m-prj/m-monitoring-worksheet/mondws/load', [MonitoringController::class, 'get_mondws'])->name('m.mon.dws.getmondws');
    Route::get('/m-prj/m-monitoring-worksheet/mondws/load', [MonitoringController::class, 'get_mondws'])->name('m.mon.dws.getmondws');
});

Route::middleware('auth')->group(function () {
    Route::get('/m-prj/projects-list/navigate', [WorksheetController::class, 'index'])->name('m.ws');
    // Route::get('/dailyws/{dwsId}', [WorksheetController::class, 'index'])->name('dailyws.show');
});




Route::middleware('auth')->group(function () {
    Route::get('/m-user/emp', [EmpUserLoginController::class, 'index'])->name('m.user.emp');
    Route::post('/m-user/emp/add', [EmpUserLoginController::class, 'add_user'])->name('m.user.emp.add');
    Route::post('/m-user/emp/edit', [EmpUserLoginController::class, 'edit_user'])->name('m.user.emp.edit');
    Route::post('/m-user/emp/delete', [EmpUserLoginController::class, 'delete_user'])->name('m.user.emp.del');
    Route::post('/m-user/emp/reset', [EmpUserLoginController::class, 'reset_user'])->name('m.user.emp.reset');
    Route::post('/m-user/emp/load', [EmpUserLoginController::class, 'get_user'])->name('m.user.emp.getuser');

});

Route::middleware('auth')->group(function () {
    Route::get('/m-user/client', [ClientUserLoginController::class, 'index'])->name('m.user.client');
    Route::post('/m-user/client/add', [ClientUserLoginController::class, 'add_user'])->name('m.user.client.add');
    Route::post('/m-user/client/edit', [ClientUserLoginController::class, 'edit_user'])->name('m.user.client.edit');
    Route::post('/m-user/client/delete', [ClientUserLoginController::class, 'delete_user'])->name('m.user.client.del');
    Route::post('/m-user/client/reset', [ClientUserLoginController::class, 'reset_user'])->name('m.user.client.reset');
    Route::post('/m-user/client/load', [ClientUserLoginController::class, 'get_user'])->name('m.user.client.getuser');

});


//////////////////////////////////////////////// <<<  END: ROUTES (WITH USERGROUP) >>> ///////////////////////////////////////////

