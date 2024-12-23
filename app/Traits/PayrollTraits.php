<?php

namespace App\Traits;

use App\Models\EmpMedicalInsurance;
use App\Models\PayrollTtumSalaryReport;
use App\Models\TaxSlabSetting;
use App\Models\Account;
use App\Models\PayrollHead;
use App\Models\PayrollSalaryHead;
use App\Models\PayrollSalary;
use App\Models\Employee;
use App\Models\PayrollTaxLog;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

trait PayrollTraits
{
    public function saveTtumData($data = [])
    {
        $ttumMonth = $data['ttum_month'];
        $branchId = $data['branch_id'];
        $accountId = $data['account_id'];
        $data['transaction_amount'] = $data['transaction_amount'] ?? 0;
        $ttumExist = PayrollTtumSalaryReport::where('ttum_month', $ttumMonth)->where('account_id', $accountId)->where('branch_id',$branchId)->first();

        if (!empty($ttumExist)) {
            $data['transaction_amount'] = $data['transaction_amount'] + $ttumExist->transaction_amount;
        }

        Log::info("transaction_amount" . $data['transaction_amount']);
        $account = Account::find($data['account_id']);
        //    return  $account->name;
        $data['transaction_details'] = $account->name . " for " . date('M-Y', strtotime($ttumMonth . '-20'));

        return PayrollTtumSalaryReport::updateOrCreate(['id' => $ttumExist?->id ?? NULL], $data);
    }
    public function saveTaxLog($payrollId)
    {
        
        $payrollSalary =PayrollSalary::find($payrollId);
        $userId = $data['user_id'];
        $employeeType = $data['employee_type'];
        $branchId = $data['branch_id'];
        $payrollId = $data['payroll_id'];
        $month = $data['month'];
        $year = $data['year'];
        $salary_amount = $data['salary_amount'];
        $taxable_amount = $data['taxable_amount'];
        $tax_amount = $data['tax_amount'];
        $head_name = $data['head_name'];
        $head_value = $data['head_value'];

        //    return  $account->name;

        return PayrollTtumSalaryReport::updateOrCreate($data);
    }

    public function createTTum($salaryId)
    {
        $salary = PayrollSalary::find($salaryId);
        $accounts = Account::where('branch_id',$salary->branch_id)->getList()->get();
        $emp = Employee::where('user_id', $salary->user_id)->first();
        $currencyValue = 1;
        if ($emp->employment_type == "expatriate") {
            $currencyValue = getCurrencyValue("usd", "pula");
        }
        foreach ($accounts as $key => $account) {
            $accountName = $account->slug;
            $amount = 0;
            $isAmountAdd = 1;
            // return $accountName;
            switch ($accountName) {
                case "salaries":
                    $basic = $salary->basic * $currencyValue;
                    $allowanceAmoumt = PayrollSalaryHead::where('payroll_salary_id', $salary->id)->whereHas('payroll_head', function ($q) {
                        $q->where('slug', 'allowance');
                    })->value('value');
                    $overTimeAmoumt = PayrollSalaryHead::where('payroll_salary_id', $salary->id)->whereHas('payroll_head', function ($q) {
                        $q->where('slug', 'over_time');
                    })->value('value');
                    $othersArrearsAmount = PayrollSalaryHead::where('payroll_salary_id', $salary->id)->whereHas('payroll_head', function ($q) {
                        $q->where('slug', 'others_arrears');
                    })->value('value');
                    $leaveEnCashAmount = $salary->leave_encashment_amount  * $currencyValue;
                    $emp13ChequeAmount = $salary->emp_13_cheque_amount  * $currencyValue;
                    $amount = $basic + $allowanceAmoumt + $overTimeAmoumt + $othersArrearsAmount + $emp13ChequeAmount + $leaveEnCashAmount;
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
                    $currencyValuePula = getCurrencyValue("pula", "inr");
                    // $amount = ($salaryHeadAmount / $currencyValuePula);
                    $amount = $salary->education_allowance_for_ind_in_pula;

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
                        $bomaid = EmpMedicalInsurance::where('user_id', $emp->user_id)->orderBy('id', 'desc')->first();

                        $amount = $salaryHeadAmount;
                        if (!empty($bomaid)) {
                            $bomaidAmount = $bomaid->amount;
                            $localBankBomaidContribution = getSeetingValue()->local_bank_bomaid_contribution;
                            $localBomaidAmount = ($bomaidAmount / 100) * $localBankBomaidContribution;
                            $amount = $amount - ($localBomaidAmount);
                        }
                    }

                    break;
                case "bomaid_ibo":
                    $amount = 0;
                    if ($emp->employment_type == "expatriate") {
                        $bomaid = EmpMedicalInsurance::where('user_id', $emp->user_id)->orderBy('id', 'desc')->first();
                        if (!empty($bomaid)) {
                            $bomaidAmount = $bomaid->amount;
                            $iboBankBomaidContribution = getSeetingValue()->ibo_bank_bomaid_contribution;
                            $amount = ($bomaidAmount / 100) * $iboBankBomaidContribution;
                            // $amount;
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
                        $amount = number_format($salaryHeadAmount, 2, ".", "");
                    }
                    break;
                case "eft_to_fnb_bank":

                    if ($emp->employment_type == "expatriate") {
                        $amount = 5;
                        $bomaid = EmpMedicalInsurance::where('user_id', $emp->user_id)->orderBy('id', 'desc')->first();
                        if (!empty($bomaid)) {
                            $bomaidAmount = $bomaid->amount;
                            $iboBankBomaidContribution = getSeetingValue()->ibo_bank_bomaid_contribution;
                            $amount = ($bomaidAmount / 100) * $iboBankBomaidContribution;
                            // $amount;
                        }
                    } else {
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

                        $amount = ($pfAmount + $this->bankContributionOfPf($emp)) * $currencyValue;
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
                case "personal_loan":
                    if ($emp->user_id == $account->user_id) {
                        $amount = PayrollSalaryHead::where('payroll_salary_id', $salary->id)->whereHas('payroll_head', function ($q) {
                            $q->where('slug', 'personal_loan');
                        })->value('value');
                        $amount = ($amount);
                    }
                    break;
                case "car_loan":
                    if ($emp->user_id == $account->user_id) {
                        $amount = PayrollSalaryHead::where('payroll_salary_id', $salary->id)->whereHas('payroll_head', function ($q) {
                            $q->where('slug', 'car_loan');
                        })->value('value');
                    }
                    $amount = ($amount);
                    break;
                case "salary_advance":
                    if ($emp->user_id == $account->user_id) {
                        $amount = PayrollSalaryHead::where('payroll_salary_id', $salary->id)->whereHas('payroll_head', function ($q) {
                            $q->where('slug', 'salary_advance');
                        })->value('value');
                        $amount = ($amount);
                    }
                    break;
                case "mortgage_loan":
                    if ($emp->user_id == $account->user_id) {
                        $amount = PayrollSalaryHead::where('payroll_salary_id', $salary->id)->whereHas('payroll_head', function ($q) {
                            $q->where('slug', 'mortgage_loan');
                        })->value('value');
                        $amount = ($amount);
                    }
                    break;
            }
            $data = ['ttum_month' => $salary->pay_for_month_year, 'account_id' => $account->id, 'transaction_amount' => number_format($amount, 2, ".", ""), 'transaction_type' => ($account->is_credit == 1 ? "credit" : "debit"), 'transaction_currency' => 'BWP','branch_id'=>$salary->branch_id];
            $saveOfficeTTUM  = $this->saveTtumData($data);
            Log::info("Personal_account_id" . json_encode($saveOfficeTTUM));
        }

        /**
         * Create TTUM for Employee Account
         */
        $empName = $emp->user->name;
        $empAccount = $this->getEmpAccount($empName, $emp->bank_account_number);
        $netTakeAmountInPula = $salary->net_take_home_in_pula;
        $data = ['ttum_month' => $salary->pay_for_month_year, 'account_id' => $empAccount->id, 'transaction_amount' => number_format($netTakeAmountInPula, 2, ".", ""), 'transaction_type' => ($empAccount->is_credit == 1 ? "credit" : "debit"), 'transaction_currency' => 'BWP','branch_id'=>$salary->branch_id];
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
        // echo $taxSlab;
        if ($empType == "expatriate") {
           
            $taxSlab = TaxSlabSetting::where('from', '<=', $taxableAmount)->where('to', '>=', $taxableAmount)->where('status', 'active')->first();
            $extraAmount = ($taxableAmount - $taxSlab->from);
            $yearlyTaxAmount =  ($taxSlab->additional_ibo_amount + (($extraAmount * $taxSlab->ibo_tax_per) / 100));
            $taxAmount = ($yearlyTaxAmount) / 12;
        } else {
            $taxSlab = TaxSlabSetting::where('from', '<=', $taxableAmount)->where('to', '>=', $taxableAmount)->where('status', 'active')->first();
            $extraAmount = (($taxableAmount - $taxSlab->from));
            $yearlyTaxAmount =  ($taxSlab->additional_local_amount  + (($extraAmount * $taxSlab->local_tax_per) / 100));
            $taxAmount = ($yearlyTaxAmount) / 12;
        }
        return ["tax_amount" => round($taxAmount, 3), 'extraAmount' => $extraAmount, 'yearlyTaxAmount' => $yearlyTaxAmount,'monthly_taxable_amount'=>$taxableAmount/12, 'taxable_amount' => $taxableAmount];
    }
    public function bankContributionOfPf($emp)
    {
        $inrBasicAmount = $emp->basic_salary_for_india;
        $pfContibutionForBank = 10;
        if ($emp->salary_type == "nps") {
            $inrBasicAmount = $emp->basic_salary_for_india  +  ((($inrBasicAmount / 100)) * $emp->da);
            $pfContibutionForBank = 14;
        }
        $usdToInrAmount = getCurrencyValue("usd", "inr");
        $providentFound = ((($inrBasicAmount / 100)) * $pfContibutionForBank);
        $providentFound = $providentFound / number_format($usdToInrAmount, 3, '.', "");
        return  number_format($providentFound, 2, '.', "");
    }
}
