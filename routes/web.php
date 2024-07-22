<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginPageController;
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
    Route::get('/dashboard', 'App\Http\Controllers\UserPanels\UserPanelController@index')->name('dashboard');
    Route::get('/logout', 'App\Http\Controllers\Auth\LoginPageController@doLogoutUPanel')->name('logout.redirect');
});

//////////////////////////////////////////////// <<<  END: ROUTES (WITH USERGROUP) >>> ///////////////////////////////////////////

