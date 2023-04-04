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
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-no-gutter">
              <li class="breadcrumb-item"><a class="breadcrumb-link" href="javascript:;">Pages</a></li>
              <li class="breadcrumb-item"><a class="breadcrumb-link" href="javascript:;">Users</a></li>
              <li class="breadcrumb-item active" aria-current="page">Overview</li>
            </ol>
          </nav>

          <h1 class="page-header-title">Users</h1>
        </div>
        <!-- End Col -->

        <div class="col-sm-auto">
          <a class="btn btn-primary" href="users-add-user.html">
            <i class="bi-person-plus-fill me-1"></i> Add user
          </a>
        </div>
        <!-- End Col -->
      </div>
      <!-- End Row -->
    </div>
    <!-- End Page Header -->

    <!-- Stats -->
    <div class="row">
      <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
        <!-- Card -->
        <div class="card h-100">
          <div class="card-body">
            <h6 class="card-subtitle mb-2">Total users</h6>

            <div class="row align-items-center gx-2">
              <div class="col">
                <span class="js-counter display-4 text-dark">24</span>
                <span class="text-body fs-5 ms-1">from 22</span>
              </div>
              <!-- End Col -->

              <div class="col-auto">
                <span class="badge bg-soft-success text-success p-1">
                  <i class="bi-graph-up"></i> 5.0%
                </span>
              </div>
              <!-- End Col -->
            </div>
            <!-- End Row -->
          </div>
        </div>
        <!-- End Card -->
      </div>

      <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
        <!-- Card -->
        <div class="card h-100">
          <div class="card-body">
            <h6 class="card-subtitle mb-2">Active members</h6>

            <div class="row align-items-center gx-2">
              <div class="col">
                <span class="js-counter display-4 text-dark">12</span>
                <span class="text-body fs-5 ms-1">from 11</span>
              </div>

              <div class="col-auto">
                <span class="badge bg-soft-success text-success p-1">
                  <i class="bi-graph-up"></i> 1.2%
                </span>
              </div>
            </div>
            <!-- End Row -->
          </div>
        </div>
        <!-- End Card -->
      </div>

      <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
        <!-- Card -->
        <div class="card h-100">
          <div class="card-body">
            <h6 class="card-subtitle mb-2">Total Employees</h6>

            <div class="row align-items-center gx-2">
              <div class="col">
                <span class="js-counter display-4 text-dark">56</span>
                <span class="display-4 text-dark">%</span>
                <span class="text-body fs-5 ms-1">from 48.7</span>
              </div>

              <div class="col-auto">
                <span class="badge bg-soft-danger text-danger p-1">
                  <i class="bi-graph-down"></i> 2.8%
                </span>
              </div>
            </div>
            <!-- End Row -->
          </div>
        </div>
        <!-- End Card -->
      </div>

      <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
        <!-- Card -->
        <div class="card h-100">
          <div class="card-body">
            <h6 class="card-subtitle mb-2">Active members</h6>

            <div class="row align-items-center gx-2">
              <div class="col">
                <span class="js-counter display-4 text-dark">28.6</span>
                <span class="display-4 text-dark">%</span>
                <span class="text-body fs-5 ms-1">from 28.6%</span>
              </div>
              <div class="col-auto">
                <span class="badge bg-soft-secondary text-secondary p-1">0.0%</span>
              </div>
            </div>
            <!-- End Row -->
          </div>
        </div>
        <!-- End Card -->
      </div>
    </div>
    <!-- End Stats -->

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
              <input id="datatableSearch" type="search" class="form-control" placeholder="Search users" aria-label="Search users">
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

          <!-- Dropdown -->
          <div class="dropdown">
            <button type="button" class="btn btn-white btn-sm dropdown-toggle w-100" id="usersExportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi-download me-2"></i> Export
            </button>

            <div class="dropdown-menu dropdown-menu-sm-end" aria-labelledby="usersExportDropdown">
              <span class="dropdown-header">Options</span>
              <a id="export-copy" class="dropdown-item" href="javascript:;">
                <img class="avatar avatar-xss avatar-4x3 me-2" src="assets/svg/illustrations/copy-icon.svg" alt="Image Description">
                Copy
              </a>
              <a id="export-print" class="dropdown-item" href="javascript:;">
                <img class="avatar avatar-xss avatar-4x3 me-2" src="assets/svg/illustrations/print-icon.svg" alt="Image Description">
                Print
              </a>
              <div class="dropdown-divider"></div>
              <span class="dropdown-header">Download options</span>
              <a id="export-excel" class="dropdown-item" href="javascript:;">
                <img class="avatar avatar-xss avatar-4x3 me-2" src="assets/svg/brands/excel-icon.svg" alt="Image Description">
                Excel
              </a>
              <a id="export-csv" class="dropdown-item" href="javascript:;">
                <img class="avatar avatar-xss avatar-4x3 me-2" src="assets/svg/components/placeholder-csv-format.svg" alt="Image Description">
                .CSV
              </a>
              <a id="export-pdf" class="dropdown-item" href="javascript:;">
                <img class="avatar avatar-xss avatar-4x3 me-2" src="assets/svg/brands/pdf-icon.svg" alt="Image Description">
                PDF
              </a>
            </div>
          </div>
          <!-- End Dropdown -->

          <!-- Dropdown -->
          <div class="dropdown">
            <button type="button" class="btn btn-white btn-sm w-100" id="usersFilterDropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
              <i class="bi-filter me-1"></i> Filter <span class="badge bg-soft-dark text-dark rounded-circle ms-1">2</span>
            </button>

            <div class="dropdown-menu dropdown-menu-sm-end dropdown-card card-dropdown-filter-centered" aria-labelledby="usersFilterDropdown" style="min-width: 22rem;">
              <!-- Card -->
              <div class="card">
                <div class="card-header card-header-content-between">
                  <h5 class="card-header-title">Filter users</h5>

                  <!-- Toggle Button -->
                  <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm ms-2">
                    <i class="bi-x-lg"></i>
                  </button>
                  <!-- End Toggle Button -->
                </div>

                <div class="card-body">
                  <form>
                    <div class="mb-4">
                      <small class="text-cap text-body">Role</small>

                      <div class="row">
                        <div class="col">
                          <!-- Check -->
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="usersFilterCheckAll" checked>
                            <label class="form-check-label" for="usersFilterCheckAll">
                              All
                            </label>
                          </div>
                          <!-- End Check -->
                        </div>
                        <!-- End Col -->

                        <div class="col">
                          <!-- Check -->
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="usersFilterCheckVendor">
                            <label class="form-check-label" for="usersFilterCheckVendor">
                              Vendor
                            </label>
                          </div>
                          <!-- End Check -->
                        </div>
                        <!-- End Col -->
                      </div>
                      <!-- End Row -->
                    </div>

                    <div class="row">
                      <div class="col-sm mb-4">
                        <small class="text-cap text-body">Position</small>

                        <!-- Select -->
                        <div class="tom-select-custom">
                          <select class="js-select js-datatable-filter form-select form-select-sm" data-target-column-index="2" data-hs-tom-select-options='{
                                      "placeholder": "Any",
                                      "searchInDropdown": false,
                                      "hideSearch": true,
                                      "dropdownWidth": "10rem"
                                    }'>
                            <option value="">Any</option>
                            <option value="Accountant">Accountant</option>
                            <option value="Co-founder">Co-founder</option>
                            <option value="Designer">Designer</option>
                            <option value="Developer">Developer</option>
                            <option value="Director">Director</option>
                          </select>
                          <!-- End Select -->
                        </div>
                      </div>
                      <!-- End Col -->

                      <div class="col-sm mb-4">
                        <small class="text-cap text-body">Status</small>

                        <!-- Select -->
                        <div class="tom-select-custom">
                          <select class="js-select js-datatable-filter form-select form-select-sm" data-target-column-index="4" data-hs-tom-select-options='{
                                      "placeholder": "Any status",
                                      "searchInDropdown": false,
                                      "hideSearch": true,
                                      "dropdownWidth": "10rem"
                                    }'>
                            <option value="">Any status</option>
                            <option value="Completed" data-option-template='<span class="d-flex align-items-center"><span class="legend-indicator bg-success"></span>Completed</span>'>Completed</option>
                            <option value="In progress" data-option-template='<span class="d-flex align-items-center"><span class="legend-indicator bg-warning"></span>In progress</span>'>In progress</option>
                            <option value="To do" data-option-template='<span class="d-flex align-items-center"><span class="legend-indicator bg-danger"></span>To do</span>'>To do</option>
                          </select>
                        </div>
                        <!-- End Select -->
                      </div>
                      <!-- End Col -->

                      <div class="col-12 mb-4">
                        <span class="text-cap text-body">Location</span>

                        <!-- Select -->
                        <div class="tom-select-custom">
                          <select class="js-select form-select">
                            <option value="AF" data-option-template='<span class="d-flex align-items-center"><img class="avatar avatar-xss avatar-circle me-2" src="assets/vendor/flag-icon-css/flags/1x1/af.svg" alt="Afghanistan Flag" /><span class="text-truncate">Afghanistan</span></span>'>Afghanistan</option>

                          </select>
                        </div>
                        <!-- End Select -->
                      </div>
                      <!-- End Col -->
                    </div>
                    <!-- End Row -->

                    <div class="d-grid">
                      <a class="btn btn-primary" href="javascript:;">Apply</a>
                    </div>
                  </form>
                </div>
              </div>
              <!-- End Card -->
            </div>
          </div>
          <!-- End Dropdown -->
        </div>
      </div>
      <!-- End Header -->

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
              <th>Position</th>
              <th>Roles</th>
              <th>Status</th>
              <!-- <th>Profile</th> -->
              <!-- <th>Vendor</th> -->
              <th></th>
            </tr>
          </thead>

          <tbody>
            <tr>
              <td class="table-column-pe-0">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="datatableCheckAll1">
                  <label class="form-check-label" for="datatableCheckAll1"></label>
                </div>
              </td>
              <td class="table-column-ps-0">
                <a class="d-flex align-items-center" href="user-profile.html">
                  <div class="avatar avatar-circle">
                    <img class="avatar-img" src="assets/img/160x160/img10.jpg" alt="Image Description">
                  </div>
                  <div class="ms-3">
                    <span class="d-block h5 text-inherit mb-0">Amanda Harvey <i class="bi-patch-check-fill text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Top endorsed"></i></span>
                    <span class="d-block fs-5 text-body">amanda@site.com</span>
                  </div>
                </a>
              </td>
              <td>
                <span class="d-block h5 mb-0">Director</span>
                <span class="d-block fs-5">Human resources</span>
              </td>
              <td>United Kingdom</td>
              <td>
                <span class="legend-indicator bg-success"></span>Active
              </td>


              <td>
                <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" data-bs-target="#editUserModal">
                  <i class="bi-pencil-fill me-1"></i> Edit
                </button>
              </td>
            </tr>
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
        <form>
          <!-- Profile Cover -->
          <div class="profile-cover">
            <div class="profile-cover-img-wrapper">
              <img id="editProfileCoverImgModal" class="profile-cover-img" src="assets/img/1920x400/img1.jpg" alt="Image Description">

              <!-- Custom File Cover -->
              <div class="profile-cover-content profile-cover-uploader p-3">
                <input type="file" class="js-file-attach profile-cover-uploader-input" id="editProfileCoverUplaoderModal" data-hs-file-attach-options='{
                                  "textTarget": "#editProfileCoverImgModal",
                                  "mode": "image",
                                  "targetAttr": "src",
                                  "allowTypes": [".png", ".jpeg", ".jpg"]
                               }'>
                <label class="profile-cover-uploader-label btn btn-sm btn-white" for="editProfileCoverUplaoderModal">
                  <i class="bi-camera-fill"></i>
                  <span class="d-none d-sm-inline-block ms-1">Upload header</span>
                </label>
              </div>
              <!-- End Custom File Cover -->
            </div>
          </div>
          <!-- End Profile Cover -->

          <!-- Avatar -->
          <label class="avatar avatar-xxl avatar-circle avatar-uploader profile-cover-avatar mb-5" for="editAvatarUploaderModal">
            <img id="editAvatarImgModal" class="avatar-img" src="assets/img/160x160/img9.jpg" alt="Image Description">

            <input type="file" class="js-file-attach avatar-uploader-input" id="editAvatarUploaderModal" data-hs-file-attach-options='{
                              "textTarget": "#editAvatarImgModal",
                              "mode": "image",
                              "targetAttr": "src",
                              "allowTypes": [".png", ".jpeg", ".jpg"]
                           }'>

            <span class="avatar-uploader-trigger">
              <i class="bi-pencil-fill avatar-uploader-icon shadow-sm"></i>
            </span>
          </label>
          <!-- End Avatar -->

          <!-- Form -->
          <div class="row mb-4">
            <label for="editFirstNameModalLabel" class="col-sm-3 col-form-label form-label">Full name <i class="tio-help-outlined text-body ms-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Displayed on public forums, such as Front."></i></label>

            <div class="col-sm-9">
              <div class="input-group input-group-sm-vertical">
                <input type="text" class="form-control" name="editFirstNameModal" id="editFirstNameModalLabel" placeholder="Your first name" aria-label="Your first name" value="Ella">
                <input type="text" class="form-control" name="editLastNameModal" id="editLastNameModalLabel" placeholder="Your last name" aria-label="Your last name" value="Lauda">
              </div>
            </div>
          </div>
          <!-- End Form -->

          <!-- Form -->
          <div class="row mb-4">
            <label for="editEmailModalLabel" class="col-sm-3 col-form-label form-label">Email</label>

            <div class="col-sm-9">
              <input type="email" class="form-control" name="editEmailModal" id="editEmailModalLabel" placeholder="Email" aria-label="Email" value="ella@site.com">
            </div>
          </div>
          <!-- End Form -->

          <!-- Form -->
          <div class="row mb-4">
            <label for="editPhoneLabel" class="col-sm-3 col-form-label form-label">Phone</label>

            <div class="col-sm-9">
              <div class="input-group input-group-sm-vertical">
                <input type="text" class="js-masked-input form-control" name="phone" id="editPhoneLabel" placeholder="+x(xxx)xxx-xx-xx" aria-label="+x(xxx)xxx-xx-xx" value="1(609)972-22-22" data-hs-mask-options='{
                                 "template": "+0(000)000-00-00"
                               }'>

                <!-- Select -->
                <div class="tom-select-custom">
                  <select class="js-select form-select" autocomplete="off" name="editPhoneSelect" data-hs-tom-select-options='{
                                  "searchInDropdown": false,
                                  "hideSearch": true
                                }'>
                    <option value="Mobile" selected>Mobile</option>
                    <option value="Home">Home</option>
                    <option value="Work">Work</option>
                    <option value="Fax">Fax</option>
                    <option value="Direct">Direct</option>
                  </select>
                </div>
                <!-- End Select -->
              </div>
            </div>
          </div>
          <!-- End Form -->

          <!-- Form -->
          <div class="row mb-4">
            <label for="editOrganizationModalLabel" class="col-sm-3 col-form-label form-label">Vendor</label>

            <div class="col-sm-9">
              <input type="text" class="form-control" name="editOrganizationModal" id="editOrganizationModalLabel" placeholder="Your organization" aria-label="Your organization" value="Htmlstream">
            </div>
          </div>
          <!-- End Form -->

          <!-- Form -->
          <div class="row mb-4">
            <label for="editDepartmentModalLabel" class="col-sm-3 col-form-label form-label">Department</label>

            <div class="col-sm-9">
              <input type="text" class="form-control" name="editDepartmentModal" id="editDepartmentModalLabel" placeholder="Your department" aria-label="Your department">
            </div>
          </div>
          <!-- End Form -->

          <div class="d-flex justify-content-end">
            <div class="d-flex gap-3">
              <button type="button" class="btn btn-white" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
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