@extends('layouts.app')
@push('styles')
@endpush
@section('content')
    <main id="content" role="main" class="main">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">

                    <!-- End Col -->
                    <!-- End Page Header -->

                    <!-- Stats -->
                    <span class="name-title">Employee Form</span>
                    <div class="mt-5">
                        <div class="row d-flex align-items-start">
                            <div class="py-4 border rounded col-xxl-2 col-xl-2 border-1 border-color">
                                @include('admin.employees.add-aside')
                                <div class="tab-pane fade ms-5 show active">
                                </div>
                            </div>
                            <div class="mx-3 border rounded col-xl-9 col-xxl-9 border-1 border-color">

                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="py-3 row">
                                        <div class="text-left">
                                            <input type="hidden" value="{{ $employee->employment_type }}"
                                                id="employment_type">
                                            <input type="hidden" value="{{ $currencies[0] }}" id="currency_salary">
                                            <button type="button" class="btn btn-white btn-sm"
                                                title="Add Emp Salary History"
                                                onclick="addSalaryhistory({{ !empty($employee) ? $employee->user_id : '' }})">
                                                Add Salary Revisions
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row this-div">

                                        @if (!empty($salaryHistories))
                                            @forelse  ($salaryHistories as $salaryhistory)
                                                <div class="pb-4">
                                                    <div class="p-3 card">
                                                        <div class="row">
                                                            <div class="col-10">
                                                                <div class="row text-dark">
                                                                    <div class="col-3 fw-semibold">Date Of Basic Salary
                                                                    </div>
                                                                    <div class="col-3">
                                                                        {{ date('d-m-Y', strtotime($salaryhistory->date_of_current_basic)) }}
                                                                    </div>

                                                                    <div class="col-3 fw-semibold">Basic Salary</div>
                                                                    <div class="col-3">
                                                                        {{ $salaryhistory->currency_salary == 'pula' ? 'BWP' : "USD" }}
                                                                        {{ ucfirst($salaryhistory->basic_salary) }}
                                                                    </div>
                                                                    @if ($salaryhistory->salary_type)
                                                                        <div class="col-3 fw-semibold">Salary Type</div>
                                                                        <div class="col-3">
                                                                            {{ ucfirst($salaryhistory->salary_type) }}
                                                                        </div>
                                                                    @endif
                                                                    @if ($salaryhistory->basic_salary_for_india > 1)
                                                                        <div class="col-3 fw-semibold">Basic Salary For
                                                                            India
                                                                        </div>
                                                                        <div class="col-3">
                                                                            {{ ucfirst($salaryhistory->currency_salary_for_india) }}
                                                                            {{ $salaryhistory->basic_salary_for_india }}
                                                                        </div>
                                                                    @endif

                                                                    <div class="col-3 fw-semibold">Pension Contribution
                                                                    </div>
                                                                    <div class="col-3">
                                                                        @if ($salaryhistory->pension_contribution == 'yes')
                                                                            {{ ucfirst($salaryhistory->pension_opt) }}%
                                                                        @else
                                                                            {{ ucfirst($salaryhistory->pension_contribution) }}
                                                                        @endif

                                                                    </div>
                                                                    <div class="col-3 fw-semibold">Union Membership</div>
                                                                    <div class="col-3">
                                                                        {{ ucfirst($salaryhistory->union_membership_id) }}
                                                                    </div>
                                                                    <div class="col-3 fw-semibold">Status</div>
                                                                    <div class="col-3">
                                                                        {{ ucfirst($salaryhistory->status) }}
                                                                    </div>



                                                                </div>
                                                            </div>
                                                            <div class="col-2 text-end">
                                                                <div class="right-div">
                                                                    <!-- Your content for right div goes here -->
                                                                    {{-- <button class="btn btn-edit btn-sm bt" title="Edit"
                                                                        id="editButton" data-id="{{ $salaryhistory->id }}"
                                                                        data-user_id="{{ $employee->user_id }}"
                                                                        data-basic_salary="{{ $salaryhistory->basic_salary }}"
                                                                        data-currency_salary="{{ $salaryhistory->currency_salary }}"
                                                                        data-salary_type="{{ $salaryhistory->salary_type }}"
                                                                        data-basic_salary_for_india="{{ $salaryhistory->basic_salary_for_india }}"
                                                                        data-date_of_current_basic="{{ $salaryhistory->date_of_current_basic }}"
                                                                        data-pension_contribution="{{ $salaryhistory->pension_contribution }}"
                                                                        data-pension_opt="{{ $salaryhistory->pension_opt }}"
                                                                        data-union_membership_id="{{ $salaryhistory->union_membership_id }}"
                                                                        data-is_medical_insuarance="{{ $salaryhistory->is_medical_insuarance }}"
                                                                        data-status="{{ $salaryhistory->status }}"
                                                                        data-da="{{ $salaryhistory->da }}"
                                                                        data-currency_salary_for_india="{{ $salaryhistory->currency_salary_for_india }}">
                                                                        <i class="fas fa-edit"></i>
                                                                    </button> --}}

                                                                    <button class="btn btn-delete btn-sm bt deleteRecord"
                                                                        title="Delete" data-id="{{ $salaryhistory->id }}"
                                                                        data-token="{{ csrf_token() }}"
                                                                        data-action="{{ route('admin.employee.salary-history.delete') }}">

                                                                        <i class="fas fa-trash-alt"></i>
                                                                    </button>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="pb-4">
                                                    <div class="p-3 card">Salary Is not Added</div>
                                                </div>
                                            @endforelse
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- End Stats -->
                </div>

                {{-- Add form model start --}}
                <!-- Modal -->
                <div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content ">
                            <div class="modal-header ">
                                <h5 class="modal-title" id="modalTitle"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="add">
                                <form id="form_id" class="formsubmit" method="post"
                                    action="{{ route('admin.employee.salary-history.post') }}">
                                    @csrf
                                    <input type="hidden" name="id" id="id">
                                    <input type="hidden" name="user_id" id="user_id">

                                    <div class="row">
                                        <div class="mb-2 col-sm-6">
                                            <div class="form-group">
                                                <label for="date_of_current_basic">Date Of Basic Salary</label>
                                                <small class="required-field">*</small>
                                                <input id="date_of_current_basic" placeholder="Enter Basic Salary"
                                                    type="date" name="date_of_current_basic"
                                                    class="form-control form-control-sm" value="">
                                            </div>
                                        </div>
                                        <div class="mb-2 col-sm-6">
                                            <div class="form-group">
                                                <label for="currency_salary">Currency</label>
                                                <small class="required-field">*</small>
                                                <select id="currency_salary" placeholder="Enter Salary Currency"
                                                    type="text" name="currency_salary"
                                                    class="form-control form-control-sm">
                                                    <option disabled value="">--select--</option>
                                                    @foreach ($currencies as $currency)
                                                        <option value="{{ $currency }}">
                                                            {{ ucfirst($currency) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-2 col-sm-6">
                                            <div class="form-group">
                                                <label for="basic_salary">Basic Salary</label>
                                                <small class="required-field">*</small>
                                                <input id="basic_salary" placeholder="Enter Basic Salary" step="0.01" type="number"
                                                    min="{{ $employee->employment_type == 'expatriate' ? '2000' : '1000' }}"
                                                    max="{{ $employee->employment_type == 'expatriate' ? '10000' : '150000' }}"
                                                    name="basic_salary" class="form-control form-control-sm"
                                                    value="">
                                            </div>
                                        </div>
                                        @if ($is_expatriate)
                                            <div class="mb-2 col-sm-6 salary-type-container">
                                                <div class="form-group">
                                                    <label for="salary_type">Salary Type</label>
                                                    <small class="required-field">*</small>
                                                    <select id="salary_type" placeholder="Enter Salary Type"
                                                        name="salary_type" class="form-control form-control-sm">
                                                        <option value="">- Select -</option>
                                                        <option value="nps">NPS</option>
                                                        <option value="pf">PF</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="mb-2 col-sm-6 basic-salary-india-container">
                                                <div class="form-group">
                                                    <label for="basic_salary_for_india">Basic Salary For India</label>
                                                    <small class="required-field">*</small>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <select name="currency_salary_for_india"
                                                                id="currency_salary_for_india"
                                                                name="currency_salary_for_india"
                                                                class="form-control form-control-sm">
                                                                <option value="inr">₹</option>
                                                            </select>
                                                        </div>
                                                        <div class="pl-0 col-md-9">
                                                            <input id="basic_salary_for_india" placeholder="Enter "
                                                                type="number" name="basic_salary_for_india"
                                                                class="form-control form-control-sm">
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                            <div class="mb-2 col-sm-6 da-container">
                                                <div class="form-group">
                                                    <label for="da"><span>DA(%)</span></label>
                                                    <small class="required-field">*</small>
                                                    <input id="da" placeholder="Enter " type="number"
                                                        name="da" maxlength="3" minlength="1" min="1"
                                                        max="99" pattern="[0-9]+"
                                                        class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        @endif
                                        <div class="mt-2 mb-2 col-sm-6">
                                            <div class="form-group">
                                                <label for="union_membership_id">Union Membership</label>
                                                <br>
                                                <input type="radio" id="radio1" name="union_membership_id"
                                                    value="no" class="form-check-input" title="Select NO" />
                                                <label class="form-check-label" title="Select NO"
                                                    for="radio1">No</label>

                                                <input type="radio" id="radio2" name="union_membership_id"
                                                    value="yes" class="form-check-input" title="Select YES"
                                                    style="margin-left: 20px" />
                                                <label class="form-check-label" title="Select YES"
                                                    for="radio2">Yes</label>
                                            </div>
                                        </div>
                                        <div class="mt-2 mb-2 col-sm-6">
                                            <div class="form-group">
                                                <label for="is_medical_insuarance">Is Bomaid / Medical Insuarance</label>
                                                <br>
                                                <input type="radio" id="bomaid_radio" name="is_medical_insuarance"
                                                    value="0" class="form-check-input" title="Select NO" />
                                                <label class="form-check-label" title="Select NO"
                                                    for="bomaid_radio">No</label>

                                                <input type="radio" id="bomaid_radio_2" name="is_medical_insuarance"
                                                    value="1" class="form-check-input" title="Select YES"
                                                    style="margin-left: 20px" />
                                                <label class="form-check-label" title="Select YES"
                                                    for="bomaid_radio_2">Yes</label>
                                            </div>
                                        </div>
                                        <div class="mt-2 mb-2 col-sm-6">
                                            <div class="form-group">
                                                <label for="pension_opt">Pension Contribution</label>
                                                <small class="required-field">*</small>
                                                <br>
                                                <input type="radio" id="pradio1" name="pension_contribution"
                                                    value="no" class="form-check-input" title="Select NO" />
                                                <label class="form-check-label" title="Select NO" for="pradio1"
                                                    value="no">No</label>

                                                <input type="radio" id="pradio2" name="pension_contribution"
                                                    value="yes" class="form-check-input" title="Select YES"
                                                    style="margin-left: 20px" />
                                                <label class="form-check-label" title="Select YES" for="pradio2"
                                                    value="yes">Yes</label>
                                            </div>
                                        </div>
                                        <div class="mb-2 col-sm-6" id="pensionDropdown" style="display: none;">
                                            <div class="form-group">
                                                <label for="pension_opt">Pension (%)</label>
                                                <small class="required-field">*</small>
                                                <select name="pension_opt" id="pension_opt"
                                                    class="form-control form-control-sm">
                                                    <option value="">Choose %</option>
                                                    <option value="4">4%</option>
                                                    <option value="5">5%</option>
                                                </select>
                                            </div>
                                        </div>



                                    </div>
                                    <hr>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-white" id="btnSave">
                                        </button>
                                    </div>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>

    </main>
@endsection
@push('custom-scripts')
    <script>
        function addSalaryhistory(user_id) {
            $('#form_id').trigger("reset");
            $("#id").val("");
            $('#formModal').modal('show');
            $("#modalTitle").html("Add: Salary Revisions");
            $("#btnSave").html("CREATE");
            $("#user_id").val(user_id);
        }
        $(document).ready(() => {
            $(document).on("click", "#editButton", (event) => {
                $('#form_id').trigger("reset");
                $("#modalTitle").html("Edit: Salary Revisions");
                $("#btnSave").html("UPDATE");

                let id = $(event.currentTarget).data("id");
                let user_id = $(event.currentTarget).data("user_id");
                let currency_salary_for_india = $(event.currentTarget).data("currency_salary_for_india");
                let salary_type = $(event.currentTarget).data("salary_type");
                let basic_salary = $(event.currentTarget).data("basic_salary");
                let currency_salary = $(event.currentTarget).data("currency_salary");
                let date_of_current_basic = $(event.currentTarget).data("date_of_current_basic");
                let basic_salary_for_india = $(event.currentTarget).data("basic_salary_for_india");
                let pension_contribution = $(event.currentTarget).data("pension_contribution");
                let pension_opt = $(event.currentTarget).data("pension_opt");
                let da = $(event.currentTarget).data("da");
                let union_membership_id = $(event.currentTarget).data("union_membership_id");
                let is_medical_insuarance = $(event.currentTarget).data("is_medical_insuarance");
                let status = $(event.currentTarget).data("status");

                $("#id").val(id);
                $("#user_id").val(user_id);
                $("#currency_salary").val(currency_salary);
                $("#basic_salary").val(basic_salary);
                if (salary_type) {
                    if (salary_type === 'nps') {
                        $('.basic-salary-india-container').show();
                        $('.da-container').show();
                    } else if (salary_type === 'pf') {
                        $('.basic-salary-india-container').show();
                    }
                }
                $("#da").val(da);

                $("#salary_type").val(salary_type);
                $("#date_of_current_basic").val(date_of_current_basic);
                $("#currency_salary_for_india").val(currency_salary_for_india);
                $("#da").val(da);
                console.log(is_medical_insuarance);
                if (union_membership_id == "yes") {
                    $('#radio2').prop('checked', true);
                } else {
                    $('#radio1').prop('checked', true);
                }
                if (is_medical_insuarance == "1") {
                    $('#bomaid_radio_2').prop('checked', true);
                } else {
                    $('#bomaid_radio').prop('checked', true);
                }

                if (pension_contribution == "yes") {
                    $('#pradio2').prop('checked', true);
                    $("#pensionDropdown").css('display', "");
                } else {
                    $('#pradio1').prop('checked', true);
                }

                $("#pension_opt").val(pension_opt);

                $("#basic_salary_for_india").val(basic_salary_for_india);

                $('#formModal').modal('show');
            });
        });
    </script>

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
