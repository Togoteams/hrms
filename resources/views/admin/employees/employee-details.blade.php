@extends('layouts.app')
@push('styles')
@endpush
@section('content')
    <main id="content" role="main" class="main">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <span class="name-title">Employee Form Of {{ !empty($employee) ? $employee->user->name : '' }}{{ !empty($employee) ? ($employee->ec_number) : '' }}</span>
                    <div class="mt-5">
                        <div class="row d-flex align-items-start">
                            <div class="py-4 border rounded col-xxl-2 col-xl-2 border-1 border-color">
                                @include('admin.employees.add-aside')
                                <div class="tab-pane fade ms-5 show active">
                                </div>
                            </div>
                            <div class="mx-3 border rounded col-xl-8 col-xxl-9 border-1 border-color">

                                <div class="tab-content" id="v-pills-tabContent">
                                    <form id="form_id" class="formsubmit" method="post"
                                        action="{{ route('admin.employee.employeeDetails.post') }}">
                                        @csrf
                                        <input type="hidden" name="id"
                                            value="{{ !empty($employee) ? $employee->id : '' }}">
                                        <input type="hidden" name="user_id"
                                            value="{{ !empty($employee) ? $employee->user_id : '' }}">

                                        <div class="p-3 pb-4 row text-dark">
                                            

                                            <div class="pt-3 col-2 fw-semibold">
                                                <label for="designation_id">Designation<small
                                                        class="required-field">*</small></label>
                                            </div>
                                            <div class="pt-2 col-4">
                                                <select id="designation_id" placeholder="Enter Employee"
                                                    name="designation_id" class="form-control form-control-sm">
                                                    <option selected disabled> -Select Designation- </option>
                                                    @foreach ($designation as $deg)
                                                        <option
                                                            {{ !empty($employee) ? ($deg->id == $employee->designation_id ? 'selected' : '') : '' }}
                                                            value="{{ $deg->id }}">{{ $deg->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="pt-3 col-2 fw-semibold">
                                                <label for="ec_number">EC Number<small
                                                        class="required-field">*</small></label>
                                            </div>
                                            <div class="pt-2 col-4">
                                                <input id="ec_number" placeholder="Enter EC number" type="text"
                                                    name="ec_number"
                                                    value="{{ !empty($employee) ? $employee->ec_number : '' }}"
                                                    class="form-control form-control-sm">
                                            </div>

                                            {{-- <div class="pt-3 col-3 fw-semibold">
                                                <label for="id_number">ID Number<small
                                                        class="required-field">*</small></label>
                                            </div>
                                            <div class="pt-2 col-3">
                                                <input type="number" id="id_number" placeholder="Enter id number"
                                                    name="id_number"
                                                    value="{{ !empty($employee) ? $employee->id_number : '' }}"
                                                    class="form-control form-control-sm ">
                                            </div> --}}

                                            <div class="pt-3 col-2 fw-semibold">
                                                <label for="start_date">Date of joining<small
                                                        class="required-field">*</small></label>
                                            </div>
                                            <div class="pt-2 col-4">
                                                <input id="start_date" placeholder="Enter start date" type="date"
                                                    name="start_date"
                                                    value="{{ !empty($employee) ? $employee->start_date : '' }}"
                                                    class="form-control form-control-sm ">
                                            </div>
                                         
                                            <div class="pt-3 col-2 fw-semibold">
                                                <label for="bank_account_number">Bank Account No<small
                                                        class="required-field">*</small></label>
                                            </div>
                                            <div class="pt-2 col-4">
                                                <input id="bank_account_number" placeholder="Enter ." type="text"
                                                pattern="[0-9]+" maxlength="16" minlength="12"
                                                value="{{ !empty($employee) ? $employee->bank_account_number : '' }}"
                                                name="bank_account_number" class="form-control form-control-sm number-input" required>
                                            </div>
                                            @if (!$employee->user->hasRole('managing-director'))
                                                <div class="pt-3 col-2 fw-semibold">
                                                    <label for="review_authority">Review Authority<small
                                                            class="required-field">*</small></label>
                                                </div>
                                                <div class="pt-2 col-4">
                                                    <select id="review_authority" placeholder="Select Authority"
                                                        name="review_authority" class="form-control form-control-sm">
                                                        <option selected disabled> - Select - </option>
                                                        @foreach ($reviewAuthority as $key => $review)
                                                            <option value="{{ $review->user_id }}"
                                                                @if ($review->user_id == $employee->review_authority) {{ 'selected' }} @endif>
                                                                {{ $review->user->name }} </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="pt-3 col-2 fw-semibold">
                                                    <label for="reporting_authority">Reporting Authority<small
                                                            class="required-field">*</small></label>
                                                </div>
                                                <div class="pt-2 col-4">

                                                    <select id="reporting_authority" placeholder="Select Authority"
                                                        name="reporting_authority" class="form-control form-control-sm">
                                                        <option selected disabled> - Select - </option>
                                                        @foreach ($reportingAuthority as $key => $value)
                                                            <option value="{{ $value->user_id }}"
                                                                @if ($value->user_id == $employee->reporting_authority) {{ 'selected' }} @endif>
                                                                {{ $value->user->name }} </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif
                                            {{-- <div class="pt-3 col-3 fw-semibold">
                                                <label for="currency">Currency<small
                                                        class="required-field">*</small></label>
                                            </div>
                                            <div class="pt-2 col-3">
                                                <select id="currency" placeholder="Select Currency"
                                                    name="currency" class="form-control form-control-sm">
                                                    <option selected disabled> - Select Currency - </option>
                                                    <option
                                                        {{ !empty($employee) ? ($employee->currency == 'pula' ? 'selected' : '') : '' }}
                                                        value="pula">Pula( P )</option>

                                                    <option
                                                        {{ !empty($employee) ? ($employee->currency == 'dollar' ? 'selected' : '') : '' }}
                                                        value="dollar">Dollar( $ )</option>
                                                </select>
                                            </div> --}}

                                            {{-- <div class="pt-3 col-3 fw-semibold">
                                                <label for="date_of_current_basic">Date of Current Basic<small
                                                        class="required-field">*</small></label>
                                            </div>
                                            <div class="pt-2 col-3">
                                                <input id="date_of_current_basic"
                                                    placeholder="Enter date of current_basic" type="date"
                                                    name="date_of_current_basic"
                                                    value="{{ !empty($employee) ? $employee->date_of_current_basic : '' }}"
                                                    class="form-control form-control-sm ">
                                            </div> --}}

                                            <div class="pt-3 col-2 fw-semibold">
                                                <label for="employment_type">Employment Type<small
                                                        class="required-field">*</small></label>
                                            </div>
                                            <div class="pt-2 col-4">
                                                <select id="employment_type" placeholder="Enter Employment Type"
                                                    name="employment_type"
                                                    value="{{ !empty($employee) ? $employee->employment_type : '' }}"
                                                    class="form-control form-control-sm">

                                                    <option disabled> - Select - </option>
                                                    <option
                                                        {{ !empty($employee) ? ($employee->employment_type == 'local' ? 'selected' : '') : '' }}
                                                        value="local">Local Confirmed</option>
                                                    <option
                                                        {{ !empty($employee) ? ($employee->employment_type == 'expatriate' ? 'selected' : '') : '' }}
                                                        value="expatriate">Expatriate</option>
                                                    <option
                                                        {{ !empty($employee) ? ($employee->employment_type == 'local-contractual' ? 'selected' : '') : '' }}
                                                        value="local-contractual">Local-Contractual </option>

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
    {{-- <script>
        $(document).ready(function () {
            $('#employment_type').change(function () {
                var selectedValue = $(this).val();
                if (selectedValue === 'expatriate') {
                    $('.salary-type-container').show();
                } else {
                    $('.salary-type-container').hide();
                }
            });
        });
    </script>
     --}}

    <script>
        $(document).ready(function() {
            function showHideContainers() {
                var selectedEmploymentType = $('#employment_type').val();
                var selectedSalaryType = $('#salary_type').val();
                $('.salary-type-container').hide();
                $('.basic-salary-india-container').hide();
                $('.da-container').hide();

                if (selectedEmploymentType === 'expatriate') {
                    $('.salary-type-container').show();

                    if (selectedSalaryType === 'nps') {
                        $('.basic-salary-india-container').show();
                        $('.da-container').show();
                    } else if (selectedSalaryType === 'pf') {
                        $('.basic-salary-india-container').show();
                    }
                }
            }

            showHideContainers();

            $('#employment_type').change(function() {
                showHideContainers();
            });

            $('#salary_type').change(function() {
                showHideContainers();
            });
        });
    </script>




    <script>
        $(document).ready(function() {
            var radioNo = $("#pradio1");
            var radioYes = $("#pradio2");
            var pensionDropdown = $("#pensionDropdown");

            radioNo.change(function() {
                pensionDropdown.hide();
            });

            radioYes.change(function() {
                pensionDropdown.show();
            });
            if (radioYes.is(":checked")) {
                pensionDropdown.show();
            } else {
                pensionDropdown.hide();
            }
        });
    </script>
    <!-- Include jQuery -->
    <script>
        $(document).ready(function() {
            var employmentTypeSelect = $("#employment_type");
            var currencySelect = $("#currency_salary");

            employmentTypeSelect.change(function() {
                var selectedEmploymentType = employmentTypeSelect.val();
                if (selectedEmploymentType === "local" || selectedEmploymentType === "local-contractual") {
                    currencySelect.val("pula");
                    // currencySelect.prop("disabled", false);
                } else if (selectedEmploymentType === "expatriate") {
                    currencySelect.val("usd");
                    // currencySelect.prop("disabled", true);
                } else {
                    currencySelect.val("");
                    // currencySelect.prop("disabled", false);
                }
            });
            employmentTypeSelect.trigger("change");
        });
    </script>


@endpush
