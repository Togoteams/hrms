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
                                                    @if (!empty($data))
                                                        <div class="row left-div text-dark">
                                                            <div class="col-2 fw-semibold">City</div>
                                                            <div class="col-4">{{ ucfirst($data ? $data->city : '') }}</div>
                                                            <div class="col-2 fw-semibold">State</div>
                                                            <div class="col-4">{{ ucfirst($data ? $data->state : '') }}</div>
                                                            <div class="col-2 fw-semibold">Country</div>
                                                            <div class="col-4">{{ $data ? $data->country : '' }}</div>
                                                            <div class="col-2 fw-semibold">Zip</div>
                                                            <div class="col-4">{{ $data ? $data->zip : '' }}</div>
                                                            <div class="col-2 fw-semibold">Address</div>
                                                            <div class="col-4">{{ ucfirst($data ? $data->address : '') }}</div>
                                                        </div>
                                                    @else
                                                        No data to show
                                                    @endif
                                                </div>
                                                <div class="col-md-2 text-end">
                                                    <div class="right-div">
                                                        <!-- Your content for right div goes here -->
                                                        @if (!empty($data->id))
                                                            <button class="btn btn-edit btn-sm bt" data-bs-toggle="modal"
                                                                data-bs-target="#modaledit">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                        @else
                                                            <button class="btn btn-white btn-sm bt" data-bs-toggle="modal"
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
                                        <div class="mb-2 col-md-12">
                                            <div class="form-group">
                                                <label for="address">Address<small class="required-field">*</small></label>
                                                <textarea required id="address" placeholder="Enter Address" name="address" class="form-control">{{ $data ? $data->address : '' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="mb-2 col-md-6">
                                            <div class="form-group">
                                                <label for="zip">Zip<small class="required-field">*</small></label>
                                                <input required id="zip" placeholder="Enter Name of Zip"
                                                    type="text" name="zip"
                                                    pattern="[0-9]+"
                                                    maxlength="10"
                                                    minlength="5" class="form-control"
                                                    value="{{ $data ? $data->zip : '' }}">
                                            </div>
                                        </div>
                                        <div class="mb-2 col-md-6">
                                            <div class="form-group">
                                                <label for="city">City<small class="required-field">*</small></label>
                                                <input required id="city" placeholder="Enter Name of City"
                                                    type="text" name="city" class="form-control"
                                                    value="{{ $data ? $data->city : '' }}">
                                            </div>
                                        </div>
                                        <div class="mb-2 col-md-6">
                                            <div class="form-group">
                                                <label for="state">State<small class="required-field">*</small></label>
                                                <input required id="state" placeholder="Enter Name of State"
                                                    type="text" name="state" class="form-control"
                                                    value="{{ $data ? $data->state : '' }}">
                                            </div>
                                        </div>
                                        <div class="mb-2 col-md-6">
                                            <div class="form-group">
                                                <label for="country">Country<small class="required-field">*</small></label>
                                                <select name="country" id="country" class="form-control" required>
                                                    <option value="">- Select Country -</option>
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country->name }}"
                                                            {{ $data && $data->country == $country->name ? 'selected' : '' }}>
                                                            {{ $country->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="text-center ">
                                        <button onclick="ajaxCall('form_edit','','POST')" type="button"
                                            class="btn btn-white">Update
                                            {{ $page }}</button>
                                    </div>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>
    </main>
@endsection
