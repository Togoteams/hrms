@extends('layouts.app')
@push('styles')
@endpush
@section('content')
    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="mt-2 mb-2 border-bottom">
                <div class="row align-items-center">
                    <div class="col">
                        <h1 class="page-header-title">{{ $page }}</h1>
                    </div>
                    <!-- End Col -->
                    <div class="col-auto">
                        <a class="text-link">
                            Home
                        </a>/ {{ $page }}
                    </div>
                    <!-- End Col -->
                </div>
                <!-- Button trigger modal -->

                <!-- End Row -->
            </div>
            <div class="row">
                <div class="mb-2 col-sm-4">
                    <div class="form-group">
                        <label for="user_id">Employee Id</label>
                        <input disabled required placeholder="Enter correct Emplooye  id " value="{{ $data->emp_id }}" readonly
                            type="text" name="emp_id" class="form-control form-control-sm ">
                    </div>
                </div>

                <div class="mb-2 col-sm-4">
                    <div class="form-group">
                        <label for="user_id">Employee Name</label>
                        <input disabled required placeholder="Enter correct Emplooye  Name " value="{{ $data->user->name }}"
                            type="text" name="name" class="form-control form-control-sm ">
                    </div>
                </div>
                <div class="mb-2 col-sm-4">
                    <div class="form-group">
                        <label for="user_id">Employee User Name</label>
                        <input disabled required placeholder="Enter correct Emplooye  User Name " value="{{ $data->user->username }}"
                            type="text" name="username" class="form-control form-control-sm ">
                    </div>
                </div>

                <div class="mb-2 col-sm-4">
                    <div class="form-group">
                        <label for="email">Email </label>
                        <input disabled required id="email" placeholder="Enter correct email   " value="{{ $data->user->email }}"
                            type="email" name="email" class="form-control form-control-sm ">
                    </div>
                </div>
                <div class="mb-2 col-sm-4">
                    <div class="form-group">
                        <label for="mobile">Mobile No </label>
                        <input disabled required id="mobile" placeholder="Enter correct Mobile No   "
                            value="{{ $data->user->mobile }}" type="number" name="mobile"
                            class="form-control form-control-sm ">
                    </div>
                </div>
                {{-- <div class="mb-2 col-sm-4">
                    <div class="form-group">
                        <label for="password">password </label>
                        <input required id="password" placeholder="Enter correct password   " type="text" name="password"
                            class="form-control form-control-sm ">
                    </div>
                </div>
                <div class="mb-2 col-sm-4">
                    <div class="form-group">
                        <label for="password_confirmation">confirm password </label>
                        <input required id="password_confirmation" placeholder="Enter correct password confirmation   "
                            type="password" name="password_confirmation" class="form-control form-control-sm ">
                    </div>
                </div> --}}
                <div class="mb-2 col-sm-4">
                    <div class="form-group">
                        <label for="designation_id">designatin </label>
                        <select disabled required id="designation_id" placeholder="Enter correct Emplooye   " name="designation_id"
                            class="form-control form-control-sm ">
                            <option disabled> -Select Designation- </option>
                            @foreach ($designation as $deg)
                                <option {{ $deg->id == $data->designation_id ? 'selected' : '' }} value="{{ $deg->id }}">
                                    {{ $deg->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-2 col-sm-4">
                    <div class="form-group">
                        <label for="ec_number">ec number </label>
                        <input disabled required id="ec_number" placeholder="Enter correct ec number   " value="{{ $data->ec_number }}"
                            type="text" name="ec_number" class="form-control form-control-sm ">
                    </div>
                </div>

                <div class="mb-2 col-sm-4">
                    <div class="form-group">
                        <label for="gender">gender </label>
                        <select disabled required id="gender" placeholder="Enter correct gender   " name="gender"
                            class="form-control form-control-sm ">
                            <option disabled> - Select Gender- </option>
                            <option {{ $data->gender == 'male' ? 'male' : '' }} value="male">Male</option>
                            <option {{ $data->gender == 'male' ? 'female' : '' }} value="female">Female</option>
                            <option {{ $data->gender == 'male' ? 'others' : '' }} value="others">others</option>
                        </select>
                    </div>
                </div>
                <div class="mb-2 col-sm-4">
                    <div class="form-group">
                        <label for="employment_type">employment_type </label>
                        <select disabled required id="employment_type" placeholder="Enter correct employment_type   "
                            name="employment_type" class="form-control form-control-sm ">
                            <option  disabled> - Select employment type- </option>
                            <option {{ $data->employment_type == 'indian' ? 'indian' : '' }} value="indian">Indian</option>
                            <option {{ $data->employment_type == 'nri' ? 'nri' : '' }} value="nri">NRI</option>

                        </select>
                    </div>
                </div>
                <div class="mb-2 col-sm-4">
                    <div class="form-group">
                        <label for="id_number">id number </label>
                        <input disabled required id="id_number" placeholder="Enter correct id number   " value="{{ $data->id_number }}"
                            type="text" name="id_number" class="form-control form-control-sm ">
                    </div>
                </div>
                <div class="mb-2 col-sm-4">
                    <div class="form-group">
                        <label for="contract_duration">contract duration </label>
                        <input disabled required id="contract_duration" placeholder="Enter correct contract duration   " type="text"
                            value="{{ $data->contract_duration }}" name="contract_duration"
                            class="form-control form-control-sm ">
                    </div>
                </div>
                <div class="mb-2 col-sm-4">
                    <div class="form-group">
                        <label for="basic_salary">basic salary </label>
                        <input disabled required id="basic_salary" placeholder="Enter correct basic salary   " type="number"
                            value="{{ $data->basic_salary }}" name="basic_salary" class="form-control form-control-sm ">
                    </div>
                </div>
                <div class="mb-2 col-sm-4">
                    <div class="form-group">
                        <label for="date_of_current_basic">date of current basic </label>
                        <input disabled required id="date_of_current_basic" placeholder="Enter correct date of current basic   "
                            value="{{ $data->date_of_current_basic }}" type="datetime-local" name="date_of_current_basic"
                            class="form-control form-control-sm ">
                    </div>
                </div>
                <div class="mb-2 col-sm-4">
                    <div class="form-group">
                        <label for="date_of_birth">date of birth </label>
                        <input disabled required id="date_of_birth" placeholder="Enter correct date of birth   " type="date"
                            value="{{ $data->date_of_birth }}" name="date_of_birth" class="form-control form-control-sm ">
                    </div>
                </div>
                <div class="mb-2 col-sm-4">
                    <div class="form-group">
                        <label for="start_date">start date </label>
                        <input disabled required id="start_date" placeholder="Enter correct start date   " type="date"
                            value="{{ $data->start_date }}" name="start_date" class="form-control form-control-sm ">
                    </div>
                </div>
                <div class="mb-2 col-sm-4">
                    <div class="form-group">
                        <label for="branch_id">branch </label>
                        <select disabled required id="branch_id" name="branch_id" class="form-control form-control-sm ">
                            <option selected disabled> - Select Branch - </option>
                            @foreach ($branch as $br)
                                <option {{ $br->id == $data->branch_id ? 'selected' : '' }} value="{{ $br->id }}">
                                    {{ $br->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-2 col-sm-4">
                    <div class="form-group">
                        <label for="pension_contribution">pension contribution </label>
                        <input disabled required id="pension_contribution" placeholder="Enter correct pension contribution   "
                            value="{{ $data->pension_contribution }}" type="number" name="pension_contribution"
                            class="form-control form-control-sm ">
                    </div>
                </div>
                <div class="mb-2 col-sm-4">
                    <div class="form-group">
                        <label for="unique_membership_id">unique membership </label>
                        <select disabled required id="unique_membership_id" placeholder="Enter correct unique membership id   "
                            name="unique_membership_id" class="form-control form-control-sm ">
                            <option selected disabled> - Select unique_membership_id - </option>
                            @foreach ($membership as $mem)
                                <option {{ $mem->id == $data->unique_membership_id ? 'selected' : '' }}
                                    value="{{ $mem->id }}">{{ $mem->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-2 col-sm-4">
                    <div class="form-group">
                        <label for="amount_payable_to_bomaind_each_year">amount payable to bomaind each year
                        </label>
                        <input disabled required id="amount payable to bomaind each year"
                            value="{{ $data->amount_payable_to_bomaind_each_year }}"
                            placeholder="Enter correct amount_payable_to_bomaind_each_year   " type="text"
                            name="amount_payable_to_bomaind_each_year" class="form-control form-control-sm ">
                    </div>
                </div>
                <div class="mb-2 col-sm-4">
                    <div class="form-group">
                        <label for="currency">currency </label>
                        <input disabled required id="currency" placeholder="Enter correct currency   " type="text"
                            value="{{ $data->currency }}" name="currency" class="form-control form-control-sm ">
                    </div>
                </div>
                <div class="mb-2 col-sm-4">
                    <div class="form-group">
                        <label for="bank_name">bank name </label>
                        <input disabled required id="bank_name" placeholder="Enter correct bank_name   " type="text"
                            value="{{ $data->bank_name }}" name="bank_name" class="form-control form-control-sm ">
                    </div>
                </div>
                <div class="mb-2 col-sm-4">
                    <div class="form-group">
                        <label for="bank_account_number">bank account number </label>
                        <input disabled required id="bank_account_number" placeholder="Enter correct bank account number   "
                            value="{{ $data->bank_account_number }}" type="text" name="bank_account_number"
                            class="form-control form-control-sm ">
                    </div>
                </div>
                <div class="mb-2 col-sm-4">
                    <div class="form-group">
                        <label for="bank_holder_name">bank holder name </label>
                        <input disabled required id="bank_holder_name" placeholder="Enter correct bank holder name   " type="text"
                            value="{{ $data->bank_holder_name }}" name="bank_holder_name"
                            class="form-control form-control-sm ">
                    </div>
                </div>
                <div class="mb-2 col-sm-4">
                    <div class="form-group">
                        <label for="ifsc">ifsc </label>
                        <input disabled required id="ifsc" placeholder="Enter correct ifsc   " type="text" name="ifsc"
                            value="{{ $data->ifsc }}" class="form-control form-control-sm ">
                    </div>
                </div>

            </div>

            {{-- edit form model end  --}}

            {{-- edit form model start --}}
            <!-- Modal -->

            {{-- edit form model end  --}}

            {{-- status form model start --}}


            {{-- status form model end  --}}

        </div>

    </main>
@endsection
