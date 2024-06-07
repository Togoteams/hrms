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
                                            <button type="button" class="btn btn-white btn-sm"
                                                title="Add Emp Salary History"
                                                onclick="addEmpLoanHistory({{ !empty($employee) ? $employee->user_id : '' }})">
                                                Add Loan
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row this-div">

                                        @if (!empty($empLoanHistories))
                                            @forelse  ($empLoanHistories as $empLoanHistory)
                                                <div class="pb-4 card-table">
                                                    <div class="p-3 card">
                                                        <div class="row">
                                                            <div class="col-10">
                                                                <div class="row text-dark">
                                                                    <div class="col-3 fw-semibold">Loan Start Date
                                                                    </div>
                                                                    <div class="col-3">
                                                                        {{ date('d-m-Y', strtotime($empLoanHistory->emi_start_date)) }}
                                                                    </div>
                                                                    <div class="col-3 fw-semibold">Loan End Date
                                                                    </div>
                                                                    <div class="col-3">
                                                                        {{ date('d-m-Y', strtotime($empLoanHistory->emi_end_date)) }}
                                                                    </div>

                                                                    <div class="col-3 fw-semibold">Loan Type</div>
                                                                    <div class="col-3">
                                                                        {{Str::headline($empLoanHistory->loan_types) }}
                                                                    </div>
                                                                    <div class="col-3 fw-semibold">Loan Amount</div>
                                                                    <div class="col-3">
                                                                        {{ ($empLoanHistory->loan_amount) }}
                                                                    </div>
                                                                    <div class="col-3 fw-semibold">EMI Amount(In PULA)</div>
                                                                    <div class="col-3">
                                                                        {{ ($empLoanHistory->emi_amount) }}
                                                                    </div>
                                                                    <div class="col-3 fw-semibold">Loan Account No</div>
                                                                    <div class="col-3">
                                                                        {{ ($empLoanHistory->loan_account_no) }}
                                                                    </div>
                                                                    <div class="col-3 fw-semibold">Status</div>
                                                                    <div class="col-3">
                                                                        {{ Str::headline($empLoanHistory->status) }}
                                                                    </div>



                                                                </div>
                                                            </div>
                                                            <div class="col-2 text-end">
                                                                <div class="right-div">
                                                                    <!-- Your content for right div goes here -->
                                                                    <button class="btn btn-edit btn-sm bt" title="Edit"
                                                                        id="editButton" data-id="{{ $empLoanHistory->id }}"
                                                                        data-loan_types="{{ $empLoanHistory->loan_types }}"
                                                                        data-account_id="{{ $empLoanHistory->account_id }}"
                                                                        data-loan_amount="{{ $empLoanHistory->loan_amount }}"
                                                                        data-loan_account_no="{{ $empLoanHistory->loan_account_no }}"
                                                                        data-emi_amount="{{ $empLoanHistory->emi_amount }}"
                                                                        data-emi_start_date="{{ $empLoanHistory->emi_start_date }}"
                                                                        data-emi_end_date="{{ $empLoanHistory->emi_end_date }}"
                                                                        data-description="{{ $empLoanHistory->description }}"
                                                                        data-status="{{ $empLoanHistory->status }}"
                                                                        >
                                                                        <i class="fas fa-edit"></i>
                                                                    </button>

                                                                    <button class="btn btn-delete btn-sm bt deleteRecord"
                                                                        title="Delete" data-id="{{ $empLoanHistory->id }}"
                                                                        data-token="{{ csrf_token() }}"
                                                                        data-action="{{ route('admin.employee.loan-history.delete') }}">
                                                                        <i class="fas fa-trash-alt"></i>
                                                                    </button>
                                                                    <button type="button" data-table="emp_loan_histories" data-uuid="{{$empLoanHistory->id}}"
                                                                        @if($empLoanHistory->status=="active") data-value="inactive" data-message="Completed"  @else data-value="active" data-message="Active" @endif
                                                                        class="btn btn-edit btn-sm changeStatus" ><i class="fas  @if($empLoanHistory->status=="active") fa-toggle-on  @else fa-toggle-off @endif"
                                                                            @if($empLoanHistory->status=="active") title="Active"  @else title="Completed" @endif  data-bs-toggle="tooltip"  ></i>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="pb-4">
                                                    <div class="p-3 card">Loan Not found</div>
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
                                action="{{ route('admin.employee.loan-history.post') }}">
                                    @csrf
                                    <input type="hidden" name="id" id="id">
                                    <input type="hidden" name="user_id" value="{{$employee->user_id}}">
                                    <input type="hidden" name="employee_id" value="{{$employee->id}}">

                                    <div class="row">
                                        
                                        <div class="mb-2 col-sm-4">
                                            <div class="form-group">
                                                <label for="loan_types">Type Of Loan</label>
                                                <select required id="loan_types" name="loan_types"
                                                    class="form-control form-control-sm ">
                                                    <option selected disabled> - Select Loans- </option>
                                                    <option value="personal_loan">Personal Loan </option>
                                                    <option value="car_loan">Car Loan </option>
                                                    <option value="mortgage_loan">Mortgage Loan</option>
                                                    <option value="salary_advance">Salary advance</option>
                                                   
                                                </select>
                                            </div>
                                        </div>
            
                                        <div class="mb-2 col-sm-4">
                                            <div class="form-group">
                                                <label for="loan_amount">Loan Amount (In PULA)</label>
                                                <input required id="loan_amount" placeholder="Enter loan_amount" type="text"
                                                    name="loan_amount" maxlength="7" minlength="3" pattern="[0-9]+"
                                                    class="form-control form-control-sm ">
                                            </div>
                                        </div>
                                        <div class="mb-2 col-sm-4">
                                            <div class="form-group">
                                                <label for="emi_amount">EMI Amount (In PULA)</label>
                                                <input required id="emi_amount" placeholder="Enter emi_amount   " type="text"
                                                    name="emi_amount" maxlength="7" minlength="3" pattern="[0-9]+"
                                                    class="form-control form-control-sm ">
                                            </div>
                                        </div>
                                       
                                        <div class="mb-2 col-sm-4">
                                            <div class="form-group">
                                                <label for="loan_account_no">Loan Account No </label>
                                                <input required id="loan_account_no" placeholder="Enter Loan Account Number  "
                                                    type="text" name="loan_account_no" maxlength="16" minlength="14"
                                                    pattern="[0-9]+" class="form-control form-control-sm number-input ">
                                            </div>
                                        </div>
                                        {{-- <div class="mb-2 col-sm-4">
                                            <div class="form-group">
                                                <label for="account_id">Loan Account No </label>
                                                <select name="account_id" id="account_id" class="form-control form-control-sm " >
                                                    <option value="">--select--</option>
                                                    @foreach ($loanAccounts as  $key => $value)
                                                        <option value="{{$value->id}}">{{$value->name}}({{$value->account_number}})</option>
                                                    @endforeach
                                                </select>
                                                
                                            </div>
                                        </div> --}}
                                        <div class="mb-2 col-sm-4">
                                            <div class="form-group">
                                                <label for="emi_start_date">EMI Start Date</label>
                                                <input required id="emi_start_date" placeholder="Enter emi_start_date   "
                                                    type="date" name="emi_start_date" class="form-control form-control-sm ">
                                            </div>
                                        </div>
                                        <div class="mb-2 col-sm-4">
                                            <div class="form-group">
                                                <label for="emi_end_date">EMI End Date</label>
                                                <input required id="emi_end_date" placeholder="Enter emi_end_date" type="date"
                                                    name="emi_end_date" class="form-control form-control-sm ">
                                            </div>
                                        </div>
                                        <div class="mb-2 col-sm-12">
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea id="description" placeholder="Enter  Description..." type="text" name="description"
                                                    class="form-control form-control-sm "></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="text-center ">
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
        function addEmpLoanHistory(user_id) {
            $('#form_id').trigger("reset");
            $("#id").val("");
            $('#formModal').modal('show');
            $("#modalTitle").html("Add: Loan");
            $("#btnSave").html("CREATE");
            $("#user_id").val(user_id);
        }
        $(document).ready(() => {
            $(document).on("click", "#editButton", (event) => {
                $('#form_id').trigger("reset");
                $("#modalTitle").html("Edit: Loan");
                $("#btnSave").html("UPDATE");

                let id = $(event.currentTarget).data("id");
                let user_id = $(event.currentTarget).data("user_id");
                let loan_types = $(event.currentTarget).data("loan_types");
                let account_id = $(event.currentTarget).data("account_id");
                let loan_account_no = $(event.currentTarget).data("loan_account_no");
                let loan_amount = $(event.currentTarget).data("loan_amount");
                let emi_amount = $(event.currentTarget).data("emi_amount");
                let emi_start_date = $(event.currentTarget).data("emi_start_date");
                let emi_end_date = $(event.currentTarget).data("emi_end_date");
                let description = $(event.currentTarget).data("description");
                let status = $(event.currentTarget).data("status");

                $("#id").val(id);
                $("#account_id").val(account_id);
               
                $("#loan_amount").val(loan_amount);
                $("#loan_account_no").val(loan_account_no);
                $("#emi_start_date").val(emi_start_date);
                $("#emi_end_date").val(emi_end_date);
                $("#loan_types").val(loan_types);



                $("#emi_amount").val(emi_amount);
                $("#description").html(description);

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
   
@endpush
