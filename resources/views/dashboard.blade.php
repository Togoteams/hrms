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
                    <div class="row  mt-5">
                        <div class="col-sm-6 col-lg-2 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow card-dashboard" href="{{ url('admin/personal-info/employee-details') }}">
                                <div class="card-body text-center">
                                    <h2 class="card-title text-white">Personal Information</h2>
                                    <h6 class="card-subtitle pt-3"><i class="fa-solid fa-blog"></i></h6>

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

                        <div class="col-sm-6 col-lg-2 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow card-dashboard" href="#">
                                <div class="card-body text-center">
                                    <h2 class="card-title text-white">Person Profile</h2>
                                    <h6 class="card-subtitle pt-3"><i class="fa-sharp fa-solid fa-user-tie"></i></h6>

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

                        <div class="col-sm-6 col-lg-2 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow card-dashboard" href="#">
                                <div class="card-body text-center">
                                    <div class="">
                                        <h2 class="card-title text-white">User Manual</h2>
                                    </div>
                                    <h6 class="card-subtitle pt-4"><i class="fa-solid fa-user-shield"></i></h6>

                                    <div class="row align-items-center gx-2">

                                        <!-- End Col -->
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>

                        <div class="col-sm-6 col-lg-2 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow card-dashboard " href="#">
                                <div class="card-body text-center">
                                    <div class="">
                                        <h2 class="card-title text-white">Reimbursement</h2>
                                    </div>
                                    <h6 class="card-subtitle pt-4"><i class="fa-solid fa-recycle"></i></h6>

                                    <div class="row align-items-center">

                                        <!-- End Col -->
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>

                        <div class="col-sm-6 col-lg-2 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow card-dashboard " href="#">
                                <div class="card-body text-center">
                                    <div class="">
                                        <h2 class="card-title text-white">Leave</h2>
                                    </div>
                                    <h6 class="card-subtitle pt-4"><i class="fa-solid fa-user-clock"></i></h6>

                                    <div class="row align-items-center gx-2">

                                        <!-- End Col -->
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>
                        <div class="col-sm-6 col-lg-2 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow card-dashboard " href="#">
                                <div class="card-body text-center">
                                    <div class="">
                                        <h2 class="card-title text-white">Payroll</h2>
                                    </div>
                                    <h6 class="card-subtitle pt-4"><i class="fa-solid fa-money-bill"></i></h6>

                                    <div class="row align-items-center gx-2">

                                        <!-- End Col -->
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>

                        <div class="col-sm-6 col-lg-2 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow card-dashboard " href="#">
                                <div class="card-body text-center">
                                    <div class="">
                                        <h2 class="card-title text-white">Upload Photo</h2>
                                    </div>
                                    <h6 class="card-subtitle pt-4"><i class="fa-solid fa-image"></i></h6>

                                    <div class="row align-items-center gx-2">

                                        <!-- End Col -->
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>

                        <div class="col-sm-6 col-lg-2 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow card-dashboard " href="#">
                                <div class="card-body text-center">
                                    <div class="">
                                        <h2 class="card-title text-white">Asset and Liability</h2>
                                    </div>
                                    <h6 class="card-subtitle pt-4"><i class="fa-solid fa-scale-balanced"></i></h6>

                                    <div class="row align-items-center gx-2">

                                        <!-- End Col -->
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>

                        <div class="col-sm-6 col-lg-2 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow card-dashboard " href="#">
                                <div class="card-body text-center">
                                    <div class="">
                                        <h2 class="card-title text-white">Reports</h2>
                                    </div>
                                    <h6 class="card-subtitle pt-4"><i class="fa-solid fa-file-invoice"></i></h6>

                                    <div class="row align-items-center gx-2">

                                        <!-- End Col -->
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>

                        <div class="col-sm-6 col-lg-2 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow card-dashboard " href="#">
                                <div class="card-body text-center">
                                    <div class="">
                                        <h2 class="card-title text-white">Baroda Samadhan</h2>
                                    </div>
                                    <h6 class="card-subtitle pt-4"><i class="fa-solid fa-house-user"></i></h6>

                                    <div class="row align-items-center gx-2">

                                        <!-- End Col -->
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>

                        <div class="col-sm-6 col-lg-2 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow card-dashboard " href="#">
                                <div class="card-body text-center">
                                    <div class="">
                                        <h2 class="card-title text-white">Baroda GEMS</h2>
                                    </div>
                                    <h6 class="card-subtitle pt-4"><i class="fa-solid fa-leaf"></i></h6>

                                    <div class="row align-items-center gx-2">

                                        <!-- End Col -->
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>

                        <div class="col-sm-6 col-lg-2 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow card-dashboard " href="#">
                                <div class="card-body text-center">
                                    <div class="">
                                        <h2 class="card-title text-white">Holiday Homes</h2>
                                    </div>
                                    <h6 class="card-subtitle pt-4"><i class="fa-solid fa-house-laptop"></i></h6>

                                    <div class="row align-items-center gx-2">

                                        <!-- End Col -->
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>

                        <div class="col-sm-6 col-lg-2 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow card-dashboard " href="#">
                                <div class="card-body text-center">
                                    <div class="">
                                        <h2 class="card-title text-white">Hr Claims</h2>
                                    </div>
                                    <h6 class="card-subtitle pt-4"><i class="fa-solid fa-suitcase"></i></h6>

                                    <div class="row align-items-center gx-2">

                                        <!-- End Col -->
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>

                        <div class="col-sm-6 col-lg-2 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow card-dashboard " href="#">
                                <div class="card-body text-center">
                                    <div class="">
                                        <h2 class="card-title text-white">Profile Approvel History</h2>
                                    </div>
                                    <h6 class="card-subtitle pt-4"><i class="fa-solid fa-user-check"></i></h6>

                                    <div class="row align-items-center gx-2">

                                        <!-- End Col -->
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>

                        <div class="col-sm-6 col-lg-2 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow card-dashboard " href="#">
                                <div class="card-body text-center">
                                    <div class="">
                                        <h2 class="card-title text-white">Self Service Applications</h2>
                                    </div>
                                    <h6 class="card-subtitle pt-4"><i class="fa-solid fa-bullhorn"></i></h6>

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
