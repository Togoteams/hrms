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
        taxAbleAmount = (basicAmount + getValue('allowance'))- (getValue('bomaid'));
        }else{
         taxAbleAmount = (basicAmount + getValue('entertainment_expenses')+getValue('house_up_keep_allow')+getValue('education_allowance'))- (getValue('bomaid')+ getValue('pension'));
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
        var unionFee = 0;
        console.log(employmentType);
        var basicAmount = getValue('basic');
        if(employmentType=="local")
        {
            var taxAmount = getValue('tax');
            if(basicAmount){
                unionFee = basicAmount/100;
            }
            totalEarning = basicAmount + getValue('allowance') + getValue('others_arrears');
                    totalDeduction = taxAmount + getValue('bomaid') + getValue('pension') + unionFee  + getValue('other_deductions');
            setId('union_fee', unionFee);

        }else
        {
            totalEarning = basicAmount + getValue('entertainment_expenses')+
             getValue('house_up_keep_allow')+  getValue('education_allowance');
             totalDeduction = getValue('provident_fund') + getValue('other_deductions');
        }

        setId('gross_earning', totalEarning);
        setId('total_deduction', totalDeduction);
        setId('net_take_home', totalEarning-totalDeduction);

    }
   
</script>