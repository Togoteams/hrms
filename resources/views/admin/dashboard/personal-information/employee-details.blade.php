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
                    <span class="name-title">Personal Information</span>
                    <div class="mt-5">
                        <div class="row d-flex align-items-start">
                            <div class="py-4 border rounded col-xxl-2 col-xl-3 border-1 border-color">
                                @include('admin.dashboard.personal-information.aside')
                                <div class="tab-pane fade ms-5 show active">
                                </div>
                            </div>
                            <div class="mx-3 border rounded col-xxl-9 col-xl-8 border-1 border-color">

                                <div class="tab-content" id="v-pills-tabContent">

                                    <div class="">
                                        <div class="container mt-2 mb-2 ms-1">
                                            <div class="row">
                                                <div class="py-4 col-md-10">
                                                    @if (!empty($data))
                                                    @php
                                                        $fullName = $data->user->name;
                                                        $nameParts = explode(' ', $fullName);
                                                        $firstName = $nameParts[0];
                                                        $lastName = count($nameParts) > 1 ? $nameParts[count($nameParts) - 1] : '';
                                                    @endphp

                                                        <div class="left-div">
                                                            <div class="row text-dark">
                                                                {{-- <div class="col-3 fw-semibold">Name</div>
                                                                <div class="col-3">{{ $data->user->name }}</div> --}}
                                                                <div class="col-3 fw-semibold">Salutation</div>
                                                                <div class="col-3">{{$salutation}}</div>

                                                                <div class="col-3 fw-semibold">First Name</div>
                                                                <div class="col-3"> {{ $firstName }}</div>

                                                                <div class="col-3 fw-semibold">Last Name</div>
                                                                <div class="col-3">{{ $lastName }}</div>

                                                                <div class="col-3 fw-semibold">Gender</div>
                                                                <div class="col-3">{{ $data->gender }}</div>

                                                                <div class="col-3 fw-semibold">User Name</div>
                                                                <div class="col-3">{{ $data->user->username }}</div>

                                                                <div class="col-3 fw-semibold">Ec Number</div>
                                                                <div class="col-3">{{ $data->ec_number }}</div>

                                                                <div class="col-3 fw-semibold">Designation</div>
                                                                <div class="col-3">{{ $data->designation->name }}</div>

                                                                {{-- <div class="col-3 fw-semibold">Basic Salary</div>
                                                                <div class="col-3">{{ $data->basic_salary }}</div> --}}

                                                                <div class="col-3 fw-semibold">Date of Birth</div>
                                                                <div class="col-3">{{ $data->date_of_birth }}</div>

                                                                <div class="col-3 fw-semibold">Age</div>
                                                                <div class="col-3"> 
                                                                    <?php
                                                                    $dob = new DateTime($data->date_of_birth);
                                                                    $now = new DateTime();
                                                                    $age = $now->diff($dob)->y;
                                                                    echo $age;
                                                                    ?>
                                                                </div>

                                                                <div class="col-3 fw-semibold">Blood Group</div>
                                                                <div class="col-3">{{ $data->blood_group }}</div>
                                                                <div class="col-3 fw-semibold">Basic Salary</div>
                                                                <div class="col-3">{{ $data->user?->payrollPayscale?->net_take_home }}</div>

                                                            </div>
                                                        </div>
                                                    @else
                                                        No data to show
                                                    @endif
                                                </div>
                                                <div class="col-md-2 text-end">
                                                    <div class="pt-2">
                                                        <!-- Your content for right div goes here -->
                                                        <button class="btn btn-edit btn-sm bt" data-bs-toggle="modal"
                                                            data-bs-target="#modaledit">
                                                            <i class="fas fa-edit"></i></button>
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
                {{-- edit form model start --}}
                <!-- Modal -->
                <div class="modal fade" id="modaledit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content ">
                            <div class="modal-header ">
                                <h5 class="modal-title" id="staticBackdropLabel">Edit {{ $page }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="edit">
                                <form id="form_edit" action="{{ route('admin.personal.info.employee.details.update') }}">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $data->user_id }}">
                                    <input type="hidden" name="id" value="{{ !empty($data) ? $data->id : '' }}">

                                    <div class="row">
                                        <div class="mb-2 col-sm-6">
                                            <div class="form-group">
                                                <label for="salutation" class="required">Salutation</label>
                                                <select name="salutation" class="form-control" id="salutation" placeholder="Employee salutation">
                                                    <option value="">Select Option</option>
                                                    <option value="mr" @if(old('salutation', $data->user->salutation) === 'mr') selected @endif>Mr</option>
                                                    <option value="mrs" @if(old('salutation', $data->user->salutation) === 'mrs') selected @endif>Mrs</option> 
                                                    <option value="miss" @if(old('salutation', $data->user->salutation) === 'miss') selected @endif>Miss</option> 
                                                    <option value="dr" @if(old('salutation', $data->user->salutation) === 'dr') selected @endif>Dr</option> 
                                                </select>
                                            </div>
                                        </div>
                                         <div class="mb-2 col-sm-6">
                                            <div class="form-group">
                                                <label for="first_name">First Name<small class="required-field">*</small></label>
                                                <input required id="first_name" placeholder="Enter First Name of Employee "
                                                    type="text" name="first_name" class="form-control form-control-"
                                                    value="{{ $data->user->first_name }}">
                                            </div>
                                        </div>
                                         <div class="mb-2 col-sm-6">
                                            <div class="form-group">
                                                <label for="last_name">Last Name<small class="required-field">*</small></label>
                                                <input required id="last_name" placeholder="Enter Last Name of Employee "
                                                    type="text" name="last_name" class="form-control form-control-"
                                                    value="{{ $data->user->last_name }}">
                                            </div>
                                        </div>
                                        <div class="mb-2 col-sm-6">
                                            <div class="form-group">
                                                <label for="birth_country">Birth Country<small class="required-field">*</small></label>
                                                <input required id="birth_country" placeholder="Enter Birth Country of Employee "
                                                    type="text" name="birth_country" class="form-control form-control-"
                                                    value="{{ $data->birth_country }}">
                                            </div>
                                        </div>
                                        {{-- <div class="mb-2 col-sm-6">
                                            <div class="form-group">
                                                <label for="name">Name<small class="required-field">*</small></label>
                                                <input required id="name" placeholder="Enter Name of Employee "
                                                    type="text" name="name" class="form-control form-control-"
                                                    value="{{ $data->user->name }}">
                                            </div>
                                        </div> --}}
                                        <div class="mb-2 col-sm-6">
                                            <div class="form-group">
                                                <label for="gender">Gender<small class="required-field">*</small></label>
                                                <select required id="gender" placeholder="Enter correct gender   "
                                                    name="gender" class="form-control form-control-sm ">
                                                    <option disabled> - Select Gender- </option>
                                                    <option {{ $data->gender == 'male' ? 'selected' : '' }} value="male">
                                                        Male
                                                    </option>
                                                    <option {{ $data->gender == 'female' ? 'selected' : '' }}
                                                        value="female">
                                                        Female</option>
                                                    <option {{ $data->gender == 'others' ? 'selected' : '' }}
                                                        value="others">
                                                        others</option>
                                                </select>
                                            </div>
                                        </div>
                                        {{-- <div class="mb-2 col-sm-6">
                                            <div class="form-group">
                                                <label for="username">User Name</label>
                                                <input required id="username" placeholder="Enter User Name" type="text"
                                                    name="username" class="form-control form-control-"
                                                    value="{{ $data->user->username }}">
                                            </div>
                                        </div>
                                        <div class="mb-2 col-sm-6">
                                            <div class="form-group">
                                                <label for="designation_id">Designation</label>
                                                <select required id="designation_id" placeholder="Enter correct Emplooye   "
                                                    name="designation_id" class="form-control form-control-sm ">
                                                    <option disabled> -Select Designation- </option>
                                                    @foreach ($designation as $deg)
                                                        <option {{ $deg->id == $data->designation_id ? 'selected' : '' }}
                                                            value="{{ $deg->id }}">
                                                            {{ $deg->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-2 col-sm-6">
                                            <div class="form-group">
                                                <label for="basic_salary">Basic Salary</label>
                                                <input required id="basic_salary"
                                                    placeholder="Enter Basic Salary of Branch " type="text"
                                                    name="basic_salary" class="form-control form-control-"
                                                    value="{{ $data->basic_salary }}">
                                            </div>
                                        </div> --}}
                                        <div class="mb-2 col-sm-6">
                                            <div class="form-group">
                                                <label for="date_of_birth">Date of Birth<small
                                                        class="required-field">*</small></label>
                                                <input required id="date_of_birth"
                                                    placeholder="Enter correct date of birth" type="date"
                                                    value="{{ $data->date_of_birth }}" name="date_of_birth"
                                                    class="form-control form-control-sm">
                                            </div>
                                        </div>

                                        <div class="mb-2 col-sm-6">
                                            <div class="form-group">
                                                <label for="blood_group">Blood Group<small
                                                        class="required-field">*</small></label>
                                                <input required id="blood_group"
                                                    placeholder="Enter blood_group" type="text"
                                                    value="{{ $data->blood_group }}" name="blood_group"
                                                    class="form-control form-control-sm">
                                            </div>
                                        </div>

                                    </div>
                                    <hr>
                                    <div class="text-center ">
                                        <button onclick="ajaxCall('form_edit','','POST')" type="button"
                                            class="btn btn-white">Update
                                            {{ $page }}</button>
                                    </div>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>
    </main>
@endsection
