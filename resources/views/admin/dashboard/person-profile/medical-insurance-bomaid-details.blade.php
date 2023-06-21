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
                                        <div class="text-right">
                                            {{-- <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#formModal" title="Add ">
                                                Add
                                            </button> --}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-10 col-xxl-8 pb-4">
                                            <div class="card p-3">
                                                <form method="POST"
                                                    action="{{ route('admin.person.profile.medical.insurance.bomaid.details.update') }}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $data->id }}">
                                                    <div class="row">
                                                        <div class="col-10">
                                                            <div class="row text-dark">
                                                                <div class="col-4 fw-semibold pt-1">Insurance Company Name:</div>
                                                                <div class="col-6 pt-1" id="nameData">
                                                                    {{ $data->company_name }}</div>
                                                                <div class="col-6 margin-style d-none" id="inputData1">
                                                                    <input required value="{{ $data->company_name }}"
                                                                        id="company_name" name="company_name"
                                                                        placeholder="Enter Insurance Company Name"
                                                                        type="text" class="form-control form-control-sm">
                                                                </div>

                                                                <div class="col-4 fw-semibold pt-3">Insurance ID:</div>
                                                                <div class="col-6 pt-3" id="idData">
                                                                    {{ $data->insurance_id }}</div>
                                                                <div class="col-6 pt-2 margin-style d-none" id="inputData2">
                                                                    <input required value="{{ $data->insurance_id }}"
                                                                        id="insurance_id" name="insurance_id"
                                                                        placeholder="Enter Insurance Company Name"
                                                                        type="number" class="form-control form-control-sm">
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
                                                                <div class="pt-2 px-2 d-none" id="closeButton">
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
            $("#inputData1").removeClass("d-none");
            $("#inputData2").removeClass("d-none");
            $("#formButton").removeClass("d-none");
            $("#closeButton").removeClass("d-none");
            $("#nameData").addClass("d-none");
            $("#idData").addClass("d-none");
            $("#openButton").addClass("d-none");
        }

        function closeForm() {
            $("#nameData").removeClass("d-none");
            $("#idData").removeClass("d-none");
            $("#openButton").removeClass("d-none");
            $("#inputData1").addClass("d-none");
            $("#inputData2").addClass("d-none");
            $("#formButton").addClass("d-none");
            $("#closeButton").addClass("d-none");
        }
    </script>
@endpush
