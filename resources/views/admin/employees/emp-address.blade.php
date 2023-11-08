@extends('layouts.app')
@push('styles')
@endpush
@section('content')
    <main id="content" role="main" class="main">
        <div class="container-fluid">
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
                                        action="{{ route('admin.employee.address.post') }}">
                                        @csrf
                                        <input type="hidden" name="id"
                                            value="{{ !empty($employee) ? (!empty($employee->address) ? $employee->address->id : '') : '' }}">
                                        <input type="hidden" name="user_id"
                                            value="{{ !empty($employee) ? $employee->user_id : '' }}">

                                        <div class="p-3 pb-4 row text-dark">
                                            <div class="pt-3 col-3 fw-semibold">
                                                <label for="address">Address<small class="required-field">*</small></label>
                                            </div>
                                            <div class="pt-2 col-9">
                                                <textarea id="address" placeholder="Enter Address" name="address" class="form-control">{{ $employee ? ($employee->address ? $employee->address->address : '') : '' }}</textarea>
                                            </div>

                                            <div class="pt-3 col-3 fw-semibold">
                                                <label for="zip">Zip<small class="required-field">*</small></label>
                                            </div>
                                            <div class="pt-2 col-3">
                                                <input id="zip" placeholder="Enter Zip"
                                                    type="text" name="zip"
                                                    pattern="[0-9]+"
                                                    maxlength="10"
                                                    minlength="5"
                                                    class="form-control"
                                                    value="{{ $employee ? ($employee->address ? $employee->address->zip : '') : '' }}">
                                            </div>

                                            <div class="pt-3 col-3 fw-semibold">
                                                <label for="city">City<small class="required-field">*</small></label>
                                            </div>
                                            <div class="pt-2 col-3">
                                                <input id="city" placeholder="Enter City"
                                                    type="text" name="city" class="form-control"
                                                    value="{{ $employee ? ($employee->address ? $employee->address->city : '') : '' }}">
                                            </div>

                                            <div class="pt-3 col-3 fw-semibold">
                                                <label for="state">State<small class="required-field">*</small></label>
                                            </div>
                                            <div class="pt-2 col-3">
                                                <input id="state" placeholder="Enter State"
                                                    type="text" name="state" class="form-control"
                                                    value="{{ $employee ? ($employee->address ? $employee->address->state : '') : '' }}">
                                            </div>

                                            <div class="pt-3 col-3 fw-semibold">
                                                <label for="country">Country<small class="required-field">*</small></label>
                                            </div>
                                            <div class="pt-2 col-3">
                                                <select name="country" id="country" class="form-control form-control-sm" required>
                                                    <option value="">- Select -</option>
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country->name }}"
                                                            {{ $employee && $employee->address && $employee->address->country == $country->name ? 'selected' : '' }}>
                                                            {{ $country->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
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
