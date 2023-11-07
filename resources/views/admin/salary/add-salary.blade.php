@extends('layouts.app')
@push('styles')
@endpush
@section('content')
<main id="content" role="main" class="main">
    <!-- Content -->
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="mt-2 mb-2">
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
        <div class="row card py-4 px-4">
            <form id="form_data" action="{{ route('admin.salary.store') }}" method="post">
                @csrf
                <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
                <div class="row mb-5">
                    <div class="title">
                        <h4 class="fw-normal">Add Salary</h4>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label for="basic">Employee</label>
                            <input required id="basic" placeholder="" type="text" name="basic"
                                class="form-control form-control-sm ">
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label for="">Select Employee</label>
                            <select required id="" placeholder="Select Employee" name=""
                                class="form-control form-control-sm ">
                                <option selected> -Select Emp- </option>
                                <option>One </option>
                                <option>Two </option>
                                <option>Three </option>
                                <option>Four </option>
                                <option>Five </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="text-left mt-5">
                            <button type="submit" class="btn btn-dark btn-sm" title="Submit">
                                Submit
                            </button>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-6 mb-2">
                        <div class="title">
                            <h4 class="fw-normal">Basic Details</h4>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="basic">Basic</label>
                                    <input required id="basic" placeholder="Enter correct basic" type="text"
                                        name="basic" class="form-control form-control-sm ">
                                </div>
                            </div>

                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="hra">HRA</label>
                                    <input required id="hra" placeholder="Enter correct hra" type="text" name="hra"
                                        class="form-control form-control-sm ">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="overtime">Overtime</label>
                                    <input required id="overtime" placeholder="Enter correct overtime" type="text"
                                        name="overtime" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="arrear">Arrear</label>
                                    <input required id="arrear" placeholder="Enter correct arrear" type="text"
                                        name="arrear" class="form-control form-control-sm ">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="union_membership">Union Membership </label>
                                    <select required id="union_membership" placeholder="Enter correct union_membership"
                                        name="union_membership" class="form-control form-control-sm ">
                                        <option selected disabled> - Select union membership - </option>
                                        @foreach ($membership as $mem)
                                        <option value="{{ $mem->id }}">{{ $mem->name }} -
                                            {{ $mem->amount }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="shift">Shift</label>
                                    <input required id="shift" placeholder="Enter correct shift" type="text"
                                        name="shift" class="form-control form-control-sm ">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="working_hours_start">Eorking Hours Start</label>
                                    <input required id="working_hours_start"
                                        placeholder="Enter correct working_hours_start" type="text"
                                        name="working_hours_start" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="working_hours_end">Working Hours End</label>
                                    <input required id="working_hours_end" placeholder="Enter correct working_hours_end"
                                        type="text" name="working_hours_end" class="form-control form-control-sm ">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="no_of_payable_days">No of Payable Days</label>
                                    <input required id="no_of_payable_days"
                                        placeholder="Enter correct no_of_payable_days" type="text"
                                        name="no_of_payable_days" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="conveyance">Conveyance</label>
                                    <input required id="conveyance" placeholder="Enter correct conveyance" type="text"
                                        name="conveyance" class="form-control form-control-sm ">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="special">Special</label>
                                    <input required id="special" placeholder="Enter correct special" type="text"
                                        name="special" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="mobile">Mobile</label>
                                    <input required id="mobile" placeholder="Enter correct mobile" type="text"
                                        name="mobile" class="form-control form-control-sm ">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="bonus">Bonus</label>
                                    <input required id="bonus" placeholder="Enter correct bonus" type="text"
                                        name="bonus" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="transportation">Transportation</label>
                                    <input required id="transportation" placeholder="Enter correct transportation"
                                        type="text" name="transportation" class="form-control form-control-sm ">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="food">Food</label>
                                    <input required id="food" placeholder="Enter correct food" type="text" name="food"
                                        class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="medical">Medical</label>
                                    <input required id="medical" placeholder="Enter correct medical" type="text"
                                        name="medical" class="form-control form-control-sm ">
                                </div>
                            </div>
                        </div>





                        <div class="row">
                            <div class="col-sm-12 mb-2">
                                <button type="button" class="btn btn-outline-dark col-12">Calculate</button>

                            </div>
                        </div>


                    </div>
                    <div class="col-sm-6 mb-2">
                        <div class="title">
                            <h4 class="fw-normal">Employee Deduction</h4>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="pf_per">PF Per</label>
                                    <input required id="pf_per" placeholder="Enter correct pf_per" type="text"
                                        name="pf_per" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="pf_amount">PF Amount</label>
                                    <input required id="pf_amount" placeholder="Enter correct pf_amount" type="text"
                                        name="pf_amount" class="form-control form-control-sm ">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="pension_per">Pension Per</label>
                                    <input required id="pension_per" placeholder="Enter correct pension_per" type="text"
                                        name="pension_per" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="pension_amount">Pension Amount</label>
                                    <input required id="pension_amount" placeholder="Enter correct pension_amount"
                                        type="text" name="pension_amount" class="form-control form-control-sm ">
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="loans_deduction">Loan Deduction</label>
                                    <input required id="loans_deduction" placeholder="Enter correct loans_deduction"
                                        type="text" name="loans_deduction" class="form-control form-control-sm ">
                                </div>

                            </div>
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="gross_earning">gross_earning</label>
                                    <input required id="gross_earning" placeholder="Enter correct gross_earning"
                                        type="text" name="gross_earning" class="form-control form-control-sm ">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="esi_per">ESI Per</label>
                                    <input required id="esi_per" placeholder="Enter correct esi_per" type="text"
                                        name="esi_per" class="form-control form-control-sm ">
                                </div>

                            </div>
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="esi_amount">ESI Amount</label>
                                    <input required id="esi_amount" placeholder="Enter correct esi_amount" type="text"
                                        name="esi_amount" class="form-control form-control-sm ">
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="income_tax_deductions">Income Tax Deductions</label>
                                    <input required id="income_tax_deductions"
                                        placeholder="Enter correct income_tax_deductions" type="text"
                                        name="income_tax_deductions" class="form-control form-control-sm ">
                                </div>

                            </div>
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="penalty_deductions">Penalty Deductions</label>
                                    <input required id="penalty_deductions"
                                        placeholder="Enter correct penalty_deductions" type="text"
                                        name="penalty_deductions" class="form-control form-control-sm ">
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="title">
                                <h4 class="fw-normal">Employer Deduction</h4>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="fixed_deductions">Fixed Deductions</label>
                                    <input required id="fixed_deductions" placeholder="Enter correct fixed_deductions"
                                        type="text" name="fixed_deductions" class="form-control form-control-sm ">
                                </div>

                            </div>
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="other_deductions">Other Deductions</label>
                                    <input required id="other_deductions" placeholder="Enter correct other_deductions"
                                        type="text" name="other_deductions" class="form-control form-control-sm ">
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="net_take_home">Net Take Home</label>
                                    <input required id="net_take_home" placeholder="Enter correct net_take_home"
                                        type="text" name="net_take_home" class="form-control form-control-sm ">
                                </div>

                            </div>
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="ctc">CTC</label>
                                    <input required id="ctc" placeholder="Enter correct ctc" type="text" name="ctc"
                                        class="form-control form-control-sm ">
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="total_employer_contribution">Total Employer Contribution</label>
                                    <input required id="total_employer_contribution"
                                        placeholder="Enter correct total_employer_contribution" type="text"
                                        name="total_employer_contribution" class="form-control form-control-sm ">
                                </div>

                            </div>
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="total_deduction">Total Deduction</label>
                                    <input required id="total_deduction" placeholder="Enter correct total_deduction"
                                        type="text" name="total_deduction" class="form-control form-control-sm ">
                                </div>

                            </div>
                        </div>
                        <div class="row bg-orange-light">
                            <div class="col-sm-6 mb-2 mt-2">
                                <label class="fw-medium text-dark">Gross: &nbsp;<span class="fw-bold">₹
                                        2000.00</span></label>
                            </div>
                            <div class="col-sm-6 mb-2 mt-2">
                                <label class="fw-medium text-dark">Net take Home: &nbsp;<span class="fw-bold">₹
                                        199.00</span></label>

                            </div>
                            <div class="col-sm-6 mb-2">
                                <label class="fw-medium text-red">Total: &nbsp;<span class="fw-bold">₹
                                        12000.00</span></label>

                            </div>
                            <div class="col-sm-6 mb-2">
                            </div>
                           
                        </div>
                    </div>
                </div>
            </form>
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
@push('custom-scripts')
<script>
$(document).ready(function() {
    $("#user_id").change(() => {
        let userID = $("#user_id").val();

        $.ajax({
            url: "{{ url('admin/payroll/pay-scale/get-payscale') }}" + "/" + userID,
            method: "GET",
            contentType: 'application/json',
            dataType: "json",
            success: function(response) {
                $('#basic').val(response.data.basic);
                $('#hra').val(response.data.hra);
                $('#overtime').val(response.data.overtime);
                $('#arrear').val(response.data.arrear);
                $('#union_membership').val(response.data.union_membership);
                $('#pf_per').val(response.data.pf_per);
                $('#pf_amount').val(response.data.pf_amount);
                $('#pension_per').val(response.data.pension_per);
                $('#pension_amount').val(response.data.pension_amount);
                $('#loans_deduction').val(response.data.loans_deduction);
                $('#no_of_working_days').val(response.data.no_of_working_days);
                $('#no_of_paid_leaves').val(response.data.no_of_paid_leaves);
                $('#shift').val(response.data.shift);
                $('#working_hours_start').val(response.data.union_membership);
                $('#working_hours_end').val(response.data.union_membership);
                $('#no_of_payable_days').val(response.data.no_of_payable_days);
                $('#conveyance').val(response.data.conveyance);
                $('#special').val(response.data.special);
                $('#mobile').val(response.data.mobile);
                $('#bonus').val(response.data.bonus);
                $('#transportation').val(response.data.transportation);
                $('#food').val(response.data.food);
                $('#medical').val(response.data.medical);
                $('#gross_earning').val(response.data.gross_earning);
                $('#esi_per').val(response.data.esi_per);
                $('#esi_amount').val(response.data.esi_amount);
                $('#income_tax_deductions').val(response.data.income_tax_deductions);
                $('#penalty_deductions').val(response.data.penalty_deductions);
                $('#fixed_deductions').val(response.data.fixed_deductions);
                $('#other_deductions').val(response.data.other_deductions);
                $('#net_take_home').val(response.data.net_take_home);
                $('#ctc').val(response.data.ctc);
                $('#total_employer_contribution').val(response.data
                    .total_employer_contribution);
                $('#total_deduction').val(response.data.total_deduction);
            }
        });
    });
});
</script>
@endpush