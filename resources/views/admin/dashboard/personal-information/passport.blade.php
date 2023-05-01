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
                    <div class="mt-5">

                        <div class="d-flex align-items-start">
                            @include('admin.dashboard.personal-information.aside')
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade ms-5 show active">

                                    <div class="border border-1 border-color rounded">
                                        <div class="container mt-2 mb-2 ms-1">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <div class="left-div">
                                                        <div class="row">
                                                            <div class="col-4">Gender:</div>
                                                            <div class="col-8">{{ $data->gender }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 text-end">
                                                    <div class="right-div">
                                                        <!-- Your content for right div goes here -->
                                                        <button class="btn btn-warning btn-sm bt" data-bs-toggle="modal"
                                                            data-bs-target="#modaledit">
                                                            <i class="fas fa-edit"></i></button>
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
                                <form id="form_edit" action="{{ route('admin.personal.info.passport.update', $data->id) }}">
                                    @csrf

                                    <div class="row">
                                        <div class="col-sm-6 mb-2">
                                            <div class="form-group">
                                                <label for="gender">Gender </label>
                                                <select required id="gender" placeholder="Enter correct gender"
                                                    name="gender" class="form-control form-control-sm ">
                                                    <option disabled> - Select Gender- </option>
                                                    <option {{ $data->gender == 'male' ? 'selected' : '' }} value="male">
                                                        Male
                                                    </option>
                                                    <option {{ $data->gender == 'female' ? 'selected' : '' }}
                                                        value="female">
                                                        Female</option>
                                                    <option {{ $data->gender == 'others' ? 'selected' : '' }}
                                                        value="others">
                                                        others</option>
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
