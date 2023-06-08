<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TrusteeController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\UserController;

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

/* ----------------- Admin Route ----------------- */

Route::prefix('admin')->group(function() {

    Route::get('/login',[AdminController::class, 'Index'])->name('login_from');

    Route::post('/login/owner',[AdminController::class, 'Login'])->name('admin.login');

    Route::get('/dashboard',[AdminController::class, 'Dashboard'])->name('admin.dashboard')->middleware('admin');

    Route::get('/logout',[AdminController::class, 'AdminLogout'])->name('admin.logout')->middleware('admin');


});

/* ----------------- End Admin Route ----------------- */


/* ----------------- Donor Route ----------------- */

/*Route::prefix('donor')->group(function() {

    Route::get('/login',[DonorController::class, 'Index'])->name('login_from');

    Route::post('/login/owner',[DonorController::class, 'Login'])->name('donor.login');

    Route::get('/dashboard',[DonorController::class, 'Dashboard'])->name('donor.dashboard')->middleware('donor');

});

/* ----------------- End Donor Route ----------------- */


/* ----------------- Trustee Route ----------------- */

Route::prefix('trustee')->group(function() {

    Route::get('/login',[TrusteeController::class, 'TrusteeIndex'])->name('trustee_login_from');

    Route::post('/login/owner',[TrusteeController::class, 'TrusteeLogin'])->name('trustee.login');

    Route::get('/dashboard',[TrusteeController::class, 'TrusteeDashboard'])->name('trustee.dashboard')->middleware('trustee');

    Route::get('/logout',[TrusteeController::class, 'TrusteeLogout'])->name('trustee.logout')->middleware('trustee');


});

/* ----------------- End Trustee Route ----------------- */

Route::resource('user',UserController::class)->shallow();
Route::get('user',[UserController::class, 'index'])->name('user.index');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
