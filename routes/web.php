<?php

use App\Http\Controllers\Admin\AjaxController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('auth.login');
});

Route::prefix('admin')->as('admin.')->middleware('auth')->group(function () {

        Route::get('/dashboard', function () {
            return view('dashboard');
        });
        // Route::get('/users', function () {
        //     return view('admin.user.users');
        // });
       
    // Route::controller(DashboardController::class)->as('dashboard.')->prefix('dashboard/')->group(function () {
    //     Route::get('/', 'viewDashboard')->name('view');
    // });
    Route::controller(RoleController::class)->as('role.')->prefix('roles/')->group(function () {
        Route::get('/', 'viewRole')->name('list');
        Route::match(['get', 'post'], 'add', 'addRole')->name('add');
    });
    Route::controller(UserController::class)->as('user.')->prefix('users/')->group(function () {
        Route::get('/', 'viewUser')->name('list');
        Route::match(['get', 'post'], 'add', 'addUser')->name('add');
        Route::match(['get', 'post', 'put'], 'edit/{uuid}', 'getUser')->name('edit');
        Route::get('/delete/{uuid}', 'deleteUser')->name('delete');
    });
    Route::controller(AjaxController::class)->as('ajax.')->prefix('ajax/')->group(function () {
        Route::get('/edit', 'editData')->name('list');
        Route::get('/update-status', 'setStatus')->name('update.status');
        Route::get('/delete', 'deleteData')->name('delete');
    });

});


Route::controller(LoginController::class)->as('login.')->prefix('login/')->group(function () {
        Route::match(['get', 'post'], '/', 'authentication')->name('authentication');
});

