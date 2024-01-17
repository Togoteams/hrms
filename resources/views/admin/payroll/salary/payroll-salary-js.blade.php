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
            taxAbleAmount = (basicAmount + getValue('allowance') + getValue('others_arrears') + getValue('over_time') - (getValue('pension_own') - getValue('pension_bank')));
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
            totalEarning = (basicAmount + getValue('allowance') + getValue('bomaid_bank')+ getValue('others_arrears')+ getValue('pension_bank')+ getValue('over_time')).toFixed(2);
            totalDeduction = (taxAmount + getValue('bomaid') + getValue('pension_own') + unionFee + getValue('other_deductions')).toFixed(2);
            // setId('union_fee', unionFee);
        } else {

            var educationAllowanceAmount = getValue('education_allowance');
            var otherDeductions = getValue('other_deductions');
            var usdToInrAmount = getValue('usdToInrAmount');
            var pulaToInr = getValue('pulaToInr');
            var usdToPulaAmount = getValue('usdToPulaAmount');
            var educationAllowanceAmount = (parseFloat(educationAllowanceAmount) / usdToInrAmount);
            var educationAllowanceAmountInPula =  parseFloat(educationAllowanceAmount*usdToPulaAmount).toFixed(3);
            var otherDeductions = parseFloat(parseFloat(otherDeductions) / usdToPulaAmount).toFixed(3);
            console.log("otherDeductions",(otherDeductions));
            console.log("usdToPulaAmount",(usdToPulaAmount));
            console.log("usdToPulaAmount",(usdToPulaAmount));
            $("#education_allowance_for_ind_in_pula").val(educationAllowanceAmountInPula);
            totalEarning = parseFloat(basicAmount + getValue('entertainment_expenses') +
                getValue('house_up_keep_allow') + educationAllowanceAmount).toFixed(3);
            totalDeduction = Number(getValue('provident_fund') + Number(otherDeductions)+ getValue('recovery_for_car')).toFixed(3);
            console.log(Number(totalDeduction));
        }
        var leaveEncashAmount = parseFloat(getValue("leave_encashment_amount"));
        console.log("totalEarning",Number(totalEarning) + leaveEncashAmount);
        setId('gross_earning', Number(Number(totalEarning) + (leaveEncashAmount)).toFixed(2));
        setId('total_deduction', Number(totalDeduction).toFixed(2));
        setId('net_take_home', (Number((Number(totalEarning)+ (leaveEncashAmount)) - totalDeduction)).toFixed(2));

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