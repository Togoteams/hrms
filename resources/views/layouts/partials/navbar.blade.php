 <!-- ========== HEADER ========== -->

 <header id="header"
     class="navbar navbar-expand-lg navbar-fixed navbar-height navbar-container navbar-bordered ">
     <div class="navbar-nav-wrap">
         <!-- Logo -->
         <a class="navbar-brand" href="{{url('/admin/dashboard')}}" aria-label="Front">
            
             <img class="navbar-brand-logo" src="{{ asset('assets/img/logo-cropped.svg')  }}" alt="Logo"
                 data-hs-theme-appearance="dark">
             <img class="navbar-brand-logo-mini" src="{{ asset('assets/img/logo-cropped.svg')  }}" alt="Logo"
                 data-hs-theme-appearance="default">
             <img class="navbar-brand-logo-mini" src="{{asset('assets/img/logo-cropped.svg')  }}"
                 alt="Logo" data-hs-theme-appearance="dark">
         </a>
         <!-- End Logo -->

         <div class="mr-auto navbar-nav-wrap-content">
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

             <!-- Search Form -->
             <h1 class="pt-2 tittle-nav">HRMS</h1>


             <!-- End Search Form -->
         </div>
         <div class="mx-auto text-center nav-center-logo">

            <img class="navbar-brand-logo" src="{{ asset('assets/img/logo-cropped.svg') }}" alt="Logo"
            data-hs-theme-appearance="default">


            <!-- End Search Form -->
        </div>

         <div class="ml-auto navbar-nav-wrap-content">
             <!-- Navbar -->
             <ul class="navbar-nav">
               
                <li style="color: white;">{{ auth()->user()->salutation }} {{ auth()->user()->name }} 
                    @if (auth()->user()->employee)
                    ({{ auth()->user()->employee->ec_number }})
                    @endif
                </li>
         
                 <li class="nav-item">
                     <!-- Account -->
                     <div class="dropdown">
                         <a class="navbar-dropdown-account-wrapper" href="javascript:;" id="accountNavbarDropdown"
                             data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside"
                             data-bs-dropdown-animation>
                             <div class="avatar avatar-sm avatar-circle">
                                 {{-- <img class="avatar-img" src="{{ asset('assets/img/160x160/user.png') }}"
                                     alt="Image Description"> --}}
                                     @if (auth()->user()->image && file_exists(public_path('assets/profile/' . auth()->user()->image)))
                                     <img class="avatar-img" src="{{ asset('assets/profile/' . auth()->user()->image) }}" alt="Profile Image">
                                    @else
                                        <img class="avatar-img" src="{{ asset('assets/img/160x160/user.png') }}" alt="Default Icon">
                                    @endif    
                                 <span class="avatar-status avatar-sm-status avatar-status-success"></span>
                             </div>
                         </a>

                         <div class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless navbar-dropdown-account"
                             aria-labelledby="accountNavbarDropdown" style="width: 16rem;">
                             <div class="dropdown-item-text">
                                 <div class="d-flex align-items-center">
                                     <div class="avatar avatar-sm avatar-circle">
                                        @if (auth()->user()->image && file_exists(public_path('assets/profile/' . auth()->user()->image)))
                                     <img class="avatar-img" src="{{ asset('assets/profile/' . auth()->user()->image) }}" alt="Profile Image">
                                    @else
                                        <img class="avatar-img" src="{{ asset('assets/img/160x160/user.png') }}" alt="Default Icon">
                                    @endif  
                                     </div>
                                     <div class="flex-grow-1 ms-3">
                                         <h5 class="mb-0">{{ auth()->user()->name }}</h5>
                                         <p class="card-text text-body">{{ auth()->user()->email }}</p>
                                     </div>
                                 </div>
                             </div>

                             <div class="dropdown-divider"></div>

                             <a class="dropdown-item" href="{{ route('admin.profile') }}">Profile</a>
                             <a class="dropdown-item" href="{{ route('admin.password') }}">Password Setting</a>

                             <div class="dropdown-divider"></div>
                             <form class="dropdown-item" method="POST" action="{{ route('logout') }}">
                                 @csrf
                                 <button class="border border-0 bg-none">Sign Out</button>
                             </form>
                             {{-- <a class="dropdown-item" href="#">Sign out</a> --}}
                         </div>
                     </div>
                     <!-- End Account -->
                 </li>
             </ul>
             <!-- End Navbar -->
         </div>
     </div>
 </header>

 <!-- ========== END HEADER ========== -->
