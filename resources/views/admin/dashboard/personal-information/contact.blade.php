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
                                            <div class="row">
                                                <div class="col-md-10 py-4">
                                                    <div class="left-div">
                                                        <div class="row text-dark">
                                                            <div class="col-3 fw-semibold">Email</div>
                                                            <div class="col-7">{{ $data->user->email }}</div>

                                                            <div class="col-3 fw-semibold">Mobile</div>
                                                            <div class="col-7">{{ $data->user->mobile }}</div>

                                                            <div class="col-3 fw-semibold">Emergency Mobile</div>
                                                            <div class="col-7">{{ $data->emergency_contact }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 text-end">
                                                    <div class="pt-2">
                                                        <!-- Your content for right div goes here -->
                                                        {{-- <button class="btn btn-warning btn-sm bt" data-bs-toggle="modal" data-bs-target="#modaledit"> --}}
                                                        <button class="btn btn-warning btn-sm bt" id="editButton"
                                                            onclick="openForm()">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <i class="bi bi-x-square-fill fs-2 text-danger pointer d-none"
                                                            title="Cancel" id="closeButton" onclick="closeForm()"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container mt-2 mb-2 ms-1 d-none" id="formDiv">
                                            <form id="form_edit" action="{{ route('admin.personal.info.contact.update') }}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $data->id ?? '' }}">
                                                <input type="hidden" name="user_id" value="{{ $data->user_id ?? '' }}">
                                                <div class="row text-dark">
                                                    <div class="col-md-10 py-4">
                                                        <div class="left-div">
                                                            <div class="row">
                                                                <div class="col-3 pt-2 fw-semibold">Email</div>
                                                                <div class="col-3">
                                                                    <input required id="email"
                                                                        placeholder="Enter correct email   "
                                                                        value="{{ $data->user->email }}" type="email"
                                                                        name="email"
                                                                        class="form-control form-control-sm ">
                                                                </div>
                                                                <div class="col-2">
                                                                </div>
                                                            </div>
                                                            <div class="row pt-2">
                                                                <div class="col-3 pt-2 fw-semibold">Mobile No
                                                                    <small class="required-field">*</small>
                                                                    </div>
                                                                <div class="col-3">
                                                                    <input required id="mobile"
                                                                        placeholder="Enter correct Mobile No   "
                                                                        value="{{ $data->user->mobile }}" type="number"
                                                                        name="mobile"
                                                                        class="form-control form-control-sm ">
                                                                </div>
                                                                <div class="col-2">
                                                                </div>
                                                            </div>
                                                            <div class="row pt-2">
                                                                <div class="col-3 pt-2 fw-semibold">Emergerncy Mobile</div>
                                                                <div class="col-3">
                                                                    <input required id="emergency_contact"
                                                                        placeholder="Enter correct Emergency Contact No."
                                                                        value="{{ $data->emergency_contact }}"
                                                                        type="number" name="emergency_contact"
                                                                        class="form-control form-control-sm ">
                                                                </div>
                                                                <div class="col-2">
                                                                    <button onclick="ajaxCall('form_edit','','POST')"
                                                                        type="button"
                                                                        class="btn btn-primary btn-sm">Update</button>
                                                                </div>
                                                                <div class="col-2 text-end">
                                                                    <div class=" px-2">
                                                                        {{-- <i class="bi bi-x-square-fill fs-2 text-danger pointer"
                                                                            title="Cancel" onclick="closeForm()"></i> --}}
                                                                    </div>
                                                                </div>
                                                            </div>
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
            $("#formDiv").removeClass("d-none");
            $("#closeButton").removeClass("d-none");
            $("#editButton").addClass("d-none");
        }

        function closeForm() {
            $("#formDiv").addClass("d-none");
            $("#closeButton").addClass("d-none");
            $("#editButton").removeClass("d-none");
        }
    </script>
@endpush
