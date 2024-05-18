 <!-- Navbar Vertical -->

 <aside
     class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl ">
     <div class="navbar-vertical-container">
         <div class="navbar-vertical-footer-offset">
             <!-- Logo -->


             <!-- End Logo -->
             <div class="pt-3 text-center">

                 <i class="name-title">Bank of Baroda (Botswana) Ltd.</i>
             </div>
             <!-- Navbar Vertical Toggle -->
             <button type="button" class="js-navbar-vertical-aside-toggle-invoker navbar-aside-toggler">
                 <i class="bi-arrow-bar-left navbar-toggler-short-align"
                     data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
                     data-bs-toggle="tooltip" data-bs-placement="right" title="Collapse"></i>
                 <i class="bi-arrow-bar-right navbar-toggler-full-align"
                     data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
                     data-bs-toggle="tooltip" data-bs-placement="right" title="Expand"></i>
             </button>

             <!-- End Navbar Vertical Toggle -->

             <!-- Content -->
             <div class="navbar-vertical-content">
                 <div id="navbarVerticalMenu" class="nav nav-pills nav-vertical card-navbar-nav">
                     <!-- Collapse -->
                     <div class="nav-item">
                         <a class="nav-link  {{ Route::getCurrentRoute()->getName() == 'admin.dashboard' ? 'active-class' : '' }}"
                             href="{{ route('admin.dashboard') }}" data-placement="left">
                             <i class="bi bi-speedometer nav-icon"></i>
                             <span class="nav-link-title">Dashboard</span>
                         </a>
                     </div>


                     <!-- End Collapse -->

                     {{-- <span class="mt-4 dropdown-header">Pages</span> --}}
                     <small class="bi-three-dots nav-subtitle-replacer"></small>

                     <!-- Collapse -->
                     <div class="navbar-nav nav-compact">

                     </div>
                     @canany(['add-users', 'edit-users', 'view-users', 'delete-users', 'add-roles', 'edit-roles',
                         'delete-roles', 'view-roles'])
                         <div id="navbarVerticalMenuPagesMenu">
                             <!-- Collapse -->

                             <div class="nav-item">
                                 <a class="nav-link dropdown-toggle " href="#navbarVerticalMenuPagesUserProfileMenu"
                                     role="button" data-bs-toggle="collapse"
                                     data-bs-target="#navbarVerticalMenuPagesUserProfileMenu" aria-expanded="false"
                                     aria-controls="navbarVerticalMenuPagesUserProfileMenu">
                                     <i class="bi-person nav-icon"></i>
                                     <span class="nav-link-title">Roles</span>
                                 </a>

                                 <div id="navbarVerticalMenuPagesUserProfileMenu"
                                     class="nav-collapse collapse {{ show(['role.list', 'user.list']) }} "
                                     data-bs-parent="#navbarVerticalMenuPagesMenu">

                                     @canany(['add-roles', 'edit-roles', 'delete-roles', 'view-roles'])
                                         <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.role.list' ? 'active' : '' }}  "
                                             href="{{ route('admin.role.list') }}">Roles</a>
                                     @endcanany
                                     {{-- @canany(['add-users', 'edit-users', 'view-users', 'delete-users'])
                                         <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.user.list' ? 'active' : '' }} "
                                             href="{{ route('admin.user.list') }}">Users</a>
                                     @endcanany --}}
                                 </div>
                             </div>
                         </div>
                     @endcanany
                     <!-- End Collapse -->
                     <div id="employee">
                         @canany(['add-employees', 'edit-employees', 'view-employees', 'delete-employees',
                             'change-employees-status', 'add-designations', 'edit-designations', 'view-designations',
                             'delete-designations', 'add-manage-tax', 'edit-manage-tax', 'view-manage-tax',
                             'delete-manage-tax', 'add-memberships', 'edit-memberships', 'view-memberships',
                             'delete-memberships', 'add-branch', 'edit-branch', 'view-branch', 'delete-branch',
                             'change-branch-status', 'add-employees-transfer', 'edit-employees-transfer',
                             'view-employees-transfer', 'delete-employees-transfer', 'add-department', 'edit-department',
                             'view-department', 'delete-department'])
                             <!-- End Collapse -->
                             <div class="nav-item">
                                 <a class="nav-link dropdown-toggle " href="#employees" role="button"
                                     data-bs-toggle="collapse" data-bs-target="#employees" aria-expanded="false"
                                     aria-controls="employees">
                                     <i class="fas fa-users nav-icon"></i>
                                     <span class="nav-link-title">Employees</span>
                                 </a>
                                 <div id="employees"
                                     class="nav-collapse collapse {{ show(['designation.index', 'membership.index', 'branch.index', 'employees.index', 'tax.index']) }}  "
                                     data-bs-parent="#employee">
                                     @canany(['add-designations', 'edit-designations', 'view-designations',
                                         'delete-designations'])
                                         <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.designation.index' ? 'active' : '' }} "
                                             href="{{ route('admin.designation.index') }}">Designation</a>
                                     @endcanany


                                     {{-- @canany(['add-memberships', 'edit-memberships', 'view-memberships', 'delete-memberships'])
                                         <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.membership.index' ? 'active' : '' }} "
                                             href="{{ route('admin.membership.index') }}">Union Membership</a>
                                     @endcanany --}}
                                     @canany(['add-branch', 'edit-branch', 'view-branch', 'delete-branch',
                                         'change-branch-status'])
                                         <a class="nav-link  {{ Route::getCurrentRoute()->getName() == 'admin.branch.index' ? 'active' : '' }}"
                                             href="{{ route('admin.branch.index') }}">Branch</a>
                                     @endcanany
                                     @canany(['add-employees', 'edit-employees', 'view-employees', 'delete-employees',
                                         'change-employees-status'])
                                         <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.employees.index' ? 'active' : '' }} "
                                             href="{{ route('admin.employees.index') }}">Employees</a>
                                     @endcanany
                                    
                                     @canany(['add-employees-transfer', 'edit-employees-transfer',
                                         'view-employees-transfer', 'delete-employees-transfer'])
                                          <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.employee-transfer.index' ? 'active' : '' }} "
                                            href="{{ route('admin.employee-transfer.index') }}">Employee Transfer </a>
                                     @endcanany
                                     @canany(['add-department', 'edit-department', 'view-department', 'delete-department'])
                                         <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.department.index' ? 'active' : '' }} "
                                             href="{{ route('admin.department.index') }}">Department </a>
                                     @endcanany
                                 </div>
                             </div>
                             <!-- End Collapse -->
                         @endcanany
                     </div>
                     {{-- <div id="me">
                         @canany(['add-loans', 'edit-loans', 'view-loans', 'delete-loans', 'add-loans-types', 'edit-loans-types', 'view-loans-types', 'delete-loans-types', 'change-status-loans-types', 'add-apply-loans', 'edit-apply-loans', 'view-apply-loans', 'delete-apply-loans', 'change-status-apply-loans'])
                             <div class="nav-item">
                                 <a class="nav-link dropdown-toggle " href="#loans" role="button"
                                     data-bs-toggle="collapse" data-bs-target="#loans" aria-expanded="false"
                                     aria-controls="loans">
                                     <i class="bi bi-credit-card-2-front nav-icon"></i>
                                     <span class="nav-link-title">Loans</span>
                                 </a>

                                 <div id="loans"
                                     class="nav-collapse collapse {{ show(['loans.index', 'employees_loans.index']) }} "
                                     data-bs-parent="#navbarVerticalMenuPagesMenu">

                                     @canany(['add-loans-types', 'edit-loans-types', 'view-loans-types', 'delete-loans-types', 'change-status-loans-types'])
                                         <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.loans.index' ? 'active' : '' }}  "
                                             href="{{ route('admin.loans.index') }}"><i
                                                 class="fal fa-calendar-edit nav-icon"></i>Loans Types</a>
                                     @endcanany

                                     @canany(['add-apply-loans', 'edit-apply-loans', 'view-apply-loans', 'delete-apply-loans', 'change-status-apply-loans'])
                                         <a class="nav-link  {{ Route::getCurrentRoute()->getName() == 'admin.emplooye_loans.index' ? 'active' : '' }}"
                                             href="{{ route('admin.employees_loans.index') }}" data-placement="left">
                                             <i class="far fa-desktop-alt nav-icon "></i> <span class="nav-link-title">Apply
                                                 Loans</span>
                                         </a>
                                     @endcanany

                                 </div>
                             </div>
                         @endcanany
                     </div> --}}
                     @canany(['add-users', 'edit-users', 'view-users', 'delete-users', 'add-roles', 'edit-roles',
                         'delete-roles', 'view-roles'])
                         {{-- <div id="navbarVerticalMenuPagesMenu">
                             <!-- Collapse -->

                             <div class="nav-item">
                                 <a class="nav-link dropdown-toggle " href="#empsalary" role="button"
                                     data-bs-toggle="collapse" data-bs-target="#empsalary" aria-expanded="false"
                                     aria-controls="empsalary">
                                     <i class="fas fa-money-bill-wave nav-icon"></i>
                                     <span class="nav-link-title">Salary</span>
                                 </a>

                                 <div id="empsalary"
                                     class="nav-collapse collapse {{ show(['employees_salary.index', 'employees-payscale.index']) }} "
                                     data-bs-parent="#navbarVerticalMenuPagesMenu">

                                     @canany(['add-roles', 'edit-roles', 'delete-roles', 'view-roles'])
                                         <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.employees_salary.index' ? 'active' : '' }}  "
                                             href="{{ route('admin.employees_salary.index') }}"> Employee Salay</a>
                                     @endcanany
                                     @canany(['add-roles', 'edit-roles', 'delete-roles', 'view-roles'])
                                         <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.employees-payscale.index' ? 'active' : '' }}  "
                                             href="{{ route('admin.employees-payscale.index') }}"> Employee Pay Scale</a>
                                     @endcanany

                                 </div>
                             </div>
                         </div> --}}
                     @endcanany


                     @canany(['add-kra', 'edit-kra', 'view-kra', 'delete-kra', 'add-attributes', 'edit-attributes',
                         'delete-attributes', 'view-attributes', 'change-status-attributes', 'add-employee-kra',
                         'edit-employee-kra', 'delete-employee-kra', 'view-employee-kra', 'change-status-employee-kra',
                         'print-employee-kra'])
                         <div id="navbarVerticalMenuPagesMenu">
                             <!-- Collapse -->

                             <div class="nav-item">
                                 <a class="nav-link dropdown-toggle " href="#kra" role="button"
                                     data-bs-toggle="collapse" data-bs-target="#kra" aria-expanded="false"
                                     aria-controls="kra">
                                     <i class="fas fa-users-class nav-icon"></i>
                                     <span class="nav-link-title">KRA</span>
                                 </a>
                                 <div id="kra"
                                     class="nav-collapse collapse {{ show(['employee-kra.index', 'kra-attributes.index']) }} "
                                     data-bs-parent="#navbarVerticalMenuPagesMenu">

                                     @canany(['add-attributes', 'edit-attributes', 'delete-attributes', 'view-attributes',
                                         'change-status-attributes'])
                                         <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.kra-attributes.index' ? 'active' : '' }}  "
                                             href="{{ route('admin.kra-attributes.index') }}"> Attributes</a>
                                     @endcanany
                                     @canany(['add-employee-kra', 'edit-employee-kra', 'delete-employee-kra',
                                         'view-employee-kra', 'change-status-employee-kra', 'print-employee-kra'])
                                         <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.employee-kra.index' ? 'active' : '' }}  "
                                             href="{{ route('admin.employee-kra.index') }}"> Employee Performance</a>
                                     @endcanany

                                 </div>
                             </div>
                         </div>
                     @endcanany


                     @canany(['add-leave-settings', 'edit-leave-settings', 'delete-leave-settings',
                         'view-leave-settings', 'add-leave-apply', 'edit-leave-apply', 'delete-leave-apply',
                         'view-leave-apply', 'change-status-leave-apply', 'add-leave-encashment', 'edit-leave-encashment',
                         'delete-leave-encashment', 'view-leave-encashment', 'add-leave-balance-report',
                         'edit-leave-balance-report', 'delete-leave-balance-report', 'view-leave-balance-report',
                         'add-leave-request-history', 'edit-leave-request-history', 'delete-leave-request-history',
                         'view-leave-request-history', 'add-leave-request-rejected', 'edit-leave-request-rejected',
                         'delete-leave-request-rejected', 'view-leave-request-rejected', 'add-leave-report',
                         'edit-leave-report', 'delete-leave-report', 'view-leave-report', 'add-leave-type-approval',
                         'edit-leave-type-approval', 'delete-leave-type-approval', 'view-leave-type-approval',
                         'change-status-leave-type-approval'])

                         <div class="nav-item">
                             <a class="nav-link dropdown-toggle " href="#leave" role="button" data-bs-toggle="collapse"
                                 data-bs-target="#leave" aria-expanded="false" aria-controls="leave">
                                 <i class="bi-person nav-icon"></i>
                                 <span class="nav-link-title">Leave</span>
                             </a>

                             <div id="leave"
                                 class="nav-collapse collapse {{ show(['leavesettings.list', 'leave_type.index', 'leave_apply.index', 'leave_encashment.index', 'leave_apply.balance_history', 'leave_apply.request_history', 'leave_reports.index', 'leave_apply.get_rejected_leave', 'leave-time-approved.index']) }} "
                                 data-bs-parent="#navbarVerticalMenuPagesMenu">

                                 {{-- @canany(['add-leave-types', 'edit-leave-types', 'delete-leave-types', 'view-leave-types', 'change-status-leave-types'])
                                 @if (!isemplooye())
                                     <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.leave_type.index' ? 'active' : '' }}  "
                                         href="{{ route('admin.leave_type.index') }}">Leave Types</a>
                                 @endif
                             @endcanany --}}
                                 @canany(['add-leave-settings', 'edit-leave-settings', 'delete-leave-settings',
                                     'view-leave-settings'])
                                     <a class="nav-link  {{ Route::getCurrentRoute()->getName() == 'admin.leavesettings.list' ? 'active' : '' }}"
                                         href="{{ route('admin.leavesettings.list') }}" data-placement="left">
                                         <span class="nav-link-title">Leave Setting</span>
                                     </a>
                                 @endcanany

                                 @canany(['add-leave-apply', 'edit-leave-apply', 'delete-leave-apply', 'view-leave-apply',
                                     'change-status-leave-apply'])
                                     <a class="nav-link  {{ Route::getCurrentRoute()->getName() == 'admin.leave_apply.index' ? 'active' : '' }}"
                                         href="{{ route('admin.leave_apply.index') }}" data-placement="left">
                                         <span class="nav-link-title">Leave Apply/Modify</span>
                                     </a>
                                 @endcanany

                                 @canany(['add-leave-encashment', 'edit-leave-encashment', 'delete-leave-encashment',
                                     'view-leave-encashment'])
                                     <a class="nav-link  {{ Route::getCurrentRoute()->getName() == 'admin.leave_encashment.index' ? 'active' : '' }}"
                                         href="{{ route('admin.leave_encashment.index') }}" data-placement="left">
                                         <span class="nav-link-title">Leave Encashment</span>
                                     </a>
                                 @endcanany

                                 {{-- @canany(['add-leave-balance-report', 'edit-leave-balance-report', 'delete-leave-balance-report', 'view-leave-balance-report'])
                                 <a class="nav-link  {{ Route::getCurrentRoute()->getName() == 'admin.leave_apply.balance_history' ? 'active' : '' }}"
                                     href="{{ route('admin.leave_apply.balance_history') }}" data-placement="left">
                                     <span class="nav-link-title">LEAVE BALANCE REPORT</span>
                                 </a>
                             @endcanany --}}

                                 @canany(['add-leave-request-history', 'edit-leave-request-history',
                                     'delete-leave-request-history', 'view-leave-request-history'])
                                     <a class="nav-link  {{ Route::getCurrentRoute()->getName() == 'admin.leave_apply.request_history' ? 'active' : '' }}"
                                         href="{{ route('admin.leave_apply.request_history') }}" data-placement="left">
                                         <span class="nav-link-title">Leave Request History</span>
                                     </a>
                                 @endcanany

                                 @canany(['add-leave-request-rejected', 'edit-leave-request-rejected',
                                     'delete-leave-request-rejected', 'view-leave-request-rejected'])
                                     <a class="nav-link  {{ Route::getCurrentRoute()->getName() == 'admin.leave_apply.get_rejected_leave' ? 'active' : '' }}"
                                         href="{{ route('admin.leave_apply.get_rejected_leave') }}" data-placement="left">
                                         <span class="nav-link-title">Leave Request Rejected</span>
                                     </a>
                                 @endcanany

                                 @canany(['add-leave-report', 'edit-leave-report', 'delete-leave-report',
                                     'view-leave-report'])
                                     <a class="nav-link  {{ Route::getCurrentRoute()->getName() == 'admin.leave_reports.index' ? 'active' : '' }}"
                                         href="{{ route('admin.leave_reports.index') }}" data-placement="left">
                                         <span class="nav-link-title">Leave Reports</span>
                                     </a>
                                 @endcanany

                                 @canany(['add-leave-type-approval', 'edit-leave-type-approval',
                                     'delete-leave-type-approval', 'view-leave-type-approval',
                                     'change-status-leave-type-approval'])
                                     <a class="nav-link  {{ Route::getCurrentRoute()->getName() == 'admin.leave-time-approved.index' ? 'active' : '' }}"
                                         href="{{ route('admin.leave-time-approved.index') }}" data-placement="left">
                                         <span class="nav-link-title">Maternity leave Request</span>
                                     </a>
                                 @endcanany



                             </div>
                         </div>
                     @endcanany


                     @canany(['add-payroll', 'edit-payroll', 'view-payroll', 'delete-payroll', 'add-tax-slab-settings',
                         'edit-tax-slab-settings', 'delete-tax-slab-settings', 'view-tax-slab-settings',
                         'add-salary-increment-settings', 'edit-salary-increment-settings',
                         'delete-salary-increment-settings', 'view-salary-increment-settings',
                         'add-salary-increment-reporting', 'edit-salary-increment-reporting',
                         'delete-salary-increment-reporting', 'view-salary-increment-reporting', 'add-payroll-head',
                         'edit-payroll-head', 'delete-payroll-head', 'view-payroll-head', 'change-status-payroll-head',
                         'add-pay-scale', 'edit-pay-scale', 'delete-pay-scale', 'view-pay-scale', 'add-salary',
                         'edit-salary', 'delete-salary', 'view-salary', 'print-salary', 'add-reimbursement-type',
                         'edit-reimbursement-type', 'delete-reimbursement-type', 'view-reimbursement-type',
                         'add-reimbursement', 'edit-reimbursement', 'delete-reimbursement', 'view-reimbursement',
                         'change-status-reimbursement'])
                         <div class="nav-item">
                             <a class="nav-link dropdown-toggle " href="#emppayroll" role="button"
                                 data-bs-toggle="collapse" data-bs-target="#emppayroll" aria-expanded="false"
                                 aria-controls="emppayroll">
                                 <i class="fas fa-money-bill-wave nav-icon"></i>
                                 <span class="nav-link-title">Payroll</span>
                             </a>

                             <div id="emppayroll"
                                 class="nav-collapse collapse {{ show(['payroll.salary.index', 'payroll.salary.create', 'overtime-settings.index', 'payroll.payscale.index', 'payroll.payscale.create', 'payroll.head.index', 'payroll.tax-slab-setting.index', 'payroll.salary-increment-setting.index', 'payroll.salary-increment-reporting.index', 'payroll.reimbursement_type.index', 'payroll.reimbursement.index']) }} "
                                 data-bs-parent="#navbarVerticalMenuPagesMenu">

                                 @canany(['add-tax-slab-settings', 'edit-tax-slab-settings', 'delete-tax-slab-settings',
                                     'view-tax-slab-settings'])
                                     <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.payroll.tax-slab-setting.index' ? 'active' : '' }}  "
                                         href="{{ route('admin.payroll.tax-slab-setting.index') }}"> Tax Slab</a>
                                 @endcanany

                                 @canany(['add-salary-increment-settings', 'edit-salary-increment-settings', 'delete-salary-increment-settings', 'view-salary-increment-settings'])
                                     <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.payroll.salary-increment-setting.index' ? 'active' : '' }}  "
                                         href="{{ route('admin.payroll.salary-increment-setting.index') }}"> Salary Increment
                                     </a>
                                 @endcanany
                                 @canany(['add-overtime-setting', 'edit-overtime-setting', 'view-overtime-setting',
                                     'delete-overtime-setting'])
                                     <div class="nav-item">
                                         <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.overtime-settings.list' ? 'active' : '' }}"
                                             href="{{ route('admin.overtime-settings.index') }}" data-placement="left">
                                             <span class="nav-link-title">Overtime</span>
                                         </a>
                                     </div>
                                 @endcanany

                                 @canany(['add-salary-increment-reporting', 'edit-salary-increment-reporting',
                                     'delete-salary-increment-reporting', 'view-salary-increment-reporting'])
                                     {{-- <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.payroll.salary-increment-reporting.index' ? 'active' : '' }}  "
                                   href="{{ route('admin.payroll.salary-increment-reporting.index') }}"> Salary
                                   Increment Reporting</a> --}}
                                 @endcanany
                                 @canany(['add-payroll-head', 'edit-payroll-head', 'delete-payroll-head',
                                     'view-payroll-head', 'change-status-payroll-head'])
                                     <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.payroll.head.index' ? 'active' : '' }}  "
                                         href="{{ route('admin.payroll.head.index') }}"> Payroll Heads</a>
                                 @endcanany

                                 @canany(['add-pay-scale', 'edit-pay-scale', 'delete-pay-scale', 'view-pay-scale'])
                                     <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.payroll.payscale.index' ? 'active' : '' }}  "
                                         href="{{ route('admin.payroll.payscale.index') }}"> Payscale</a>
                                 @endcanany

                                 @canany(['add-salary', 'edit-salary', 'delete-salary', 'view-salary', 'print-salary'])
                                     <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.payroll.salary.index' ? 'active' : '' }}  "
                                         href="{{ route('admin.payroll.salary.index') }}"> Salary</a>
                                 @endcanany

                                 @canany(['add-reimbursement-type', 'edit-reimbursement-type', 'delete-reimbursement-type',
                                     'view-reimbursement-type'])
                                     <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.payroll.reimbursement_type.index' ? 'active' : '' }}  "
                                         href="{{ route('admin.payroll.reimbursement_type.index') }}">Reimbursement Type</a>
                                 @endcanany

                                 @canany(['add-reimbursement', 'edit-reimbursement', 'delete-reimbursement',
                                     'view-reimbursement', 'change-status-reimbursement'])
                                     <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.payroll.reimbursement.index' ? 'active' : '' }}  "
                                         href="{{ route('admin.payroll.reimbursement.index') }}">Reimbursement</a>
                                 @endcanany
                                 @canany(['add-13-cheque', 'edit-13-cheque', 'delete-13-cheque', 'view-13-cheque'])
                                 @endcanany
                                 <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.payroll.index' ? 'active' : '' }}  "
                                     href="{{ route('admin.payroll.emp-13th-cheque.index') }}">13th Cheque</a>
                                 {{-- @canany(['salary-setting'])
                                     <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.payroll.salary_setting.index' ? 'active' : '' }}  "
                                         href="{{ route('admin.payroll.salary_setting.index') }}">Salary Setting</a>
                                 @endcanany --}}

                             </div>
                         </div>
                     @endcanany
                     <div id="navbarVerticalMenuPagesMenu">
                         <!-- Collapse -->
                         @canany(['add-document-type', 'edit-document-type', 'view-document-type',
                             'delete-document-type', 'change-status-document-type', 'add-document-management',
                             'edit-document-management', 'view-document-management', 'delete-document-management'])
                             <div class="nav-item">
                                 <a class="nav-link dropdown-toggle " href="#documents" role="button"
                                     data-bs-toggle="collapse" data-bs-target="#documents" aria-expanded="false"
                                     aria-controls="documents">
                                     <i class="fa fa-folder nav-icon"></i>
                                     <span class="nav-link-title">Documents</span>
                                 </a>
                                 <div id="documents"
                                     class="nav-collapse collapse {{ show(['document.index', 'document-type.index']) }} "
                                     data-bs-parent="#navbarVerticalMenuPagesMenu">

                                     @canany(['add-document-type', 'edit-document-type', 'view-document-type',
                                         'delete-document-type', 'change-status-document-type'])
                                         <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.document-type.index' ? 'active' : '' }}  "
                                             href="{{ route('admin.document-type.index') }}">Document Type</a>
                                     @endcanany
                                     @canany(['add-document-management', 'edit-document-management',
                                         'view-document-management', 'delete-document-management'])
                                         <div class="nav-item">
                                             <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.document.list' ? 'active' : '' }}"
                                                 href="{{ route('admin.document.index') }}" data-placement="left">
                                                 <span class="nav-link-title">Documents</span>
                                             </a>
                                         </div>
                                     @endcanany

                                 </div>
                             </div>
                         @endcanany
                         @canany(['report-tax-for-ibo', 'calcualte-tax-for-ibo'])
                             <div class="nav-item">
                                 <a class="nav-link dropdown-toggle " href="#ibotax" role="button"
                                     data-bs-toggle="collapse" data-bs-target="#ibotax" aria-expanded="false"
                                     aria-controls="ibotax">
                                     <i class="fa fa-folder nav-icon"></i>
                                     <span class="nav-link-title">Tax for IBO</span>
                                 </a>
                                 <div id="ibotax" class="nav-collapse collapse {{ show(['tax-for-ibo.report']) }} "
                                     data-bs-parent="#navbarVerticalMenuPagesMenu">

                                     @canany(['report-tax-for-ibo'])
                                         <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.payroll.tax-for-ibo.report' ? 'active' : '' }}  "
                                             href="{{ route('admin.payroll.tax-for-ibo.report') }}">Reports</a>
                                     @endcanany

                                     @canany(['calcualte-tax-for-ibo'])
                                         <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.payroll.tax-for-ibo.calculate' ? 'active' : '' }}"
                                             href="{{ route('admin.payroll.tax-for-ibo.calculate') }}" data-placement="left">
                                             <span class="nav-link-title">Calculate</span>
                                         </a>
                                     @endcanany

                                 </div>
                             </div>
                         @endcanany



                     </div>

                     @canany(['add-medical-card-type', 'edit-medical-card-type', 'view-medical-card-type',
                         'delete-medical-card-type'])
                         {{-- <div class="nav-item">
                   <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.medical-card.list' ? 'active' : '' }}"
                       href="{{ route('admin.medical-card.index') }}" data-placement="left">
                       <i class="fa fa-medkit nav-icon"></i>
                       <span class="nav-link-title">Bomaid Type</span>
                   </a>
               </div> --}}
                     @endcanany


                     {{-- <div id="navbarVerticalMenuSettingMenu">
                         <!-- Collapse -->

                         <div class="nav-item">
                             <a class="nav-link dropdown-toggle " href="#setting" role="button"
                                 data-bs-toggle="collapse" data-bs-target="#setting" aria-expanded="false"
                                 aria-controls="setting">
                                 <i class="fas fa-users-class nav-icon"></i>
                                 <span class="nav-link-title">Setting</span>
                             </a>

                             <div id="setting" class="nav-collapse collapse {{ show(['admin.setting.index']) }} "
                                 data-bs-parent="#navbarVerticalMenuSettingMenu">
                                 <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.setting.index' ? 'active' : '' }}  "
                                     href="{{ route('admin.setting.index') }}"> Settings</a>
                             </div>
                         </div>
                     </div> --}}


                     <!-- End Collapse -->
                     @canany(['add-account', 'edit-account', 'view-account', 'delete-account', 'change-status-account',
                         'add-currency-settings', 'edit-currency-settings', 'view-currency-settings',
                         'delete-currency-settings', 'change-status-currency-settings', 'add-holidays', 'edit-holidays',
                         'view-holidays', 'delete-holidays', 'add-ttum-report', 'edit-ttum-report', 'view-ttum-report',
                         'delete-ttum-report', 'export-report-ttum-report', 'add-country', 'edit-country', 'view-country',
                         'delete-country', 'change-status-country'])
                         <span class="mt-4 dropdown-header">Master</span>
                     @endcanany
                     <small class="bi-three-dots nav-subtitle-replacer"></small>

                     @canany(['add-account', 'edit-account', 'view-account', 'delete-account', 'change-status-account'])
                         <div class="nav-item">
                             <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.account.list' ? 'active' : '' }}"
                                 href="{{ route('admin.account.index') }}" data-placement="left">
                                 <i class="bi bi-bank2 nav-icon"></i>
                                 <span class="nav-link-title">Account</span>
                             </a>
                         </div>
                     @endcanany

                     @canany(['add-currency-settings', 'edit-currency-settings', 'view-currency-settings',
                         'delete-currency-settings', 'change-status-currency-settings'])
                         <div class="nav-item">
                             <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.currency_settings.list' ? 'active' : '' }}"
                                 href="{{ route('admin.currency_settings.index') }}" data-placement="left">
                                 <i class="bi bi-currency-dollar nav-icon"></i>
                                 <span class="nav-link-title">Currency Settings</span>
                             </a>
                         </div>
                     @endcanany

                     @canany(['add-holidays', 'edit-holidays', 'view-holidays', 'delete-holidays'])
                         <div class="nav-item">
                             <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.holiday.list' ? 'active' : '' }}"
                                 href="{{ route('admin.holiday.list') }}" data-placement="left">
                                 <i class="bi bi-house nav-icon"></i>
                                 <span class="nav-link-title">Holidays</span>
                             </a>
                         </div>
                     @endcanany

                     @canany(['add-ttum-report', 'edit-ttum-report', 'view-ttum-report', 'delete-ttum-report',
                         'export-report-ttum-report'])
                         <div class="nav-item">
                             <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.payroll.reports.ttum.list' ? 'active' : '' }}"
                                 href="{{ route('admin.payroll.reports.ttum.list') }}" data-placement="left">
                                 <i class="bi bi-receipt nav-icon"></i>
                                 <span class="nav-link-title">TTUM report</span>
                             </a>
                         </div>
                     @endcanany

                     @canany(['add-country', 'edit-country', 'view-country', 'delete-country', 'change-status-country'])
                         <div class="nav-item">
                             <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.country.list' ? 'active' : '' }}"
                                 href="{{ route('admin.country.index') }}" data-placement="left">
                                 <i class="fa fa-medkit nav-icon"></i>
                                 <span class="nav-link-title">Country</span>
                             </a>
                         </div>
                     @endcanany

                     {{-- @canany(['aaaa']) --}}
                     <div class="nav-item">
                         <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.backups.index' ? 'active' : '' }}"
                             href="{{ route('admin.backups.index') }}" data-placement="left">
                             <i class="fas fa-cloud-download-alt nav-icon"></i>
                             <span class="nav-link-title">Backup</span>
                         </a>
                     </div>
                     {{-- @endcanany --}}



                     {{-- @canany(['add-leave-settings', 'edit-leave-settings', 'view-leave-settings', 'delete-leave-settings', 'add-leave-type', 'edit-leave-type', 'delete-leave-type', 'view-leave-type'])
                         <div class="nav-item">
                             <a class="nav-link dropdown-toggle " href="#leavesetting" role="button"
                                 data-bs-toggle="collapse" data-bs-target="#leavesetting" aria-expanded="false"
                                 aria-controls="leavesetting">
                                 <i class="bi bi-stickies-fill nav-icon"></i>
                                 <span class="nav-link-title">Leave Settings</span>
                             </a>

                             <div id="leavesetting" class="nav-collapse collapse {{ show(['leavesettings.list']) }} "
                                 data-bs-parent="#navbarVerticalMenuPagesMenu">



                             </div>
                         </div>
                     @endcanany --}}

                 </div>
                 {{-- @endcanany --}}
             </div>
             <!-- End Content -->

             <!-- Footer -->
             <div class="navbar-vertical-footer">
                 <ul class="navbar-vertical-footer-list">
                     <li class="navbar-vertical-footer-list-item">
                         <!-- Style Switcher -->
                         <div class="dropdown dropup">
                             <button type="button" class="btn btn-ghost-secondary btn-icon rounded-circle"
                                 id="selectThemeDropdown" data-bs-toggle="dropdown" aria-expanded="false"
                                 data-bs-dropdown-animation>

                             </button>

                             <div class="dropdown-menu navbar-dropdown-menu navbar-dropdown-menu-borderless"
                                 aria-labelledby="selectThemeDropdown">
                                 <a class="dropdown-item" href="#" data-icon="bi-moon-stars"
                                     data-value="auto">
                                     <i class="bi-moon-stars me-2"></i>
                                     <span class="text-truncate" title="Auto (system default)">Auto (system
                                         default)</span>
                                 </a>
                                 <a class="dropdown-item" href="#" data-icon="bi-brightness-high"
                                     data-value="default">
                                     <i class="bi-brightness-high me-2"></i>
                                     <span class="text-truncate" title="Default (light mode)">Default (light
                                         mode)</span>
                                 </a>
                                 <a class="dropdown-item active" href="#" data-icon="bi-moon"
                                     data-value="dark">
                                     <i class="bi-moon me-2"></i>
                                     <span class="text-truncate" title="Dark">Dark</span>
                                 </a>
                             </div>
                         </div>

                         <!-- End Style Switcher -->
                     </li>



                 </ul>
             </div>
             <!-- End Footer -->
         </div>
     </div>
 </aside>

 <!-- End Navbar Vertical -->
