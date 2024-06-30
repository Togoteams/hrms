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
                                    <div class="row">
                                        <div class="pb-4">
                                            <div class="p-3 card">
                                                <div class="row">
                                                    <div class="col-10">
                                                        <div class="row text-dark">
                                                            <div class="col-3 fw-semibold">Employment Type</div>
                                                            <div class="col-7">
                                                                @php
                                                                    $employment_type = $data->employment_type;
                                                                    $employeeType = "Permanent";
                                                                    if($employment_type=='local-contractual')
                                                                    {
                                                                        $employeeType = "Local Contractual";
                                                                    }elseif($employment_type=='local') {
                                                                        # code...
                                                                        $employeeType = "Local Permanent";
                                                                    }else {
                                                                        # code...
                                                                        $employeeType = $data->employment_typ;
                                                                    }
                                                                @endphp
                                                                {{ ucfirst($employeeType) }}
                                                            </div>

                                                            @if ($data->employment_type == 'local-contractual' && !empty($data->contract_duration))
                                                                <div class="col-3 fw-semibold">Contract Duration</div>
                                                                <div class="col-7">
                                                                    {{ $data->contract_duration }} Months
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-2 text-end">
                                                        <div class="right-div">
                                                            <!-- Your content for right div goes here -->

                                                            {{-- <button class="btn btn-edit btn-sm bt" data-bs-toggle="modal"
                                                                title="Edit">
                                                                <i class="fas fa-edit"></i>
                                                            </button> --}}
                                                        </div>
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

    </main>
@endsection
@push('custom-scripts')
@endpush
