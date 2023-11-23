@extends('layouts.app')
@push('styles')
@endpush
@section('content')
    @php
        function isHideCheck($employee)
        {
            if (!empty($employee)) {
                return !empty($employee->emp_id) ? 'disabled' : '';
            }
            return '';
        }
        $userRoleSelect = '';
        if (!empty($employee)) {
            $userRoleSelect = $employee->user->roles?->first()?->id;
        }
    @endphp

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
                                        action="{{ route('admin.employee.userDetails.post') }}">
                                        @csrf
                                        <input type="hidden" name="id"
                                            value="{{ !empty($employee) ? $employee->id : '' }}">
                                        <input type="hidden" name="user_id"
                                            value="{{ !empty($employee) ? $employee->user_id : '' }}">
                                        <div class="p-3 pb-4 row text-dark">
                                            <div class="pt-3 col-3 fw-semibold">
                                                <label for="name">Employee Name<small
                                                        class="required-field">*</small></label>
                                            </div>
                                            <div class="pt-2 col-3">
                                                <input id="name" placeholder="Enter Name" type="text" name="name"
                                                    value="{{ !empty($employee) ? $employee->user->name : '' }}"
                                                    class="form-control form-control-sm">
                                            </div>

                                            {{-- <div class="pt-3 col-3 fw-semibold">
                                                <label for="username">User-Name <small
                                                        class="required-field {{ isHideCheck($employee) ? 'd-none' : '' }}">*</small></label>
                                            </div> --}}
                                            {{-- <div class="pt-2 col-3">
                                                <input id="username" placeholder="Enter User Name" type="text"
                                                    name="username"
                                                    value="{{ !empty($employee) ? $employee->user->username : '' }}"
                                                    class="form-control form-control-sm" {{ isHideCheck($employee) }}>
                                            </div> --}}
                                            <div class="pt-3 col-3 fw-semibold">
                                                <label for="role">Select Role<small
                                                        class="required-field">*</small></label>
                                            </div>
                                            <div class="pt-2 col-3">
                                                <select id="role_id" placeholder="Select role" name="role_id"
                                                    class="form-control form-control-sm">
                                                    <option selected disabled> - Select role - </option>

                                                    @foreach ($roles as $key => $value)
                                                        <option value="{{ $value->id }}"
                                                            @if ($userRoleSelect == $value->id) {{ 'selected' }} @endif>
                                                            {{ $value->name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>

                                            <div class="pt-3 col-3 fw-semibold">
                                                <label for="email">Email<small
                                                        class="required-field {{ isHideCheck($employee) ? 'd-none' : '' }}">*</small></label>
                                            </div>
                                            <div class="pt-2 col-3">
                                                <input type="email" name="email" id="email"
                                                    placeholder="Enter email"
                                                    value="{{ !empty($employee) ? $employee->user->email : '' }}"
                                                    class="form-control form-control-sm" {{ isHideCheck($employee) }}>
                                            </div>

                                            <div class="pt-3 col-3 fw-semibold">
                                                <label for="mobile">Mobile No<small
                                                        class="required-field">*</small></label>
                                            </div>
                                            <div class="pt-2 col-3">
                                                <div class="row">
                                                    <div class="col-2">
                                                        <label for="mobile" class="pt-2">+267</label>
                                                    </div>
                                                    <div class="col-10">
                                                        <input id="mobile" maxlength="8" minlength="7" pattern="[0-9]+"
                                                            placeholder="Enter Mobile No" type="text"
                                                            value="{{ !empty($employee) ? $employee->user->mobile : '' }}"
                                                            name="mobile" class="form-control form-control-sm">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="pt-3 col-3 fw-semibold">
                                                <label for="emergency_contact">Emergency Contact No</label>
                                            </div>
                                            <div class="pt-2 col-3">
                                                <div class="row">
                                                    <div class="col-5">
                                                        <select name="std_code" id="std_code" class="form-control form-control-sm ">
                                                            <option value="">Code</option>
                                                            @foreach ($countries as $country)
                                                                <option value="{{ $country->std_code }}" @if($employee->std_code==$country->std_code) selected @endif>
                                                                    {{ $country->std_code }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-7">
                                                        <input id="emergency_contact" placeholder="Enter ." pattern="[0-9]+"
                                                            maxlength="8" minlength="7"
                                                            value="{{ !empty($employee) ? $employee->emergency_contact : '' }}"
                                                            name="emergency_contact" class="form-control form-control-sm ">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="pt-3 col-3 fw-semibold">
                                                <label for="date_of_birth">Date of Birth<small
                                                        class="required-field">*</small></label>
                                            </div>
                                            <div class="pt-2 col-3">
                                                <input id="date_of_birth" placeholder="Enter " type="date"
                                                    name="date_of_birth"
                                                    value="{{ !empty($employee) ? $employee->date_of_birth : '' }}"
                                                    class="form-control form-control-sm ">
                                            </div>

                                            <div class="pt-3 col-3 fw-semibold">
                                                <label for="gender">Gender<small
                                                        class="required-field">*</small></label>
                                            </div>
                                            <div class="pt-2 col-3">
                                                <select id="gender" placeholder="Select gender" name="gender"
                                                    class="form-control form-control-sm">
                                                    <option selected disabled> - Select Gender - </option>
                                                    <option
                                                        {{ !empty($employee) ? ($employee->gender == 'male' ? 'selected' : '') : '' }}
                                                        value="male">Male</option>
                                                    <option
                                                        {{ !empty($employee) ? ($employee->gender == 'female' ? 'selected' : '') : '' }}
                                                        value="female">Female</option>
                                                    <option
                                                        {{ !empty($employee) ? ($employee->gender == 'others' ? 'selected' : '') : '' }}
                                                        value="others">others</option>
                                                </select>
                                            </div>

                                            <div class="pt-3 col-3 fw-semibold">
                                                <label for="marital_status">Marital Status<small
                                                        class="required-field">*</small></label>
                                            </div>
                                            <div class="pt-2 col-3">
                                                <select id="marital_status" placeholder="Select" name="marital_status"
                                                    class="form-control form-control-sm">
                                                    <option selected disabled value=""> - Select -
                                                    </option>
                                                    <option
                                                        {{ !empty($employee) ? ($employee->marital_status == 'single' ? 'selected' : '') : '' }}
                                                        value="single">
                                                        Single
                                                    </option>
                                                    <option
                                                        {{ !empty($employee) ? ($employee->marital_status == 'married' ? 'selected' : '') : '' }}
                                                        value="married">
                                                        Married
                                                    </option>
                                                    <option
                                                        {{ !empty($employee) ? ($employee->marital_status == 'widowed' ? 'selected' : '') : '' }}
                                                        value="widowed">
                                                        Widowed
                                                    </option>
                                                    <option
                                                        {{ !empty($employee) ? ($employee->marital_status == 'separated' ? 'selected' : '') : '' }}
                                                        value="separated">
                                                        Separated
                                                    </option>
                                                    <option
                                                        {{ !empty($employee) ? ($employee->marital_status == 'divorced' ? 'selected' : '') : '' }}
                                                        value="divorced">
                                                        Divorced
                                                    </option>
                                                </select>
                                            </div>

                                            @if (!isHideCheck($employee))
                                                <div class="pt-3 col-3 fw-semibold">
                                                    <label for="password">Password<small
                                                            class="required-field">*</small></label>
                                                </div>
                                                <div class="pt-2 col-3">
                                                    <input id="password" placeholder="Enter password" type="password"
                                                        name="password" class="form-control form-control-sm ">
                                                </div>

                                                <div class="pt-3 col-3 fw-semibold">
                                                    <label for="password_confirmation">Confirm Password<small
                                                            class="required-field">*</small></label>
                                                </div>
                                                <div class="pt-2 col-3">
                                                    <input id="password_confirmation"
                                                        placeholder="Enter password confirmation" type="password"
                                                        name="password_confirmation"
                                                        class="form-control form-control-sm ">
                                                </div>
                                            @endif
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
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var stdCodeSelect = $('#std_code');
            var emergencyContactInput = $('#emergency_contact');
            var stdCodeLengths = {
                '+267': {
                    minLength: 7,
                    maxLength: 8
                },
                '+91': {
                    minLength: 10,
                    maxLength: 10
                },
            };

            stdCodeSelect.on('change', function() {
                var selectedStdCode = stdCodeSelect.val();
                if (selectedStdCode in stdCodeLengths) {
                    var lengths = stdCodeLengths[selectedStdCode];
                    emergencyContactInput.attr('minlength', lengths.minLength);
                    emergencyContactInput.attr('maxlength', lengths.maxLength);
                } else {
                    // Reset the minlength and maxlength if the selected std_code is not found
                    emergencyContactInput.removeAttr('minlength');
                    emergencyContactInput.removeAttr('maxlength');
                }
            });
            stdCodeSelect.trigger('change');
        });
    </script>
@endpush
