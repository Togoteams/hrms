<?php

use App\Http\Controllers\Admin\AjaxController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\DesignationContoller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\HolidayController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\MembershipController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\LeaveController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserAccountController;

Route::get('/', [LoginController::class, 'authentication']);

Route::prefix('admin')->as('admin.')->middleware('auth')->group(function () {

    // Route::get('/users', function () {
    //     return view('admin.user.users');
    // });

    Route::controller(DashboardController::class)->as('dashboard.')->prefix('dashboard/')->group(function () {
        Route::get('/', 'viewDashboard')->name('view');
    });
    Route::controller(RoleController::class)->as('role.')->prefix('roles/')->group(function () {
        Route::get('/', 'viewRole')->name('list');
        Route::match(['get', 'post'], 'add', 'addRole')->name('add');
        Route::match(['get', 'post'], '/{id}/attach-permission', 'attachPermission')->name('attach.permission');
    });
    Route::controller(HolidayController::class)->as('holiday.')->prefix('holidays/')->group(function () {
        Route::get('/', 'viewHoliday')->name('list');
        Route::match(['get', 'post'], 'add', 'addHoliday')->name('add');
    });
    Route::controller(LeaveController::class)->as('leave.')->prefix('leaves/')->group(function () {
        Route::get('/', 'viewLeave')->name('list');
        Route::match(['get', 'post'], 'add', 'addLeave')->name('add');
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
    Route::resource('employees', EmployeeController::class);
    Route::get('employees/list', [EmployeeController::class, 'list'])->name('employees.list');
    Route::get('employees/status/{id}', [EmployeeController::class, 'status'])->name('employees.status');

    Route::resource('designation', DesignationContoller::class);
    Route::resource('membership', MembershipController::class);
    Route::resource('branch', BranchController::class);
    Route::get('branch/status/{id}', [BranchController::class, 'status'])->name('branch.status');

    Route::get('account-profile', [UserAccountController::class, 'viewProfile'])->name('profile');
    Route::post('profile-update', [UserAccountController::class, 'profileUpdate'])->name('profile.update');
    Route::get('password-reset', [UserAccountController::class, 'viewPasswordReset'])->name('password');
    Route::post('password-update', [UserAccountController::class, 'passwordReset'])->name('password.reset');
});


Route::controller(LoginController::class)->as('login.')->prefix('login/')->group(function () {
    Route::match(['get', 'post'], '/', 'authentication')->name('authentication');
});

Route::get('admin/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');
require __DIR__ . '/auth.php';
