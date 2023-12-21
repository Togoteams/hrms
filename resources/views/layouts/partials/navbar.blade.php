 <!-- ========== HEADER ========== -->
 <style>
.notification-icon {
    position: relative;
    color: #FF5722;
    background: #fff;
    padding: 7px 9px;
    border-radius: 31px;
}
.list-group-flush {
    border-radius: 0;
}

.list-group {
    border-radius: 0.375rem;
    display: flex;
    flex-direction: column;
    margin-bottom: 0;
    padding-left: 0;
}
.list-group-activity .list-group-item {
    border: 0;
}

.list-group-flush>.list-group-item {
    padding-left: 0;
    padding-right: 0;
}
.list-group-flush>.list-group-item {
    border-width: 0 0 1px;
}
.list-group-item:first-child {
    border-top-left-radius: inherit;
    border-top-right-radius: inherit;
}
.list-group-item {
    background-color: transparent;
    border: 1px solid #edf2f9;
    color: #283e59;
    display: block;
    padding: 1rem 1.25rem;
    position: relative;
}
.list-group-activity .list-group-item:not(:last-child):before {
    border-left: 1px solid #e3ebf6;
    content: "";
    height: 100%;
    left: 1.25rem;
    position: absolute;
    top: 1rem;
}
.avatar-sm {
    font-size: .83333rem;
    height: 2.5rem;
    width: 2.5rem;
}
.avatar-img {
    height: 100%;
    -o-object-fit: cover;
    object-fit: cover;
    width: 100%;
}
.navbar-dropdown-notification{
    width: 26em!important;
    height: 379px;
    overflow-x: auto;
}
 </style>

 <header id="header" class="navbar navbar-expand-lg navbar-fixed navbar-height navbar-container navbar-bordered ">
     <div class="navbar-nav-wrap">
         <!-- Logo -->
         <a class="navbar-brand" href="{{url('/admin/dashboard')}}" aria-label="Front">

             <img class="navbar-brand-logo" src="{{ asset('assets/img/logo-cropped.svg')  }}" alt="Logo"
                 data-hs-theme-appearance="dark">
             <img class="navbar-brand-logo-mini" src="{{ asset('assets/img/logo-cropped.svg')  }}" alt="Logo"
                 data-hs-theme-appearance="default">
             <img class="navbar-brand-logo-mini" src="{{asset('assets/img/logo-cropped.svg')  }}" alt="Logo"
                 data-hs-theme-appearance="dark">
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


             <li class="nav-item">
                     <!-- Account -->
                     <div class="dropdown">
                         <a class="navbar-dropdown-account-wrapper" href="javascript:;" id="accountNavbarDropdown"
                             data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside"
                             data-bs-dropdown-animation>
                             <div class="notification-icon">


                                 <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="lucide lucide-bell-ring">
                                     <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
                                     <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
                                     <path d="M4 2C2.8 3.7 2 5.7 2 8" />
                                     <path d="M22 8c0-2.3-.8-4.3-2-6" />
                                 </svg>
                             </div>
                         </a>

                         <div class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless navbar-dropdown-notification"
                             aria-labelledby="accountNavbarDropdown" style="width: 16rem;">
                             <div class="dropdown-item-text">
                                 <div class="d-flex align-items-center">

                                     <div class="list-group list-group-flush list-group-activity my-n3">
                                         <div class="list-group-item">
                                             <div class="row">
                                                 <div class="col-auto">

                                                     <!-- Avatar -->
                                                     <div class="avatar avatar-sm">
                                                         <img src="{{asset('assets/img/160x160/img3.jpg')}}" alt="..."
                                                             class="avatar-img rounded-circle">
                                                     </div>

                                                 </div>
                                                 <div class="col ms-n2">

                                                     <!-- Content -->
                                                     <div class="small">
                                                         <strong>Dianna Smiley</strong> shared your post with Ab Hadley,
                                                         Adolfo
                                                         Hess, and 3 others.
                                                     </div>

                                                     <!-- Time -->
                                                     <small class="text-muted">
                                                         2m ago
                                                     </small>

                                                 </div>
                                             </div> <!-- / .row -->
                                         </div>
                                         <div class="list-group-item">
                                             <div class="row">
                                                 <div class="col-auto">

                                                     <!-- Avatar -->
                                                     <div class="avatar avatar-sm">
                                                     <img src="{{ asset('assets/img/160x160/img4.jpg') }}" alt="..."
                                                             class="avatar-img rounded-circle">
                                                     </div>

                                                 </div>
                                                 <div class="col ms-n2">

                                                     <!-- Content -->
                                                     <div class="small">
                                                         <strong>Ab Hadley</strong> reacted to your post with a 😍
                                                     </div>

                                                     <!-- Time -->
                                                     <small class="text-muted">
                                                         2m ago
                                                     </small>

                                                 </div>
                                             </div> <!-- / .row -->
                                         </div>
                                         <div class="list-group-item">
                                             <div class="row">
                                                 <div class="col-auto">

                                                     <!-- Avatar -->
                                                     <div class="avatar avatar-sm">
                                                     <img src="{{ asset('assets/img/160x160/img5.jpg') }}" alt="..."
                                                             class="avatar-img rounded-circle">
                                                     </div>

                                                 </div>
                                                 <div class="col ms-n2">

                                                     <!-- Content -->
                                                     <div class="small">
                                                         <strong>Adolfo Hess</strong> commented
                                                         <blockquote class="mb-0">
                                                             “I don’t think this really makes sense to do without
                                                             approval from
                                                             Johnathan since he’s the one...”
                                                         </blockquote>
                                                     </div>

                                                     <!-- Time -->
                                                     <small class="text-muted">
                                                         2m ago
                                                     </small>

                                                 </div>
                                             </div> <!-- / .row -->
                                         </div>
                                         <div class="list-group-item">
                                             <div class="row">
                                                 <div class="col-auto">

                                                     <!-- Avatar -->
                                                     <div class="avatar avatar-sm">
                                                     <img src="{{ asset('assets/img/160x160/img6.jpg') }}" alt="..."
                                                             class="avatar-img rounded-circle">
                                                     </div>

                                                 </div>
                                                 <div class="col ms-n2">

                                                     <!-- Content -->
                                                     <div class="small">
                                                         <strong>Daniela Dewitt</strong> subscribed to you.
                                                     </div>

                                                     <!-- Time -->
                                                     <small class="text-muted">
                                                         2m ago
                                                     </small>

                                                 </div>
                                             </div> <!-- / .row -->
                                         </div>
                                         <div class="list-group-item">
                                             <div class="row">
                                                 <div class="col-auto">

                                                     <!-- Avatar -->
                                                     <div class="avatar avatar-sm">
                                                     <img src="{{ asset('assets/img/160x160/img7.jpg') }}" alt="..."
                                                             class="avatar-img rounded-circle">
                                                     </div>

                                                 </div>
                                                 <div class="col ms-n2">

                                                     <!-- Content -->
                                                     <div class="small">
                                                         <strong>Miyah Myles</strong> shared your post with Ryu Duke,
                                                         Glen Rouse,
                                                         and 3 others.
                                                     </div>

                                                     <!-- Time -->
                                                     <small class="text-muted">
                                                         2m ago
                                                     </small>

                                                 </div>
                                             </div> <!-- / .row -->
                                         </div>
                                         <div class="list-group-item">
                                             <div class="row">
                                                 <div class="col-auto">

                                                     <!-- Avatar -->
                                                     <div class="avatar avatar-sm">
                                                     <img src="{{ asset('assets/img/160x160/img8.jpg') }}" alt="..."
                                                             class="avatar-img rounded-circle">
                                                     </div>

                                                 </div>
                                                 <div class="col ms-n2">

                                                     <!-- Content -->
                                                     <div class="small">
                                                         <strong>Ryu Duke</strong> reacted to your post with a 😍
                                                     </div>

                                                     <!-- Time -->
                                                     <small class="text-muted">
                                                         2m ago
                                                     </small>

                                                 </div>
                                             </div> <!-- / .row -->
                                         </div>
                                     </div>
                                 </div>
                             </div>

                             <div class="dropdown-divider"></div>

                         </div>
                     </div>
                     <!-- End Account -->
                 </li>
                 <li style="color: white; word-spacing: 3px"><b>{{ auth()->user()->salutation }}
                         {{ auth()->user()->name }}
                         @if (auth()->user()->employee)
                         ({{ auth()->user()->employee->ec_number }})
                         @endif
                     </b>
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
                                 @if (auth()->user()->image && file_exists(public_path('assets/profile/' .
                                 auth()->user()->image)))
                                 <img class="avatar-img" src="{{ asset('assets/profile/' . auth()->user()->image) }}"
                                     alt="Profile Image">
                                 @else
                                 <img class="avatar-img" src="{{ asset('assets/profile/profileImage.png') }}"
                                     alt="Default Icon">
                                 @endif
                                 <span class="avatar-status avatar-sm-status avatar-status-success"></span>
                             </div>
                         </a>

                         <div class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless navbar-dropdown-account"
                             aria-labelledby="accountNavbarDropdown" style="width: 16rem;">
                             <div class="dropdown-item-text">
                                 <div class="d-flex align-items-center">
                                     <div class="avatar avatar-sm avatar-circle">
                                         @if (auth()->user()->image && file_exists(public_path('assets/profile/' .
                                         auth()->user()->image)))
                                         <img class="avatar-img"
                                             src="{{ asset('assets/profile/' . auth()->user()->image) }}"
                                             alt="Profile Image">
                                         @else
                                         <img class="avatar-img" src="{{ asset('assets/profile/profileImage.png') }}"
                                             alt="Default Icon">
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