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
                    <span class="name-title">Person Profile</span>
                    <div class="mt-5">
                        <div class="row d-flex align-items-start">
                            <div class="col-xxl-2 col-xl-3  border border-1 border-color rounded py-4">
                                @include('admin.dashboard.person-profile.aside')
                                <div class="tab-pane fade ms-5 show active">
                                </div>
                            </div>
                            <div class="col-xl-8 col-xxl-9 border border-1 border-color rounded mx-3">

                                <div class="tab-content this-div" id="v-pills-tabContent">
                                    <div class="row py-3">
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
                                                    <div class="card p-3">
                                                        <div class="row">
                                                            <div class="col-9">
                                                                <div class="row text-dark">
                                                                    <div class="col-3 fw-semibold pt-1">Training Name</div>
                                                                    <div class="col-3 pt-1">
                                                                        {{ $data->name }}
                                                                    </div>

                                                                    <div class="col-3 fw-semibold pt-1">
                                                                        Training Duration:
                                                                    </div>
                                                                    <div class="col-3 pt-1">
                                                                        {{ date_format(date_create_from_format('Y-m-d', $data->start_date), 'd/m/Y') }}
                                                                        -
                                                                        {{ date_format(date_create_from_format('Y-m-d', $data->end_date), 'd/m/Y') }}
                                                                    </div>

                                                                        <div class="col-3 fw-semibold pt-1">
                                                                            Traning Grade
                                                                        </div>
                                                                        <div class="col-3 pt-1">
                                                                            {{ $data->grade}}
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
                                                                        data-grade="{{ $data->grade }}">
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
                                        <div class="card p-3 mb-5">No data to show</div>
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
                                        <div class="col-md-6 mb-2">
                                            <div class="form-group">
                                                <label for="name" class="required">Training Name</label>
                                                <input type="text" id="name" name="name"
                                                    placeholder="Enter Traning Name"
                                                    class="form-control form-control-sm" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <div class="form-group">
                                                <label for="start_date" class="required">Start date</label>
                                                <input required value="" id="start_date" name="start_date"
                                                    placeholder="Start date" type="date"
                                                    class="form-control form-control-sm">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <div class="form-group">
                                                <label for="end_date" class="required">End date</label>
                                                <input required value="" id="end_date" name="end_date"
                                                    placeholder="End Date" type="date"
                                                    class="form-control form-control-sm">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <div class="form-group">
                                                <label for="grade" class="required">Traning Grade</label>
                                                <input required value="" id="grade" name="grade"
                                                    placeholder="Enter Traning Grade" type="text"
                                                    class="form-control form-control-sm">
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

                $("#id").val(id);
                $("#user_id").val(user_id);
                $("#name").val(name);
                $("#start_date").val(start_date);
                $("#end_date").val(end_date);
                $("#grade").val(grade);
            });
        });
    </script>

@endpush
