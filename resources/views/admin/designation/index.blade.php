@extends('layouts.app')
@push('styles')
@endpush
@section('content')
    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class=" border-bottom mt-2 mb-2">
                <div class="row align-items-center">
                    <div class="col">
                        <h1 class="page-header-title">{{ $page }}</h1>
                    </div>
                    <!-- End Col -->

                    <div class="col-auto">
                        <a class="text-link">
                            Home
                        </a>/ {{ $page }}
                    </div>
                    <!-- End Col -->
                </div>
                <!-- Button trigger modal -->

                <!-- End Row -->
            </div>
            <div class="row">
                <div class="col-sm-9"></div>
                <div class="col-sm-3">
                    <div class="mb-2 col-auto">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">
                            Add {{ $page }}
                        </button>
                    </div>
                </div>
            </div>
            @include('admin.designation.create')


            <!-- Card -->
            <div class="card mb-3 mb-lg-5">
        

                <!-- Table -->
                <div class="table-responsive datatable-custom">
                    <table id="datatable"
                        class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="table-column-pe-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="datatableCheckAll">
                                        <label class="form-check-label" for="datatableCheckAll"></label>
                                    </div>
                                </th>
                                <th class="table-column-ps-0">Full name</th>
                                <th>Status</th>
                                <th>Type</th>
                                <th>Email</th>
                                <th>Signed up</th>
                                <th>User ID</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td class="table-column-pe-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="usersDataCheck2">
                                        <label class="form-check-label" for="usersDataCheck2"></label>
                                    </div>
                                </td>
                                <td class="table-column-ps-0">
                                    <a class="d-flex align-items-center" href="user-profile.html">
                                        <div class="flex-shrink-0">
                                            <div class="avatar avatar-sm avatar-circle">
                                                <img class="avatar-img" src="{{ asset('assets/img/160x160/img10.jpg') }}"
                                                    alt="Image Description">
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h5 class="text-inherit mb-0">Amanda Harvey <i
                                                    class="bi-patch-check-fill text-primary" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Top endorsed"></i></h5>
                                        </div>
                                    </a>
                                </td>
                                <td>
                                    <span class="legend-indicator bg-success"></span>Successful
                                </td>
                                <td>Unassigned</td>
                                <td>amanda@site.com</td>
                                <td>1 year ago</td>
                                <td>67989</td>
                            </tr>




                        </tbody>
                    </table>
                </div>
                <!-- End Table -->


            </div>
            <!-- End Card -->


        </div>

    </main>
@endsection
