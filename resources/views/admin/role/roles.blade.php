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
                        <h1 class="page-header-title">Roles</h1>
                    </div>
                    <!-- End Col -->

                    <div class="col-sm-auto">
                        <a class="btn btn-primary g-popup" href="javascript:;" data-bs-toggle="modal" data-action="add"
                            data-bs-target="#addEditRoleModal">
                            <i class="bi-person-plus-fill me-1"></i> Add role
                        </a>
                    </div>
                    <!-- End Col -->
                </div>
                <!-- End Row -->
            </div>
            <!-- End Page Header -->

            <!-- Card -->
            <div class="card">

                <!-- Table -->
                <div class="table-responsive datatable-custom position-relative">
                    <table id="datatable"
                        class="table table-lg table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
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
                                <th>Type</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($roles as $key => $role)
                                <tr>
                                    <td class="table-column-pe-0">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="datatableCheckAll1">
                                            <label class="form-check-label" for="datatableCheckAll1"></label>
                                        </div>
                                    </td>
                                    <td class="table-column-ps-0">
                                        <span class="d-block h5 mb-0">{{ $role->name }}</span>
                                        <!-- <span class="d-block fs-5">Human resources</span> -->
                                    </td>
                                    <td>
                                        <span class="d-block h5 mb-0">{{ $role->role_type }}</span>
                                    </td>
                                    <td> {{ $role->description }}</td>
                                    <td>
                                        <span class="legend-indicator bg-success"></span>{{ $role->status ?? 'Active' }}
                                    </td>

                                    <td class="">

                                        <a type="button" class="btn btn-success btn-sm"
                                            href="{{ route('admin.role.attach.permission', $role->id) }}"><i
                                                class="fa fa-check" data-bs-toggle="tooltip" data-bs-placement="top" title="Permission"></i> </a>
                                        <button type="button" data-table="roles" data-form-modal="addEditRoleModal"
                                            data-message="inactive" data-uuid="{{ $role->uuid }}"
                                            class="btn btn-warning btn-sm editData" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" data-table="roles" data-message="inactive"
                                            data-uuid="{{ $role->uuid }}"
                                            class="btn btn-danger btn-sm deleteData" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
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

    <div class="modal fade" id="addEditRoleModal" tabindex="-1" aria-labelledby="addEditRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEditRoleModalLabel">Role:<span class="action_name">add</span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Body -->
                <div class="modal-body">
                    <!-- Nav Scroller -->
                    <form method="post" action="{{ route('admin.role.add') }}" class="formsubmit">
                        @csrf
                        <!-- Form -->
                        <div class="row mb-4">
                            <label for="name" class="col-sm-3 col-form-label form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="hidden" class="form-control" name="role_id" id="role_id">
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Name" aria-label="name">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="name" class="col-sm-3 col-form-label form-label">Short Code</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" rows="4" cols="50"
                                    name="short_code" id="short_code" placeholder="Short Code" aria-label="Short Code">
                            </div>
                        </div>
                        <!-- End Form -->
                        <div class="row mb-4">
                            <label for="description" class="col-sm-3 col-form-label form-label">Role Type</label>
                            <div class="col-sm-9">
                                <select class="js-select form-select" autocomplete="off" name="role_type" id="role_type"
                                    data-hs-tom-select-options='{
                                  "searchInDropdown": false,
                                  "hideSearch": true
                                }'>
                                    <option value="admin" selected>Admin</option>
                                    <option value="employee">Employee</option>
                                    <option value="hr">Hr</option>
                                </select>
                            </div>
                        </div>
                        <!-- Form -->
                        <div class="row mb-4">
                            <label for="description" class="col-sm-3 col-form-label form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea type="text" class="form-control" rows="4" cols="50" name="description" id="description"
                                    placeholder="Role Description" aria-label="Description"></textarea>
                            </div>
                        </div>


                        <!-- End Form -->

                        <div class="d-flex justify-content-end">
                            <div class="d-flex gap-3">
                                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"
                                    aria-label="Close">Cancel</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
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
    <script type="text/javascript" src="{{ URL::asset('js/admin/role.js') }}"></script>
@endpush
