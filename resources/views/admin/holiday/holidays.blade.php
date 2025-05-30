@extends('layouts.app')
@push('styles')
@endpush
@section('content')
    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="container-fluid">
            <!-- Card -->
            <div class="card">
            <div class="page-header">
                <div class="row">
                    <div class="mb-2 col-sm mb-sm-0">
                        <h2 class="page-header-title">Holidays</h2>
                    </div>
                    <div class="col-sm-auto">
                    @can('add-holidays')
                            <a class="btn btn-white g-popup" href="javascript:;" data-bs-toggle="modal" data-action="add"
                                data-bs-target="#addEditHolidayModal">
                                <i class="bi-person-plus-fill me-1"></i> Add Holiday
                            </a>
                        @endcan
                    </div>
                </div>
            </div>
                <!-- Header -->
                <div class="card-header card-header-content-md-between">
                    <!-- <div class="mb-2 mb-md-0">
                        <form>
                            <div class="input-group input-group-merge input-group-flush">
                                <div class="input-group-prepend input-group-text">
                                    <i class="bi-search"></i>
                                </div>
                                <input id="datatableSearch" type="search" class="form-control"
                                    placeholder="Search Holidays" aria-label="Search Holidays">
                            </div>
                        </form>
                    </div> -->

                    <div class="d-grid d-sm-flex justify-content-md-end align-items-sm-center">
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
                <div class="table-responsive position-relative">
                    <table id="datatable"
                        class="table table-lg table-strippedtable-thead-bordered table-nowrap table-align-middle card-table"
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

                                <th class="table-column-ps-0">Name</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($holidays as $key => $holiday)
                                <tr>

                                    <td class="table-column-ps-0">
                                        <span class="mb-0 d-block h5">{{ $holiday->name }}</span>
                                        <!-- <span class="d-block fs-5">Human resources</span> -->
                                    </td>
                                    <td>
                                        <span class="mb-0 d-block h5">{{  date('d-m-Y', strtotime($holiday->date)) }}</span>
                                    </td>
                                    <td> {{ $holiday->description }}</td>
                                    {{-- <td>
                                        <button class="success-badges changeStatus" data-table="holidays" data-uuid="{{$holiday->uuid}}"
                                            @if($holiday->status=="Active") data-value="Inactive" data-message="Inactive"  @else data-value="Active" data-message="Active" @endif>
                                            <span class="legend-indicator @if($holiday->status=="Active") bg-success @else bg-danger @endif "></span>{{ $holiday->status ?? 'Active' }}
                                        </button>
                                    </td> --}}

                                    <td>
                                        @can('edit-holidays')
                                            <button type="button" data-table="holidays" data-form-modal="addEditHolidayModal"
                                                data-message="inactive" data-uuid="{{ $holiday->uuid }}"
                                                class="btn btn-edit btn-sm editData">
                                                <i class="fas fa-edit" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Edit"></i>
                                            </button>
                                        @endcan
                                        @can('delete-holidays')
                                            <button type="button" data-table="holidays" data-message="inactive"
                                                data-uuid="{{ $holiday->uuid }}" class="btn btn-delete btn-sm deleteData">
                                                <i class="fas fa-trash-alt" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Delete"></i>
                                            </button>
                                        @endcan
                                        <button type="button" data-table="holidays" data-uuid="{{$holiday->uuid}}"
                                            @if($holiday->status=="active") data-value="inactive" data-message="Inactive"  @else data-value="active" data-message="Active" @endif
                                            class="btn btn-edit btn-sm changeStatus" ><i class="fas  @if($holiday->status=="active") fa-toggle-on  @else fa-toggle-off @endif"
                                                @if($holiday->status=="active") title="Active"  @else title="Inactive" @endif  data-bs-toggle="tooltip"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- End Table -->

                <!-- Footer -->
                <!-- <div class="card-footer">
                    <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                        <div class="mb-2 col-sm mb-sm-0">
                            <div class="d-flex justify-content-center justify-content-sm-start align-items-center">
                                <span class="me-2">Showing:</span>

                                <div class="tom-select-custom">
                                    <select id="datatableEntries"
                                        class="w-auto js-select form-select form-select-borderless" autocomplete="off"
                                        data-hs-tom-select-options='{
                            "searchInDropdown": false,
                            "hideSearch": true
                          }'>
                                        <option value="10">10</option>
                                        <option value="15" selected>15</option>
                                        <option value="20">20</option>
                                    </select>
                                </div>

                                <span class="text-secondary me-2">of</span>

                                <span id="datatableWithPaginationInfoTotalQty"></span>
                            </div>
                        </div>

                        <div class="col-sm-auto">
                            <div class="d-flex justify-content-center justify-content-sm-end">
                                <nav id="datatablePagination" aria-label="Activity pagination"></nav>
                            </div>
                        </div>
                    </div>
                </div> -->
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
                        <div class="mb-4 row">
                            <label for="name" class="col-sm-3 col-form-label form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="hidden" class="form-control" name="holiday_id" id="holiday_id">
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Name" aria-label="name">
                            </div>
                        </div>
                        <div class="mb-4 row">
                            <label for="name" class="col-sm-3 col-form-label form-label">Date</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" rows="4" cols="50" name="date"
                                    id="date" placeholder="Date" aria-label="Date">
                            </div>
                        </div>
                        <!-- End Form -->
                        {{-- <div class="mb-4 row">
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
                        </div> --}}
                        <!-- Form -->
                        <div class="mb-4 row">
                            <label for="description" class="col-sm-3 col-form-label form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea type="text" class="form-control" rows="4" cols="50" name="description" id="description"
                                    placeholder="Holiday Description" aria-label="Description"></textarea>
                            </div>
                        </div>


                        <!-- End Form -->

                        <div class="d-flex justify-content-end">
                            <div class="gap-3 d-flex">
                                <button type="button" class="btn btn-delete btn-sm" data-bs-dismiss="modal"
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
