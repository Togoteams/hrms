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
                            <div class="col-xxl-9 col-xl-8 border border-1 border-color rounded  mx-3">

                                <div class="tab-content" id="v-pills-tabContent">

                                    <div class=" ">
                                        <div class="container mt-2 mb-2 ms-1">
                                            <form id="form_edit" method="POST"
                                                action="{{ route('admin.personal.info.emergency.contact.post') }}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ !empty($data) ? $data->id : '' }}">
                                                <div class="row">
                                                    <div class="col-md-10 py-4">
                                                        @if (!empty($data->emergency_contact))
                                                            <div class="left-div">
                                                                <div class="row text-dark">
                                                                    <div class="col-3 fw-semibold" id="labelData">Emergerncy
                                                                        Mobile:
                                                                    </div>
                                                                    <div class="col-3" id="contactData">
                                                                        {{ $data->emergency_contact }}</div>
                                                                    <div class="col-3 margin-style d-none" id="inputData">
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
                                                        @else
                                                            <span id="ndts">No data to show</span>
                                                            <div class="left-div d-none" id="addForm">
                                                                <div class="row text-dark">
                                                                    <div class="col-3 fw-semibold">Emergerncy
                                                                        Mobile:
                                                                    </div>
                                                                    <div class="col-3 margin-style">
                                                                        <input required id="emergency_contact"
                                                                            placeholder="Enter correct Emergency Contact No."
                                                                            value="{{ $data->emergency_contact }}"
                                                                            type="number" name="emergency_contact"
                                                                            class="form-control form-control-sm ">
                                                                    </div>
                                                                    <div class="col-2 margin-style">
                                                                        <button onclick="ajaxCall('form_edit','','POST')"
                                                                            type="button" class="btn btn-primary btn-sm">
                                                                            Update
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
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
                                                                    type="button" onclick="openAddForm()">
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
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- End Stats -->
                </div>
    </main>
@endsection
@push('custom-scripts')

    <script>
        function openForm() {
            $("#inputData").removeClass("d-none");
            $("#formButton").removeClass("d-none");
            $("#closeButton").removeClass("d-none");
            $("#contactData").addClass("d-none");
            $("#editButton").addClass("d-none");
        }

        function openAddForm() {
            $("#ndts").addClass("d-none");
            $("#addForm").removeClass("d-none");
            $("#addButton").addClass("d-none");
            $("#closeButton").removeClass("d-none");
        }

        function closeForm() {
            $("#contactData").removeClass("d-none");
            $("#inputData").addClass("d-none");
            $("#formButton").addClass("d-none");
            $("#closeButton").addClass("d-none");
            $("#editButton").removeClass("d-none");
            $("#addButton").removeClass("d-none");
            $("#addForm").addClass("d-none");
            $("#ndts").removeClass("d-none");
        }
    </script>
@endpush
