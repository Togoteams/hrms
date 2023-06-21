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
                                                        @if (!empty($data->id))
                                                            <div class="row text-dark">
                                                                @if (!empty($data->passport_no))
                                                                    <div class="col-4 fw-semibold">Passport No:</div>
                                                                    <div class="col-6">{{ $data->passport_no ?? '' }}</div>

                                                                    <div class="col-4 fw-semibold">Expiry Date:</div>
                                                                    <div class="col-6">
                                                                        {{ !empty($data->passport_expiry) ? date_format(date_create_from_format('Y-m-d', $data->passport_expiry), 'd/m/Y') : '' }}
                                                                    </div>
                                                                @endif

                                                                <br><br>

                                                                @if (!empty($data->omang_no))
                                                                    <div class="col-4 fw-semibold">OMANG No:</div>
                                                                    <div class="col-6">{{ $data->omang_no ?? '' }}</div>

                                                                    <div class="col-4 fw-semibold">Expiry Date:</div>
                                                                    <div class="col-6">
                                                                        {{ !empty($data->omang_expiry) ? date_format(date_create_from_format('Y-m-d', $data->omang_expiry), 'd/m/Y') : '' }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-2 text-end">
                                                    <div class="pt-2">
                                                        <!-- Your content for right div goes here -->
                                                        @if (!empty($data->id))
                                                            <button class="btn btn-warning btn-sm bt" data-bs-toggle="modal"
                                                                data-bs-target="#modaledit">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                        @else
                                                            <button type="button" class="btn btn-primary btn-sm"
                                                                title="Add" data-bs-toggle="modal"
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
                                <h5 class="modal-title" id="staticBackdropLabel">Edit {{ $page }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="edit">
                                <form id="form_edit" action="{{ route('admin.personal.info.passport.update') }}">
                                    @csrf
                                    <input type="hidden" id="id" name="id" value="{{ $data->id ?? '' }}">
                                    <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
                                    <div class="row">
                                        <div class="col-sm-6 mb-2">
                                            <div class="form-group">
                                                <label for="passport_no">Passport No. </label>
                                                <input id="passport_no" placeholder="Enter Passport No." type="number"
                                                    value="{{ $data->passport_no ?? '' }}" name="passport_no"
                                                    class="form-control form-control-sm ">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-2">
                                            <div class="form-group">
                                                <label for="passport_expiry">Passport Expiry </label>
                                                <input id="passport_expiry" placeholder="Enter Date of Passport Expiry"
                                                    type="date" value="{{ $data->passport_expiry ?? '' }}"
                                                    name="passport_expiry" class="form-control form-control-sm ">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-2">
                                            <div class="form-group">
                                                <label for="omang_no">OMANG No. </label>
                                                <input id="omang_no" placeholder="Enter omang No." type="number"
                                                    value="{{ $data->omang_no ?? '' }}" name="omang_no"
                                                    class="form-control form-control-sm ">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-2">
                                            <div class="form-group">
                                                <label for="omang_expiry">OMANG Expiry </label>
                                                <input id="omang_expiry" placeholder="Enter Date of OMANG Expiry"
                                                    type="date" value="{{ $data->omang_expiry ?? '' }}"
                                                    name="omang_expiry" class="form-control form-control-sm ">
                                                </select>
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
