@extends('layouts.app')
@push('styles')
<style>
    .table-nowrap td,
    .table-nowrap th {
        white-space: normal !important;
    }
</style>
@endpush
@section('content')
<main id="content" role="main" class="main card ">
    <!-- Content -->
    <div class="container-fluid">
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
            <div class="p-5 card">
                <form id="form_data" action="{{ route('admin.payroll.salary.store') }}">
                    @csrf
                    <input type="hidden" name="created_at" value="{{ date('Y-m-d h:s:i') }}">

                    <div class="row">
                        <div class="mb-2 col-sm-4">
                            <div class="form-group">
                                <label for="pay_for_month_year" class="required">Pay For Month</label>
                                <input type="month" class="form-control form-control-sm" name="pay_for_month_year" id="pay_for_month_year" required>
                            </div>
                        </div>
                        <div class="mb-2 col-sm-4">
                            <div class="form-group">
                                <label for="gender">Select Employees</label>
                                <select required  id="select_employee" placeholder="Enter correct Employee  " name="user_id" class="form-control form-control-sm ">
                                    <option selected disabled> - Select Employees- </option>
                                    @foreach ($all_users as $au)
                                    <option value="{{ $au->user->id }}">{{ $au->user->name }} -
                                        {{ $au->ec_number }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-2 col-sm-4">
                            <div class="mt-4 form-group">
                                <button type="button" onclick="callEditMethod()" class="btn btn-primary btn-sm">Search</button>
                            </div>
                        </div>
                        <span id="edit">

                        </span>
                    </div>
                    <hr>
                    <div class="mt-1 text-center" style="display: none" id="table_data_btn">
                        <button type="button" onclick="ajaxCall('form_data')" class="btn btn-primary btn-sm">Add
                            {{ $page }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection

@push('custom-scripts')
<script>
    function setId(id, value) {
        document.getElementById(id).value = value;
    }

    function getValue(id) {
        // console.log(id);
        return Number(document.getElementById(id).value);
    }

    function taxCalCalculation(e){
        var basicAmount = getValue('basic');
        employmentType = document.getElementById('employment_type').value;
        var taxCalcUrl ="{{route('admin.payroll.payscale.tax.cal')}}";
        var taxAbleAmount = 0;

        if(employmentType=="local")
        {
            taxAbleAmount = (basicAmount + getValue('allowance'))- (getValue('bomaid') + getValue('pension'));
        }else{
            taxAbleAmount = (basicAmount + getValue('entertainment_expenses') + getValue('house_up_keep_allow') + getValue('education_allowance'));
        }

        $.ajax({
            url: taxCalcUrl,
            type: "get",
            data:{"taxable_amount":taxAbleAmount,'employment_type':employmentType},
            dataType: "json",
            success: function (result) {
               console.log(result);
               if(result.status==true)
               {
                var data = result.data;
                $("#tax").val(data.tax_amount);
                console.log(data.tax_amount);
               }else
               {
                $("#tax").val(0);
               }
               amount_cal(e);
            },
        });
    }


    function amount_cal(data, operator = null) {
        var total_gross_amount = 0;
        var total_deduction = 0;
        var totalEarning = 0;
        var totalDeduction = 0;

        var employmentType = document.getElementById('employment_type').value;

        var basicAmount = getValue('basic');
        console.log(basicAmount);
        if (employmentType == "local") {
            var unionFee = getValue('union_fee');
            var taxAmount = getValue('tax');
            // if (basicAmount) {
            //     unionFee = basicAmount / 100;
            // }
            totalEarning = (basicAmount + getValue('allowance') + getValue('others_arrears')+ getValue('over_time')).toFixed(2);
            totalDeduction = (taxAmount + getValue('bomaid') + getValue('pension') + unionFee + getValue('other_deductions')).toFixed(2);
            // setId('union_fee', unionFee);
        } else {

            var educationAllowanceAmount = getValue('education_allowance');
            var otherDeductions = getValue('other_deductions');
            var inrToUSDAmount = getValue('inrToUSDAmount');
            var educationAllowanceAmount = (educationAllowanceAmount * inrToUSDAmount);
            var otherDeductions = (otherDeductions * inrToUSDAmount);

            totalEarning = (basicAmount + getValue('entertainment_expenses') +
                getValue('house_up_keep_allow') + educationAllowanceAmount);
            totalDeduction = (getValue('provident_fund') + otherDeductions + getValue('recovery_for_car'));
        }

        setId('gross_earning', totalEarning);
        setId('total_deduction', totalDeduction);
        setId('net_take_home', (totalEarning - totalDeduction));

    }
    // editForm('{{ route('admin.payroll.salary.emp.head') }}/'+this.value, 'edit')
    const editUrl="{{ route('admin.payroll.salary.emp.head') }}/";
    function callEditMethod()
    {
        var empId = $("#select_employee").val();
        // var empId = $("#employee").val();
        console.log(empId);
        $(".err_message").removeClass("d-block").hide();
        var pay_for_month_year = $("#pay_for_month_year").val();
        if(empId==null || empId=="" )
        {
            let empErrMessage ="Please Select Employee";
            $("#select_employee").after("<p class='d-block text-danger err_message'>" + empErrMessage + "</p>");
        }
        if(pay_for_month_year=="")
        {
            let valueMessage="Please Select salary Month";
            $("#pay_for_month_year").after("<p class='d-block text-danger err_message'>" +valueMessage +"</p>");
        }

        if(pay_for_month_year!="" && empId!=""){
            editForm(editUrl+empId+"/"+pay_for_month_year, 'edit');
            // taxCalCalculation();
            setTimeout(() => {
                 taxCalCalculation(2);
            }, 1500);
        }
    }

    $(document).ready(function() {
        // taxCalCalculation("e");
    });
</script>

@endpush

