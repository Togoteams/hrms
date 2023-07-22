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
                                        action="{{ route('admin.employee.address.post') }}">
                                        @csrf
                                        <input type="hidden" name="id"
                                            value="{{ !empty($employee) ? (!empty($employee->address) ? $employee->address->id : '') : '' }}">
                                        <input type="hidden" name="user_id"
                                            value="{{ !empty($employee) ? $employee->user_id : '' }}">

                                        <div class="row pb-4 p-3 text-dark">
                                            <div class="col-3 pt-3 fw-semibold">
                                                <label for="address">Address<small class="required-field">*</small></label>
                                            </div>
                                            <div class="col-9 pt-2">
                                                <textarea id="address" placeholder="Enter Address" name="address" class="form-control">{{ $employee ? ($employee->address ? $employee->address->address : '') : '' }}</textarea>
                                            </div>

                                            <div class="col-3 pt-3 fw-semibold">
                                                <label for="zip">Zip<small class="required-field">*</small></label>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <input id="zip" placeholder="Enter Name of Zip"
                                                    type="text" name="zip" class="form-control"
                                                    value="{{ $employee ? ($employee->address ? $employee->address->zip : '') : '' }}">
                                            </div>

                                            <div class="col-3 pt-3 fw-semibold">
                                                <label for="city">City<small class="required-field">*</small></label>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <input id="city" placeholder="Enter Name of City"
                                                    type="text" name="city" class="form-control"
                                                    value="{{ $employee ? ($employee->address ? $employee->address->city : '') : '' }}">
                                            </div>

                                            <div class="col-3 pt-3 fw-semibold">
                                                <label for="state">State<small class="required-field">*</small></label>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <input id="state" placeholder="Enter Name of State"
                                                    type="text" name="state" class="form-control"
                                                    value="{{ $employee ? ($employee->address ? $employee->address->state : '') : '' }}">
                                            </div>

                                            <div class="col-3 pt-3 fw-semibold">
                                                <label for="country">Country<small class="required-field">*</small></label>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <input id="country" placeholder="Enter Name of Country"
                                                    type="text" name="country" class="form-control"
                                                    value="{{ $employee ? ($employee->address ? $employee->address->country : '') : '' }}">
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
