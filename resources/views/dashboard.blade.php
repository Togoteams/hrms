@extends('layouts.app')
@push('styles')
@endpush
@section('content')
    <main id="content" role="main" class="main">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h1 class="page-header-title">Dashboard</h1>
                    </div>
                    <!-- End Col -->
            <!-- End Page Header -->

            <!-- Stats -->
            <div class="row  mt-5">
                <div class="col-sm-6 col-lg-4 mb-3 mb-lg-5">
                    <!-- Card -->
                    <a class="card card-hover-shadow card-dashboard pb-5" href="#">
                        <div class="card-body text-center">
                            <h6 class="card-subtitle pb-2"><i class="fa-solid fa-blog"></i></h6>

                            <div class="row align-items-center gx-2">
                                <div class="">
                                    <h2 class="card-title text-white">Personal Information</h2>
                                </div>
                                <!-- End Col -->
                                <!-- End Col -->
                            </div>
                            <!-- End Row -->
                        </div>
                    </a>
                    <!-- End Card -->
                </div>

                <div class="col-sm-6 col-lg-4 mb-3 mb-lg-5">
                    <!-- Card -->
                    <a class="card card-hover-shadow card-dashboard pb-5" href="#">
                        <div class="card-body text-center">
                            <h6 class="card-subtitle pb-2"><i class="fa-sharp fa-solid fa-user-tie"></i></h6>

                            <div class="row align-items-center gx-2">
                                <div class="">
                                    <h2 class="card-title text-white">Person Information</h2>
                                </div>
                                <!-- End Col -->
                                <!-- End Col -->
                            </div>
                            <!-- End Row -->
                        </div>
                    </a>
                    <!-- End Card -->
                </div>

                <div class="col-sm-6 col-lg-4 mb-3 mb-lg-5">
                    <!-- Card -->
                    <a class="card card-hover-shadow card-dashboard pb-5" href="#">
                        <div class="card-body text-center">
                            <h6 class="card-subtitle pb-2"><i class="fa-solid fa-user-shield"></i></h6>

                            <div class="row align-items-center gx-2">
                                <div class="">
                                    <h2 class="card-title text-white">HR Admin</h2>
                                </div>
                                <!-- End Col -->
                                <!-- End Col -->
                            </div>
                            <!-- End Row -->
                        </div>
                    </a>
                    <!-- End Card -->
                </div>

                <div class="col-sm-6 col-lg-4 mb-3 mb-lg-5">
                    <!-- Card -->
                    <a class="card card-hover-shadow card-dashboard pb-5" href="#">
                        <div class="card-body text-center">
                            <h6 class="card-subtitle pb-2"><i class="fa-solid fa-virus"></i></h6>

                            <div class="row align-items-center gx-2">
                                <div class="">
                                    <h2 class="card-title text-white">Leave Module</h2>
                                </div>
                                <!-- End Col -->
                                <!-- End Col -->
                            </div>
                            <!-- End Row -->
                        </div>
                    </a>
                    <!-- End Card -->
                </div>

                <div class="col-sm-6 col-lg-4 mb-3 mb-lg-5">
                    <!-- Card -->
                    <a class="card card-hover-shadow card-dashboard pb-5" href="#">
                        <div class="card-body text-center">
                            <h6 class="card-subtitle pb-2"><i class="fa-sharp fa-solid fa-money-bill"></i></h6>

                            <div class="row align-items-center gx-2">
                                <div class="">
                                    <h2 class="card-title text-white">Payroll Report</h2>
                                </div>
                                <!-- End Col -->
                                <!-- End Col -->
                            </div>
                            <!-- End Row -->
                        </div>
                    </a>
                    <!-- End Card -->
                </div>

                <div class="col-sm-6 col-lg-4 mb-3 mb-lg-5">
                    <!-- Card -->
                    <a class="card card-hover-shadow card-dashboard pb-5" href="#">
                        <div class="card-body text-center">
                            <h6 class="card-subtitle pb-2"><i class="fa-solid fa-file"></i></h6>

                            <div class="row align-items-center gx-2">
                                <div class="">
                                    <h2 class="card-title text-white">Other report/Regulatory report</h2>
                                </div>
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
