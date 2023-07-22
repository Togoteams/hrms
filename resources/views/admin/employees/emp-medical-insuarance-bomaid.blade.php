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
                                        action="{{ route('admin.employee.medicalInsuaranceBomaid.post') }}">
                                        @csrf
                                        <input type="hidden" name="id"
                                            value="{{ $employee ? ($employee->medicalBomaid ? $employee->medicalBomaid->id : '') : '' }}">
                                        <input type="hidden" name="user_id"
                                            value="{{ !empty($employee) ? $employee->user_id : '' }}">

                                        <div class="row pb-4 p-3 text-dark">
                                            <div class="col-3 pt-3 fw-semibold">
                                                <label for="company_name">Insurance Company Name<small class="required-field">*</small></label>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <input type="text" id="company_name" name="company_name"
                                                    value="{{ $employee ? ($employee->medicalBomaid ? $employee->medicalBomaid->company_name : '') : '' }}"
                                                    placeholder="Enter Insurance Company Name"
                                                    class="form-control form-control-sm">
                                            </div>

                                            <div class="col-3 pt-3 fw-semibold">
                                                <label for="insurance_id">Insurance ID<small class="required-field">*</small></label>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <input type="number" id="insurance_id" name="insurance_id"
                                                    value="{{ $employee ? ($employee->medicalBomaid ? $employee->medicalBomaid->insurance_id : '') : '' }}"
                                                    placeholder="Enter Insurance Company Name"
                                                    class="form-control form-control-sm">
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
