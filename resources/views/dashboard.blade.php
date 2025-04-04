@extends('layouts.app')
@push('styles')
@endpush
@section('content')
    <main id="content" role="main" class="main">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">

                    <!-- End Col -->
                    <!-- End Page Header -->

                    <!-- Stats -->
                    <div class="row card-sec-das">
                        {{-- <div class="mb-3 col-sm-6 col-lg-2">
                            <!-- Card -->
                            <a class="card card-hover-shadow card-dashboard card-bg " href="{{route('admin.profile')}}">
                                <div class="text-center ">
                                    <div class="card-subtitle">
                                    @if ($data->image && file_exists(public_path('assets/profile/' . $data->image)))
                                        <img class="dashboard-icon" src="{{ asset('assets/profile/' . $data->image) }}" alt="Profile Image" style="height: 130px; width: 130px;border-radius: 50%;">
                                    @else
                                        <img class="dashboard-icon" src="{{ asset('assets/profile/profileImage.png') }}" alt="Default Icon" style="height:130px; width: 130px;border-radius: 50%;">
                                    @endif
                                    </div>
                                    <h2 class="text-white card-title">Profile</h2>


                                    <div class="row align-items-center gx-2">

                                     
                                    </div>
                                </div>
                                <img class="card-overlay-bg img-fluid" src="{{ asset('assets/img/card-bg-img.png') }}" alt="">
                            </a>
                        </div> --}}
                        @if(isemplooye())
                        <div class="mb-3 col-sm-6 col-lg-2">
                            <!-- Card -->
                            <a class="card card-hover-shadow card-dashboard card-bg"
                                href="{{ url('admin/personal-info/employee-details')}}">
                                <div class="text-center card-body">
                                    <div class="card-subtitle">
                                    <img class="dashboard-icon" src="{{ asset('assets/profile/profileImage.png') }}" alt="">
                                    </div>
                                    <h2 class="text-white card-title">Personal Information</h2>

                                    <div class="row align-items-center gx-2">
                                        <div class="">

                                        </div>
                                        <!-- End Col -->
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->
                                </div>
                                <img class="card-overlay-bg img-fluid" src="{{ asset('assets/img/card-bg-img.png') }}" alt="">
                            </a>
                            <!-- End Card -->
                        </div>
                        @endif
                        @if(isemplooye())
                        <div class="mb-3 col-sm-6 col-lg-2">
                            <!-- Card -->
                            <a class="card card-hover-shadow card-dashboard card-bg"
                                href="{{ url('admin/person-profile/qualifications') }}">
                                <div class="text-center card-body">
                                    <h6 class="card-subtitle">
                                    <img class="dashboard-icon" src="{{ asset('assets/img/dashboard/icon2.png') }}" alt="">
                                    </h6>
                                    <h2 class="text-white card-title">Personal Profile</h2>


                                    <div class="row align-items-center gx-2">
                                        <div class="">

                                        </div>
                                        <!-- End Col -->
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->
                                </div>
                                <img class="card-overlay-bg img-fluid" src="{{ asset('assets/img/card-bg-img.png') }}" alt="">
                            </a>
                            <!-- End Card -->
                        </div>
                        @endif
                        {{-- @if(isemplooye())
                        <div class="mb-3 col-sm-6 col-lg-2">
                            <a class="card card-hover-shadow card-dashboard card-bg"
                                href="{{ route('admin.userManualDownload', ['filename' => 'user_manual.pdf']) }}">
                                <div class="text-center card-body">
                                    <h6 class="card-subtitle">
                                    <img class="dashboard-icon" src="{{ asset('assets/img/dashboard/icon3.png') }}" alt="">

                                    </h6>
                                    <h2 class="text-white card-title">User Manual</h2>


                                    <div class="row align-items-center gx-2">


                                    </div>
                                </div>
                            </a>
                        </div>
                        @endif --}}


                        <div class="mb-3 col-sm-6 col-lg-2">
                            <!-- Card -->
                            <a class="card card-hover-shadow card-dashboard card-bg " href="{{ url('/admin/leave_apply') }}">
                                <div class="text-center card-body">
                                    <h6 class="card-subtitle">
                                    <img class="dashboard-icon" src="{{ asset('assets/img/dashboard/leav.png') }}" alt="">

                                    </h6>
                                    <h2 class="text-white card-title">Leave</h2>


                                    <div class="row align-items-center gx-2">

                                        <!-- End Col -->
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->
                                </div>
                                <img class="card-overlay-bg img-fluid" src="{{ asset('assets/img/card-bg-img.png') }}" alt="">
                            </a>
                            <!-- End Card -->
                        </div>
                        <div class="mb-3 col-sm-6 col-lg-2">
                            <!-- Card -->
                            <a class="card card-hover-shadow card-dashboard card-bg "
                                href="{{ route('admin.payroll.salary.index') }}">
                                <div class="text-center card-body">
                                    <h6 class="card-subtitle">
                                    <img class="dashboard-icon" src="{{ asset('assets/img/dashboard/pay.png') }}" alt="">

                                    </h6>
                                    <h2 class="text-white card-title">Payroll</h2>


                                    <div class="row align-items-center gx-2">

                                        <!-- End Col -->
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->
                                </div>
                                <img class="card-overlay-bg img-fluid" src="{{ asset('assets/img/card-bg-img.png') }}" alt="">
                            </a>
                            <!-- End Card -->
                        </div>



                        {{-- <div class="mb-3 col-sm-6 col-lg-2">
                            <!-- Card -->
                            <a class="card card-hover-shadow card-dashboard card-bg">
                                <div class="text-center card-body">
                                    <h6 class="card-subtitle">
                                    <img class="dashboard-icon" src="{{ asset('assets/img/dashboard/icon7.png') }}" alt="">

                                    </h6>
                                    <h2 class="text-white card-title">Asset and Liability</h2>


                                    <div class="row align-items-center gx-2">

                                        <!-- End Col -->
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div> --}}

                        @if(!isemplooye())
                        <div class="mb-3 col-sm-6 col-lg-2">
                            <a class="card card-hover-shadow card-dashboard card-bg " href="{{route('admin.payroll.reports.ttum.list')}}">
                                <div class="text-center card-body">
                                    <h6 class="card-subtitle">
                                    <img class="dashboard-icon" src="{{ asset('assets/img/dashboard/repo.png') }}" alt="">

                                    </h6>
                                    <h2 class="text-white card-title">Reports</h2>


                                    <div class="row align-items-center gx-2">


                                    </div>

                                </div>
                                <img class="card-overlay-bg img-fluid" src="{{ asset('assets/img/card-bg-img.png') }}" alt="">
                            </a>

                        </div>
                        @endif

                        @if(!isemplooye())
                        {{-- <div class="mb-3 col-sm-6 col-lg-2">
                            <a class="card card-hover-shadow card-dashboard card-bg " href="#">
                                <div class="text-center card-body">
                                    <h6 class="card-subtitle">
                                    <img class="dashboard-icon" src="{{ asset('assets/img/dashboard/icon8.png') }}" alt="">

                                    </h6>
                                    <h2 class="text-white card-title">Profile Approvel </h2>


                                    <div class="row align-items-center gx-2">

                                    </div>
                                </div>
                            </a>
                        </div> --}}
                        @endif



                    </div>
                    <!-- End Stats -->
                </div>
    </main>
@endsection
