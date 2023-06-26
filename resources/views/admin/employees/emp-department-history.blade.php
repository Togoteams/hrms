@extends('layouts.app')
@push('styles')
@endpush
@section('content')
    <style>
        .float-right {
            float: right;
        }
    </style>
    <main id="content" role="main" class="main">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">

                    <!-- End Col -->
                    <!-- End Page Header -->

                    <!-- Stats -->
                    <span class="name-title">Employee Form</span>
                    <div class="mt-5">
                        <div class="row d-flex align-items-start">
                            <div class="col-xxl-2 col-xl-3  border border-1 border-color rounded py-4">
                                @include('admin.employees.add-aside')
                                <div class="tab-pane fade ms-5 show active">
                                </div>
                            </div>
                            <div class="col-xl-8 col-xxl-9 border border-1 border-color rounded mx-3">

                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="row py-3">
                                        <div class="text-left">
                                            <button type="button" class="btn btn-primary btn-sm" title="Add Department"
                                                onclick="addDepartment({{ !empty($employee) ? $employee->user_id : '' }})">
                                                Add Department
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        @if (!empty($employee->departmentHistory))
                                            @foreach ($employee->departmentHistory as $department)
                                                <div class="pb-4">
                                                    <div class="card p-3">
                                                        <div class="row">
                                                            <div class="col-9">
                                                                <div class="row text-dark">
                                                                    <div class="col-3 fw-semibold">Department Name:</div>
                                                                    <div class="col-3">{{ $department->department_name }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-3 text-end">
                                                                <div class="right-div">
                                                                    <!-- Your content for right div goes here -->
                                                                    <form id="form_id"
                                                                        action="{{ route('admin.employee.departmentHistory.delete') }}"
                                                                        class="float-right mx-1" method="post">
                                                                        @csrf
                                                                        <input type="hidden" name="id"
                                                                            value="{{ $department->id }}">
                                                                        <button class="btn btn-danger btn-sm bt"
                                                                            title="Delete">
                                                                            <i class="fa-solid fa-trash fa-lg"></i>
                                                                        </button>
                                                                    </form>
                                                                    <button class="btn btn-warning btn-sm bt float-right"
                                                                        title="Edit" id="editButton"
                                                                        data-id="{{ $department->id }}"
                                                                        data-user_id="{{ $employee->user_id }}"
                                                                        data-department_name="{{ $department->department_name }}">
                                                                        <i class="fas fa-edit"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- End Stats -->
                </div>

                {{-- Add form model start --}}
                <!-- Modal -->
                <div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content ">
                            <div class="modal-header ">
                                <h5 class="modal-title" id="modalTitle"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="add">
                                <form id="form_id" action="{{ route('admin.employee.departmentHistory.post') }}">
                                    @csrf
                                    <input type="hidden" name="id" id="id">
                                    <input type="hidden" name="user_id" id="user_id">

                                    <div class="row">
                                        <div class="col-sm-12 mb-2">
                                            <div class="form-group">
                                                <label for="department_name">Department Name</label>
                                                <input required id="department_name" placeholder="Enter exam name"
                                                    type="text" name="department_name" class="form-control form-control-"
                                                    value="">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="text-center ">
                                        <button onclick="ajaxCall('form_id','','POST')" type="button"
                                            class="btn btn-primary" id="btnSave">
                                        </button>
                                    </div>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>

    </main>
@endsection
@push('custom-scripts')
    @if (!empty(Session::get('success')))
        <script>
            Swal.fire({
                icon: 'success',
                title: '{{ Session::get('success') }}',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
        @php
            Session::forget('success');
        @endphp
    @endif

    <script>
        function addDepartment(user_id) {
            $('#form_id').trigger("reset");
            $("#id").val("");
            $('#formModal').modal('show');
            $("#modalTitle").html("Add: Department");
            $("#btnSave").html("CREATE");
            $("#user_id").val(user_id);
        }
        $(document).ready(() => {
            $(document).on("click", "#editButton", (event) => {
                $('#form_id').trigger("reset");
                $("#modalTitle").html("Edit: Department");
                $("#btnSave").html("UPDATE");

                let id = $(event.currentTarget).data("id");
                let user_id = $(event.currentTarget).data("user_id");
                let department_name = $(event.currentTarget).data("department_name");

                $("#id").val(id);
                $("#user_id").val(user_id);
                $("#department_name").val(department_name);

                $('#formModal').modal('show');
            });
        });
    </script>
@endpush
