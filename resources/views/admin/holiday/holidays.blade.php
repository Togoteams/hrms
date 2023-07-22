@extends('layouts.app')
@push('styles')
@endpush
@section('content')
    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-end">
                    <div class="col-sm mb-2 mb-sm-0">

                        <h1 class="page-header-title">Holidays</h1>
                    </div>
                    <!-- End Col -->

                    <div class="col-sm-auto">
                        @can('add-holidays')
                            <a class="btn btn-white g-popup" href="javascript:;" data-bs-toggle="modal" data-action="add"
                                data-bs-target="#addEditHolidayModal">
                                <i class="bi-person-plus-fill me-1"></i> Add Holiday
                            </a>
                        @endcan

                    </div>
                    <!-- End Col -->
                </div>
                <!-- End Row -->
            </div>
            <!-- End Page Header -->

            <!-- Card -->
            <div class="card">
                <!-- Header -->
                <div class="card-header card-header-content-md-between">
                    <div class="mb-2 mb-md-0">
                        <form>
                            <!-- Search -->
                            <div class="input-group input-group-merge input-group-flush">
                                <div class="input-group-prepend input-group-text">
                                    <i class="bi-search"></i>
                                </div>
                                <input id="datatableSearch" type="search" class="form-control"
                                    placeholder="Search Holidays" aria-label="Search Holidays">
                            </div>
                            <!-- End Search -->
                        </form>
                    </div>

                    <div class="d-grid d-sm-flex justify-content-md-end align-items-sm-center gap-2">
                        <!-- Datatable Info -->
                        <div id="datatableCounterInfo" style="display: none;">
                            <div class="d-flex align-items-center">
                                <span class="fs-5 me-3">
                                    <span id="datatableCounter">0</span>
                                    Selected
                                </span>
                                <a class="btn btn-outline-danger btn-sm" href="javascript:;">
                                    <i class="bi-trash"></i> Delete
                                </a>
                            </div>
                        </div>
                        <!-- End Datatable Info -->


                    </div>
                </div>
                <!-- End Header -->

                <!-- Table -->
                <div class="table-responsive datatable-custom position-relative">
                    <table id="datatable"
                        class="table table-lg table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                        data-hs-datatables-options='{
                            "columnDefs": [{
                                "targets": [0, 7],
                                "orderable": false
                                }],
                            "order": [],
                            "info": {
                                "totalQty": "#datatableWithPaginationInfoTotalQty"
                            },
                            "search": "#datatableSearch",
                            "entries": "#datatableEntries",
                            "pageLength": 15,
                            "isResponsive": false,
                            "isShowPaging": false,
                            "pagination": "datatablePagination"
                        }'>
                        <thead class="thead-light">
                            <tr>
                                <th class="table-column-pe-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="datatableCheckAll">
                                        <label class="form-check-label" for="datatableCheckAll"></label>
                                    </div>
                                </th>
                                <th class="table-column-ps-0">Name</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($holidays as $key => $holiday)
                                <tr>
                                    <td class="table-column-pe-0">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="datatableCheckAll1">
                                            <label class="form-check-label" for="datatableCheckAll1"></label>
                                        </div>
                                    </td>
                                    <td class="table-column-ps-0">
                                        <span class="d-block h5 mb-0">{{ $holiday->name }}</span>
                                        <!-- <span class="d-block fs-5">Human resources</span> -->
                                    </td>
                                    <td>
                                        <span class="d-block h5 mb-0">{{ $holiday->date }}</span>
                                    </td>
                                    <td> {{ $holiday->description }}</td>
                                    <td>
                                        <div class="success-badges"><span class="legend-indicator bg-success"></span>{{ $holiday->status ?? 'Active' }}</div>
                                    </td>

                                    <td>
                                        @can('edit-holidays')
                                            <button type="button" data-table="holidays" data-form-modal="addEditHolidayModal"
                                                data-message="inactive" data-uuid="{{ $holiday->uuid }}"
                                                class="btn btn-warning btn-sm editData">
                                                <i class="fas fa-edit" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Edit"></i>
                                            </button>
                                        @endcan
                                        @can('delete-holidays')
                                            <button type="button" data-table="holidays" data-message="inactive"
                                                data-uuid="{{ $holiday->uuid }}" class="btn btn-danger btn-sm deleteData">
                                                <i class="fas fa-trash-alt" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Delete"></i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- End Table -->

                <!-- Footer -->
                <div class="card-footer">
                    <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                        <div class="col-sm mb-2 mb-sm-0">
                            <div class="d-flex justify-content-center justify-content-sm-start align-items-center">
                                <span class="me-2">Showing:</span>

                                <!-- Select -->
                                <div class="tom-select-custom">
                                    <select id="datatableEntries"
                                        class="js-select form-select form-select-borderless w-auto" autocomplete="off"
                                        data-hs-tom-select-options='{
                            "searchInDropdown": false,
                            "hideSearch": true
                          }'>
                                        <option value="10">10</option>
                                        <option value="15" selected>15</option>
                                        <option value="20">20</option>
                                    </select>
                                </div>
                                <!-- End Select -->

                                <span class="text-secondary me-2">of</span>

                                <!-- Pagination Quantity -->
                                <span id="datatableWithPaginationInfoTotalQty"></span>
                            </div>
                        </div>
                        <!-- End Col -->

                        <div class="col-sm-auto">
                            <div class="d-flex justify-content-center justify-content-sm-end">
                                <!-- Pagination -->
                                <nav id="datatablePagination" aria-label="Activity pagination"></nav>
                            </div>
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Row -->
                </div>
                <!-- End Footer -->
            </div>
            <!-- End Card -->
        </div>
        <!-- End Content -->

    </main>
    <!-- Add - edit modal -->

    <div class="modal fade" id="addEditHolidayModal" tabindex="-1" aria-labelledby="addEditHolidayModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEditHolidayModalLabel">Holiday:<span class="action_name">add</span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Body -->
                <div class="modal-body">
                    <!-- Nav Scroller -->
                    <form method="post" action="{{ route('admin.holiday.add') }}" class="formsubmit">
                        @csrf
                        <!-- Form -->
                        <div class="row mb-4">
                            <label for="name" class="col-sm-3 col-form-label form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="hidden" class="form-control" name="holiday_id" id="holiday_id">
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Name" aria-label="name">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="name" class="col-sm-3 col-form-label form-label">Date</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" rows="4" cols="50" name="date"
                                    id="date" placeholder="Date" aria-label="Date">
                            </div>
                        </div>
                        <!-- End Form -->
                        <div class="row mb-4">
                            <label for="description" class="col-sm-3 col-form-label form-label">Is Paid</label>
                            <div class="col-sm-9">
                                <select class="js-select form-select" autocomplete="off" name="is_optional"
                                    id="is_optional"
                                    data-hs-tom-select-options='{
                                  "searchInDropdown": false,
                                  "hideSearch": true
                                }'>
                                    <option value="1" selected>Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <!-- Form -->
                        <div class="row mb-4">
                            <label for="description" class="col-sm-3 col-form-label form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea type="text" class="form-control" rows="4" cols="50" name="description" id="description"
                                    placeholder="Holiday Description" aria-label="Description"></textarea>
                            </div>
                        </div>


                        <!-- End Form -->

                        <div class="d-flex justify-content-end">
                            <div class="d-flex gap-3">
                                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"
                                    aria-label="Close">Cancel</button>
                                <button type="submit" class="btn btn-white">Save changes</button>
                            </div>
                        </div>
                    </form>
                    <!-- End Nav Scroller -->
                </div>
                <!-- End Body -->
            </div>
        </div>
    </div>
@endsection
@push('custom-scripts')
    <script type="text/javascript" src="{{ URL::asset('js/admin/Holiday.js') }}"></script>
@endpush
