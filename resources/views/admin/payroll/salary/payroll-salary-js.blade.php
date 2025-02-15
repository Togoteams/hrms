<script>
    function setId(id, value) {
        document.getElementById(id).value = value;
    }

    function getValue(id) {
        // console.log(id);
        return Number(document.getElementById(id).value);
    }

    function taxCalCalculation() {
        var basicAmount = getValue('basic');
        employmentType = document.getElementById('employment_type').value;
        var taxCalcUrl = "{{ route('admin.payroll.payscale.tax.cal') }}";
        var taxAbleAmount = 0;
        var montlyIncome = 0;
        var salaryHead;
        if (employmentType == "local") {
            salaryHead ={
                'basicAmount':basicAmount,
                'allowance': getValue('allowance'),
                'employee_id': getValue('select_employee'),
                'pension_own':getValue('pension_own'),
                'pension_bank':getValue('pension_bank'),
                'others_arrears':getValue('others_arrears'),
                'over_time':getValue('over_time')
            };
            montlyIncome = (basicAmount +getValue('others_arrears') + getValue('over_time')+ getValue('allowance') -(getValue('pension_own') - getValue('pension_bank'))) * 12;
            taxAbleAmount = (montlyIncome);
            net_take_home =getValue('net_take_home');
        } else {
             salaryHead ={
                'basicAmount':basicAmount,
                'house_up_keep_allow': getValue('house_up_keep_allow'),
                'employee_id': getValue('select_employee'),
                'entertainment_expenses':getValue('entertainment_expenses'),
                'education_allowance':getValue('education_allowance'),
                'others_arrears':getValue('others_arrears'),
                'reimbursement':getValue('reimbursement_for_tax')
            };
            montlyIncome = (basicAmount + getValue('house_up_keep_allow')) *12;
            net_take_home =getValue('net_take_home');
            // taxAbleAmount = (montlyIncome + getValue('entertainment_expenses')+
            //     getValue('education_allowance'));
            var usdToPulaAmount = getValue('usdToPulaAmount');
            var removetaxAmount = (getValue('reimbursement') - getValue('reimbursement_for_tax'))/usdToPulaAmount;
            console.log("reimbursement_for_tax",getValue('reimbursement_for_tax'));
            console.log("usdToPulaAmount",usdToPulaAmount);
            taxAbleAmount = getValue('gross_earning') - removetaxAmount;
        }

        $.ajax({
            url: taxCalcUrl,
            type: "get",
            data: {
                "taxable_amount": taxAbleAmount,
                "salary_head": salaryHead,
                "net_take_home": net_take_home,
                'employment_type': employmentType
            },
            dataType: "json",
            success: function(result) {
                console.log(result);
                if (result.status == true) {
                    var data = result.data;
                    $("#tax").val(data.tax_amount);
                    $("#taxable_amount_in_pula").val(data.monthly_taxable_amount);
                    $("#tax_amount_in_pula").val(data.tax_amount);
                    console.log(data.tax_amount);
                } else {
                    $("#tax").val(0);
                }
                amount_cal();
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
        var emp13ChequeAmount = getValue('emp_13_cheque_amount');
        if (employmentType == "local") {
            var unionFee = getValue('union_fee');
            var taxAmount = getValue('tax');
            totalEarning = (basicAmount + getValue('allowance') + emp13ChequeAmount + getValue('bomaid_bank') +
                getValue('others_arrears') + getValue('pension_bank') + getValue('over_time')).toFixed(2);
            totalDeduction = (taxAmount + getValue('bomaid') + getValue('salary_advance') + getValue('mortgage_loan') +
                getValue('car_loan') + getValue('personal_loan') + getValue('pension_own') + unionFee + getValue(
                    'other_deductions')).toFixed(2);
        } else {

            var educationAllowanceAmount = getValue('education_allowance');
            var otherDeductions = getValue('other_deductions');
            var salaryAdvance = getValue('salary_advance');
            var mortgageLon = Number(getValue('mortgage_loan'));
            var carLoan = Number(getValue('car_loan'));
            var othersArrears = Number(getValue('others_arrears'));
            var reimbursement = Number(getValue('reimbursement'));
            var personalLoan = Number(getValue('personal_loan'));
            var usdToInrAmount = Number(getValue('usdToInrAmount'));
            var pulaToInr = getValue('pulaToInr');
            var usdToPulaAmount = getValue('usdToPulaAmount');
            var educationAllowanceAmount = (parseFloat(educationAllowanceAmount) / usdToInrAmount);
            var educationAllowanceAmountInPula = parseFloat(educationAllowanceAmount * usdToPulaAmount).toFixed(3);
            var otherDeductions = parseFloat(parseFloat(otherDeductions) / usdToPulaAmount).toFixed(3);
            reimbursement = parseFloat(parseFloat(reimbursement) / usdToPulaAmount).toFixed(3);
            var mortgageLoanUsd = parseFloat(parseFloat(mortgageLon) / usdToPulaAmount).toFixed(3);
            var salaryAdvanceLoanUSD = parseFloat(parseFloat(salaryAdvance) / usdToPulaAmount).toFixed(3);
            var carLoanUSD = parseFloat(parseFloat(carLoan) / usdToPulaAmount).toFixed(3);
            var personalLoanUSD = parseFloat(parseFloat(personalLoan) / usdToPulaAmount).toFixed(3);
            console.log(personalLoanUSD);
            console.log(mortgageLoanUsd);
            console.log(salaryAdvanceLoanUSD);
            console.log(reimbursement);
            console.log(carLoanUSD);
            $("#education_allowance_for_ind_in_pula").val(educationAllowanceAmountInPula);
            totalEarning = parseFloat(basicAmount + emp13ChequeAmount + othersArrears + Number(reimbursement) +
                getValue('entertainment_expenses') +
                getValue('house_up_keep_allow') + educationAllowanceAmount).toFixed(3);

            totalDeduction = Number(getValue('provident_fund') + Number(otherDeductions) + Number(
                salaryAdvanceLoanUSD) + Number(mortgageLoanUsd) + Number(carLoanUSD) + Number(personalLoanUSD) +
                getValue('recovery_for_car')).toFixed(3);
            console.log(Number(totalDeduction));
        }
        var leaveEncashAmount = parseFloat(getValue("leave_encashment_amount"));
        setId('gross_earning', Number(Number(totalEarning) + (leaveEncashAmount)).toFixed(2));
        setId('total_deduction', Number(totalDeduction).toFixed(2));
        setId('net_take_home', (Number((Number(totalEarning) + (leaveEncashAmount)) - totalDeduction)).toFixed(2));
        console.log('calculating net_take_home',getValue('net_take_home'));

    }

    // editForm('{{ route('admin.payroll.salary.emp.head') }}/'+this.value, 'edit')
    const editUrl = "{{ route('admin.payroll.salary.emp.head') }}/";

    function callEditMethod() {
        var empId = $("#select_employee").val();
        // var empId = $("#employee").val();
        console.log(empId);
        $(".err_message").removeClass("d-block").hide();
        var pay_for_month_year = $("#pay_for_month_year").val();
        if (empId == null || empId == "") {
            let empErrMessage = "Please Select Employee";
            $("#select_employee").after("<p class='d-block text-danger err_message'>" + empErrMessage + "</p>");
        }
        if (pay_for_month_year == "") {
            let valueMessage = "Please Select salary Month";
            $("#pay_for_month_year").after("<p class='d-block text-danger err_message'>" + valueMessage + "</p>");
        }

        if (pay_for_month_year != "" && empId != "") {
            editForm(editUrl+empId+"/"+pay_for_month_year, 'edit',"GET","",taxCalCalculation);
            // var returndata = editForm(editUrl + empId + "/" + pay_for_month_year, 'edit');
            // taxCalCalculation();
            // console.log(returndata);
            // setTimeout(() => {
            //     taxCalCalculation();
            // }, 3000);
        }
    }

    $(document).ready(function() {
        $("#pay_for_month_year,#select_employee").change(function() {
            callEditMethod();
        });
    });
</script>
