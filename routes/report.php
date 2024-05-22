<?php

use App\Http\Controllers\Admin\Reports\ReportController;

use Illuminate\Support\Facades\Route;


Route::prefix('admin')->as('admin.')->middleware(['auth', 'changed.password'])->group(function () {
    Route::prefix('reports')->as('reports.')->group(function(){
        Route::get('/reports', [ReportController::class, 'reportsType'])->name('index');
        Route::get('/salary-report', [ReportController::class, 'salaryReport'])->name('salary');
        Route::get('/leave-report', [ReportController::class, 'leaveReport'])->name('leave');
    });
});