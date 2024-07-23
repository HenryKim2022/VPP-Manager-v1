<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginPageController;

use App\Http\Controllers\UserPanels\Manage\EmployeeController;
use App\Http\Controllers\UserPanels\Manage\UserLoginController;
use App\Http\Controllers\UserPanels\Manage\OfficeRoleController;
/////////////////////////////////////////////////// <<<  END: USE CONTROLLER  >>> ///////////////////////////////////////////////


/////////////////////////////////////////////// <<<  START: ROUTES (NO USERGROUP) >>> ///////////////////////////////////////////
Route::get('/', [LoginPageController::class, 'index'])->name('login.page');
// Route::get('/', [LoginPageController::class, 'index'])->name('userPanels.dashboard');

//////////////////////////////////////////////// <<<  END: ROTES (NO USERGROUP) >>> /////////////////////////////////////////////





/////////////////////////////////////////////////// <<<  START: ROUTES (WITH USERGROUP) >>> //////////////////////////////////////
Route::prefix('')->name('login.')->middleware('guest')->group(function () {
    Route::get('/login', 'App\Http\Controllers\Auth\LoginPageController@showLogin')->name('page');
    Route::post('/login', 'App\Http\Controllers\Auth\LoginPageController@doLogin')->name('do');
});

Route::prefix('')->name('register.')->middleware('guest')->group(function () {
    Route::get('/register', 'App\Http\Controllers\Auth\RegisterPageController@showRegister')->name('page');
    Route::post('/register', 'App\Http\Controllers\Auth\RegisterPageController@doRegister')->name('do');
});


Route::prefix('')->name('userPanels.')->middleware('auth')->group(function () {
    Route::get('/dashboard', 'App\Http\Controllers\UserPanels\Navigate\UserPanelController@index')->name('dashboard');
    Route::get('/logout', 'App\Http\Controllers\Auth\LoginPageController@doLogoutUPanel')->name('logout.redirect');
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
    Route::get('/m-user', [UserLoginController::class, 'index'])->name('m.user');
    Route::post('/m-user/add', [UserLoginController::class, 'add_user'])->name('m.user.add');
    Route::post('/m-user/edit', [UserLoginController::class, 'edit_user'])->name('m.user.edit');
    Route::post('/m-user/delete', [UserLoginController::class, 'delete_user'])->name('m.user.del');
    Route::post('/m-user/reset', [UserLoginController::class, 'reset_user'])->name('m.user.reset');
    Route::post('/m-user/emp/load', [UserLoginController::class, 'get_user'])->name('m.user.getuser');

});

//////////////////////////////////////////////// <<<  END: ROUTES (WITH USERGROUP) >>> ///////////////////////////////////////////

