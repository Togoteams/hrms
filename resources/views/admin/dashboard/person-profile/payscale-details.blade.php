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
                                            <div class="p-3 ">
                                                <div class="row">
                                                    <div class="col-10 text-dark">
                                                        @if (count($datas) > 0)
                                                            @foreach ($datas as $key => $data)
                                                                <div class="row">
                                                                    <div class="pb-4">
                                                                        <div class="p-3 ">
                                                                            <div class="row">
                                                                                <div class="col-9">
                                                                                    <div class="row text-dark">
                                                                                        <div class="pt-1 col-4 fw-semibold">Basic:</div>
                                                                                        <div class="pt-1 col-6">
                                                                                            {{ $data->basic }}
                                                                                        </div>

                                                                                        @foreach ($data->payroll_payscale_head as $head)
                                                                                        <div class="pt-1 col-4 fw-semibold">{{ $head->payroll_head->name }}</div>
                                                                                        <div class="pt-1 col-6">
                                                                                            {{ $head->value }}
                                                                                        </div>
                                                                                        @endforeach
                                                                                       
                                                                                        <div class="pt-1 col-4 fw-semibold">Gross Earning</div>
                                                                                        <div class="pt-1 col-6">
                                                                                            {{ $data->gross_earning }}
                                                                                        </div>
                                                                                       
                                                                                        <div class="pt-1 col-4 fw-semibold">Total Deduction</div>
                                                                                        <div class="pt-1 col-6">
                                                                                            {{ $data->total_deduction }}
                                                                                        </div>

                                                                                        <div class="pt-1 col-4 fw-semibold">
                                                                                            Net Take Home:
                                                                                        </div>
                                                                                        <div class="pt-1 col-6">
                                                                                            {{ $data->net_take_home }}
                                                                                        </div>

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @else
                                                            <div class="p-3 mb-5">No data  Available</div>
                                                        @endif
                                                        {{-- <div class="col-10 text-dark">
                                                            @if (count($data) > 0)
                                                            @foreach ($data as $key => $datas)

                                                                <div class="row">
                                                                    <div class="col-3 fw-semibold">Basic</div>
                                                                    <div class="col-7">
                                                                        {{ $datas->basic }}
                                                                    </div>
                                                                </div>
                                                                @endforeach
                                                            @else
                                                                No data to show
                                                            @endif
                                                        </div> --}}
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
