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
                            <div class="col-xxl-2 col-xl-3  border border-1 border-color rounded py-4">
                                @include('admin.dashboard.person-profile.aside')
                                <div class="tab-pane fade ms-5 show active">
                                </div>
                            </div>
                            <div class="col-xl-8 col-xxl-9 border border-1 border-color rounded mx-3">

                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="row py-3">
                                        <div class="text-left">
                                            {{-- <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#formModal" title="Add ">
                                                Add
                                            </button> --}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="pb-4">
                                            <div class="card p-3">
                                                <div class="row">
                                                    <div class="col-10 text-dark">
                                                        @if (count($datas) > 0)
                                                            @foreach ($datas as $key => $data)
                                                                <div class="row">
                                                                    <div class="pb-4">
                                                                        <div class="card p-3">
                                                                            <div class="row">
                                                                                <div class="col-9">
                                                                                    <div class="row text-dark">
                                                                                        <div class="col-4 fw-semibold pt-1">Basic:</div>
                                                                                        <div class="col-6 pt-1">
                                                                                            {{ $data->basic }}
                                                                                        </div>

                                                                                        @foreach ($data->payroll_payscale_head as $head)
                                                                                        <div class="col-4 fw-semibold pt-1">{{ $head->payroll_head->name }}</div>
                                                                                        <div class="col-6 pt-1">
                                                                                            {{ $head->value }}
                                                                                        </div>
                                                                                        @endforeach
                                                                                        {{-- <div class="col-4 fw-semibold pt-1">Allowance</div>
                                                                                        <div class="col-6 pt-1">
                                                                                            {{ $data-> }}
                                                                                        </div>

                                                                                        <div class="col-4 fw-semibold pt-1">Others/Arrears</div>
                                                                                        <div class="col-6 pt-1">
                                                                                            {{ $data-> }}
                                                                                        </div>

                                                                                        <div class="col-4 fw-semibold pt-1">BoMaid</div>
                                                                                        <div class="col-6 pt-1">
                                                                                            {{ $data->}}
                                                                                        </div>

                                                                                        <div class="col-4 fw-semibold pt-1">Pension</div>
                                                                                        <div class="col-6 pt-1">
                                                                                            {{ $data-> }}
                                                                                        </div>

                                                                                        <div class="col-4 fw-semibold pt-1">Union Fee</div>
                                                                                        <div class="col-6 pt-1">
                                                                                            {{ $data-> }}
                                                                                        </div>

                                                                                        <div class="col-4 fw-semibold pt-1">Other Deductions</div>
                                                                                        <div class="col-6 pt-1">
                                                                                            {{ $data-> }}
                                                                                        </div>

                                                                                        <div class="col-4 fw-semibold pt-1">Tax</div>
                                                                                        <div class="col-6 pt-1">
                                                                                            {{ $data-> }}
                                                                                        </div> --}}

                                                                                        <div class="col-4 fw-semibold pt-1">Gross Earning</div>
                                                                                        <div class="col-6 pt-1">
                                                                                            {{ $data->gross_earning }}
                                                                                        </div>
                                                                                       
                                                                                        <div class="col-4 fw-semibold pt-1">Total Deduction</div>
                                                                                        <div class="col-6 pt-1">
                                                                                            {{ $data->total_deduction }}
                                                                                        </div>

                                                                                        <div class="col-4 fw-semibold pt-1">
                                                                                            Net Take Home:
                                                                                        </div>
                                                                                        <div class="col-6 pt-1">
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
                                                            <div class="card p-3 mb-5">No data to show</div>
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
