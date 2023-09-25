<?php

namespace App\Traits;

use App\Models\PayrollTtumSalaryReport;

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
}