@extends('layouts.app')
@push('styles')
@endpush
@section('content')
    <main id="content" role="main" class="main">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">

                    <!-- End Col -->
                    <!-- End Page Header -->

                    <!-- Stats -->
                    <span class="name-title">Employee Form</span>
                    <div class="mt-5">
                        <div class="row d-flex align-items-start">
                            <div class="py-4 border rounded col-xxl-2 col-xl-3 border-1 border-color">
                                @include('admin.employees.add-aside')
                                <div class="tab-pane fade ms-5 show active">
                                </div>
                            </div>
                            <div class="mx-3 border rounded col-xl-8 col-xxl-9 border-1 border-color">

                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="py-3 row">
                                        <div class="text-left">
                                            <button type="button" class="btn btn-white btn-sm" title="Add Department"
                                                onclick="addDepartment({{ !empty($employee) ? $employee->user_id : '' }})">
                                                Add Department
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row this-div">
                                        @if (!empty($employee->departmentHistory))
                                            @foreach ($employee->departmentHistory as $department)
                                                <div class="pb-4">
                                                    <div class="p-3 card">
                                                        <div class="row">
                                                            <div class="col-9 text-dark">
                                                                <div class="row">
                                                                    <div class="col-4 fw-semibold">Department Name</div>
                                                                    <div class="col-4">{{ $department->department_name }}
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-4 fw-semibold">Start Date</div>
                                                                    <div class="col-4">{{ date("d-m-Y",strtotime($department->start_date)) }}
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-4 fw-semibold">End date</div>
                                                                    <div class="col-4"> @if(!empty($department->end_date))  {{  date("d-m-Y",strtotime($department->end_date)) }} @else "Till Now" @endif
                                                                    </div>
                                                                </div>
                                                                @if (!empty($department->description))
                                                                    <div class="row">
                                                                        <div class="col-4 fw-semibold">Description</div>
                                                                        <div class="col-4">{{ $department->description }}
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="col-3 text-end">
                                                                <div class="right-div">
                                                                    <!-- Your content for right div goes here -->
                                                                    <button class="btn btn-edit btn-sm bt" title="Edit"
                                                                        id="editButton" data-id="{{ $department->id }}"
                                                                        data-user_id="{{ $employee->user_id }}"
                                                                        data-department_name="{{ $department->department_name }}"
                                                                        data-start_date="{{ $department->start_date }}"
                                                                        data-end_date="{{ $department->end_date }}"
                                                                        data-description="{{ $department->description }}">
                                                                        <i class="fas fa-edit"></i>
                                                                    </button>

                                                                    <button class="btn btn-delete btn-sm bt deleteRecord"
                                                                        title="Delete" data-id="{{ $department->id }}"
                                                                        data-token="{{ csrf_token() }}"
                                                                        data-action="{{ route('admin.employee.departmentHistory.delete') }}">
                                                                        <i class="fa-solid fas fa-trash-alt fa-lg"></i>
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
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content ">
                            <div class="modal-header ">
                                <h5 class="modal-title" id="modalTitle"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="add">
                                <form id="form_id" class="formsubmit" method="post"
                                    action="{{ route('admin.employee.departmentHistory.post') }}">
                                    @csrf
                                    <input type="hidden" name="id" id="id">
                                    <input type="hidden" name="user_id" id="user_id">
                                    <input type="hidden" name="created_at" value="{{ date('Y-m-d h:s:i') }}">

                                    <div class="row">

                                        <div class="mb-2 col-md-6">
                                            <div class="form-group">
                                                <label for="department_name">Department Name<small
                                                        class="required-field">*</small></label>
                                                        <select name="department_name" id="department_name" class="form-control form-control-sm">
                                                            <option value="" >--Select--</option>
                                                            @foreach ($departments as $key => $department )
                                                                    <option value="{{$department->name}}"> {{$department->name}} </option>
                                                            @endforeach
                                                        </select>
                                            </div>
                                        </div>
                                        <div class="mb-2 col-md-3">
                                            <div class="form-group">
                                                <label for="">Period of work<small
                                                        class="required-field">*</small></label>
                                                <input id="start_date" name="start_date" placeholder="Start Date"
                                                    type="date" class="form-control form-control-sm">
                                            </div>
                                        </div>
                                        <div class="mb-2 col-md-3">
                                            <label for=""></label>
                                            <input id="end_date" name="end_date" placeholder="End Date" type="date"
                                                class="form-control form-control-sm">
                                        </div>
                                        <div class="mb-2 col-md-12">
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea id="description" placeholder="Enter Description..." name="description" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="text-center ">
                                        <button type="submit" class="btn btn-white btn-sm"
                                            id="btnSave">SUBMIT</button>
                                    </div>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>

    </main>
@endsection
@push('custom-scripts')
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
                let start_date = $(event.currentTarget).data("start_date");
                let end_date = $(event.currentTarget).data("end_date");
                let description = $(event.currentTarget).data("description");
                console.log(start_date);
                console.log(end_date);
                $("#id").val(id);
                $("#user_id").val(user_id);
                $("#department_name").val(department_name);
                $("#start_date").val(start_date);
                $("#end_date").val(end_date);
                $("#description").val(description);

                $('#formModal').modal('show');
            });
        });
    </script>
@endpush
