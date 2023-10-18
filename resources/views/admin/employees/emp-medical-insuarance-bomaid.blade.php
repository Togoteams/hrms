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
                            <div class="py-4 border rounded col-xxl-2 col-xl-3 border-1 border-color">
                                @include('admin.employees.add-aside')
                                <div class="tab-pane fade ms-5 show active">
                                </div>
                            </div>
                            <div class="mx-3 border rounded col-xl-8 col-xxl-9 border-1 border-color">

                                <div class="tab-content" id="v-pills-tabContent">
                                    <form id="form_id" class="formsubmit" method="post"
                                        action="{{ route('admin.employee.medicalInsuaranceBomaid.post') }}">
                                        @csrf
                                        <input type="hidden" name="id"
                                            value="{{ $employee ? ($employee->medicalBomaid ? $employee->medicalBomaid->id : '') : '' }}">
                                        <input type="hidden" name="user_id"
                                            value="{{ !empty($employee) ? $employee->user_id : '' }}">

                                        <div class="p-3 pb-4 row text-dark">
                                            <div class="pt-3 col-3 fw-semibold">
                                                <label for="company_name">Insurance Company Name<small class="required-field">*</small></label>
                                            </div>
                                            <div class="pt-2 col-3">
                                                <input type="text" id="company_name" name="company_name"
                                                    value="{{ $employee ? ($employee->medicalBomaid ? $employee->medicalBomaid->company_name : '') : '' }}"
                                                    placeholder="Enter"
                                                    class="form-control form-control-sm">
                                            </div>

                                            <div class="pt-3 col-3 fw-semibold">
                                                <label for="insurance_id">Insurance ID<small class="required-field">*</small></label>
                                            </div>
                                            <div class="pt-2 col-3">
                                                <input type="number" id="insurance_id" name="insurance_id"
                                                    value="{{ $employee ? ($employee->medicalBomaid ? $employee->medicalBomaid->insurance_id : '') : '' }}"
                                                    placeholder="Enter Insurance ID"
                                                    class="form-control form-control-sm">
                                            </div>

                                            <div class="pt-5 text-center">
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
