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
                            <div class="col-6 border border-1 border-color rounded  mx-3">

                                <div class="tab-content" id="v-pills-tabContent">

                                    <div class=" ">
                                        <div class="container mt-2 mb-2 ms-1">
                                            <div class="row">
                                                <div class="col-md-10 py-4">
                                                    <div class="left-div">
                                                        <div class="row">
                                                            <div class="col-5">Emergerncy Mobile:</div>
                                                            <div class="col-7">{{ $data->emergency_contact }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 text-end">
                                                    <div class="pt-2">
                                                        <!-- Your content for right div goes here -->
                                                        {{-- <button class="btn btn-warning btn-sm bt" data-bs-toggle="modal" data-bs-target="#modaledit"> --}}
                                                        <button class="btn btn-warning btn-sm bt" onclick="openForm()">
                                                            <i class="fas fa-edit"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container mt-2 mb-2 ms-1 d-none" id="formDiv">
                                            <form id="form_edit"
                                                action="{{ route('admin.personal.info.emergency.contact.update', $data->id) }}">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-10 py-4">
                                                        <div class="left-div">
                                                            <div class="row">
                                                                <div class="col-4">Emergency Contact No.:</div>
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
                                        </div>
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
    <script>
        function openForm() {
            $("#formDiv").removeClass("d-none");
        }

        function closeForm() {
            $("#formDiv").addClass("d-none");
        }
    </script>
@endpush
