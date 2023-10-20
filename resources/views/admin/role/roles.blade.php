@extends('layouts.app')
@push('styles')
@endpush
@section('content')
    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
           

            <!-- Card -->
            <div class="card">
            <div class="page-header">
                <div class="row">
                    <div class="mb-2 col-sm mb-sm-0">
                        <h2 class="page-header-title">Roles</h2>
                    </div>
                    <div class="col-sm-auto">
                        <a class="btn btn-white g-popup" href="javascript:;" data-bs-toggle="modal" data-action="add"
                            data-bs-target="#addEditRoleModal">
                            <i class="bi-person-plus-fill me-1"></i> Add role
                        </a>
                    </div>
                </div>
            </div>
            <!-- End Page Header -->
                <!-- Table -->
                <div class="table-responsive datatable-custom position-relative">
                    <table id="datatable"
                        class="table table-lg table-stripped table-thead-bordered table-nowrap table-align-middle card-table">
                        <thead class="thead-light">
                            <tr>
                                <th class="table-column-pe-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="datatableCheckAll">
                                        <!-- <label class="form-check-label" for="datatableCheckAll"></label> -->
                                    </div>
                                </th>
                                <th class="table-column-ps-0">Name</th>
                                {{-- <th>Type</th> --}}
                                {{-- <th>Description</th> --}}
                                {{-- <th>Status</th> --}}
                                <th style="text-align:right;">Action</th>
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
                                        <span class="mb-0 d-block h5">{{ $role->name }}</span>
                                        <!-- <span class="d-block fs-5">Human resources</span> -->
                                    </td>
                                    {{-- <td>
                                        <span class="mb-0 d-block h5">{{ $role->role_type }}</span>
                                    </td> --}}
                                    {{-- <td> {{ $role->description }}</td> --}}
                                    {{-- <td>
                                        <div class="success-badges changeStatus" data-table="roles" data-uuid="{{$role->uuid}}"
                                         @if($role->status=="active") data-value="active" data-message="Inactive"
                                         @else data-value="inactive"  data-message="Active"@endif ><span class="legend-indicator   
                                         @if($role->status=="active") bg-success @else   bg-danger @endif"></span>{{ $role->status ?? 'Active' }}</div>
                                        
                                    </td> --}}

                                    <td class="text-right">

                                        <a type="button" class="btn btn-success-check btn-sm"
                                            href="{{ route('admin.role.attach.permission', $role->id) }}"><i
                                                class="fa fa-check" data-bs-toggle="tooltip" data-bs-placement="top" title="Permission"></i> </a>
                                        <button type="button" data-table="roles" data-form-modal="addEditRoleModal"
                                            data-message="inactive" data-uuid="{{ $role->uuid }}"
                                            class="btn btn-edit btn-sm editData" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                            <i class="fas fa-pencil"></i>
                                        </button>
                                        <button type="button" data-table="roles" data-message="inactive"
                                            data-uuid="{{ $role->uuid }}"
                                            class="btn btn-delete btn-sm deleteData" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                        <button type="button" data-table="roles" data-uuid="{{$role->uuid}}"
                                            @if($role->status=="active") data-value="inactive" data-message="Inactive"  @else data-value="active" data-message="Active" @endif
                                            class="btn btn-edit btn-sm changeStatus" ><i class="fas  @if($role->status=="active") fa-toggle-on  @else fa-toggle-off @endif" 
                                                @if($role->status=="active") title="Active"  @else title="Inactive" @endif  data-bs-toggle="tooltip"  ></i>
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
                        <div class="mb-4 row">
                            <label for="name" class="col-sm-3 col-form-label form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="hidden" class="form-control" name="role_id" id="role_id">
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Name" aria-label="name">
                            </div>
                        </div>
                        <div class="mb-4 row">
                            <label for="name" class="col-sm-3 col-form-label form-label">Short Code</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" rows="4" cols="50"
                                    name="short_code" id="short_code" placeholder="Short Code" aria-label="Short Code">
                            </div>
                        </div>
                        <!-- End Form -->
                        {{-- <div class="mb-4 row">
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
                        </div> --}}
                        <!-- Form -->
                        <div class="mb-4 row">
                            <label for="description" class="col-sm-3 col-form-label form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea type="text" class="form-control" rows="4" cols="50" name="description" id="description"
                                    placeholder="Role Description" aria-label="Description"></textarea>
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
    <script type="text/javascript" src="{{ URL::asset('js/admin/role.js') }}"></script>
@endpush
