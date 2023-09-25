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
                    <span class="name-title">Personal Profile</span>
                    <div class="mt-5">
                        <div class="row d-flex align-items-start">
                            <div class="py-4 border rounded col-xxl-2 col-xl-3 border-1 border-color">
                                @include('admin.dashboard.person-profile.aside')
                                <div class="tab-pane fade ms-5 show active">
                                </div>
                            </div>
                            <div class="mx-3 border rounded col-xl-8 col-xxl-9 border-1 border-color">

                                <div class="tab-content this-div" id="v-pills-tabContent">
                                    <div class="py-3 row">
                                        <div class="text-left">
                                            <button type="button" class="btn btn-white btn-sm"
                                                onclick="addForm({{ Auth::user()->id }})">
                                                Add Training Details
                                            </button>
                                        </div>
                                    </div>
                                    @if (count($datas) > 0)
                                        @foreach ($datas as $key => $data)
                                            <div class="row">
                                                <div class="pb-4">
                                                    <div class="p-3 card">
                                                        <div class="row">
                                                            <div class="col-9">
                                                                <div class="row text-dark">
                                                                    <div class="pt-1 col-3 fw-semibold">Training Name</div>
                                                                    <div class="pt-1 col-3">
                                                                        {{ $data->name }}
                                                                    </div>

                                                                    <div class="pt-1 col-3 fw-semibold">
                                                                        Training Duration:
                                                                    </div>
                                                                    <div class="pt-1 col-3">
                                                                        {{ date_format(date_create_from_format('Y-m-d', $data->start_date), 'd/m/Y') }}
                                                                        -
                                                                        {{ date_format(date_create_from_format('Y-m-d', $data->end_date), 'd/m/Y') }}
                                                                    </div>

                                                                        <div class="pt-1 col-3 fw-semibold">
                                                                            Traning Grade
                                                                        </div>
                                                                        <div class="pt-1 col-3">
                                                                            {{ $data->grade}}
                                                                        </div>

                                                                        <div class="pt-1 col-3 fw-semibold">
                                                                            Skills
                                                                        </div>
                                                                        <div class="pt-1 col-3">
                                                                            @php
                                                                                $skills = explode(',', $data->skill); // Convert the string to an array
                                                                            @endphp
                                                                            @foreach ($skills as $skill)
                                                                                <span class="badge rounded-pill bg-danger" style="font-size: 13px;">{{ $skill }}</span>
                                                                            @endforeach
                                                                        </div>

                                                                        <div class="pt-1 col-3 fw-semibold">
                                                                            Description
                                                                        </div>
                                                                        <div class="pt-1 col-3">
                                                                            {{ $data->description}}
                                                                        </div>

                                                                </div>
                                                            </div>
                                                            <div class="col-3 text-end">
                                                                <div class="right-div">
                                                                    <button type="button"
                                                                        class="btn btn-edit btn-sm bt editButton"
                                                                        title="Edit" data-id="{{ $data->id }}"
                                                                        data-user_id="{{ Auth::user()->id }}"
                                                                        data-name="{{ $data->name }}"
                                                                        data-start_date="{{ $data->start_date }}"
                                                                        data-end_date="{{ $data->end_date }}"
                                                                        data-grade="{{ $data->grade }}"
                                                                        data-skill="{{ $data->skill }}"
                                                                        data-description="{{ $data->description }}">

                                                                        <i class="fas fa-edit"></i>
                                                                    </button>

                                                                    <button class="btn btn-delete btn-sm bt deleteRecord"
                                                                        title="Delete" data-id="{{ $data->id }}"
                                                                        data-token="{{ csrf_token() }}"
                                                                        data-action="{{ route('admin.person.profile.training.details.delete') }}">
                                                                        <i class="fa-solid fa-trash fa-lg"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="p-3 mb-5 card">No data to show</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- End Stats -->
                </div>

                {{-- edit form model start --}}
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
                            <div class="modal-body" id="edit">
                                <form id="form_add"
                                    action="{{ route('admin.person.profile.training.details.post') }}">
                                    @csrf
                                    <input type="hidden" id="id" name="id" value="">
                                    <input type="hidden" id="user_id" name="user_id">
                                    <input type="hidden" name="created_at" value="{{ date('Y-m-d h:s:i') }}">
                                    <div class="row">
                                        <div class="mb-2 col-md-6">
                                            <div class="form-group">
                                                <label for="name" class="required">Training Name</label>
                                                <input type="text" id="name" name="name"
                                                    placeholder="Enter Traning Name"
                                                    class="form-control form-control-sm" required>
                                            </div>
                                        </div>
                                        <div class="mb-2 col-md-6">
                                            <div class="form-group">
                                                <label for="start_date" class="required">Start date</label>
                                                <input required value="" id="start_date" name="start_date"
                                                    placeholder="Start date" type="date"
                                                    class="form-control form-control-sm">
                                            </div>
                                        </div>
                                        <div class="mb-2 col-md-6">
                                            <div class="form-group">
                                                <label for="end_date" class="required">End date</label>
                                                <input required value="" id="end_date" name="end_date"
                                                    placeholder="End Date" type="date"
                                                    class="form-control form-control-sm">
                                            </div>
                                        </div>
                                        <div class="mb-2 col-md-6">
                                            <div class="form-group">
                                                <label for="grade" class="required">Traning Grade</label>
                                                <input required value="" id="grade" name="grade"
                                                    placeholder="Enter Traning Grade" type="text"
                                                    class="form-control form-control-sm">
                                            </div>
                                        </div>

                                        <div class="mb-2 col-md-6">
                                            <div class="form-group">
                                                <label for="skill" class="required">Skills</label>
                                                <select class="form-control js-tags" multiple="multiple" name="skill[]" >
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-2 col-md-12">
                                            <div class="form-group">
                                                <label for="description" class="required">Description</label>
                                                <textarea name="description" id="description" cols="30" rows="10" 
                                                placeholder="Enter Traning Description...." class="form-control form-control-sm" required></textarea>
                                            </div>
                                        </div>
                                       
                                    </div>
                                    <hr>
                                    <div class="text-center ">
                                        <button onclick="ajaxCall('form_add','','POST')" type="button"
                                            class="btn btn-white" id="btnSave">
                                            Add
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        function addForm(user_id) {
            $('#form_add').trigger("reset");
            $("#id").val("");
            $('#formModal').modal('show');
            $("#modalTitle").html("Add: Training Details");
            $("#btnSave").html("CREATE");
            $("#user_id").val(user_id);
        }
        $(document).ready(() => {
            $(document).on("click", ".editButton", (event) => {
                $('#formModal').modal('show');
                $("#modalTitle").html("Edit: Training Details");
                $("#btnSave").html("Update");

                let id = $(event.currentTarget).data("id");
                let user_id = $(event.currentTarget).data("user_id");
                let name = $(event.currentTarget).data("name");
                let start_date = $(event.currentTarget).data("start_date");
                let end_date = $(event.currentTarget).data("end_date");
                let grade = $(event.currentTarget).data("grade");
                let skill = $(event.currentTarget).data("skill");
                let description = $(event.currentTarget).data("description");


                $("#id").val(id);
                $("#user_id").val(user_id);
                $("#name").val(name);
                $("#start_date").val(start_date);
                $("#end_date").val(end_date);
                $("#grade").val(grade);
                $("#skill").val(skill);
                $("#description").val(description);

            });
        });

        $(document).ready(function() {
            $(".js-tags").select2({
                tags: true
            });
        });

    </script>

@endpush
