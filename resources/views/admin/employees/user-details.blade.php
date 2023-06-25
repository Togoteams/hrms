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
                                    <form id="form_id" action="{{ route('admin.employee.userDetails.post') }}">
                                        @csrf
                                        {{-- <input type="hidden" name="id" id="id">
                                        <input type="hidden" name="user_id" id="user_id"> --}}
                                        <div class="row pb-4 p-3 text-dark">
                                            <div class="col-3 pt-2 fw-semibold">
                                                <label for="name">Employee Name:</label>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <input id="name" required placeholder="Enter Name" type="text"
                                                    name="name" class="form-control form-control-sm">
                                            </div>

                                            <div class="col-3 pt-2 fw-semibold">
                                                <label for="username">User-Name:</label>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <input id="username" required placeholder="Enter User Name" type="text"
                                                    name="username" class="form-control form-control-sm">
                                            </div>

                                            <div class="col-3 pt-2 fw-semibold">
                                                <label for="gender">Gender:</label>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <select required id="gender" placeholder="Enter gender" name="gender"
                                                    class="form-control form-control-sm">
                                                    <option selected disabled> - Select Gender- </option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                    <option value="others">others</option>
                                                </select>
                                            </div>

                                            <div class="col-3 pt-2 fw-semibold">
                                                <label for="email">Email:</label>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <input required id="email" placeholder="Enter email" type="email"
                                                    name="email" class="form-control form-control-sm">
                                            </div>

                                            <div class="col-3 pt-2 fw-semibold">
                                                <label for="mobile">Mobile No:</label>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <input required id="mobile" placeholder="Enter Mobile No" type="tel"
                                                    name="mobile" class="form-control form-control-sm">
                                            </div>

                                            <div class="col-3 pt-2 fw-semibold">
                                                <label for="emergency_contact">Emergency Contact No:</label>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <input required id="emergency_contact"
                                                    placeholder="Enter Emergency Contact No." value="" type="tel"
                                                    name="emergency_contact" class="form-control form-control-sm ">
                                            </div>

                                            <div class="col-3 pt-2 fw-semibold">
                                                <label for="date_of_birth">Date of Birth </label>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <input required id="date_of_birth" placeholder="Enter date of birth"
                                                    type="date" name="date_of_birth"
                                                    class="form-control form-control-sm ">
                                            </div>

                                            <div class="col-3 pt-2 fw-semibold">
                                                <label for="password">Password: </label>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <input required id="password" placeholder="Enter password" type="password"
                                                    name="password" class="form-control form-control-sm ">
                                            </div>

                                            <div class="col-3 pt-2 fw-semibold">
                                                <label for="password_confirmation">Confirm Password: </label>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <input required id="password_confirmation"
                                                    placeholder="Enter password confirmation" type="password"
                                                    name="password_confirmation" class="form-control form-control-sm ">
                                            </div>
                                            <div class="text-center pt-5">
                                                <button onclick="ajaxCall('form_id','','POST')" type="button"
                                                    class="btn btn-primary btn-sm">SUBMIT</button>
                                                {{-- <button type="submit" class="btn btn-primary btn-sm">SUBMIT</button> --}}
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
