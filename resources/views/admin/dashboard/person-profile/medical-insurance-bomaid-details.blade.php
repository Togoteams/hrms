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
                    <span class="name-title">Personal Profile</span>
                    <div class="mt-5">
                        <div class="row d-flex align-items-start">
                            <div class="py-4 border rounded col-xxl-2 col-xl-3 border-1 border-color">
                                @include('admin.dashboard.person-profile.aside')
                                <div class="tab-pane fade ms-5 show active">
                                </div>
                            </div>
                            <div class="mx-3 border rounded col-xl-8 col-xxl-9 border-1 border-color">

                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="py-3 row">
                                        <div class="text-left">
                                            {{-- <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#formModal" title="Add ">
                                                Add
                                            </button> --}}
                                        </div>
                                    </div>
                                    <div class="pb-4 row">
                                        <div class="">
                                            <div class="p-3 card">
                                                <form class="formsubmit" id="form_id" method="post"
                                                    action="{{ route('admin.person.profile.medical.insurance.bomaid.details.update') }}">
                                                    @csrf
                                                    <input type="hidden" name="id"
                                                        value="{{ !empty($data) ? $data->id : '' }}">
                                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                    <div class="row">
                                                        <div class="col-10 text-dark">
                                                            @if (!empty($data))
                                                                <div class="row showData">
                                                                    <div class="pt-1 col-3 fw-semibold">
                                                                        Insurance Company Name
                                                                    </div>
                                                                    <div class="pt-1 col-3">
                                                                        {{ $data->company_name }}
                                                                    </div>
                                                                </div>
                                                                <div class="row showData">
                                                                    <div class="pt-3 col-3 fw-semibold">Insurance ID</div>
                                                                    <div class="pt-3 col-3">
                                                                        {{ $data->insurance_id }}
                                                                    </div>
                                                                </div>
                                                                <div class="row showData">
                                                                    <div class="pt-3 col-3 fw-semibold">Insurance card Type</div>
                                                                    <div class="pt-3 col-3">
                                                                        {{ $data->medicalCard->name }}                                                                    </div>
                                                                </div>
                                                            @else
                                                                <span id="noDataMsg">No data to show</span>
                                                            @endif
                                                            <div class="row addInputDiv d-none">
                                                                <div class="pt-1 col-3 fw-semibold">
                                                                    Insurance Company Name<small
                                                                        class="required-field">*</small>
                                                                </div>
                                                                <div class="col-3 margin-style">
                                                                    <input type="text" name="company_name"
                                                                        id="company_name"
                                                                        placeholder="Enter Insurance Company Name"
                                                                        class="form-control form-control-sm"
                                                                        value="{{ !empty($data) ? $data->company_name : '' }}">
                                                                </div>
                                                            </div>
                                                            <div class="row addInputDiv d-none">
                                                                <div class="pt-3 col-3 fw-semibold">
                                                                    Insurance ID<small class="required-field">*</small>
                                                                </div>
                                                                <div class="pt-2 col-3 margin-style">
                                                                    <input type="number" name="insurance_id"
                                                                        id="insurance_id"
                                                                        placeholder="Enter Insurance Company Name"
                                                                        class="form-control form-control-sm"
                                                                        value="{{ !empty($data) ? $data->insurance_id : '' }}">
                                                                </div>
                                                                {{-- <div class="pt-2 col-2 margin-style">
                                                                    <button class="btn btn-white btn-sm">
                                                                        {{ !empty($data) ? 'Update' : 'Save' }}
                                                                    </button>
                                                                </div> --}}
                                                            </div>

                                                            <div class="row addInputDiv d-none">
                                                                <div class="pt-3 col-3 fw-semibold">
                                                                    Insurance card Type<small class="required-field">*</small>
                                                                </div>
                                                                <div class="pt-2 col-3 margin-style">
                                                                    {{-- <input type="number" name="insurance_id"
                                                                        id="insurance_id"
                                                                        placeholder="Enter Insurance Company Name"
                                                                        class="form-control form-control-sm"
                                                                        value="{{ !empty($data) ? $data->insurance_id : '' }}"> --}}
                                                                        <select name="medical_card_id" class="form-control" id="medical_card_id" placeholder="Employee department">
                                                                            <option value="">Select Option</option>
                                                                            @foreach($card as $cardData)
                                                                                <option value="{{ $cardData->id }}" {{ !empty($data) && $data->medical_card_id == $cardData->id ? 'selected' : '' }}>
                                                                                    {{ $cardData->name }}
                                                                                </option>
                                                                            @endforeach 
                                                                        </select>
                                                                </div>

                                                                <div class="pt-2 col-2 margin-style">
                                                                    <button class="btn btn-white btn-sm">
                                                                        {{ !empty($data) ? 'Update' : 'Save' }}
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-2 text-end">
                                                            <div class="right-div">
                                                                @if (!empty($data))
                                                                    <button type="button" class="btn btn-edit btn-sm bt"
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
                                                                <div class="px-2 pt-2 d-none" id="closeButton">
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
