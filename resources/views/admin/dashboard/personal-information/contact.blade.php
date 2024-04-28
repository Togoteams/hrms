@extends('layouts.app')
@push('styles')
@endpush
@section('content')
    <main id="content" role="main" class="main">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">

                    <!-- End Col -->
                    <!-- End Page Header -->

                    <!-- Stats -->
                    <span class="name-title">Personal Information</span>
                    <div class="mt-5">
                        <div class="row d-flex align-items-start">
                            <div class="py-4 border rounded col-xxl-2 col-xl-3 border-1 border-color">
                                @include('admin.dashboard.personal-information.aside')
                                <div class="tab-pane fade ms-5 show active">
                                </div>
                            </div>
                            <div class="mx-3 border rounded col-xxl-9 col-xl-8 border-1 border-color">

                                <div class="tab-content" id="v-pills-tabContent">

                                    <div class="">
                                        <div class="container mt-2 mb-2 ms-1">
                                            <div class="row">
                                                <div class="py-4 col-md-10">
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
                                                    
                                                        {{-- <button class="btn btn-edit btn-sm bt" id="editButton"
                                                            onclick="openForm()">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <i class="bi bi-x-square-fill fs-2 text-danger pointer d-none"
                                                            title="Cancel" id="closeButton" onclick="closeForm()"></i> --}}
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
                                                    <div class="py-4 col-md-10">
                                                        <div class="left-div">
                                                            <div class="row">
                                                                <div class="pt-2 col-3 fw-semibold">Email</div>
                                                                <div class="col-7">
                                                                    <input required id="email"
                                                                        placeholder="Enter correct email   "
                                                                        value="{{ $data->user->email }}" type="email"
                                                                        name="email"
                                                                        class="form-control form-control-sm ">
                                                                </div>
                                                                <div class="col-2">
                                                                </div>
                                                            </div>
                                                            <div class="pt-2 row">
                                                                <div class="pt-2 col-3 fw-semibold">Mobile No
                                                                    <small class="required-field">*</small>
                                                                    </div>
                                                                <div class="col-7">
                                                                    <input required id="mobile"
                                                                        placeholder="Enter correct Mobile No   "
                                                                        value="{{ $data->user->mobile }}" type="number"
                                                                        name="mobile"
                                                                        class="form-control form-control-sm ">
                                                                </div>
                                                                <div class="col-2">
                                                                </div>
                                                            </div>
                                                            <div class="pt-2 row">
                                                                <div class="pt-2 col-3 fw-semibold">Emergerncy Mobile</div>
                                                                <div class="col-7">
                                                                    <input required id="emergency_contact"
                                                                        placeholder="Enter correct Emergency Contact No."
                                                                        value="{{ $data->emergency_contact }}"
                                                                        type="number" name="emergency_contact"
                                                                        class="form-control form-control-sm ">
                                                                </div>
                                                                <div class="col-2">
                                                                    <button onclick="ajaxCall('form_edit','','POST')"
                                                                        type="button"
                                                                        class="btn btn-white btn-sm">Update</button>
                                                                </div>
                                                                <div class="col-2 text-end">
                                                                    <div class="px-2 ">
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
