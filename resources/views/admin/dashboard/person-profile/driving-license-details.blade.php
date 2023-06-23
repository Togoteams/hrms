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

                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="row py-3">
                                        <div class="text-left">
                                            {{-- <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#formModal" title="Add ">
                                                Add
                                            </button> --}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="pb-4">
                                            <div class="card p-3">
                                                <form method="POST"
                                                    action="{{ route('admin.person.profile.driving.license.details.update') }}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $data->id }}">
                                                    <div class="row">
                                                        <div class="col-10">
                                                            <div class="row text-dark">
                                                                <div class="col-3 fw-semibold pt-1">Driving License No:</div>
                                                                <div class="col-3 pt-1" id="licenseData">
                                                                    {{ $data->license_no }}</div>
                                                                <div class="col-3 margin-style d-none" id="inputData">
                                                                    <input required value="{{ $data->license_no }}"
                                                                        id="license_no" name="license_no"
                                                                        placeholder="Enter Driving License No"
                                                                        type="text" class="form-control form-control-sm">
                                                                </div>
                                                                <div class="col-2 margin-style d-none" id="formButton">
                                                                    <button class="btn btn-primary btn-sm">
                                                                        Update
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-2 text-end">
                                                            <div class="right-div">
                                                                <button type="button" class="btn btn-warning btn-sm bt"
                                                                    id="openButton" title="Edit" onclick="openForm()">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                                <div class="px-2 d-none" id="closeButton">
                                                                    <i class="bi bi-x-square-fill fs-2 text-danger pointer"
                                                                        title="Cancel" onclick="closeForm()"></i>
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

                    </div>
                    <!-- End Stats -->
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
        function openForm() {
            $("#inputData").removeClass("d-none");
            $("#formButton").removeClass("d-none");
            $("#closeButton").removeClass("d-none");
            $("#licenseData").addClass("d-none");
            $("#idData").addClass("d-none");
            $("#openButton").addClass("d-none");
        }

        function closeForm() {
            $("#licenseData").removeClass("d-none");
            $("#idData").removeClass("d-none");
            $("#openButton").removeClass("d-none");
            $("#inputData").addClass("d-none");
            $("#formButton").addClass("d-none");
            $("#closeButton").addClass("d-none");
        }
    </script>
@endpush
