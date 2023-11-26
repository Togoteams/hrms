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
        console.log(employmentType);
        var basicAmount = getValue('basic');
        if(employmentType=="local")
        {
            var taxAmount = getValue('tax');
            var unionFee = getValue('union_fee');

            totalEarning = basicAmount + getValue('allowance') + getValue('others_arrears');
            totalDeduction = taxAmount + getValue('bomaid') + getValue('pension') + unionFee  + getValue('other_deductions');
            setId('union_fee', unionFee);

        }else
        {
            var educationAllowanceAmount = getValue('education_allowance');
            var otherDeductions = getValue('other_deductions');
            var pulaToUSDAmount = getValue('pulaToUSDAmount');
            var educationAllowanceAmount = (educationAllowanceAmount * pulaToUSDAmount).toFixed(2);
            var otherDeductions = (otherDeductions * pulaToUSDAmount).toFixed(2);

            totalEarning = basicAmount + getValue('entertainment_expenses')+
             getValue('house_up_keep_allow')+  educationAllowanceAmount;
             totalDeduction = getValue('provident_fund') + otherDeductions + getValue('recovery_for_car') ;
        }

        setId('gross_earning', totalEarning.toFixed(2));
        setId('total_deduction', totalDeduction.toFixed(2));
        setId('net_take_home',(totalEarning-totalDeduction).toFixed(2));

    }
   
</script>