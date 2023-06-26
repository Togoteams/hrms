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
                                    <form id="form_id" action="{{ route('admin.employee.userDetails.post') }}"
                                        method="post">
                                        @csrf
                                        <input type="hidden" name="id"
                                            value="{{ !empty($employee) ? $employee->id : '' }}">
                                        <input type="hidden" name="user_id"
                                            value="{{ !empty($employee) ? $employee->user_id : '' }}">
                                        <div class="row pb-4 p-3 text-dark">
                                            <div class="col-3 pt-3 fw-semibold">
                                                <label for="name">Employee Name:</label>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <input id="name" required placeholder="Enter Name" type="text"
                                                    name="name"
                                                    value="{{ !empty($employee) ? $employee->user->name : '' }}"
                                                    class="form-control form-control-sm">
                                            </div>

                                            <div class="col-3 pt-3 fw-semibold">
                                                <label for="username">User-Name:</label>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <input id="username" required placeholder="Enter User Name" type="text"
                                                    name="username"
                                                    value="{{ !empty($employee) ? $employee->user->username : '' }}"
                                                    class="form-control form-control-sm">
                                            </div>

                                            <div class="col-3 pt-3 fw-semibold">
                                                <label for="email">Email:</label>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <input required id="email" placeholder="Enter email" type="email"
                                                    name="email"
                                                    value="{{ !empty($employee) ? $employee->user->email : '' }}"
                                                    class="form-control form-control-sm">
                                            </div>

                                            <div class="col-3 pt-3 fw-semibold">
                                                <label for="mobile">Mobile No:</label>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <input required id="mobile" placeholder="Enter Mobile No" type="tel"
                                                    name="mobile"
                                                    value="{{ !empty($employee) ? $employee->user->mobile : '' }}"
                                                    class="form-control form-control-sm">
                                            </div>

                                            <div class="col-3 pt-3 fw-semibold">
                                                <label for="emergency_contact">Emergency Contact No:</label>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <input required id="emergency_contact"
                                                    placeholder="Enter Emergency Contact No." value="" type="tel"
                                                    value="{{ !empty($employee) ? $employee->emergency_contact : '' }}"
                                                    name="emergency_contact" class="form-control form-control-sm ">
                                            </div>

                                            <div class="col-3 pt-3 fw-semibold">
                                                <label for="date_of_birth">Date of Birth </label>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <input required id="date_of_birth" placeholder="Enter date of birth"
                                                    type="date" name="date_of_birth"
                                                    value="{{ !empty($employee) ? $employee->date_of_birth : '' }}"
                                                    class="form-control form-control-sm ">
                                            </div>

                                            <div class="col-3 pt-3 fw-semibold">
                                                <label for="gender">Gender:</label>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <select required id="gender" placeholder="Select gender" name="gender"
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

                                            <div class="col-3 pt-3 fw-semibold">
                                                <label for="marital_status">Marital Status:</label>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <select required id="marital_status" placeholder="Select Marital Status"
                                                    name="marital_status" class="form-control form-control-sm">
                                                    <option selected disabled> - Select Marital Status - </option>
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

                                            <div class="col-3 pt-3 fw-semibold">
                                                <label for="password">Password: </label>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <input required id="password" placeholder="Enter password"
                                                    type="password" name="password"
                                                    class="form-control form-control-sm ">
                                            </div>

                                            <div class="col-3 pt-3 fw-semibold">
                                                <label for="password_confirmation">Confirm Password: </label>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <input required id="password_confirmation"
                                                    placeholder="Enter password confirmation" type="password"
                                                    name="password_confirmation" class="form-control form-control-sm ">
                                            </div>
                                            <div class="text-center pt-5">
                                                <button type="submit" class="btn btn-primary btn-sm">SUBMIT</button>
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
@endpush
