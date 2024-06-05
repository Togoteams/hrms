<?php

use App\Http\Controllers\Admin\Reports\ReportController;

use Illuminate\Support\Facades\Route;


Route::prefix('admin')->as('admin.')->middleware(['auth', 'changed.password'])->group(function () {
    Route::prefix('reports')->as('reports.')->group(function(){
        Route::get('/reports', [ReportController::class, 'reportsType'])->name('index');
        Route::get('/salary-report', [ReportController::class, 'salaryReport'])->name('salary');
        Route::get('/annual-pay-report', [ReportController::class, 'annualPayReport'])->name('annual-pay-report');
        Route::get('/annula-tax-deduction', [ReportController::class, 'annulaTaxDeduction'])->name('annula-tax-deduction');
        Route::get('/thirteen-cheque-report', [ReportController::class, 'thirteenChequeReport'])->name('thirteen-cheque-report');
        Route::get('/branch-wise-employee-report', [ReportController::class, 'branchWiseEmployeeReport'])->name('branch-wise-employee-report');
        Route::get('/employee-arrear-report', [ReportController::class, 'employeeArrearReport'])->name('employee-arrear-report');
        Route::get('/leave-report', [ReportController::class, 'leaveReport'])->name('leave-report');
    });
});