@extends('layouts.app')
@push('styles')
@endpush
@section('content')
    <main id="content" role="main" class="main">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">

                    <!-- End Col -->
                    <!-- End Page Header -->

                    <!-- Stats -->
                    <div class="row">
                        <div class="mb-3 col-sm-6 col-lg-2">
                            <!-- Card -->
                            <a class="card card-hover-shadow card-dashboard card-bg " href="{{route('admin.profile')}}">
                                <div class="text-center card-body">
                                    <h6 class="card-subtitle">
                                    {{-- <img class="dashboard-icon" src="{{ asset('assets/img/dashboard/icon6.png') }}" alt=""> --}}
                                    @if ($data->image && file_exists(public_path('assets/profile/' . $data->image)))
                                        <img class="dashboard-icon" src="{{ asset('assets/profile/' . $data->image) }}" alt="Profile Image" style="height: 56px; width: 70px;">
                                    @else
                                        <img class="dashboard-icon" src="{{ asset('assets/img/dashboard/icon6.png') }}" alt="Default Icon" style="height: 56px; width: 70px;">
                                    @endif
                                    </h6>
                                    <h2 class="text-white card-title">Profile</h2>


                                    <div class="row align-items-center gx-2">

                                        <!-- End Col -->
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>
                        @if(isemplooye())
                        <div class="mb-3 col-sm-6 col-lg-2">
                            <!-- Card -->
                            <a class="card card-hover-shadow card-dashboard card-bg"
                                href="{{ url('admin/personal-info/employee-details')}}">
                                <div class="text-center card-body">
                                    <h6 class="card-subtitle">
                                    <img class="dashboard-icon" src="{{ asset('assets/img/dashboard/icon1.png') }}" alt="">
                                    </h6>
                                    <h2 class="text-white card-title">Personal Information</h2>

                                    <div class="row align-items-center gx-2">
                                        <div class="">

                                        </div>
                                        <!-- End Col -->
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->
                                </div>
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
                                    <img class="dashboard-icon" src="{{ asset('assets/img/dashboard/icon4.png') }}" alt="">

                                    </h6>
                                    <h2 class="text-white card-title">Leave</h2>


                                    <div class="row align-items-center gx-2">

                                        <!-- End Col -->
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>
                        <div class="mb-3 col-sm-6 col-lg-2">
                            <!-- Card -->
                            <a class="card card-hover-shadow card-dashboard card-bg "
                                href="{{ route('admin.payroll.salary.index') }}">
                                <div class="text-center card-body">
                                    <h6 class="card-subtitle">
                                    <img class="dashboard-icon" src="{{ asset('assets/img/dashboard/icon5.png') }}" alt="">

                                    </h6>
                                    <h2 class="text-white card-title">Payroll</h2>


                                    <div class="row align-items-center gx-2">

                                        <!-- End Col -->
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->
                                </div>
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
                                    <img class="dashboard-icon" src="{{ asset('assets/img/dashboard/icon7.png') }}" alt="">

                                    </h6>
                                    <h2 class="text-white card-title">Reports</h2>


                                    <div class="row align-items-center gx-2">

                                       
                                    </div>
                                   
                                </div>
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
