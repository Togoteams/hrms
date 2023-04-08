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
            @include('admin.employees.create')


            <!-- Card -->
            <div class="card mb-3 mb-lg-5">
                <!-- Header -->
                <div class="card-header">
                    <div class="row justify-content-between align-items-center flex-grow-1">
                        <div class="col-md">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="card-header-title">Users</h4>

                                <!-- Datatable Info -->
                                <div id="datatableCounterInfo" style="display: none;">
                                    <div class="d-flex align-items-center">
                                        <span class="fs-6 me-3">
                                            <span id="datatableCounter">0</span>
                                            Selected
                                        </span>
                                        <a class="btn btn-outline-danger btn-sm" href="javascript:;">
                                            <i class="tio-delete-outlined"></i> Delete
                                        </a>
                                    </div>
                                </div>
                                <!-- End Datatable Info -->
                            </div>
                        </div>
                        <!-- End Col -->

                        <div class="col-auto">
                            <!-- Filter -->
                            <div class="row align-items-sm-center">
                                <div class="col-sm-auto">
                                    <div class="row align-items-center gx-0">
                                        <div class="col">
                                            <span class="text-secondary me-2">Status:</span>
                                        </div>
                                        <!-- End Col -->

                                        <div class="col-auto">
                                            <!-- Select -->
                                            <div class="tom-select-custom tom-select-custom-end">
                                                <select
                                                    class="js-select js-datatable-filter form-select form-select-sm form-select-borderless"
                                                    data-target-column-index="2" data-target-table="datatable"
                                                    autocomplete="off"
                                                    data-hs-tom-select-options='{
                                  "searchInDropdown": false,
                                  "hideSearch": true,
                                  "dropdownWidth": "10rem"
                                }'>
                                                    <option value="null" selected>All</option>
                                                    <option value="successful">Successful</option>
                                                    <option value="overdue">Overdue</option>
                                                    <option value="pending">Pending</option>
                                                </select>
                                            </div>
                                            <!-- End Select -->
                                        </div>
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->
                                </div>
                                <!-- End Col -->

                                <div class="col-sm-auto">
                                    <div class="row align-items-center gx-0">
                                        <div class="col">
                                            <span class="text-secondary me-2">Signed up:</span>
                                        </div>
                                        <!-- End Col -->

                                        <div class="col-auto">
                                            <!-- Select -->
                                            <div class="tom-select-custom tom-select-custom-end">
                                                <select
                                                    class="js-select js-datatable-filter form-select form-select-sm form-select-borderless"
                                                    data-target-column-index="5" data-target-table="datatable"
                                                    autocomplete="off"
                                                    data-hs-tom-select-options='{
                                  "searchInDropdown": false,
                                  "hideSearch": true,
                                  "dropdownWidth": "10rem"
                                }'>
                                                    <option value="null" selected>All</option>
                                                    <option value="1 year ago">1 year ago</option>
                                                    <option value="6 months ago">6 months ago</option>
                                                </select>
                                            </div>
                                            <!-- End Select -->
                                        </div>
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->
                                </div>
                                <!-- End Col -->

                                <div class="col-md">
                                    <form>
                                        <!-- Search -->
                                        <div class="input-group input-group-merge input-group-flush">
                                            <div class="input-group-prepend input-group-text">
                                                <i class="bi-search"></i>
                                            </div>
                                            <input id="datatableSearch" type="search" class="form-control"
                                                placeholder="Search users" aria-label="Search users">
                                        </div>
                                        <!-- End Search -->
                                    </form>
                                </div>
                                <!-- End Col -->
                            </div>
                            <!-- End Filter -->
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Row -->
                </div>
                <!-- End Header -->

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
