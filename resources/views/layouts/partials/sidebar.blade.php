 <!-- Navbar Vertical -->

 <aside
     class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl ">
     <div class="navbar-vertical-container">
         <div class="navbar-vertical-footer-offset">
             <!-- Logo -->

             {{-- <a class="navbar-brand" href="index-2.html" aria-label="Front">
                 <img src="{{ asset('assets/img/logo.svg') }}" alt="Logo" data-hs-theme-appearance="default">
                 <img class="navbar-brand-logo" src="{{ asset('assets/svg/logos-light/logo.svg') }}" alt="Logo"
                     data-hs-theme-appearance="dark">
                 <img class="navbar-brand-logo-mini" src="{{ asset('assets/svg/logos/logo-short.svg') }}" alt="Logo"
                     data-hs-theme-appearance="default">
                 <img class="navbar-brand-logo-mini" src="{{ asset('assets/svg/logos-light/logo-short.svg') }}"
                     alt="Logo" data-hs-theme-appearance="dark">
             </a> --}}

             <!-- End Logo -->
             <div class="pt-3 text-center">

                 <i class="name-title">Bank of Baroda Ltd.

                     (Botswana)</i>
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
                             <span class="nav-link-title">Dashboards</span>
                         </a>
                     </div>

                     {{-- <div class="nav-item">
                         <a class="nav-link dropdown-toggle active" href="#navbarVerticalMenuDashboards" role="button"
                             data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuDashboards"
                             aria-expanded="true" aria-controls="navbarVerticalMenuDashboards">
                             <i class="bi-house-door nav-icon"></i>
                             <span class="nav-link-title">Dashboards</span>
                         </a>

                         <div id="navbarVerticalMenuDashboards" class="nav-collapse collapse show"
                             data-bs-parent="#navbarVerticalMenu">
                             <a class="nav-link active" href="index-2.html">Default</a>
                         </div>
                     </div> --}}
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
                                     <span class="nav-link-title">User Accounts</span>
                                 </a>

                                 <div id="navbarVerticalMenuPagesUserProfileMenu"
                                     class="nav-collapse collapse {{ show(['role.list', 'user.list']) }} "
                                     data-bs-parent="#navbarVerticalMenuPagesMenu">

                                     @canany(['add-roles', 'edit-roles', 'delete-roles', 'view-roles'])
                                         <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.role.list' ? 'active' : '' }}  "
                                             href="{{ route('admin.role.list') }}">Roles</a>
                                     @endcanany
                                     @canany(['add-users', 'edit-users', 'view-users', 'delete-users'])
                                         <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.user.list' ? 'active' : '' }} "
                                             href="{{ route('admin.user.list') }}">Users</a>
                                     @endcanany
                                 </div>
                             </div>
                         </div>
                     @endcanany
                     <!-- End Collapse -->
                     <div id="employee">
                         @canany(['add-employees', 'edit-employees', 'view-employees', 'delete-employees',
                             'add-designations', 'edit-designations', 'view-designations', 'delete-designations',
                             'add-memberships', 'edit-memberships', 'view-memberships', 'delete-memberships', 'add-branch',
                             'edit-branch', 'view-branch', 'delete-branch'])
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
                                     {{--
                                     @canany(['add-tax', 'edit-tax', 'view-tax', 'delete-tax']) --}}
                                     <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.tax.index' ? 'active' : '' }} "
                                         href="{{ route('admin.tax.index') }}"> Manage Tax </a>
                                     {{-- @endcanany --}}

                                     @canany(['add-memberships', 'edit-memberships', 'view-memberships',
                                         'delete-memberships'])
                                         <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.membership.index' ? 'active' : '' }} "
                                             href="{{ route('admin.membership.index') }}">Union Membership</a>
                                     @endcanany
                                     @canany(['add-branch', 'edit-branch', 'view-branch', 'delete-branch'])
                                         <a class="nav-link  {{ Route::getCurrentRoute()->getName() == 'admin.branch.index' ? 'active' : '' }}"
                                             href="{{ route('admin.branch.index') }}">Branch</a>
                                     @endcanany
                                     @canany(['add-employees', 'edit-employees', 'view-employees', 'delete-employees'])
                                         <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.employees.index' ? 'active' : '' }} "
                                             href="{{ route('admin.employees.index') }}">Employees</a>
                                     @endcanany
                                     @canany(['add-employees', 'edit-employees', 'view-employees', 'delete-employees'])
                                     <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.employee-transfer.index' ? 'active' : '' }} "
                                         href="{{ route('admin.employee-transfer.index') }}">Employee Transfer </a>
                                     @endcanany
                                     @canany(['add-employees', 'edit-employees', 'view-employees', 'delete-employees'])
                                         <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.department.index' ? 'active' : '' }} "
                                             href="{{ route('admin.department.index') }}">Department </a>
                                     @endcanany
                                 </div>
                             </div>
                             <!-- End Collapse -->
                         @endcanany
                     </div>
                     <div id="me">
                         @canany(['add-leaves', 'edit-leaves', 'view-leaves', 'delete-leaves'])
                             <div class="nav-item">
                                 <a class="nav-link dropdown-toggle " href="#loans" role="button"
                                     data-bs-toggle="collapse" data-bs-target="#loans" aria-expanded="false"
                                     aria-controls="loans">
                                     <i class="bi-person nav-icon"></i>
                                     <span class="nav-link-title">Loans</span>
                                 </a>

                                 <div id="loans"
                                     class="nav-collapse collapse {{ show(['loans.index', 'employees_loans.index']) }} "
                                     data-bs-parent="#navbarVerticalMenuPagesMenu">

                                     <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.loans.index' ? 'active' : '' }}  "
                                         href="{{ route('admin.loans.index') }}"><i
                                             class="fal fa-calendar-edit nav-icon"></i>Loans Types</a>

                                     <a class="nav-link  {{ Route::getCurrentRoute()->getName() == 'admin.emplooye_loans.index' ? 'active' : '' }}"
                                         href="{{ route('admin.employees_loans.index') }}" data-placement="left">
                                         <i class="far fa-desktop-alt nav-icon "></i> <span class="nav-link-title">Apply
                                             Loans </span>
                                     </a>
                                 </div>
                             </div>
                         @endcanany
                     </div>
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


                     @canany(['add-users', 'edit-users', 'view-users', 'delete-users', 'add-roles', 'edit-roles',
                         'delete-roles', 'view-roles'])
                         <div id="navbarVerticalMenuPagesMenu">
                             <!-- Collapse -->

                             <div class="nav-item">
                                 <a class="nav-link dropdown-toggle " href="#kra" role="button"
                                     data-bs-toggle="collapse" data-bs-target="#kra" aria-expanded="false"
                                     aria-controls="kra">
                                     <i class="fas fa-users-class nav-icon"></i>
                                     <span class="nav-link-title">Kra</span>
                                 </a>

                                 <div id="kra"
                                     class="nav-collapse collapse {{ show(['employee-kra.index', 'kra-attributes.index']) }} "
                                     data-bs-parent="#navbarVerticalMenuPagesMenu">

                                     @canany(['add-roles', 'edit-roles', 'delete-roles', 'view-roles'])
                                         <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.kra-attributes.index' ? 'active' : '' }}  "
                                             href="{{ route('admin.kra-attributes.index') }}"> Attributes</a>
                                     @endcanany
                                     @canany(['add-roles', 'edit-roles', 'delete-roles', 'view-roles'])
                                         <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.employee-kra.index' ? 'active' : '' }}  "
                                             href="{{ route('admin.employee-kra.index') }}"> Employee Kra</a>
                                     @endcanany

                                 </div>
                             </div>
                         </div>
                     @endcanany

                     @canany(['add-users', 'edit-users', 'view-users', 'delete-users', 'add-roles', 'edit-roles',
                     'delete-roles', 'view-roles'])
                         <div class="nav-item">
                             <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.document.list' ? 'active' : '' }}"
                                 href="{{ route('admin.document.index') }}" data-placement="left">
                                 <i class="fa fa-file nav-icon"></i>
                                 <span class="nav-link-title">Document Management</span>
                             </a>
                         </div>
                     @endcanany

                     @canany(['add-users', 'edit-users', 'view-users', 'delete-users', 'add-roles', 'edit-roles',
                     'delete-roles', 'view-roles'])
                         <div class="nav-item">
                             <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.medical-cart.list' ? 'active' : '' }}"
                                 href="{{ route('admin.medical-cart.index') }}" data-placement="left">
                                 <i class="fa fa-truck-medical nav-icon"></i>
                                 <span class="nav-link-title">Medical card Type</span>
                             </a>
                         </div>
                     @endcanany

                     @canany(['add-users', 'edit-users', 'view-users', 'delete-users', 'add-roles', 'edit-roles',
                     'delete-roles', 'view-roles'])
                         <div class="nav-item">
                             <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.overtime-settings.list' ? 'active' : '' }}"
                                 href="{{ route('admin.overtime-settings.index') }}" data-placement="left">
                                 <i class="fa fa-clock nav-icon"></i>
                                 <span class="nav-link-title">Overtime Setting</span>
                             </a>
                         </div>
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

                     <span class="mt-4 dropdown-header">Master</span>
                     <small class="bi-three-dots nav-subtitle-replacer"></small>


                     @canany(['add-holidays', 'edit-holidays', 'view-holidays', 'delete-holidays'])
                         <div class="nav-item">
                             <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.holiday.list' ? 'active' : '' }}"
                                 href="{{ route('admin.holiday.list') }}" data-placement="left">
                                 <i class="bi-folder2-open nav-icon"></i>
                                 <span class="nav-link-title">Holidays</span>
                             </a>
                         </div>
                     @endcanany

                     {{-- @canany(['add-leaves', 'edit-leaves', 'view-leaves', 'delete-leaves']) --}}
                     <div class="nav-item">
                         <a class="nav-link dropdown-toggle " href="#leave" role="button"
                             data-bs-toggle="collapse" data-bs-target="#leave" aria-expanded="false"
                             aria-controls="leave">
                             <i class="bi-person nav-icon"></i>
                             <span class="nav-link-title">Leave</span>
                         </a>

                         <div id="leave"
                             class="nav-collapse collapse {{ show(['leave_type.index', 'leave_apply.index', 'leave_encashment.index', 'leave_apply.balance_history', 'leave_apply.request_history', 'leave_reports.index', 'leave_apply.get_rejected_leave']) }} "
                             data-bs-parent="#navbarVerticalMenuPagesMenu">

                             @if (!isemplooye())
                                 <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.leave_type.index' ? 'active' : '' }}  "
                                     href="{{ route('admin.leave_type.index') }}">Leave Types</a>
                             @endif

                             <a class="nav-link  {{ Route::getCurrentRoute()->getName() == 'admin.leave_apply.index' ? 'active' : '' }}"
                                 href="{{ route('admin.leave_apply.index') }}" data-placement="left">
                                 <span class="nav-link-title">LEAVE Apply/Modify</span>


                             </a>

                             <a class="nav-link  {{ Route::getCurrentRoute()->getName() == 'admin.leave_encashment.index' ? 'active' : '' }}"
                                 href="{{ route('admin.leave_encashment.index') }}" data-placement="left">
                                 <span class="nav-link-title">LEAVE ENCASHMENT</span>


                             </a>
                             <a class="nav-link  {{ Route::getCurrentRoute()->getName() == 'admin.leave_apply.balance_history' ? 'active' : '' }}"
                                 href="{{ route('admin.leave_apply.balance_history') }}" data-placement="left">
                                 <span class="nav-link-title">LEAVE BALANCE REPORT</span>


                             </a>
                             <a class="nav-link  {{ Route::getCurrentRoute()->getName() == 'admin.leave_apply.request_history' ? 'active' : '' }}"
                                 href="{{ route('admin.leave_apply.request_history') }}" data-placement="left">
                                 <span class="nav-link-title">LEAVE REQUEST HISTORY</span>
                             </a>

                             <a class="nav-link  {{ Route::getCurrentRoute()->getName() == 'admin.leave_apply.get_rejected_leave' ? 'active' : '' }}"
                                 href="{{ route('admin.leave_apply.get_rejected_leave') }}" data-placement="left">
                                 <span class="nav-link-title">LEAVE REQUEST REJECTED</span>


                             </a>

                             <a class="nav-link  {{ Route::getCurrentRoute()->getName() == 'admin.leave_reports.index' ? 'active' : '' }}"
                                 href="{{ route('admin.leave_reports.index') }}" data-placement="left">
                                 <span class="nav-link-title">LEAVE REPORTS</span>


                             </a>

                         </div>
                     </div>
                     <div class="nav-item">
                        <a class="nav-link dropdown-toggle " href="#leavesetting" role="button"
                            data-bs-toggle="collapse" data-bs-target="#leavesetting" aria-expanded="false"
                            aria-controls="leavesetting">
                            <i class="bi-person nav-icon"></i>
                            <span class="nav-link-title">Leave Settings</span>
                        </a>

                        <div id="leavesetting"
                            class="nav-collapse collapse {{ show(['leavesettings.list']) }} "
                            data-bs-parent="#navbarVerticalMenuPagesMenu">

                            <a class="nav-link  {{ Route::getCurrentRoute()->getName() == 'admin.leavesettings.list' ? 'active' : '' }}"
                                href="{{ route('admin.leavesettings.list') }}" data-placement="left">
                                <span class="nav-link-title">Leave Type</span>
                            </a>


                        </div>
                    </div>
                     <div class="nav-item">
                         <a class="nav-link dropdown-toggle " href="#emppayroll" role="button"
                             data-bs-toggle="collapse" data-bs-target="#emppayroll" aria-expanded="false"
                             aria-controls="emppayroll">
                             <i class="fas fa-money-bill-wave nav-icon"></i>
                             <span class="nav-link-title">Payroll</span>
                         </a>

                         <div id="emppayroll"
                             class="nav-collapse collapse {{ show(['payroll.salary.index', 'payroll.payscale.index', 'payroll.head.index','payroll.tax-slab-setting.index','payroll.salary-increment-setting.index','payroll.salary-increment-reporting.index','payroll.reimbursement_type.index','payroll.reimbursement.index']) }} "
                             data-bs-parent="#navbarVerticalMenuPagesMenu">

                             <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.payroll.tax-slab-setting.index' ? 'active' : '' }}  "
                                href="{{ route('admin.payroll.tax-slab-setting.index') }}"> Tax Slab Settings</a>

                             <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.payroll.salary-increment-setting.index' ? 'active' : '' }}  "
                                 href="{{ route('admin.payroll.salary-increment-setting.index') }}"> Salary Increment Settings</a>

                            <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.payroll.salary-increment-reporting.index' ? 'active' : '' }}  "
                                    href="{{ route('admin.payroll.salary-increment-reporting.index') }}"> Salary Increment Reporting</a>
    
                             <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.payroll.head.index' ? 'active' : '' }}  "
                                 href="{{ route('admin.payroll.head.index') }}"> Payroll Head</a>

                             <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.payroll.payscale.index' ? 'active' : '' }}  "
                                 href="{{ route('admin.payroll.payscale.index') }}"> Pay Scale</a>

                             <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.payroll.salary.index' ? 'active' : '' }}  "
                                 href="{{ route('admin.payroll.salary.index') }}"> Salary</a>
		
                            <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.payroll.reimbursement_type.index' ? 'active' : '' }}  "
                                href="{{ route('admin.payroll.reimbursement_type.index') }}">Reimbursement Type</a>
                            
                            <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.payroll.reimbursement.index' ? 'active' : '' }}  "
                                href="{{ route('admin.payroll.reimbursement.index') }}">Reimbursement</a>

                         </div>
                     </div>

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

                     <li class="navbar-vertical-footer-list-item">
                         <!-- Other Links -->
                         <div class="dropdown dropup">
                             <button type="button" class="btn btn-ghost-secondary btn-icon rounded-circle"
                                 id="otherLinksDropdown" data-bs-toggle="dropdown" aria-expanded="false"
                                 data-bs-dropdown-animation>
                                 <i class="bi-info-circle"></i>
                             </button>

                             <div class="dropdown-menu navbar-dropdown-menu-borderless"
                                 aria-labelledby="otherLinksDropdown">
                                 <span class="dropdown-header">Help</span>
                                 <a class="dropdown-item" href="#">
                                     <i class="bi-journals dropdown-item-icon"></i>
                                     <span class="text-truncate" title="Resources &amp; tutorials">Resources
                                         &amp; tutorials</span>
                                 </a>
                                 <a class="dropdown-item" href="#">
                                     <i class="bi-gift dropdown-item-icon"></i>
                                     <span class="text-truncate" title="What's new?">What's new?</span>
                                 </a>
                                 <div class="dropdown-divider"></div>
                                 <span class="dropdown-header">Contacts</span>
                                 <a class="dropdown-item" href="#">
                                     <i class="bi-chat-left-dots dropdown-item-icon"></i>
                                     <span class="text-truncate" title="Contact support">Developer Help</span>
                                 </a>
                             </div>
                         </div>
                         <!-- End Other Links -->
                     </li>

                 </ul>
             </div>
             <!-- End Footer -->
         </div>
     </div>
 </aside>

 <!-- End Navbar Vertical -->
