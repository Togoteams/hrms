<?php

namespace App\Traits;

use App\Models\MedicalCard;
use App\Models\PayrollTtumSalaryReport;
use App\Models\TaxSlabSetting;
trait PayrollTraits
{
    public function saveTtumData($data=[])
    {
        $accounId = $data['account_id'];
        $transactionNumber = $data['transaction_number'];
        $transactionType = $data['transaction_type'];
        $transactionAmount = $data['transaction_amount'];
        $transactionCurrency = $data['transaction_currency'];
        // $transactionAt = date('Y-m-d H:i:s');
        $refrenceId = $data['refrence_id'];
        $refrenceTableType = $data['refrence_table_type'];
       return PayrollTtumSalaryReport::create($data);
    }
    public function getTaxAmount($data)
    {
        $taxableAmount = $data['taxable_amount'];
        $empType = $data['employment_type'];
        $taxSlab = TaxSlabSetting::where('from','<=',$taxableAmount)->where('to','>=',$taxableAmount)->where('status', 'active')->first();
        // echo $taxSlab;
        if($empType=="expatriate")
        {
            $extraAmount = ((($taxableAmount - $taxSlab->from)/100)*$taxSlab->ibo_tax_per);
            $taxAmount = ($taxSlab->additional_ibo_amount + $extraAmount)/12 ;
            $yearlyTaxAmount =  ($taxSlab->additional_ibo_amount + $extraAmount);
        }else{

            $extraAmount = ((($taxableAmount - $taxSlab->from)/100) * $taxSlab->local_tax_per);
            $yearlyTaxAmount =  ($taxSlab->additional_local_amount + $extraAmount);
            $taxAmount = ($taxSlab->additional_local_amount + $extraAmount)/12;
        }
        return ["tax_amount"=>round($taxAmount),'extraAmount'=>$extraAmount,'yearlyTaxAmount'=>$yearlyTaxAmount,'taxable_amount'=>$taxableAmount];
    }
   
}