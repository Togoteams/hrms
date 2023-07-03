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
                    <div class="mt-5 row">
                        <div class="mb-3 col-sm-6 col-lg-2 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow card-dashboard"
                                href="{{ url('admin/personal-info/employee-details') }}">
                                <div class="text-center card-body">
                                    <h2 class="text-white card-title">Personal Information</h2>
                                    <h6 class="pt-3 card-subtitle"><i class="fa-solid fa-blog"></i></h6>

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

                        <div class="mb-3 col-sm-6 col-lg-2 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow card-dashboard"
                                href="{{ url('admin/person-profile/qualifications') }}">
                                <div class="text-center card-body">
                                    <h2 class="text-white card-title">Person Profile</h2>
                                    <h6 class="pt-3 card-subtitle"><i class="fa-sharp fa-solid fa-user-tie"></i></h6>

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

                        <div class="mb-3 col-sm-6 col-lg-2 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow card-dashboard"
                                href="{{ route('admin.userManualDownload', ['filename' => 'user_manual.pdf']) }}">
                                <div class="text-center card-body">
                                    <div class="">
                                        <h2 class="text-white card-title">User Manual</h2>
                                    </div>
                                    <h6 class="pt-4 card-subtitle"><i class="fa-solid fa-user-shield"></i></h6>

                                    <div class="row align-items-center gx-2">

                                        <!-- End Col -->
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>

                        <div class="mb-3 col-sm-6 col-lg-2 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow card-dashboard " href="{{ url('/admin/leave_apply') }}">
                                <div class="text-center card-body">
                                    <div class="">
                                        <h2 class="text-white card-title">Leave</h2>
                                    </div>
                                    <h6 class="pt-4 card-subtitle"><i class="fa-solid fa-user-clock"></i></h6>

                                    <div class="row align-items-center gx-2">

                                        <!-- End Col -->
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>
                        <div class="mb-3 col-sm-6 col-lg-2 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow card-dashboard "
                                href="{{ route('admin.payroll.pay-scale.list') }}">
                                <div class="text-center card-body">
                                    <div class="">
                                        <h2 class="text-white card-title">Payroll</h2>
                                    </div>
                                    <h6 class="pt-4 card-subtitle"><i class="fa-solid fa-money-bill"></i></h6>

                                    <div class="row align-items-center gx-2">

                                        <!-- End Col -->
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>

                        <div class="mb-3 col-sm-6 col-lg-2 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow card-dashboard " href="{{route('admin.profile')}}">
                                <div class="text-center card-body">
                                    <div class="">
                                        <h2 class="text-white card-title">Upload Photo</h2>
                                    </div>
                                    <h6 class="pt-4 card-subtitle"><i class="fa-solid fa-image"></i></h6>

                                    <div class="row align-items-center gx-2">

                                        <!-- End Col -->
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>

                        {{-- <div class="mb-3 col-sm-6 col-lg-2 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow card-dashboard " href="#">
                                <div class="text-center card-body">
                                    <div class="">
                                        <h2 class="text-white card-title">Asset and Liability</h2>
                                    </div>
                                    <h6 class="pt-4 card-subtitle"><i class="fa-solid fa-scale-balanced"></i></h6>

                                    <div class="row align-items-center gx-2">

                                        <!-- End Col -->
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div> --}}

                        <div class="mb-3 col-sm-6 col-lg-2 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow card-dashboard " href="#">
                                <div class="text-center card-body">
                                    <div class="">
                                        <h2 class="text-white card-title">Reports</h2>
                                    </div>
                                    <h6 class="pt-4 card-subtitle"><i class="fa-solid fa-file-invoice"></i></h6>

                                    <div class="row align-items-center gx-2">

                                        <!-- End Col -->
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>

                        <div class="mb-3 col-sm-6 col-lg-2 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow card-dashboard " href="#">
                                <div class="text-center card-body">
                                    <div class="">
                                        <h2 class="text-white card-title">Profile Approvel </h2>
                                    </div>
                                    <h6 class="pt-4 card-subtitle"><i class="fa-solid fa-user-check"></i></h6>

                                    <div class="row align-items-center gx-2">

                                        <!-- End Col -->
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>


                    </div>
                    <!-- End Stats -->
                </div>
    </main>
@endsection
