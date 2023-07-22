@extends('layouts.app')
@push('styles')
@endpush
@section('content')
    <main id="content" role="main" class="main">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <span class="name-title">Employee Form</span>
                    <div class="mt-5">
                        <div class="row d-flex align-items-start">
                            <div class="col-xxl-2 col-xl-3  border border-1 border-color rounded py-4">
                                @include('admin.employees.add-aside')
                                <div class="tab-pane fade ms-5 show active">
                                </div>
                            </div>
                            <div class="col-xl-8 col-xxl-9 border border-1 border-color rounded mx-3">

                                <div class="tab-content" id="v-pills-tabContent">
                                    <form id="form_id" class="formsubmit" method="post"
                                        action="{{ route('admin.employee.passportOmang.post') }}">
                                        @csrf
                                        <input type="hidden" name="id"
                                            value="{{ $employee ? ($employee->passportOmang ? $employee->passportOmang->id : '') : '' }}">
                                        <input type="hidden" name="user_id"
                                            value="{{ !empty($employee) ? $employee->user_id : '' }}">

                                        <div class="row pb-4 p-3 text-dark">
                                            <div class="col-3 pt-3 fw-semibold">
                                                <label for="passport_no">Passport No</label>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <input id="passport_no" placeholder="Enter Passport No." type="number"
                                                    value="{{ $employee ? ($employee->passportOmang ? $employee->passportOmang->passport_no : '') : '' }}"
                                                    name="passport_no" class="form-control form-control-sm ">
                                            </div>

                                            <div class="col-3 pt-3 fw-semibold">
                                                <label for="passport_expiry">Passport Expiry</label>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <input id="passport_expiry" placeholder="Enter Date of Passport Expiry"
                                                    value="{{ $employee ? ($employee->passportOmang ? $employee->passportOmang->passport_expiry : '') : '' }}"
                                                    type="date"name="passport_expiry"
                                                    class="form-control form-control-sm ">
                                            </div>

                                            <div class="col-3 pt-3 fw-semibold">
                                                <label for="omang_no">OMANG No</label>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <input id="omang_no" placeholder="Enter omang No." type="number"
                                                    value="{{ $employee ? ($employee->passportOmang ? $employee->passportOmang->omang_no : '') : '' }}"
                                                    name="omang_no" class="form-control form-control-sm ">
                                            </div>

                                            <div class="col-3 pt-3 fw-semibold">
                                                <label for="omang_expiry">OMANG Expiry</label>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <input id="omang_expiry" placeholder="Enter Date of OMANG Expiry"
                                                    value="{{ $employee ? ($employee->passportOmang ? $employee->passportOmang->omang_expiry : '') : '' }}"
                                                    type="date" name="omang_expiry"
                                                    class="form-control form-control-sm ">
                                            </div>

                                            <div class="text-center pt-5">
                                                <button type="submit" class="btn btn-white btn-sm">SUBMIT</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <!-- End Stats -->
                    </div>

    </main>
@endsection
@push('custom-scripts')
@endpush
