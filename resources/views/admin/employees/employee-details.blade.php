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
                                    <form id="form_id" action="{{ route('admin.employee.employeeDetails.post') }}"
                                        {{-- class="formsubmit" --}}
                                        method="post">
                                        @csrf
                                        <input type="hidden" name="id"
                                            value="{{ !empty($employee) ? $employee->id : '' }}">
                                        <input type="hidden" name="user_id"
                                            value="{{ !empty($employee) ? $employee->user_id : '' }}">

                                        <div class="row pb-4 p-3 text-dark">
                                            <div class="col-3 pt-3 fw-semibold">
                                                <label for="branch_id">branch </label>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <select required id="branch_id" name="branch_id"
                                                    class="form-control form-control-sm">
                                                    <option selected disabled> - Select Branch - </option>
                                                    @foreach ($branch as $br)
                                                        <option
                                                            {{ !empty($employee) ? ($br->id == $employee->branch_id ? 'selected' : '') : '' }}
                                                            value="{{ $br->id }}">{{ $br->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-3 pt-3 fw-semibold">
                                                <label for="designation_id">Designation:</label>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <select required id="designation_id" placeholder="Enter Employee"
                                                    name="designation_id" class="form-control form-control-sm">
                                                    <option selected disabled> -Select Designation- </option>
                                                    @foreach ($designation as $deg)
                                                        <option
                                                            {{ !empty($employee) ? ($deg->id == $employee->designation_id ? 'selected' : '') : '' }}
                                                            value="{{ $deg->id }}">{{ $deg->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-3 pt-3 fw-semibold">
                                                <label for="ec_number">EC Number </label>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <input required id="ec_number" placeholder="Enter ec number" type="text"
                                                    name="ec_number"
                                                    value="{{ !empty($employee) ? $employee->ec_number : '' }}"
                                                    class="form-control form-control-sm ">
                                            </div>

                                            <div class="col-3 pt-3 fw-semibold">
                                                <label for="id_number">ID Number </label>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <input required id="id_number" placeholder="Enter id number" type="text"
                                                    name="id_number"
                                                    value="{{ !empty($employee) ? $employee->id_number : '' }}"
                                                    class="form-control form-control-sm ">
                                            </div>

                                            <div class="col-3 pt-3 fw-semibold">
                                                <label for="start_date">Start Date </label>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <input required id="start_date" placeholder="Enter start date"
                                                    type="date" name="start_date"
                                                    value="{{ !empty($employee) ? $employee->start_date : '' }}"
                                                    class="form-control form-control-sm ">
                                            </div>

                                            <div class="col-3 pt-3 fw-semibold">
                                                <label for="currency">Currency </label>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <input required id="currency" placeholder="Enter currency" type="text"
                                                    name="currency"
                                                    value="{{ !empty($employee) ? $employee->currency : '' }}"
                                                    class="form-control form-control-sm ">
                                            </div>

                                            <div class="col-3 pt-3 fw-semibold">
                                                <label for="basic_salary">Basic Salary </label>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <input required id="basic_salary" placeholder="Enter basic salary"
                                                    type="number" name="basic_salary"
                                                    value="{{ !empty($employee) ? $employee->basic_salary : '' }}"
                                                    class="form-control form-control-sm ">
                                            </div>

                                            <div class="col-3 pt-3 fw-semibold">
                                                <label for="date_of_current_basic">Date of Current Basic </label>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <input required id="date_of_current_basic"
                                                    placeholder="Enter date of current_basic" type="datetime-local"
                                                    name="date_of_current_basic"
                                                    value="{{ !empty($employee) ? $employee->date_of_current_basic : '' }}"
                                                    class="form-control form-control-sm ">
                                            </div>

                                            <div class="col-3 pt-3 fw-semibold">
                                                <label for="employment_type">Employment Type </label>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <select required id="employment_type" placeholder="Enter Employment Type"
                                                    name="employment_type"
                                                    value="{{ !empty($employee) ? $employee->employment_type : '' }}"
                                                    class="form-control form-control-sm">

                                                    <option disabled> - Select employment type- </option>
                                                    <option
                                                        {{ !empty($employee) ? ($employee->employment_type == 'local' ? 'selected' : '') : '' }}
                                                        value="local">Local</option>
                                                    <option
                                                        {{ !empty($employee) ? ($employee->employment_type == 'expatriate' ? 'selected' : '') : '' }}
                                                        value="expatriate">Expatriate</option>
                                                    <option
                                                        {{ !empty($employee) ? ($employee->employment_type == 'local-contractual' ? 'selected' : '') : '' }}
                                                        value="local-contractual">Local-Contractual </option>

                                                </select>
                                            </div>

                                            <div class="col-3 pt-3 fw-semibold contractDiv">
                                                <label for="contract_duration">Contract Duration</label>
                                            </div>
                                            <div class="col-2 pt-2 contractDiv">
                                                <input id="contract_duration" name="contract_duration"
                                                    placeholder="Enter Months" type="number"
                                                    value="{{ !empty($employee) ? $employee->contract_duration : '' }}"
                                                    class="form-control form-control-sm ">
                                            </div>
                                            <div class="col-1 pt-3 contractDiv">
                                                Month(s)
                                            </div>

                                            <div class="col-3 pt-3 fw-semibold">
                                                <label for="pension_contribution">Pension Contribution </label>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <input required id="pension_contribution"
                                                    placeholder="Enter pension contribution" type="number"
                                                    name="pension_contribution"
                                                    value="{{ !empty($employee) ? $employee->pension_contribution : '' }}"
                                                    class="form-control form-control-sm ">
                                            </div>

                                            <div class="col-3 pt-3 fw-semibold">
                                                <label for="union_membership_id">Union Membership </label>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <select required id="union_membership_id"
                                                    placeholder="Select union membership" name="union_membership_id"
                                                    class="form-control form-control-sm"
                                                    value="{{ !empty($employee) ? $employee->union_membership_id : '' }}">
                                                    <option selected disabled> - Select Union Membership ID - </option>
                                                    @foreach ($membership as $mem)
                                                        <option
                                                            {{ !empty($employee) ? ($mem->id == $employee->union_membership_id ? 'selected' : '') : '' }}
                                                            value="{{ $mem->id }}">{{ $mem->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-3 pt-3 fw-semibold">
                                                <label for="amount_payable_to_bomaind_each_year">
                                                    Amount Payable to Bomaind Each Year
                                                </label>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <input required id="amount_payable_to_bomaind_each_year"
                                                    placeholder="Enter amount_payable to bomaind each year" type="text"
                                                    name="amount payable to bomaind each year"
                                                    value="{{ !empty($employee) ? $employee->amount_payable_to_bomaind_each_year : '' }}"
                                                    class="form-control form-control-sm ">
                                            </div>

                                            <div class="col-3 pt-3 fw-semibold">
                                                <label for="bank_account_number">Bank Account No </label>
                                            </div>
                                            <div class="col-3 pt-2">
                                                <input required id="bank_account_number"
                                                    placeholder="Enter bank account number" type="text"
                                                    value="{{ !empty($employee) ? $employee->bank_account_number : '' }}"
                                                    name="bank_account_number" class="form-control form-control-sm ">
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


    <script>
        let isLocalContractual = false;
    </script>


    @if (!empty($employee) ? ($employee->employment_type == 'local-contractual' ? true : false) : false)
        <script>
            isLocalContractual = true;
        </script>
    @endif
    <script>
        $(document).ready(function() {
            //For Creation Time
            if (!isLocalContractual) {
                $(".contractDiv").hide();
            }

            //For Edit Time
            $("#employment_type").val() == "local-contractual" ?
                $(".contractDivEdit").show() && $("#contract_duration_edit").prop("required", true) :
                $(".contractDivEdit").hide() && $("#contract_duration").val("");
        });

        //For Creation Time
        $("#employment_type").change(() => {
            $("#employment_type").val() == "local-contractual" ?
                $(".contractDiv").show() && $("#contract_duration").prop("required", true) :
                $(".contractDiv").hide() && $("#contract_duration").val("") &&
                $("#contract_duration").removeAttr("required");
        });

        //For Edit Time
        $("#employment_type").change(() => {
            $("#employment_type").val() == "local-contractual" ?
                $(".contractDivEdit").show() :
                $(".contractDivEdit").hide() && $("#contract_duration").val("");
        });
    </script>
@endpush
