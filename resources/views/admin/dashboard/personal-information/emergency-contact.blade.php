@extends('layouts.app')
@push('styles')
@endpush
@section('content')
    <style>
        .margin-style {
            margin-top: -8px;
            margin-left: -15px;
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
                    <span class="name-title">Personal Information</span>
                    <div class="mt-5">
                        <div class="row d-flex align-items-start">
                            <div class="col-xxl-2 col-xl-3  border border-1 border-color rounded py-4">
                                @include('admin.dashboard.personal-information.aside')
                                <div class="tab-pane fade ms-5 show active">
                                </div>
                            </div>
                            <div class="col-6 border border-1 border-color rounded  mx-3">

                                <div class="tab-content" id="v-pills-tabContent">

                                    <div class=" ">
                                        <div class="container mt-2 mb-2 ms-1">
                                            <form id="form_edit" method="POST"
                                                action="{{ route('admin.personal.info.emergency.contact.post') }}">
                                                @csrf
                                                <input type="hidden" id="id" name="id" value="{{ $data->id }}">
                                                <div class="row">
                                                    <div class="col-md-10 py-4">
                                                        {{-- @if (!empty($data->emergency_contact)) --}}
                                                            <div class="left-div">
                                                                <div class="row text-dark">
                                                                    <div class="col-4 fw-semibold" id="labelData">Emergerncy Mobile:
                                                                    </div>
                                                                    <div class="col-6" id="contactData">
                                                                        {{ $data->emergency_contact }}</div>
                                                                    <div class="col-6 margin-style d-none" id="inputData">
                                                                        <input required id="emergency_contact"
                                                                            placeholder="Enter correct Emergency Contact No."
                                                                            value="{{ $data->emergency_contact }}"
                                                                            type="number" name="emergency_contact"
                                                                            class="form-control form-control-sm ">
                                                                    </div>
                                                                    <div class="col-2 margin-style d-none" id="formButton">
                                                                        <button onclick="ajaxCall('form_edit','','POST')"
                                                                            type="button" class="btn btn-primary btn-sm">
                                                                            Update
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        {{-- @endif --}}
                                                    </div>
                                                    <div class="col-md-2 text-end">
                                                        <div class="pt-2">
                                                            <!-- Your content for right div goes here -->
                                                            @if (!empty($data->emergency_contact))
                                                                <button class="btn btn-warning btn-sm bt" id="editButton"
                                                                    type="button" title="Edit" onclick="openForm()">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                            @else
                                                                <button class="btn btn-primary btn-sm bt" id="addButton"
                                                                    type="button" onclick="openForm()">
                                                                    Add
                                                                </button>
                                                            @endif
                                                            <i class="bi bi-x-square-fill fs-2 text-danger pointer d-none"
                                                                title="Cancel" id="closeButton" onclick="closeForm()"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        {{-- <div class="container mt-2 mb-2 ms-1 d-none" id="formDiv">
                                            <form id="form_edit"
                                                action="{{ route('admin.personal.info.emergency.contact.update', $data->id) }}">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-10 py-4">
                                                        <div class="left-div">
                                                            <div class="row">
                                                                <div class="col-4">Emergency Mobile:</div>
                                                                <div class="col-5">
                                                                    <input required id="emergency_contact"
                                                                        placeholder="Enter correct Emergency Contact No."
                                                                        value="{{ $data->emergency_contact }}"
                                                                        type="number" name="emergency_contact"
                                                                        class="form-control form-control-sm ">
                                                                </div>
                                                                <div class="col-3">
                                                                    <button onclick="ajaxCall('form_edit','','POST')"
                                                                        type="button"
                                                                        class="btn btn-primary btn-sm">Update</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 text-end">
                                                        <div class="pt-4 px-2">
                                                            <i class="bi bi-x-square-fill fs-2 text-danger pointer"
                                                                title="Cancel" onclick="closeForm()"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- End Stats -->
                </div>
                {{-- edit form model start --}}
                <!-- Modal -->
                {{-- <div class="modal fade" id="modaledit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content ">
                            <div class="modal-header ">
                                <h5 class="modal-title" id="staticBackdropLabel">Edit {{ $page }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="edit">
                                <form id="form_edit"
                                    action="{{ route('admin.personal.info.emergency.contact.update', $data->id) }}">
                                    @csrf

                                    <div class="row">
                                        <div class="col-sm-6 mb-2">
                                            <div class="form-group">
                                                <label for="emergency_contact">Emergency Contact No. </label>
                                                <input required id="emergency_contact"
                                                    placeholder="Enter correct Emergency Contact No."
                                                    value="{{ $data->emergency_contact }}" type="number"
                                                    name="emergency_contact" class="form-control form-control-sm ">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="text-center ">
                                        <button onclick="ajaxCall('form_edit','','POST')" type="button"
                                            class="btn btn-primary">Update
                                            {{ $page }}</button>
                                    </div>
                                </form>

                            </div>

                        </div>
                    </div>
                </div> --}}
    </main>
@endsection
@push('custom-scripts')
    {{-- <script>
        function openForm() {
            $("#formDiv").removeClass("d-none");
            $("#closeButton").removeClass("d-none");
            $("#editButton").addClass("d-none");
            $("#addButton").addClass("d-none");
        }

        function closeForm() {
            $("#formDiv").addClass("d-none");
            $("#closeButton").addClass("d-none");
            $("#editButton").removeClass("d-none");
            $("#addButton").removeClass("d-none");
        }
    </script> --}}

    <script>
        function openForm() {
            $("#inputData").removeClass("d-none");
            $("#formButton").removeClass("d-none");
            $("#closeButton").removeClass("d-none");
            $("#contactData").addClass("d-none");
            $("#editButton").addClass("d-none");
            $("#addButton").addClass("d-none");
        }

        function closeForm() {
            $("#contactData").removeClass("d-none");
            $("#inputData").addClass("d-none");
            $("#formButton").addClass("d-none");
            $("#closeButton").addClass("d-none");
            $("#editButton").removeClass("d-none");
            $("#addButton").removeClass("d-none");
        }
    </script>
@endpush
