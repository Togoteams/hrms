<?php

namespace App\Traits;

use App\Models\MedicalCard;
use App\Models\PayrollTtumSalaryReport;
use App\Models\TaxSlabSetting;
use App\Models\Account;
use App\Models\PayrollHead;
use App\Models\PayrollSalaryHead;
use App\Models\PayrollSalary;
use App\Models\Employee;
use Illuminate\Support\Str;

trait PayrollTraits
{
    public function saveTtumData($data = [])
    {
        $ttumMonth = $data['ttum_month'];
        $accountId = $data['account_id'];
        $data['transaction_amount'] = $data['transaction_amount'] ?? 0;
        $ttumExist = PayrollTtumSalaryReport::where('ttum_month', $ttumMonth)->where('account_id', $accountId)->first();
        if(!empty($ttumExist))
        {
            $data['transaction_amount'] = $data['transaction_amount'] + $ttumExist->transaction_amount;
        }
        $account = Account::find($data['account_id']);
    //    return  $account->name;
        $data['transaction_details'] = $account->name . " for " . date('M-Y', strtotime($ttumMonth . '-20'));

        return PayrollTtumSalaryReport::updateOrCreate(['id' => $ttumExist?->id ?? NULL], $data);
    }

    public function createTTum($salaryId)
    {
        $salary = PayrollSalary::find($salaryId);
        $accounts = Account::getList()->get();
        $emp = Employee::where('user_id', $salary->user_id)->first();
        $currencyValue = 1;
        if ($emp->employment_type == "expatriate") {
            $currencyValue = getCurrencyValue("usd", "pula");
        }
        foreach ($accounts as $key => $account) {
            $accountName = $account->slug;
            $amount = 0;
            // return $accountName;
            switch ($accountName) {
                case "salaries":
                    $amount = $salary->basic * $currencyValue;
                    break;
                case "entertainment":
                    $salaryHeadAmount = PayrollSalaryHead::where('payroll_salary_id', $salary->id)->whereHas('payroll_head', function ($q) {
                        $q->where('slug', 'entertainment_expenses');
                    })->value('value');
                    $amount = ($salaryHeadAmount) * $currencyValue;
                    break;
                case "education":
                    $salaryHeadAmount = PayrollSalaryHead::where('payroll_salary_id', $salary->id)->whereHas('payroll_head', function ($q) {
                        $q->where('slug', 'education_allowance');
                    })->value('value');
                    $currencyValueForUsd = getCurrencyValue("inr", "usd");
                    $amount = ($salaryHeadAmount * $currencyValueForUsd) * $currencyValue;
                    break;
                case "house_up_keep":
                    $salaryHeadAmount = PayrollSalaryHead::where('payroll_salary_id', $salary->id)->whereHas('payroll_head', function ($q) {
                        $q->where('slug', 'house_up_keep_allow');
                    })->value('value');
                    $amount = ($salaryHeadAmount) * $currencyValue;
                    break;
                case "bomaid_local":
                    if ($emp->employment_type != "expatriate") {
                        $salaryHeadAmount = PayrollSalaryHead::where('payroll_salary_id', $salary->id)->whereHas('payroll_head', function ($q) {
                            $q->where('slug', 'bomaid');
                        })->value('value');
                        $bomaid = MedicalCard::find($emp->amount_payable_to_bomaind_each_year);
                        $amount = $salaryHeadAmount;
                        if(!empty($bomaid))
                        {
                            $amount = $amount - ($bomaid->amount/2);
                        }
                    }
                    
                    break;
                case "bomaid_ibo":
                    $amount = 0;
                    if ($emp->employment_type == "expatriate") {
                        if(!empty($bomaid))
                        {
                            $bomaid = MedicalCard::find($emp->amount_payable_to_bomaind_each_year);
                            $amount = $bomaid->amount;
                        }
                    }
                    break;
                case "pf_bank_contribution":
                    if ($emp->employment_type == "expatriate") {
                    $amount =  $this->bankContributionOfPf($emp) * $currencyValue;
                    }
                    break;
                case "banks_conti_to_pension":
                    if ($emp->employment_type != "expatriate") {
                        $salaryHeadAmount = PayrollSalaryHead::where('payroll_salary_id', $salary->id)->whereHas('payroll_head', function ($q) {
                            $q->where('slug', 'pension_bank');
                        })->value('value');
                        $amount = ($salaryHeadAmount) * $currencyValue;
                    }
                    break;
                case "sundry_dep_pension_eft":
                    if ($emp->employment_type != "expatriate") {
                        $pensionOwn = PayrollSalaryHead::where('payroll_salary_id', $salary->id)->whereHas('payroll_head', function ($q) {
                            $q->where('slug', 'pension_own');
                        })->value('value');
                        $amount = $pensionOwn;
                    }
                    break;
                case "B_B_E_U_Banker_Chq":
                    if ($emp->employment_type != "expatriate") {
                        $salaryHeadAmount = PayrollSalaryHead::where('payroll_salary_id', $salary->id)->whereHas('payroll_head', function ($q) {
                            $q->where('slug', 'union_fee');
                        })->value('value');
                        $amount = ($salaryHeadAmount);
                    }
                    break;
                case "eft_to_fnb_bank":
                   
                    if ($emp->employment_type == "expatriate") {
                        $medicalCard = MedicalCard::find($emp->amount_payable_to_bomaind_each_year);
                        $iboBomaidAmount = 0;
                        if (!empty($medicalCard)) {
                            $iboBomaidAmount = $medicalCard->amount;
                        }
                        $amount = $iboBomaidAmount;
                    }else
                    {
                        // This is Total Bomaid Fund Receive From Emp
                        $bomaidAmount = PayrollSalaryHead::where('payroll_salary_id', $salary->id)->whereHas('payroll_head', function ($q) {
                            $q->where('slug', 'bomaid');
                        })->value('value');
                        // This Bomaid Fund for emplyee i:e 50% of Bomain
                        $amount = ($bomaidAmount);
                    }
                    break;
                case "pf_contribution":
                    if ($emp->employment_type == "expatriate") {
                     $pfAmount = PayrollSalaryHead::where('payroll_salary_id', $salary->id)->whereHas('payroll_head', function ($q) {
                            $q->where('slug', 'provident_fund');
                        })->value('value');

                        $amount = ($pfAmount + $this->bankContributionOfPf($emp) ) * $currencyValue;
                    }
                    break;
                
                case "vehicle_expenses":
                    $vehicleExpenses = PayrollSalaryHead::where('payroll_salary_id', $salary->id)->whereHas('payroll_head', function ($q) {
                        $q->where('slug', 'recovery_for_car');
                    })->value('value');
                    $amount = ($vehicleExpenses) * $currencyValue;
                    break;
                case "income_tax":
                    $incomeTax = PayrollSalaryHead::where('payroll_salary_id', $salary->id)->whereHas('payroll_head', function ($q) {
                        $q->where('slug', 'tax');
                    })->value('value');
                    $amount = ($incomeTax);
                    break;
                case "special_advance_to_staff":
                    $amount = PayrollSalaryHead::where('payroll_salary_id', $salary->id)->whereHas('payroll_head', function ($q) {
                        $q->where('slug', 'other_deductions');
                    })->value('value');
                    $amount = ($amount);
                    break;
            }
            $data = ['ttum_month' => $salary->pay_for_month_year, 'account_id' => $account->id, 'transaction_amount' => $amount, 'transaction_type' => ($account->is_credit == 1 ? "credit" : "debit"), 'transaction_currency' => 'BWP'];
            $saveOfficeTTUM  = $this->saveTtumData($data);

           
        }

        /**
         * Create TTUM for Employee Account
         */
        $empName = $emp->user->name;
        $empAccount = $this->getEmpAccount($empName, $emp->bank_account_number);
        $netTakeAmountInPula = $salary->net_take_home_in_pula;
        $data = ['ttum_month' => $salary->pay_for_month_year, 'account_id' => $empAccount->id, 'transaction_amount' => $netTakeAmountInPula, 'transaction_type' => ($empAccount->is_credit == 1 ? "credit" : "debit"), 'transaction_currency' => 'BWP'];
        $saveEmpTTUM  =  $this->saveTtumData($data);
    }
    public function getEmpAccount($accountName, $accountNumber)
    {
        $account = Account::where('name', $accountName)->where('account_number', $accountNumber)->first();
        if (empty($account)) {
            $account =  Account::updateOrCreate(['name' => $accountName, 'slug' => Str::slug($accountName), 'account_number' => $accountNumber, 'account_type' => 'employee', 'is_credit' => 1, 'description' => "This is " . $accountName . " Salary Account "]);
        }
        return $account;
    }


    public function getTTUMAccount($headName)
    {
        $empAccounts = Account::where('name', $headName)->first();
        if (empty($empAccounts)) {
            $empAccounts = Account::create(['name' => $headName]);
        }
        return $empAccounts;
    }
    public function getTaxAmount($data)
    {
        $taxableAmount = $data['taxable_amount'];
        $empType = $data['employment_type'];
        $taxSlab = TaxSlabSetting::where('from', '<=', $taxableAmount)->where('to', '>=', $taxableAmount)->where('status', 'active')->first();
        // echo $taxSlab;
        if ($empType == "expatriate") {
            $extraAmount = ($taxableAmount - $taxSlab->from);
            $yearlyTaxAmount =  ($taxSlab->additional_ibo_amount + $extraAmount);
            $taxAmount = (($yearlyTaxAmount * $taxSlab->ibo_tax_per )/100) / 12;
        } else {
            $extraAmount = (($taxableAmount - $taxSlab->from));
            $yearlyTaxAmount =  ($taxSlab->additional_local_amount + $extraAmount);
            $taxAmount = (($yearlyTaxAmount * $taxSlab->local_tax_per )/100) / 12;
        }
        return ["tax_amount" => round($taxAmount,3), 'extraAmount' => $extraAmount, 'yearlyTaxAmount' => $yearlyTaxAmount, 'taxable_amount' => $taxableAmount];
    }
    public function bankContributionOfPf($emp)
    {
        $inrBasicAmount = $emp->basic_salary_for_india;
        $pfContibutionForBank = 10;
        if($emp->salary_type=="nps")
        {
            $inrBasicAmount = $emp->basic_salary_for_india  +  ((($inrBasicAmount / 100)) * $emp->da) ;
            $pfContibutionForBank = 14;
        }
        $inrToPulaAmount = getCurrencyValue("inr", "usd");
        $providentFound = ((($inrBasicAmount / 100)) * $pfContibutionForBank);
        $providentFound = $providentFound * number_format($inrToPulaAmount,3,'.',"");
        return  number_format($providentFound,2,'.',"");

    }
}
