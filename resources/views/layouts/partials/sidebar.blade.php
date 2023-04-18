 <!-- Navbar Vertical -->

 <aside
     class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered bg-white  ">
     <div class="navbar-vertical-container">
         <div class="navbar-vertical-footer-offset">
             <!-- Logo -->

             <a class="navbar-brand" href="index-2.html" aria-label="Front">
                 <img src="{{ asset('assets/img/logo.svg') }}" alt="Logo" data-hs-theme-appearance="default">
                 <img class="navbar-brand-logo" src="{{ asset('assets/svg/logos-light/logo.svg') }}" alt="Logo"
                     data-hs-theme-appearance="dark">
                 <img class="navbar-brand-logo-mini" src="{{ asset('assets/svg/logos/logo-short.svg') }}" alt="Logo"
                     data-hs-theme-appearance="default">
                 <img class="navbar-brand-logo-mini" src="{{ asset('assets/svg/logos-light/logo-short.svg') }}"
                     alt="Logo" data-hs-theme-appearance="dark">
             </a>

             <!-- End Logo -->

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
                     @can('view_dashboard')
                        <div class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}" data-placement="left">
                                <i class="bi bi-speedometer nav-icon"></i>
                                <span class="nav-link-title">Dashboards</span>
                            </a>
                        </div>
                     @endcan
                     
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

                     <span class="dropdown-header mt-4">Pages</span>
                     <small class="bi-three-dots nav-subtitle-replacer"></small>

                     <!-- Collapse -->
                     <div class="navbar-nav nav-compact">

                     </div>
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

                             <div id="navbarVerticalMenuPagesUserProfileMenu" class="nav-collapse collapse "
                                 data-bs-parent="#navbarVerticalMenuPagesMenu">
                                 <a class="nav-link " href="{{ url('admin/roles') }}">Roles</a>
                                 <a class="nav-link " href="{{ url('admin/users') }}">Users</a>
                             </div>
                         </div>
                         <!-- End Collapse -->
                         <div id="employee">

                             <!-- End Collapse -->
                             <div class="nav-item">
                                 <a class="nav-link dropdown-toggle " href="#employees" role="button"
                                     data-bs-toggle="collapse" data-bs-target="#employees" aria-expanded="false"
                                     aria-controls="employees">
                                     <i class="fas fa-users nav-icon"></i>
                                     <span class="nav-link-title">Employees</span>
                                 </a>
                                 <div id="employees"
                                     class="nav-collapse collapse {{ show(['designation.index', 'membership.index', 'branch.index', 'employees.index']) }}  "
                                     data-bs-parent="#employee">
                                     <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.designation.index' ? 'active' : '' }} "
                                         href="{{ route('admin.designation.index') }}">Designation</a>
                                     <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.membership.index' ? 'active' : '' }} "
                                         href="{{ route('admin.membership.index') }}">Membership</a>
                                     <a class="nav-link  {{ Route::getCurrentRoute()->getName() == 'admin.branch.index' ? 'active' : '' }}"
                                         href="{{ route('admin.branch.index') }}">Branch</a>
                                     <a class="nav-link {{ Route::getCurrentRoute()->getName() == 'admin.employees.index' ? 'active' : '' }} "
                                         href="{{ route('admin.employees.index') }}">Employees</a>
                                 </div>
                             </div>
                             <!-- End Collapse -->
                         </div>


                         <!-- End Collapse -->

                         <span class="dropdown-header mt-4">Master</span>
                         <small class="bi-three-dots nav-subtitle-replacer"></small>



                         <div class="nav-item">
                             <a class="nav-link" href="{{ route('admin.holiday.list') }}" data-placement="left">
                                 <i class="bi-folder2-open nav-icon"></i>
                                 <span class="nav-link-title">Holidays</span>
                             </a>
                         </div>
                         <div class="nav-item">
                            <a class="nav-link" href="{{ route('admin.leave.list') }}" data-placement="left">
                                <i class="bi-folder2-open nav-icon"></i>
                                <span class="nav-link-title">Leave</span>
                            </a>
                        </div>




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
