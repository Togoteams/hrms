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
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">

                    <!-- End Col -->
                    <!-- End Page Header -->

                    <!-- Stats -->
                    <span class="name-title">Person Profile</span>
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
                                            {{-- <button type="button" class="btn btn-white btn-sm" title="Add Qualification"
                                                onclick="addQualification({{ Auth::user()->id }})">
                                                Add Qualification
                                            </button> --}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="pb-4">
                                            <div class="card p-3">
                                                <div class="row">
                                                    <div class="col-9">
                                                        <div class="row text-dark">
                                                            <div class="col-3 fw-semibold">Field Name</div>
                                                            <div class="col-3">Data</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-3 text-end">
                                                        {{-- <div class="right-div">
                                                                <form id="form_id" action="{{ route('admin.person.profile.qualification.delete') }}" class="float-right mx-1" method="post">
                                                                    @csrf
                                                                    <input type="hidden" name="id" value="">
                                                                    <button class="btn btn-delete btn-sm bt" title="Delete">
                                                                        <i class="fa-solid fa-trash fa-lg"></i>
                                                                    </button>
                                                                </form>
                                                                <button class="btn btn-edit btn-sm bt float-right" title="Edit"
                                                                    id="editButton"
                                                                    data-id="{{ $data->id }}"
                                                                    data-user_id="{{ Auth::user()->id }}"
                                                                    data-exam_name="{{ $data->exam_name }}"
                                                                    data-specialization="{{ $data->specialization }}"
                                                                    data-institute_name="{{ $data->institute_name }}"
                                                                    data-university="{{ $data->university }}"
                                                                    data-year_of_passing="{{ $data->year_of_passing }}"
                                                                    data-marks="{{ $data->marks }}">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                            </div> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                                <form id="form_id" action="{{ route('admin.person.profile.qualification.post') }}">
                                    @csrf
                                    <input type="hidden" name="id" id="id">
                                    <input type="hidden" name="user_id" id="user_id">

                                    <div class="row">
                                        <div class="col-sm-6 mb-2">
                                            <div class="form-group">
                                                <label for="exam_name">Exam Name</label>
                                                <input required id="exam_name" placeholder="Enter exam name" type="text"
                                                    name="exam_name" class="form-control form-control-" value="">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-2">
                                            <div class="form-group">
                                                <label for="specialization">Specialization</label>
                                                <input required id="specialization" placeholder="Enter specialization"
                                                    type="text" name="specialization" class="form-control form-control-"
                                                    value="">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-2">
                                            <div class="form-group">
                                                <label for="institute_name">Institute Name</label>
                                                <input required id="institute_name" placeholder="Enter institute name"
                                                    type="text" name="institute_name" class="form-control form-control-"
                                                    value="">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-2">
                                            <div class="form-group">
                                                <label for="university">University</label>
                                                <input required id="university" placeholder="Enter university"
                                                    type="text" name="university" class="form-control form-control-"
                                                    value="">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-2">
                                            <div class="form-group">
                                                <label for="year_of_passing">Year of Passing</label>
                                                <input required id="year_of_passing" placeholder="Enter year of passing"
                                                    type="text" name="year_of_passing" class="form-control form-control-"
                                                    value="">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-2">
                                            <div class="form-group">
                                                <label for="marks">Marks(%)</label>
                                                <input required id="marks" placeholder="Enter marks in percentage"
                                                    type="text" name="marks" class="form-control form-control-"
                                                    value="">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="text-center ">
                                        <button onclick="ajaxCall('form_id','','POST')" type="button"
                                            class="btn btn-white" id="btnSave">
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
