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
                                                Add Award Details
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
                                                                    <div class="col-4 fw-semibold pt-1"> Name:</div>
                                                                    <div class="col-6 pt-1">
                                                                        {{ ucfirst($data->name) }}
                                                                    </div>

                                                                    <div class="col-4 fw-semibold pt-1">
                                                                        Event date:
                                                                    </div>
                                                                    <div class="col-6 pt-1">
                                                                        {{ date_format(date_create_from_format('Y-m-d', $data->event_date), 'd/m/Y') }}
                                                                    </div>

                                                                    <div class="col-4 fw-semibold pt-1">Purpose</div>
                                                                    <div class="col-6 pt-1">
                                                                        {{ ucfirst($data->purpose) }}
                                                                    </div>

                                                                    <div class="col-4 fw-semibold pt-1">Description</div>
                                                                    <div class="col-6 pt-1">
                                                                        {{ $data->description }}
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
                                                                        data-event_date="{{ $data->event_date }}"
                                                                        data-purpose="{{ $data->purpose }}"
                                                                        data-description="{{ $data->description }}">
                                                                        <i class="fas fa-edit"></i>
                                                                    </button>

                                                                    <button class="btn btn-delete btn-sm bt deleteRecord"
                                                                        title="Delete" data-id="{{ $data->id }}"
                                                                        data-token="{{ csrf_token() }}"
                                                                        data-action="{{ route('admin.person.profile.award.details.delete') }}">
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
                                    action="{{ route('admin.person.profile.award.details.post') }}">
                                    @csrf
                                    <input type="hidden" id="id" name="id" value="">
                                    <input type="hidden" id="user_id" name="user_id">
                                    <input type="hidden" name="created_at" value="{{ date('Y-m-d h:s:i') }}">
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <div class="form-group">
                                                <label for="name" class="required"> Name</label>
                                                <input type="text" id="name" name="name"
                                                    placeholder="Enter Award Name"
                                                    class="form-control form-control-sm" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <div class="form-group">
                                                <label for="event_date" class="required">Event date<small
                                                        class="required-field">*</small></label>
                                                <input required value="" id="event_date" name="event_date"
                                                    placeholder="Event Date" type="date"
                                                    class="form-control form-control-sm">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label for="purpose" class="required">Purpose</label>
                                            <input required value="" id="purpose" name="purpose"
                                                placeholder="Enter purpose of Award" type="text"
                                                class="form-control form-control-sm">
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <div class="form-group">
                                                <label for="description" class="required">Description</label>
                                                <textarea id="description" placeholder="Enter Description..." name="description" class="form-control" required></textarea>
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
            $("#modalTitle").html("Add: Award Details");
            $("#btnSave").html("CREATE");
            $("#user_id").val(user_id);
        }
        $(document).ready(() => {
            $(document).on("click", ".editButton", (event) => {
                $('#formModal').modal('show');
                $("#modalTitle").html("Edit: Award Details");
                $("#btnSave").html("Update");

                let id = $(event.currentTarget).data("id");
                let user_id = $(event.currentTarget).data("user_id");
                let name = $(event.currentTarget).data("name");
                let event_date = $(event.currentTarget).data("event_date");
                let purpose = $(event.currentTarget).data("purpose");
                let description = $(event.currentTarget).data("description");

                $("#id").val(id);
                $("#user_id").val(user_id);
                $("#name").val(name);
                $("#event_date").val(event_date);
                $("#purpose").val(purpose);
                $("#description").val(description);
            });
        });
    </script>

@endpush
