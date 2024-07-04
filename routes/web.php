<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\AjaxController;
use App\Http\Controllers\Admin\Backup\BackupController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\DesignationContoller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\HolidayController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\MembershipController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmplooyeLoansController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\LeaveApplyController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\LeaveController;
use App\Http\Controllers\Admin\LeaveEncashmentController;
use App\Http\Controllers\Admin\LeaveTypeCobntroller;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\LoansController;
use App\Http\Controllers\Admin\TaxController;
use App\Http\Controllers\Admin\UserAccountController;
use App\Http\Controllers\Admin\Dashboard\PersonalInformationController;
use App\Http\Controllers\Admin\LeaveReportsController;
use App\Http\Controllers\Admin\Payroll\PayscaleController;
use App\Http\Controllers\Admin\Salary\SalaryController;
use App\Http\Controllers\Admin\Dashboard\PersonProfileController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\DocumentTypeController;
use App\Http\Controllers\Admin\EmployeeKraController;
use App\Http\Controllers\Admin\EmployeePayScaleController;
use App\Http\Controllers\Admin\EmployeeTransferControler;
use App\Http\Controllers\Admin\KraAttributesController;
use App\Http\Controllers\Admin\LeaveSettingController;
use App\Http\Controllers\Admin\LeaveTimeApprovelController;
use App\Http\Controllers\Admin\MedicalCardController;
use App\Http\Controllers\Admin\OvertimeController;
use App\Http\Controllers\Admin\Payroll\PayrollHeadController;
use App\Http\Controllers\Admin\Payroll\PayRollPayscaleCotroller;
use App\Http\Controllers\Admin\Payroll\PayrollSalaryController;
use App\Http\Controllers\Admin\Payroll\TaxSlabSettingController;
use App\Http\Controllers\Admin\Payroll\ReimbursementController;
use App\Http\Controllers\Admin\Payroll\ReimbursementTypeController;
use App\Http\Controllers\Admin\SalaryReportingController;
use App\Http\Controllers\SalaryIncrementController;
use App\Http\Controllers\Admin\Payroll\PayrollIboTaxController;
use App\Http\Controllers\Admin\Payroll\SalarySettingController;
use App\Http\Controllers\Admin\Payroll\SalaryHistoryController;
use App\Http\Controllers\Admin\CurrentLeaveController;
use App\Http\Controllers\Admin\EmpLoanHistoryController;
use App\Http\Controllers\Admin\Payroll\Emp13thChequeController;
use App\Http\Controllers\PayrollReportController;


Route::get('/', [LoginController::class, 'authentication']);
Route::prefix('admin')->as('admin.')->middleware(['auth', 'changed.password'])->group(function () {

    Route::controller(DashboardController::class)->as('dashboard.')->prefix('dashboard/')->group(function () {
        Route::get('/', 'viewDashboard')->name('view');
    });
    Route::controller(PersonalInformationController::class)
        ->as('personal.info.')
        ->prefix('personal-info')
        ->group(function () {
            Route::get('/employee-details', 'viewEmployeeDetails')->name('employee.details');
            Route::post('/update-employee-details', 'updateEmployeeDetails')->name('employee.details.update');

            Route::get('/family-details', 'viewFamilyDetails')->name('family.details.view');
            Route::post('/add-family-details', 'addFamilyDetails')->name('family.details.save');
            Route::post('/delete-family-details', 'deleteFamilyDetails')->name('family.details.delete');

            Route::get('/document-details', 'viewDocumentDetails')->name('document.details.view');

            Route::get('/contact-details', 'viewContact')->name('contact');
            Route::post('/update-contact', 'updateContact')->name('contact.update');

            Route::get('/address-details', 'viewAddress')->name('address');
            Route::post('/post-address', 'postAddress')->name('address.post');

            Route::get('/passport-details', 'viewPassport')->name('passport');
            Route::post('/update-passport', 'updatePassport')->name('passport.update');
        });


    Route::controller(PersonProfileController::class)
        ->as('person.profile.')
        ->prefix('person-profile')
        ->group(function () {
            Route::get('/qualifications', 'viewQualifications')->name('qualifications.view');
            Route::post('/post-qualification', 'postQualification')->name('qualification.post');
            Route::post('/delete-qualification', 'deleteQualification')->name('qualification.delete');

            Route::get('/medical-insurance-bomaid-details', 'viewMedicalInsuranceBomaidDetails')->name('medical.insurance.bomaid.details.view');
            Route::post('/update-medical-insurance-bomaid-details', 'updateMedicalInsuranceBomaidDetails')->name('medical.insurance.bomaid.details.update');

            Route::get('/driving-license-details', 'viewDrivingLicenseDetails')->name('driving.license.details.view');
            Route::post('/update-driving-license-details', 'updateDrivingLicenseDetails')->name('driving.license.details.update');

            Route::get('/previous-employment-details', 'viewPreviousEmploymentDetails')->name('previous.employment.details.view');
            Route::post('/post-previous-employment-details', 'postPreviousEmploymentDetails')->name('previous.employment.details.post');
            Route::post('/delete-previous-employment-details', 'deletePreviousEmploymentDetails')->name('previous.employment.details.delete');

            Route::get('/place-of-domicile', 'viewPlaceOfDomicile')->name('place.of.domicile.view');
            Route::post('/place-of-domicile', 'postPlaceOfDomicile')->name('place.of.domicile.post');

            Route::get('/training-details', 'viewTrainingDetails')->name('training.details.view');
            Route::post('/post-training-details-details', 'postTrainingDetails')->name('training.details.post');
            Route::post('/delete-training-details-details', 'deleteTrainingDetails')->name('training.details.delete');

            Route::get('/award-details', 'viewAwardDetails')->name('award.details.view');
            Route::post('/post-award-details-details', 'postAwardDetails')->name('award.details.post');
            Route::post('/delete-award-details-details', 'deleteAwardDetails')->name('award.details.delete');

            Route::get('/union-details', 'viewUnionDetails')->name('union.details.view');
            Route::get('/permanent-contractual', 'viewPermanentContractual')->name('permanent.contractual.view');

            Route::get('/payscale-details', 'viewPayscaleDetails')->name('payscale.details.view');
        });
    Route::get('/download/{filename}', [DashboardController::class, 'userManualDownload'])->name('userManualDownload');

    Route::controller(RoleController::class)->as('role.')->prefix('roles/')->group(function () {
        Route::get('/', 'viewRole')->name('list');
        Route::match(['get', 'post'], 'add', 'addRole')->name('add');
        Route::match(['get', 'post'], '/{id}/attach-permission', 'attachPermission')->name('attach.permission');
    });


    Route::resource('account', AccountController::class);

    Route::resource('country', CountryController::class);


    Route::resource('currency_settings', CurrencyController::class);

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
    Route::controller(LeaveSettingController::class)->as('leavesettings.')->prefix('leavesettings/')->group(function () {
        Route::get('/list', 'index')->name('list');
        Route::post('/add', 'store')->name('add');
        Route::post('/edit', 'edit')->name('edit');
        Route::get('/delete', 'delete')->name('delete');
    });
    Route::resource('employees', EmployeeController::class);
    Route::post('employees/import', [EmployeeController::class, 'importEmployee'])->name('employees.import');

    Route::get('employees/list', [EmployeeController::class, 'list'])->name('employees.list');
    Route::get('employees/status/{id}', [EmployeeController::class, 'status'])->name('employees.status');

    Route::get('employee/user-details/{eid?}', [EmployeeController::class, 'viewUserDetails'])->name('employee.userDetails.form');
    Route::post('employee/user-details', [EmployeeController::class, 'postUserDetails'])->name('employee.userDetails.post');

    Route::get('employee/employee-details/{eid?}', [EmployeeController::class, 'viewEmployeeDetails'])->name('employee.employeeDetails.form');
    Route::post('employee/employee-details', [EmployeeController::class, 'postEmployeeDetails'])->name('employee.employeeDetails.post');

    Route::get('employee/address/{eid?}', [EmployeeController::class, 'viewAddress'])->name('employee.address.form');
    Route::post('employee/address', [EmployeeController::class, 'postAddress'])->name('employee.address.post');
    Route::post('employee/delete-address', [EmployeeController::class, 'deleteAddress'])->name('employee.address.delete');


    Route::get('employee/salary-history/{eid?}', [SalaryHistoryController::class, 'viewSalaryHistory'])->name('employee.salary-history.list');
    Route::post('employee/salary-history', [SalaryHistoryController::class, 'postSalaryHistory'])->name('employee.salary-history.post');
    Route::post('employee/delete-salary-history', [SalaryHistoryController::class, 'deleteSalaryHistory'])->name('employee.salary-history.delete');

    Route::get('employee/loan-history/{eid?}', [EmpLoanHistoryController::class, 'viewEmpLoanHistory'])->name('employee.loan-history.list');
    Route::post('employee/loan-history', [EmpLoanHistoryController::class, 'postEmpLoanHistory'])->name('employee.loan-history.post');
    Route::post('employee/delete-loan-history', [EmpLoanHistoryController::class, 'deleteEmpLoanHistory'])->name('employee.loan-history.delete');

    Route::get('employee/current-leaves/{eid?}', [CurrentLeaveController::class, 'viewCurrentLeaves'])->name('employee.current-leaves.list');
    Route::get('employee/current-leaves-log', [CurrentLeaveController::class, 'leaveActivityLogList'])->name('employee.current-leaves-log.list');
    Route::post('employee/current-leaves', [CurrentLeaveController::class, 'postCurrentLeaves'])->name('employee.current-leaves.post');
    Route::post('employee/current-leaves-credit', [CurrentLeaveController::class, 'creditCurrentLeaves'])->name('employee.credit-leaves.post');

    Route::get('employee/passport-omang/{eid?}', [EmployeeController::class, 'viewPassportOmang'])->name('employee.passportOmang.form');
    Route::post('employee/passport-omang', [EmployeeController::class, 'postPassportOmang'])->name('employee.passportOmang.post');

    Route::get('employee/qualification/{eid?}', [EmployeeController::class, 'viewQualification'])->name('employee.qualification.form');
    Route::post('employee/qualification', [EmployeeController::class, 'postQualification'])->name('employee.qualification.post');
    Route::post('employee/delete-qualification', [EmployeeController::class, 'deleteQualification'])->name('employee.qualification.delete');

    Route::get('employee/medical-insuarance-bomaid/{eid?}', [EmployeeController::class, 'viewMedicalInsuaranceBomaid'])->name('employee.medicalInsuaranceBomaid.form');
    Route::post('employee/medical-insuarance-bomaid', [EmployeeController::class, 'postMedicalInsuaranceBomaid'])->name('employee.medicalInsuaranceBomaid.post');
    Route::post('employee/delete-medical-insuarance-bomaid', [EmployeeController::class, 'deleteMedicalInsuarance'])->name('employee.medicalInsuaranceBomaid.delete');

    Route::get('employee/domicile/{eid?}', [EmployeeController::class, 'viewDomicile'])->name('employee.domicile.form');
    Route::post('employee/domicile', [EmployeeController::class, 'postDomicile'])->name('employee.domicile.post');

    Route::get('employee/department-history/{eid?}', [EmployeeController::class, 'viewDepartmentHistory'])->name('employee.departmentHistory.form');
    Route::post('employee/department-history', [EmployeeController::class, 'postDepartmentHistory'])->name('employee.departmentHistory.post');
    Route::post('employee/delete-department-history', [EmployeeController::class, 'deleteDepartmentHistory'])->name('employee.departmentHistory.delete');
    Route::resource('employee-transfer', EmployeeTransferControler::class);
    Route::post('/admin/employee-transfer', [EmployeeTransferControler::class, 'status'])->name('status');

    // Department start
    Route::resource('department', DepartmentController::class);
    // Department  end

    Route::resource('designation', DesignationContoller::class);
    Route::resource('tax', TaxController::class);
    Route::resource('membership', MembershipController::class);
    Route::resource('branch', BranchController::class);
    Route::get('branch/status/{id}', [BranchController::class, 'status'])->name('branch.status');
    Route::get('setting/list', [SettingController::class, 'index'])->name('setting.index');

    Route::resource('kra-attributes', KraAttributesController::class);
    Route::get('kra-attributes/status/{id}', [KraAttributesController::class, 'status'])->name('kra-attributes.status');

    Route::resource('employee-kra', EmployeeKraController::class);
    Route::get('employee-kra/status/{id}', [EmployeeKraController::class, 'status'])->name('employee-kra.status');
    Route::get('employee/employee-kra/{user_id}', [EmployeeKraController::class, 'create'])->name('employee.employee-kra.create');
    Route::get('employee/print/employee-kra/print/{user_id}', [EmployeeKraController::class, 'print'])->name('employee-kra.print');

    Route::resource('document-type', DocumentTypeController::class);
    Route::get('document-type/status/{id}', [DocumentTypeController::class, 'status'])->name('document-type.status');

    Route::resource('document', DocumentController::class);
    Route::post('document/asign', [DocumentController::class, 'asign'])->name('document.asign');
    Route::get('document-get/asign/{id}', [DocumentController::class, 'documentAssignedit'])->name('document.get.asign');

    // Medical Cart start
    Route::resource('medical-card', MedicalCardController::class);
    // Medical Cart end

    Route::resource('overtime-settings', OvertimeController::class);

    Route::resource('leave_type', LeaveTypeCobntroller::class);
    Route::get('leave_type/status/{id}', [LeaveTypeCobntroller::class, 'status'])->name('leave_type.status');
    // leave route start
    Route::resource('leave_apply', LeaveApplyController::class);

    Route::resource('maternity-leave-apply', LeaveTimeApprovelController::class);
    Route::post('/status/maternity-leave-apply', [LeaveTimeApprovelController::class, 'status'])->name('leave_approval.status');

    Route::get('leave_balance_history/', [LeaveApplyController::class, 'balance_history'])->name('leave_apply.balance_history');
    Route::get('leave_request_history/', [LeaveApplyController::class, 'request_history'])->name('leave_apply.request_history');

    Route::get('leave_apply/status_modal/{id}', [LeaveApplyController::class, 'status_modal'])->name('leave_apply.status_modal');
    Route::put('leave_apply/status/{id}', [LeaveApplyController::class, 'status'])->name('leave_apply.status');

    Route::post('leave_apply/get/leave/', [LeaveApplyController::class, 'get_leave'])->name('leave_apply.get_leave');
    Route::get('get_balance_leave/', [LeaveApplyController::class, 'get_balance_leave'])->name('leave_apply.get_balance_leave');
    Route::get('get_approval_authority/', [LeaveApplyController::class, 'get_approval_authority'])->name('leave_apply.get_approval_authority');
    Route::get('rejected_leave/', [LeaveApplyController::class, 'get_rejected_leave'])->name('leave_apply.get_rejected_leave');
    Route::get('reverse-leave-without-pay/', [LeaveApplyController::class, 'reverseLeaveWithoutPay'])->name('leave_apply.reverse_leave_without_pay');
    //Leave Settings start
    // Route::resource('leave_setting', LeaveSettingController::class);
    //   encashemnt start
    Route::resource('leave_encashment', LeaveEncashmentController::class);
    Route::put('leave_encashment/status/{id}', [LeaveEncashmentController::class, 'status'])->name('leave_encashment.status');
    Route::get('leave_encashment/status_modal/{id}', [LeaveEncashmentController::class, 'status_modal'])->name('leave_encashment.status_modal');
    Route::post('get_encash_leave/', [LeaveEncashmentController::class, 'get_encash_leave'])->name('leave_apply.get_encash_leave');
    Route::get('get_balance_encash_leave/', [LeaveEncashmentController::class, 'get_balance_leave'])->name('leave_encashment.get_balance_encah_leave');

    // encashment end

    // leave Reports start
    Route::resource('leave_reports', LeaveReportsController::class);

    // leave Reports End



    // leave route start
    Route::resource('loans', LoansController::class);
    Route::get('loans/status/{id}', [LoansController::class, 'status'])->name('loans.status');
    Route::get('notification/list', [NotificationController::class, 'index'])->name('notification.index');

    Route::resource('employees_loans', EmplooyeLoansController::class);
    Route::get('employees_loans/status/{id}', [EmplooyeLoansController::class, 'status'])->name('employees_loans.status');



    Route::get('account-profile', [UserAccountController::class, 'viewProfile'])->name('profile');
    Route::post('profile-update', [UserAccountController::class, 'profileUpdate'])->name('profile.update');
    Route::post('password-update', [UserAccountController::class, 'passwordReset'])->name('password.reset');
    Route::post('image-update', [UserAccountController::class, 'imageUpdate'])->name('image.update');


    // Payroll
    Route::prefix('payroll')->as('payroll.')->group(function () {

        Route::controller(PayrollReportController::class)->as('reports.')->prefix('reports')->group(function () {
            Route::get('/ttum-view', 'ttumReport')->name('ttum.list');
            Route::post('/ttum-export', 'ttumReportExport')->name('ttum.exports');
        });

        /*--------------------------------------------- Pay Roll Tax slab Settting Crud Start---------------------------------------------------------------*/
        Route::resource('tax-slab-setting', TaxSlabSettingController::class);
        Route::get('tax-slab-setting/status/{id}', [TaxSlabSettingController::class, 'status'])->name('tax-slab-setting.status');
        /*--------------------------------------------- Pay Roll Tax slab Settting Crud End---------------------------------------------------------------*/

        /*--------------------------------------------- Pay Roll Salary Increment Settting Crud Start---------------------------------------------------------------*/
        Route::resource('salary-increment-setting', SalaryIncrementController::class);
        //  Route::get('salary-increment-setting/status/{id}', [SalaryIncrementController::class, 'status'])->name('salary-increment-setting.status');
        /*--------------------------------------------- Pay Roll Salary Increment Settting Crud End---------------------------------------------------------------*/

        /*--------------------------------------------- Pay Roll Salary Increment Reporting Crud Start---------------------------------------------------------------*/
        Route::resource('salary-increment-reporting', SalaryReportingController::class);
        /*--------------------------------------------- Pay Roll Salary Increment Reporting Crud End---------------------------------------------------------------*/

        /*--------------------------------------------- Pay Roll Head Crud Start---------------------------------------------------------------*/
        Route::resource('head', PayrollHeadController::class);
        Route::get('head/status/{id}', [PayrollHeadController::class, 'status'])->name('head.status');
        /*--------------------------------------------- Pay Roll Head Crud End---------------------------------------------------------------*/

        /*--------------------------------------------- Pay Roll Payscal Crud Start---------------------------------------------------------------*/
        Route::resource('payscale', PayRollPayscaleCotroller::class);
        Route::get('payscale/status/{id}', [PayRollPayscaleCotroller::class, 'status'])->name('payscale.status');
        Route::get('payscale/tax/cal', [PayRollPayscaleCotroller::class, 'payscaleTaxCal'])->name('payscale.tax.cal');
        Route::get('payscale/get-emp-head/{user_id?}/{payscale_date?}', [PayRollPayscaleCotroller::class, 'get_employee_data'])->name('payscale.emp.head');
        /*--------------------------------------------- Pay Roll Payscal Crud End---------------------------------------------------------------*/

        // Pay Roll ReimbursementTypeController start
        Route::resource('reimbursement_type', ReimbursementTypeController::class);
        // Pay Roll ReimbursementTypeController end

        // Pay Roll ReimbursementController start
        Route::resource('reimbursement', ReimbursementController::class);
        Route::post('/admin/payroll/reimbursement', [ReimbursementController::class, 'status'])->name('status');

        // payRoll salary setting
        Route::resource('salary_setting', SalarySettingController::class);

        // Pay Roll ReimbursementController end
        /*--------------------------------------------- Pay Roll Payscal Crud Start---------------------------------------------------------------*/
        Route::resource('salary', PayrollSalaryController::class);
        Route::get('emp-13th-cheque', [Emp13thChequeController::class, 'index'])->name('emp-13th-cheque.index');

        Route::get('salary/status/{id}', [PayrollSalaryController::class, 'status'])->name('salary.status');
        Route::get('tax-for-ibo/report', [PayrollIboTaxController::class, 'iboTaxReport'])->name('tax-for-ibo.report');
        Route::match(['get', 'post'], '/tax-for-ibo/calculate', [PayrollIboTaxController::class, 'iboTaxCalculate'])->name('tax-for-ibo.calculate');
        Route::match(['get', 'post'], '/tax-for-ibo/show/{user_id?}/{financial_year?}', [PayrollIboTaxController::class, 'get_tax_head_data'])->name('tax-for-ibo.show');
        Route::get('print-salary-slip/{id}', [PayrollSalaryController::class, 'print'])->name('salary.print');

        Route::get('salary/get-emp-head/{user_id?}/{salary_month?}', [PayrollSalaryController::class, 'get_employee_data'])->name('salary.emp.head');
        /*--------------------------------------------- Pay Roll Payscal Crud End---------------------------------------------------------------*/
    });

    // Database Backup
    Route::resource('backups', BackupController::class);
});

// this group only for update password and +
Route::prefix('admin')->as('admin.')->middleware(['auth',])->group(function () {
    Route::post('password-update', [UserAccountController::class, 'passwordReset'])->name('password.reset');
    Route::get('password-reset', [UserAccountController::class, 'viewPasswordReset'])->name('password');
});

Route::get('user-forgot-password', [UserAccountController::class, 'viewForgotPasswordPage'])->name('forgot.password');
Route::post('user-forgot-password', [UserAccountController::class, 'forgotPassword'])->name('forgot.password.post');
Route::get('user-reset-password/{unique_key}', [UserAccountController::class, 'resetPassword'])->name('forgot.password.reset');
Route::post('user-reset-password', [UserAccountController::class, 'resetPasswordSave'])->name('reset.password.post');
Route::get('password-changed', [UserAccountController::class, 'viewPasswordChangedPage'])->name('password.changed');

Route::controller(LoginController::class)->as('login.')->prefix('login/')->group(function () {
    Route::match(['get', 'post'], '/', 'authentication')->name('authentication');
});

// Route::get('admin/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified', 'changed.password'])->name('admin.dashboard');
// require __DIR__ . '/auth.php';
Route::get('admin/dashboard', [DashboardController::class, 'viewDashboard'])
    ->middleware(['auth', 'verified', 'changed.password'])
    ->name('admin.dashboard');
require __DIR__ . '/auth.php';
