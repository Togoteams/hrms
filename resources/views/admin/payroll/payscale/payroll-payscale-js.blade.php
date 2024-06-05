<script>
    function setId(id, value) {
        document.getElementById(id).value = value;
    }

    function getValue(id) {
        return Number(document.getElementById(id).value);
    }

    function taxCalCalculation(e){
        var basicAmount = getValue('basic');
        employmentType = document.getElementById('employment_type').value;
        var taxCalcUrl ="{{route('admin.payroll.payscale.tax.cal')}}";
        var taxAbleAmount = 0;


        if(employmentType=="local")
        {
            taxAbleAmount = (basicAmount + getValue('allowance') + getValue('others_arrears') + getValue('over_time')- (getValue('pension_own') - getValue('pension_bank')));
            // taxAbleAmount = (basicAmount + getValue('allowance') + getValue('pension_bank')+getValue('bomaid_bank'))- (getValue('bomaid') + getValue('pension_own'));
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


    function amount_cal() {

        
        var total_gross_amount = 0;
        var total_deduction = 0;
        var totalEarning = 0;
        var totalDeduction = 0;
        
        var employmentType = document.getElementById('employment_type').value;
        console.log(employmentType);
        var basicAmount = getValue('basic');
        if(employmentType=="local")
        {
            var taxAmount = getValue('tax');
            var unionFee = getValue('union_fee');

            totalEarning = basicAmount + getValue('allowance')+getValue('bomaid_bank') + getValue('others_arrears')+ getValue('pension_bank') + getValue('over_time');
            totalDeduction = taxAmount + getValue('bomaid') + getValue('pension_own') + unionFee  + getValue('other_deductions');
            setId('union_fee', unionFee);

        }else
        {
            var educationAllowanceAmount = getValue('education_allowance');
            var otherDeductions = getValue('other_deductions');
            var usdToInrAmount = getValue('usdToInrAmount');

            var usdToPulaAmount = getValue('usdToPulaAmount');
            var educationAllowanceAmount = (parseFloat(educationAllowanceAmount) / usdToInrAmount);
            var otherDeductions = (parseFloat(otherDeductions) / usdToPulaAmount);

            totalEarning = basicAmount + getValue('entertainment_expenses')+
             getValue('house_up_keep_allow')+  educationAllowanceAmount;
             totalDeduction = getValue('provident_fund') + otherDeductions + getValue('recovery_for_car') ;
        }

        setId('gross_earning', Number(totalEarning).toFixed(2));
        setId('total_deduction', Number(totalDeduction).toFixed(2));
        setId('net_take_home',Number(totalEarning-totalDeduction).toFixed(2));

    }
    const editUrl="{{ route('admin.payroll.payscale.emp.head') }}/";

    function callEditMethod()
    {
       
        var empId = $("#select_employee").val();
        // var empId = $("#employee").val();
        console.log(empId);
        $(".err_message").removeClass("d-block").hide();
        var payscale_date = $("#payscale_date").val();
        if(empId==null || empId=="" )
        {
            let empErrMessage ="Please Select Employee";
            $("#select_employee").after("<p class='d-block text-danger err_message'>" + empErrMessage + "</p>");
        }
        if(payscale_date=="")
        {
            let valueMessage="Please Select salary Month";
            $("#payscale_date").after("<p class='d-block text-danger err_message'>" +valueMessage +"</p>");
        }

        if(empId!=""){
            editForm(editUrl+empId+"/"+payscale_date, 'edit');
            // taxCalCalculation();
            setTimeout(() => {
                 taxCalCalculation(2);
            }, 1500);
        }
    }
</script>