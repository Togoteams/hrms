@extends('layouts.app')
@push('styles')
@endpush
@section('content')
    <main id="content" role="main" class="main">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
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
                                    <div class="row">
                                        <div class="pb-4">
                                            <div class="card p-3">
                                                <form class="formsubmit" id="form_id" method="post"
                                                    action="{{ route('admin.person.profile.place.of.domicile.post') }}">
                                                    @csrf
                                                    <input type="hidden" name="id"
                                                        value="{{ !empty($data) ? $data->id : '' }}">

                                                    <div class="row">
                                                        <div class="col-10">
                                                            @if (!empty($data->place_of_domicile))
                                                                <div class="row text-dark showData">
                                                                    <div class="col-3 fw-semibold pt-1">
                                                                        Place Of Domicile
                                                                    </div>
                                                                    <div class="col-3 pt-1">
                                                                        {{ !empty($data) ? $data->place_of_domicile : '' }}
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <span id="noDataMsg">No data to show</span>
                                                            @endif
                                                            <div class="row text-dark addInputDiv d-none">
                                                                <div class="col-3 fw-semibold pt-1">
                                                                    <label for="place_of_domicile">
                                                                        Place of Domicile<small class="required-field">*</small>
                                                                    </label>
                                                                </div>
                                                                <div class="col-3 margin-style">
                                                                    <input
                                                                        value="{{ !empty($data) ? $data->place_of_domicile : '' }}"
                                                                        id="place_of_domicile" name="place_of_domicile"
                                                                        placeholder="Enter Place of Domicile" type="text"
                                                                        class="form-control form-control-sm">
                                                                </div>
                                                                <div class="col-2 margin-style" id="formButton">
                                                                    <button class="btn btn-white btn-sm">
                                                                        {{ !empty($data) ? 'Update' : 'Save' }}
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-2 text-end">
                                                            <div class="right-div">
                                                                @if (!empty($data->place_of_domicile))
                                                                    <button type="button" class="btn btn-warning btn-sm bt"
                                                                        id="openButton" title="Edit" onclick="openForm()">
                                                                        <i class="fas fa-edit"></i>
                                                                    </button>
                                                                @else
                                                                    <button type="button" class="btn btn-white btn-sm bt"
                                                                        id="addButton" title="Add"
                                                                        onclick="openAddForm()">
                                                                        Add
                                                                    </button>
                                                                @endif
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
                        <!-- End Stats -->
                    </div>

    </main>
@endsection
@push('custom-scripts')
    <script>
        function openForm() {
            $(".addInputDiv").removeClass("d-none");
            $(".showData").addClass("d-none");
            $("#closeButton").removeClass("d-none");
            $("#openButton").addClass("d-none");
        }

        function openAddForm() {
            $("#noDataMsg").addClass("d-none");
            $(".addInputDiv").removeClass("d-none");
            $("#addButton").addClass("d-none");
            $("#closeButton").removeClass("d-none");
        }

        function closeForm() {
            $(".showData").removeClass("d-none");
            $("#openButton").removeClass("d-none");
            $("#closeButton").addClass("d-none");
            $("#noDataMsg").removeClass("d-none");
            $(".addInputDiv").addClass("d-none");
            $("#addButton").removeClass("d-none");
        }
    </script>
@endpush
