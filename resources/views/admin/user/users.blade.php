@extends('layouts.app')
@push('styles')
@endpush
@section('content')
    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="content container-fluid">
           

            <!-- Card -->
            <div class="card">
            <div class="page-header">
                <div class="row">
                    <div class="mb-2 col-sm mb-sm-0">
                        <h2 class="page-header-title">Users</h2>
                    </div>
                    <div class="col-sm-auto">
                    <a class="btn btn-white" href="javascript:void(0)" data-bs-toggle="modal"
                            data-bs-target="#editUserModal">
                            <i class="bi-person-plus-fill me-1"></i> Add user
                        </a>
                    </div>
                </div>
            </div>
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
                                        <label class="form-check-label" for="datatableCheckAll"></label>
                                    </div>
                                </th>
                                <th class="table-column-ps-0">Name</th>
                                <th>Department</th>
                                <th>Roles</th>
                                <th>Status</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($users as $user)
                            {{-- @if (!$user->hasRole('admin')) --}}
                            <tr>
                                    <td class="table-column-pe-0">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="datatableCheckAll1">
                                            <label class="form-check-label" for="datatableCheckAll1"></label>
                                        </div>
                                    </td>
                                    <td class="table-column-ps-0">
                                        <a class="d-flex align-items-center" href="user-profile.html">
                                            <div class="ms-3">
                                                <span class="d-block h5 text-inherit mb-0">{{ $user->name }} <i
                                                        class="bi-patch-check-fill text-primary" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Top endorsed"></i></span>
                                                <span class="d-block fs-5 text-body">
                                                    @foreach ($employees as $employee)
                                                    @if ($employee->user_id == $user->id)
                                                        {{ $employee->emp_id}}
                                                    @endif
                                                @endforeach
                                            </span>
                                            </div>
                                        </a>
                                    </td>
                                    <td>
                                        @foreach ($user->latestDepartmentHistory as $departmentHistory)
                                              {{ $departmentHistory->department_name }}
                                         @endforeach
                                    </td>
                                    <td>
                                        <span class="d-block h5 mb-0">{{ $user->roles?->first()?->name }}</span>
                                    </td>
                                    <td>
                                            <div class="success-badges changeStatus" data-table="users" data-uuid="{{$user->uuid}}"
                                                data-message="inactive" @if($user->status=="active") data-value="active" @else data-value="inactive" @endif><span class="legend-indicator bg-success"></span>{{ $user->status ?? 'Active' }}</div>
                                    </td>


                                    <td>
                                        <button type="button" class="btn btn-edit btn-sm editData"
                                            data-table="users" data-form-modal="editUserModal" data-message="inactive"
                                            data-uuid="{{ $user->uuid }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                           <i class="fas fa-edit"></i></button>
                                    </td>
                                </tr>
                                {{-- @endif --}}
                             @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- End Table -->

                <!-- Footer -->
                <!-- <div class="card-footer">
                    <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                        <div class="col-sm mb-2 mb-sm-0">
                            <div class="d-flex justify-content-center justify-content-sm-start align-items-center">
                                <span class="me-2">Showing:</span>

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



    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Add user</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Body -->
                <div class="modal-body">
                    <!-- Nav Scroller -->
                    <form method="post" action="{{ route('admin.user.add') }}" class="formsubmit">
                        @csrf
                        <!-- Form -->
                        <div class="row mb-4">
                            <label for="first_name" class="col-sm-3 col-form-label form-label">Full name <i
                                    class="tio-help-outlined text-body ms-1" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Displayed on public forums, such as Front."></i></label>

                            <div class="col-sm-9">
                                <div class="input-group input-group-sm-vertical">
                                    <input type="hidden" class="form-control" name="user_id" id="user_id">
                                    <input type="text" class="form-control" name="first_name" id="first_name"
                                        placeholder="Your first name" aria-label="Your first name">
                                    <input type="text" class="form-control" name="last_name" id="last_name"
                                        placeholder="Your last name" aria-label="Your last name">
                                </div>
                            </div>
                        </div>
                        <!-- End Form -->

                        <!-- Form -->
                        <div class="row mb-4">
                            <label for="email" class="col-sm-3 col-form-label form-label">Email</label>

                            <div class="col-sm-9">
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Email" aria-label="Email">
                            </div>
                        </div>
                        <!-- End Form -->

                        <!-- Form -->
                        <div class="row mb-4">
                            <label for="mobile" class="col-sm-3 col-form-label form-label">Mobile</label>
                            <div class="col-sm-9">
                                <div class="input-group input-group-sm-vertical">
                                    <input type="text" class=" form-control" name="mobile" id="mobile">


                                </div>
                            </div>
                        </div>
                        <!-- End Form -->

                        <!-- Form -->
                        <div class="row mb-4">
                            <label for="editOrganizationModalLabel"
                                class="col-sm-3 col-form-label form-label">Role</label>

                            <div class="col-sm-9">
                                <select class="js-select form-select" autocomplete="off" id="role_id" name="role_id">
                                    <option value="" selected>Roles</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- End Form -->

                        <!-- Form -->
                        <div class="row mb-4">
                            <label for="username" class="col-sm-3 col-form-label form-label">Username</label>

                            <div class="col-sm-9">
                                <input type="username" class="form-control" name="username" id="username"
                                    placeholder="username" aria-label="username">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="password" class="col-sm-3 col-form-label form-label">Password <i
                                    class="tio-help-outlined text-body ms-1"></i></label>

                            <div class="col-sm-9">
                                <div class="input-group input-group-sm-vertical">
                                    <input type="password" class="form-control" name="password" id="password"
                                        placeholder="password" aria-label="Your login password">
                                    <input type="password" class="form-control" name="confirm_password"
                                        id="confirm_password" placeholder="Confirm Password"
                                        aria-label="Confirm Password Should be similar as password">
                                </div>
                            </div>
                        </div>
                        <!-- End Form -->

                        <div class="d-flex justify-content-end">
                            <div class="d-flex gap-3">
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
    <!-- End Edit user -->
@endsection
