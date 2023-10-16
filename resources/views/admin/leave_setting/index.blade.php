@extends('layouts.app')
@push('styles')
@endpush
@section('content')
    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="mt-2 mb-2 border-bottom">
                <div class="row align-items-center">


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

            @include('admin.leave_type.create')


            <!-- Card -->
            <div class="mb-3 card mb-lg-5">
                <div class="page-header">
                    <div class="row">
                        <div class="mb-2 col-sm mb-sm-0">
                            <h2 class="page-header-title">{{ $page }}</h2>
                        </div>
                        <div class="col-sm-auto">
                            {{-- @can('add-leave-type')
                            <button type="button" class="btn btn-white" data-bs-toggle="modal"
                                data-bs-target="#leave_setting_add_modal">
                                Add {{ $page }}
                            </button>
                            @endcan --}}
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="table-responsive datatable-custom">
                    <table id="datatable"
                        class="table table-strippedtable-thead-bordered table-nowrap table-align-middle card-table">
                        <thead class="thead-light">
                            <tr>
                                <th>S.no</th>
                                <th>Name</th>
                                <th>Employee type</th>
                                <th>Total Leave Year</th>
                                <th>Max leave at time</th>
                                <th>Starting Date</th>
                                <th>Is Certificate</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $key => $item)
                                <tr>
                                    <td class="table-column-pe-0">
                                        {{ $key + 1 }}
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->emp_type == '1' ? 'Local' : 'IBO' }}</td>
                                    <td>{{ $item->total_leave_year }}</td>
                                    <td>{{ $item->max_leave_at_time }}</td>
                                    <td>{{ $item->starting_date == '1' ? 'DOJ' : 'Other Date' }}</td>
                                    <td>{{ $item->is_certificate == '1' ? 'Yes' : 'No' }}</td>
                                    <td>
                                        @can('edit-leave-type')
                                        <a href="javascript:void(0)" data-value="{{ json_encode($item) }}"
                                            class="btn btn-edit btn-sm edit_leave_setting_btn">
                                            <i class="fas fa-edit" title="Edit"></i>
                                        </a>
                                        @endcan
                                        @can('delete-leave-type')
                                        <a class="btn btn-delete btn-sm delete_leave_setting_btn"
                                            data-value="{{ $item->id }}">
                                            <i class="fas fa-trash-alt" title="Delete"></i>
                                        </a>
                                        @endcan
                                        @can('view-leave-type')
                                        <a class="btn btn-sm btn-info view_leave_setting_btn" data-value="{{ json_encode($item) }}">
                                            <i class="fas fa-eye" style="color:#fff;"></i>
                                        </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- End Table -->


            </div>
            <!-- End Card -->

            <!-- Being:Add Modal -->
            <div class="modal fade modal-lg" id="leave_setting_add_modal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Add {{ $page }}</h5>
                            <button type="button" class="close leave_setting_add_modal_close_btn" data-dismiss="modal"
                                aria-label="Close"
                                style="background-color: transparent; border: 0px; font-size: 31px; color: #b3acac">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="add_leave_seeting_form" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Employee type</label>
                                            <select name="emp_type" class="form-control">
                                                <option value="">---Select---</option>
                                                <option value=1>Local</option>
                                                <option value=0>IBO</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Total Leave Year</label>
                                            <input type="text" name="total_leave_year" class="form-control"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Max leave at time</label>
                                            <input type="text" name="max_leave_at_time" class="form-control"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Is Accumulated</label>
                                            <select name="is_accumulated" class="form-control">
                                                <option value="">---Select---</option>
                                                <option value=1>Yes</option>
                                                <option value=0>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Is Accumulated Max Value</label>
                                            <input type="text" name="is_accumulated_max_value" class="form-control"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Is Pro Data</label>
                                            <select name="is_pro_data" class="form-control">
                                                <option value="">---Select---</option>
                                                <option value=1>Yes</option>
                                                <option value=0>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Starting Date</label>
                                            <select name="starting_date" class="form-control">
                                                <option value="">---Select---</option>
                                                <option value=1>Date of joining</option>
                                                <option value=0>Other Date</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Is Count Holyday</label>
                                            <select name="is_count_holyday" class="form-control">
                                                <option value="">---Select---</option>
                                                <option value=1>Yes</option>
                                                <option value=0>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Is Leave Encash</label>
                                            <select name="is_leave_encash" class="form-control">
                                                <option value="">---Select---</option>
                                                <option value=1>Yes</option>
                                                <option value=0>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Is Certificate</label>
                                            <select name="is_certificate" class="form-control">
                                                <option value="">---Select---</option>
                                                <option value=1>Yes</option>
                                                <option value=0>No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="justify-content: center;">
                                    <button type="submit" class="add_leave_setting_save_btn">Add
                                        {{ $page }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--end:add Modal-->
            <!-- Being:Edit Modal -->
            <div class="modal fade modal-lg" id="leave_setting_edit_modal" tabindex="-1" role="dialog"
                aria-labelledby="leave_setting_edit_modalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="leave_setting_edit_modalTitle">Edit {{ $page }}</h5>
                            <button type="button" class="close leave_setting_edit_modal_close_btn" data-dismiss="modal"
                                aria-label="Close"
                                style="background-color: transparent; border: 0px; font-size: 31px; color: #b3acac">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="edit_leave_seeting_form" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name" id="leave_setting_name"
                                                class="form-control">
                                        </div>
                                        <input type="hidden" name="id" id="leave_setting_id">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Employee type</label>
                                            <select name="emp_type" class="form-control" id="leave_setting_emp_type">
                                                <option value="">---Select---</option>
                                                <option value=1>Local</option>
                                                <option value=0>IBO</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Total Leave Year</label>
                                            <input type="text" name="total_leave_year"
                                                id="leave_setting_total_leave_year" class="form-control"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Max leave at time</label>
                                            <input type="text" name="max_leave_at_time"
                                                id="leave_setting_max_leave_at_time" class="form-control"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Is Accumulated</label>
                                            <select name="is_accumulated" class="form-control"
                                                id="leave_setting_is_accumulated">
                                                <option value="">---Select---</option>
                                                <option value=1>Yes</option>
                                                <option value=0>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Is Accumulated Max Value</label>
                                            <input type="text" name="is_accumulated_max_value"
                                                id="leave_setting_is_accumulated_max_value" class="form-control"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Is Pro Data</label>
                                            <select name="is_pro_data" id="leave_setting_is_pro_data"
                                                class="form-control">
                                                <option value="">---Select---</option>
                                                <option value=1>Yes</option>
                                                <option value=0>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Starting Date</label>
                                            <select name="starting_date" id="leave_setting_starting_date"
                                                class="form-control">
                                                <option value="">---Select---</option>
                                                <option value=1>Date of joining</option>
                                                <option value=0>Other Date</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Is Count Holyday</label>
                                            <select name="is_count_holyday" id="leave_setting_is_count_holyday"
                                                class="form-control">
                                                <option value="">---Select---</option>
                                                <option value=1>Yes</option>
                                                <option value=0>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Is Leave Encash</label>
                                            <select name="is_leave_encash" id="leave_setting_is_leave_encash"
                                                class="form-control">
                                                <option value="">---Select---</option>
                                                <option value=1>Yes</option>
                                                <option value=0>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Is Certificate</label>
                                            <select name="is_certificate" id="leave_setting_is_certificate"
                                                class="form-control">
                                                <option value="">---Select---</option>
                                                <option value=1>Yes</option>
                                                <option value=0>No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="justify-content: center;">
                                    <button type="submit" class="add_leave_setting_save_btn">Edit
                                        {{ $page }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--end:edit Modal-->
            <!-- Being:VIew Modal -->
            <div class="modal fade modal-lg" id="leave_setting_view_modal" tabindex="-1" role="dialog"
                aria-labelledby="leave_setting_view_modalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="leave_setting_view_modalTitle">view {{ $page }}</h5>
                            <button type="button" class="close leave_setting_view_modal_close_btn" data-dismiss="modal"
                                aria-label="Close"
                                style="background-color: transparent; border: 0px; font-size: 31px; color: #b3acac">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name" id="leave_setting_name_view"
                                                class="form-control">
                                        </div>
                                        <input type="hidden" name="id" id="leave_setting_id_view">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Employee type</label>
                                            <select name="emp_type" class="form-control" id="leave_setting_emp_type_view">
                                                <option value="">---Select---</option>
                                                <option value=1>Local</option>
                                                <option value=0>IBO</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Total Leave Year</label>
                                            <input type="text" name="total_leave_year"
                                                id="leave_setting_total_leave_year_view" class="form-control"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Max leave at time</label>
                                            <input type="text" name="max_leave_at_time"
                                                id="leave_setting_max_leave_at_time_view" class="form-control"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Is Accumulated</label>
                                            <select name="is_accumulated" class="form-control"
                                                id="leave_setting_is_accumulated_view">
                                                <option value="">---Select---</option>
                                                <option value=1>Yes</option>
                                                <option value=0>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Is Accumulated Max Value</label>
                                            <input type="text" name="is_accumulated_max_value"
                                                id="leave_setting_is_accumulated_max_value_view" class="form-control"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Is Pro Data</label>
                                            <select name="is_pro_data" id="leave_setting_is_pro_data_view"
                                                class="form-control">
                                                <option value="">---Select---</option>
                                                <option value=1>Yes</option>
                                                <option value=0>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Starting Date</label>
                                            <select name="starting_date" id="leave_setting_starting_date_view"
                                                class="form-control">
                                                <option value="">---Select---</option>
                                                <option value=1>Date of joining</option>
                                                <option value=0>Other Date</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Is Count Holyday</label>
                                            <select name="is_count_holyday" id="leave_setting_is_count_holyday_view"
                                                class="form-control">
                                                <option value="">---Select---</option>
                                                <option value=1>Yes</option>
                                                <option value=0>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Is Leave Encash</label>
                                            <select name="is_leave_encash" id="leave_setting_is_leave_encash_view"
                                                class="form-control">
                                                <option value="">---Select---</option>
                                                <option value=1>Yes</option>
                                                <option value=0>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Is Certificate</label>
                                            <select name="is_certificate" id="leave_setting_is_certificate_view"
                                                class="form-control">
                                                <option value="">---Select---</option>
                                                <option value=1>Yes</option>
                                                <option value=0>No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end:edit Modal-->

        </div>
    </main>
    @push('script')
        <script>
            $(document).on('click', '.leave_setting_add_modal_close_btn', function() {
                $('#leave_setting_add_modal').modal('hide');
            })
            $(document).on('click', '.leave_setting_edit_modal_close_btn', function() {
                $('#leave_setting_edit_modal').modal('hide');
            })
            $(document).on('click', '.leave_setting_view_modal_close_btn', function() {
                $('#leave_setting_view_modal').modal('hide');
            })

            $(document).on('click', '.delete_leave_setting_btn', function() {
                var leave_id = $(this).attr('data-value');
                alert('Are you sure, want to delete this leave setting?')
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: APP_URL + '/admin/leavesettings/delete',
                    data: leave_id,
                    dataType: 'JSON',
                    success: function(response) {
                        if (response.status == true) {
                            toastr.options = {
                                "closeButton": true,
                                "progressBar": true
                            }
                            toastr.success('Leave settings deleted successfully')
                            setTimeout(function() {
                                location.reload();
                            }, 5000);
                        } else {
                            toastr.options = {
                                "closeButton": true,
                                "progressBar": true
                            }
                            toastr.error('Leave settings not deleted')
                            setTimeout(function() {
                                location.reload();
                            }, 5000);
                        }
                    },
                    error: function(errorResponse) {
                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true
                        }
                        toastr.error('Something went wrong !!')
                        setTimeout(function() {
                            location.reload();
                        }, 5000);
                    }
                })
            })

            $(document).on('click', '.edit_leave_setting_btn', function() {
                var data = JSON.parse($(this).attr('data-value'));
                $('#leave_setting_id').val(data['id']);
                $('#leave_setting_name').val(data['name']);
                $('#leave_setting_emp_type').val(data['emp_type']);
                $('#leave_setting_total_leave_year').val(data['total_leave_year']);
                $('#leave_setting_max_leave_at_time').val(data['max_leave_at_time']);
                $('#leave_setting_is_accumulated').val(data['is_accumulated']);
                $('#leave_setting_is_accumulated_max_value').val(data['is_accumulated_max_value']);
                $('#leave_setting_is_pro_data').val(data['is_pro_data']);
                $('#leave_setting_starting_date').val(data['starting_date']);
                $('#leave_setting_is_count_holyday').val(data['is_count_holyday']);
                $('#leave_setting_is_leave_encash').val(data['is_leave_encash']);
                $('#leave_setting_is_certificate').val(data['is_certificate']);
                $('#leave_setting_edit_modal').modal('show');
            })

            $(document).on('click', '.view_leave_setting_btn', function() {
                var data = JSON.parse($(this).attr('data-value'));
                $('#leave_setting_id_view').val(data['id']);
                $('#leave_setting_name_view').val(data['name']);
                $('#leave_setting_emp_type_view').val(data['emp_type']);
                $('#leave_setting_total_leave_year_view').val(data['total_leave_year']);
                $('#leave_setting_max_leave_at_time_view').val(data['max_leave_at_time']);
                $('#leave_setting_is_accumulated_view').val(data['is_accumulated']);
                $('#leave_setting_is_accumulated_max_value_view').val(data['is_accumulated_max_value']);
                $('#leave_setting_is_pro_data_view').val(data['is_pro_data']);
                $('#leave_setting_starting_date_view').val(data['starting_date']);
                $('#leave_setting_is_count_holyday_view').val(data['is_count_holyday']);
                $('#leave_setting_is_leave_encash_view').val(data['is_leave_encash']);
                $('#leave_setting_is_certificate_view').val(data['is_certificate']);
                $('#leave_setting_view_modal').modal('show');
            })

            var addLeaveSettigs = $('#add_leave_seeting_form')
            $(document).on('submit', '#add_leave_seeting_form', function(e) {
                e.preventDefault()
            })

            var editLeaveSettigs = $('#edit_leave_seeting_form')
            $(document).on('submit', '#edit_leave_seeting_form', function(e) {
                e.preventDefault()
                alert('Are you sure you want to edit this leave setting?')
            })

            $(document).ready(function() {
                var validator = addLeaveSettigs.validate({
                    ignore: "",
                    errorClass: "invalid-feedback",
                    errorElement: "span",
                    rules: {
                        name: {
                            required: true,
                        },
                        emp_type: {
                            required: true,
                        },
                        total_leave_year: {
                            required: true,
                        },
                        max_leave_at_time: {
                            required: true,
                        },
                        is_accumulated: {
                            required: true,
                        },
                        is_accumulated_max_value: {
                            required: true,
                        },
                        is_pro_data: {
                            required: true,
                        },
                        starting_date: {
                            required: true,
                        },
                        is_count_holyday: {
                            required: true,
                        },
                        is_leave_encash: {
                            required: true,
                        },
                        is_certificate: {
                            required: true,
                        }
                    },
                    messages: {
                        name: {
                            required: "name is required",
                        },
                        emp_type: {
                            required: "Epmloyee type is required",
                        },
                        total_leave_year: {
                            required: "Total leave year is required",
                        },
                        max_leave_at_time: {
                            required: "Max leave at time is required",
                        },
                        is_accumulated: {
                            required: "Accumulated is required",
                        },
                        is_accumulated_max_value: {
                            required: "Accumulated max value is required",
                        },
                        is_pro_data: {
                            required: "Pro data is required",
                        },
                        starting_date: {
                            required: "Starting date is required",
                        },
                        is_count_holyday: {
                            required: "Holyday count is required",
                        },
                        is_leave_encash: {
                            required: "Leave encash is required",
                        },
                        is_certificate: {
                            required: "Certificate is required",
                        },
                    },
                    errorPlacement: function(error, element) {
                        error.insertAfter(element)
                    },
                    highlight: function(element, errorClass, validClass) {
                        $(element).closest("input").addClass("error")
                    },
                    unhighlight: function(element, errorClass, validClass) {
                        $(element).closest("input").removeClass("error")
                    },
                    submitHandler: function(form) {
                        var data = new FormData($('#add_leave_seeting_form')[0]);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: APP_URL + '/admin/leavesettings/add',
                            data: data,
                            contentType: false,
                            processData: false,
                            dataType: 'JSON',
                            success: function(response) {
                                if (response.status == true) {
                                    toastr.options = {
                                        "closeButton": true,
                                        "progressBar": true
                                    }
                                    toastr.success('Leave settings added successfully')
                                    setTimeout(function() {
                                        location.reload();
                                    }, 5000);
                                } else {
                                    toastr.options = {
                                        "closeButton": true,
                                        "progressBar": true
                                    }
                                    toastr.error('Leave settings not added')
                                    setTimeout(function() {
                                        location.reload();
                                    }, 5000);
                                }
                            },
                            error: function(errorResponse) {
                                toastr.options = {
                                    "closeButton": true,
                                    "progressBar": true
                                }
                                toastr.error('Something went wrong !!')
                                setTimeout(function() {
                                    location.reload();
                                }, 5000);
                            }
                        })
                    }
                })

                var validator = editLeaveSettigs.validate({
                    ignore: "",
                    errorClass: "invalid-feedback",
                    errorElement: "span",
                    rules: {
                        name: {
                            required: true,
                        },
                        emp_type: {
                            required: true,
                        },
                        total_leave_year: {
                            required: true,
                        },
                        max_leave_at_time: {
                            required: true,
                        },
                        is_accumulated: {
                            required: true,
                        },
                        is_accumulated_max_value: {
                            required: true,
                        },
                        is_pro_data: {
                            required: true,
                        },
                        starting_date: {
                            required: true,
                        },
                        is_count_holyday: {
                            required: true,
                        },
                        is_leave_encash: {
                            required: true,
                        },
                        is_certificate: {
                            required: true,
                        }
                    },
                    messages: {
                        name: {
                            required: "name is required",
                        },
                        emp_type: {
                            required: "Epmloyee type is required",
                        },
                        total_leave_year: {
                            required: "Total leave year is required",
                        },
                        max_leave_at_time: {
                            required: "Max leave at time is required",
                        },
                        is_accumulated: {
                            required: "Accumulated is required",
                        },
                        is_accumulated_max_value: {
                            required: "Accumulated max value is required",
                        },
                        is_pro_data: {
                            required: "Pro data is required",
                        },
                        starting_date: {
                            required: "Starting date is required",
                        },
                        is_count_holyday: {
                            required: "Holyday count is required",
                        },
                        is_leave_encash: {
                            required: "Leave encash is required",
                        },
                        is_certificate: {
                            required: "Certificate is required",
                        },
                    },
                    errorPlacement: function(error, element) {
                        error.insertAfter(element)
                    },
                    highlight: function(element, errorClass, validClass) {
                        $(element).closest("input").addClass("error")
                    },
                    unhighlight: function(element, errorClass, validClass) {
                        $(element).closest("input").removeClass("error")
                    },
                    submitHandler: function(form) {
                        var data = new FormData($('#edit_leave_seeting_form')[0]);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: APP_URL + '/admin/leavesettings/edit',
                            data: data,
                            contentType: false,
                            processData: false,
                            dataType: 'JSON',
                            success: function(response) {
                                if (response.status == true) {
                                    toastr.options = {
                                        "closeButton": true,
                                        "progressBar": true
                                    }
                                    toastr.success('Leave settings update successfully')
                                    setTimeout(function() {
                                        location.reload();
                                    }, 5000);
                                } else {
                                    toastr.options = {
                                        "closeButton": true,
                                        "progressBar": true
                                    }
                                    toastr.error('Leave settings not update')
                                    setTimeout(function() {
                                        location.reload();
                                    }, 5000);
                                }
                            },
                            error: function(errorResponse) {
                                toastr.options = {
                                    "closeButton": true,
                                    "progressBar": true
                                }
                                toastr.error('Something went wrong')
                                setTimeout(function() {
                                    location.reload();
                                }, 5000);
                            }
                        })
                    }
                })
            })
        </script>
    @endpush
@endsection
