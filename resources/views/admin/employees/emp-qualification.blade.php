@extends('layouts.app')
@push('styles')
@endpush
@section('content')
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
                            <div class="py-4 border rounded col-xxl-2 col-xl-3 border-1 border-color">
                                @include('admin.employees.add-aside')
                                <div class="tab-pane fade ms-5 show active">
                                </div>
                            </div>
                            <div class="mx-3 border rounded col-xl-8 col-xxl-9 border-1 border-color">

                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="py-3 row">
                                        <div class="text-left">
                                            <button type="button" class="btn btn-white btn-sm" title="Add Qualification"
                                                onclick="addQualification({{ !empty($employee) ? $employee->user_id : '' }})">
                                                Add Qualification
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row this-div">
                                        @if (!empty($employee->qualification))
                                            @foreach ($employee->qualification as $qualification)
                                                <div class="pb-4">
                                                    <div class="p-3 card">
                                                        <div class="row">
                                                            <div class="col-9">
                                                                <div class="row text-dark">
                                                                    <div class="col-3 fw-semibold">Exam Name</div>
                                                                    <div class="col-3">{{ $qualification->exam_name }}
                                                                    </div>

                                                                    <div class="col-3 fw-semibold">Specialization</div>
                                                                    <div class="col-3">{{ $qualification->specialization }}
                                                                    </div>

                                                                    <div class="col-3 fw-semibold">Institute Name</div>
                                                                    <div class="col-3">{{ $qualification->institute_name }}
                                                                    </div>

                                                                    <div class="col-3 fw-semibold">University</div>
                                                                    <div class="col-3">{{ $qualification->university }}
                                                                    </div>

                                                                    <div class="col-3 fw-semibold">Year of passing</div>
                                                                    <div class="col-3">
                                                                        {{ $qualification->year_of_passing }}
                                                                    </div>

                                                                    <div class="col-3 fw-semibold">Marks</div>
                                                                    <div class="col-3">{{ $qualification->marks }} %</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-3 text-end">
                                                                <div class="right-div">
                                                                    <!-- Your content for right div goes here -->
                                                                    <button class="btn btn-edit btn-sm bt"
                                                                        title="Edit" id="editButton"
                                                                        data-id="{{ $qualification->id }}"
                                                                        data-user_id="{{ $employee->user_id }}"
                                                                        data-exam_name="{{ $qualification->exam_name }}"
                                                                        data-specialization="{{ $qualification->specialization }}"
                                                                        data-institute_name="{{ $qualification->institute_name }}"
                                                                        data-university="{{ $qualification->university }}"
                                                                        data-year_of_passing="{{ $qualification->year_of_passing }}"
                                                                        data-marks="{{ $qualification->marks }}">
                                                                        <i class="fas fa-edit"></i>
                                                                    </button>

                                                                    <button class="btn btn-delete btn-sm bt deleteRecord"
                                                                        title="Delete" data-id="{{ $qualification->id }}"
                                                                        data-token="{{ csrf_token() }}"
                                                                        data-action="{{ route('admin.employee.qualification.delete') }}">
                                                                        <i class="fas fa-trash-alt"></i>
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
                                    action="{{ route('admin.employee.qualification.post') }}">
                                    @csrf
                                    <input type="hidden" name="id" id="id">
                                    <input type="hidden" name="user_id" id="user_id">

                                    <div class="row">
                                        <div class="mb-2 col-sm-6">
                                            <div class="form-group">
                                                <label for="exam_name">Exam Name<small class="required-field">*</small></label>
                                                <input id="exam_name" placeholder="Enter exam name" type="text"
                                                    name="exam_name" class="form-control form-control-" value="">
                                            </div>
                                        </div>
                                        <div class="mb-2 col-sm-6">
                                            <div class="form-group">
                                                <label for="specialization">Specialization<small class="required-field">*</small></label>
                                                <input id="specialization" placeholder="Enter specialization"
                                                    type="text" name="specialization"
                                                    class="form-control form-control-" value="">
                                            </div>
                                        </div>
                                        <div class="mb-2 col-sm-6">
                                            <div class="form-group">
                                                <label for="institute_name">Institute Name<small class="required-field">*</small></label>
                                                <input id="institute_name" placeholder="Enter institute name"
                                                    type="text" name="institute_name"
                                                    class="form-control form-control-" value="">
                                            </div>
                                        </div>
                                        <div class="mb-2 col-sm-6">
                                            <div class="form-group">
                                                <label for="university">University<small class="required-field">*</small></label>
                                                <input id="university" placeholder="Enter university"
                                                    type="text" name="university" class="form-control form-control-"
                                                    value="">
                                            </div>
                                        </div>
                                        <div class="mb-2 col-sm-6">
                                            <div class="form-group">
                                                <label for="year_of_passing">Year of Passing<small class="required-field">*</small></label>
                                                <input id="year_of_passing" placeholder="Enter year of passing"
                                                    type="number" name="year_of_passing"
                                                    class="form-control form-control-" value="">
                                            </div>
                                        </div>
                                        <div class="mb-2 col-sm-6">
                                            <div class="form-group">
                                                <label for="marks">Marks(%)<small class="required-field">*</small></label>
                                                <input id="marks" placeholder="Enter marks in percentage"
                                                    type="number" name="marks" class="form-control form-control-"
                                                    value="">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="text-center ">
                                        <button type="submit" class="btn btn-white" id="btnSave">
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
    <script>
        function addQualification(user_id) {
            $('#form_id').trigger("reset");
            $("#id").val("");
            $('#formModal').modal('show');
            $("#modalTitle").html("Add: Qualification");
            $("#btnSave").html("CREATE");
            $("#user_id").val(user_id);
        }
        $(document).ready(() => {
            $(document).on("click", "#editButton", (event) => {
                $('#form_id').trigger("reset");
                $("#modalTitle").html("Edit: Qualification");
                $("#btnSave").html("UPDATE");

                let id = $(event.currentTarget).data("id");
                let user_id = $(event.currentTarget).data("user_id");
                let exam_name = $(event.currentTarget).data("exam_name");
                let specialization = $(event.currentTarget).data("specialization");
                let institute_name = $(event.currentTarget).data("institute_name");
                let university = $(event.currentTarget).data("university");
                let year_of_passing = $(event.currentTarget).data("year_of_passing");
                let marks = $(event.currentTarget).data("marks");

                $("#id").val(id);
                $("#user_id").val(user_id);
                $("#exam_name").val(exam_name);
                $("#specialization").val(specialization);
                $("#institute_name").val(institute_name);
                $("#university").val(university);
                $("#year_of_passing").val(year_of_passing);
                $("#marks").val(marks);

                $('#formModal').modal('show');
            });
        });
    </script>
@endpush
