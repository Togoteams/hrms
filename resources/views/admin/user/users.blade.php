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
          {{-- <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-no-gutter">
              <li class="breadcrumb-item"><a class="breadcrumb-link" href="javascript:;">Pages</a></li>
              <li class="breadcrumb-item"><a class="breadcrumb-link" href="javascript:;">Users</a></li>
              <li class="breadcrumb-item active" aria-current="page">Overview</li>
            </ol>
          </nav> --}}

          <h1 class="page-header-title">Users</h1>
        </div>
        <!-- End Col -->

        <div class="col-sm-auto">
          <a class="btn btn-primary" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#editUserModal">
            <i class="bi-person-plus-fill me-1"></i> Add user
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
        <table id="datatable" class="table table-lg table-borderless table-thead-bordered table-nowrap table-align-middle card-table" data-hs-datatables-options='{
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
                  <input class="form-check-input" type="checkbox" value="" id="datatableCheckAll">
                  <label class="form-check-label" for="datatableCheckAll"></label>
                </div>
              </th>
              <th class="table-column-ps-0">Name</th>
              <th>Department</th>
              <th>Roles</th>
              <th>Status</th>
              
              <th></th>
            </tr>
          </thead>

          <tbody>
            @foreach ($users as $user )
            <tr>
              <td class="table-column-pe-0">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="datatableCheckAll1">
                  <label class="form-check-label" for="datatableCheckAll1"></label>
                </div>
              </td>
              <td class="table-column-ps-0">
                <a class="d-flex align-items-center" href="user-profile.html">
                  {{-- <div class="avatar avatar-circle">
                    <img class="avatar-img" src="{{asset('assets/img/160x160/img10.jpg')}}" alt="Image Description">
                  </div> --}}
                  <div class="ms-3">
                    <span class="d-block h5 text-inherit mb-0">{{$user->name}} <i class="bi-patch-check-fill text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Top endorsed"></i></span>
                    <span class="d-block fs-5 text-body">{{$user->email}} </span>
                  </div>
                </a>
              </td>
              <td>
                <span class="d-block h5 mb-0">{{$user->roles->first()}}</span>
              </td>
              <td><span class="d-block fs-5">Human resources</span></td>
              <td>
                <span class="legend-indicator bg-success"></span>Active
              </td>


              <td>
                <button type="button" class="btn btn-white btn-sm" >
                  <i class="bi-pencil-fill me-1"></i> Edit
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
                <select id="datatableEntries" class="js-select form-select form-select-borderless w-auto" autocomplete="off" data-hs-tom-select-options='{
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



    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit user</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

      <!-- Body -->
      <div class="modal-body">
        <!-- Nav Scroller -->
        <form >
        
          <!-- Form -->
          <div class="row mb-4">
            <label for="editFirstNameModalLabel" class="col-sm-3 col-form-label form-label">Full name <i class="tio-help-outlined text-body ms-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Displayed on public forums, such as Front."></i></label>

                            <div class="col-sm-9">
                                <div class="input-group input-group-sm-vertical">
                                    <input type="text" class="form-control" name="first_name"
                                        id="first_name" placeholder="Your first name"
                                        aria-label="Your first name" >
                                    <input type="text" class="form-control" name="last_name"
                                        id="last_name" placeholder="Your last name"
                                        aria-label="Your last name">
                                </div>
                            </div>
                        </div>
                        <!-- End Form -->

                        <!-- Form -->
                        <div class="row mb-4">
                            <label for="editEmailModalLabel" class="col-sm-3 col-form-label form-label">Email</label>

                            <div class="col-sm-9">
                                <input type="email" class="form-control" name="email"
                                    id="email" placeholder="Email" aria-label="Email"
                                   >
                            </div>
                        </div>
                        <!-- End Form -->

                        <!-- Form -->
                        <div class="row mb-4">
                            <label for="mobile" class="col-sm-3 col-form-label form-label">Phone</label>

                            <div class="col-sm-12">
                                <div class="input-group input-group-sm-vertical">
                                    <input type="text" class="js-masked-input form-control" name="mobile"
                                        id="mobile" placeholder="+x(xxx)xxx-xx-xx" aria-label="+x(xxx)xxx-xx-xx"
                                       
                                        data-hs-mask-options='{
                                 "template": "+0(000)000-00-00"
                               }'>

                                    <!-- Select -->
                                   
                                    <!-- End Select -->
                                </div>
                            </div>
                        </div>
                        <!-- End Form -->

                       

                        <!-- Form -->
                        <div class="row mb-4">
                            <label for="username"
                                class="col-sm-3 col-form-label form-label">User name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="username"
                                    id="username" placeholder="Your department"
                                    aria-label="User Name">
                            </div>
                        </div>
                        <!-- End Form -->
                        <!-- Form -->
                        <div class="row mb-4">
                            <label for="password"
                                class="col-sm-3 col-form-label form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="password"
                                    id="password" placeholder="Password"
                                    aria-label="Password">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="confirm_password"
                                class="col-sm-3 col-form-label form-label">Confirm Password</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="confirm_password"
                                    id="confirm_password" placeholder="Confirm Password"
                                    aria-label="Confirm Password">
                            </div>
                        </div>
                        <!-- End Form -->

                        <div class="d-flex justify-content-end">
                            <div class="d-flex gap-3">
                                <button type="button" class="btn btn-white" data-bs-dismiss="modal"
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
    <!-- End Edit user -->
@endsection
