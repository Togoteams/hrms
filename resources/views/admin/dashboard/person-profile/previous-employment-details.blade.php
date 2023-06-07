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
                    <span class="name-title">Person Profile</span>
                    <div class="mt-5">
                        <div class="row d-flex align-items-start">
                            <div class="col-xxl-2 col-xl-3  border border-1 border-color rounded py-4">
                                @include('admin.dashboard.person-profile.aside')
                                <div class="tab-pane fade ms-5 show active">
                                </div>
                            </div>
                            <div class="col-xl-8 col-xxl-9 border border-1 border-color rounded mx-3">

                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="row py-3">
                                        <div class="text-right">
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#formModal" title="Add ">
                                                Add
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-6 col-xxl-4 pb-4">
                                            <div class="card p-3">
                                                <div class="row">
                                                    <div class="col-10">
                                                        <div class="row">
                                                            <div class="col-6">Field:</div>
                                                            <div class="col-6">Field Data</div>

                                                            <div class="col-6">Field:</div>
                                                            <div class="col-6">Field Data</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-1 text-end">
                                                        <div class="right-div">
                                                            <!-- Your content for right div goes here -->

                                                            <button class="btn btn-warning btn-sm bt" data-bs-toggle="modal"
                                                                title="Edit">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- End Stats -->
                </div>

    </main>
@endsection
@push('custom-scripts')
@endpush
