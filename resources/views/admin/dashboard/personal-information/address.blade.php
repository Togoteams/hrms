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
                                                    @if (!empty($data))
                                                        <div class="row left-div text-dark">
                                                            <div class="col-2 fw-semibold">City</div>
                                                            <div class="col-4">{{ $data ? $data->city : '' }}</div>
                                                            <div class="col-2 fw-semibold">State</div>
                                                            <div class="col-4">{{ $data ? $data->state : '' }}</div>
                                                            <div class="col-2 fw-semibold">Country</div>
                                                            <div class="col-4">{{ $data ? $data->country : '' }}</div>
                                                            <div class="col-2 fw-semibold">Zip</div>
                                                            <div class="col-4">{{ $data ? $data->zip : '' }}</div>
                                                            <div class="col-2 fw-semibold">Address</div>
                                                            <div class="col-4">{{ $data ? $data->address : '' }}</div>
                                                        </div>
                                                    @else
                                                        No data to show
                                                    @endif
                                                </div>
                                                <div class="col-md-2 text-end">
                                                    <div class="right-div">
                                                        <!-- Your content for right div goes here -->
                                                        @if (!empty($data->id))
                                                            <button class="btn btn-warning btn-sm bt" data-bs-toggle="modal"
                                                                data-bs-target="#modaledit">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                        @else
                                                            <button class="btn btn-primary btn-sm bt" data-bs-toggle="modal"
                                                                data-bs-target="#modaledit">
                                                                Add
                                                            </button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
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
                <div class="modal fade" id="modaledit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content ">
                            <div class="modal-header ">
                                <h5 class="modal-title" id="staticBackdropLabel">
                                    {{ !empty($data->id) ? 'Edit' : 'Add' }} {{ $page }}
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="edit">
                                <form id="form_edit" action="{{ route('admin.personal.info.address.post') }}">
                                    @csrf
                                    <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" id="id" name="id" value="{{ $data->id ?? '' }}">
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <div class="form-group">
                                                <label for="address">Address<small class="required-field">*</small></label>
                                                <textarea required id="address" placeholder="Enter Address" name="address" class="form-control">{{ $data ? $data->address : '' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <div class="form-group">
                                                <label for="zip">Zip<small class="required-field">*</small></label>
                                                <input required id="zip" placeholder="Enter Name of Zip"
                                                    type="text" name="zip" class="form-control"
                                                    value="{{ $data ? $data->zip : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <div class="form-group">
                                                <label for="city">City<small class="required-field">*</small></label>
                                                <input required id="city" placeholder="Enter Name of City"
                                                    type="text" name="city" class="form-control"
                                                    value="{{ $data ? $data->city : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <div class="form-group">
                                                <label for="state">State<small class="required-field">*</small></label>
                                                <input required id="state" placeholder="Enter Name of State"
                                                    type="text" name="state" class="form-control"
                                                    value="{{ $data ? $data->state : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <div class="form-group">
                                                <label for="country">Country<small class="required-field">*</small></label>
                                                <input required id="country" placeholder="Enter Name of Country"
                                                    type="text" name="country" class="form-control"
                                                    value="{{ $data ? $data->country : '' }}">
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
                </div>
    </main>
@endsection
