<?php
// <!-- Here is the routes/web.php: -->
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginPageController;



// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [LoginPageController::class, 'index'])->name('login.page');
Route::get('/', [LoginPageController::class, 'index'])->name('userPanels.dashboard');


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


