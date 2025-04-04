<?php

namespace App\Traits;

use App\Models\EmpMedicalInsurance;
use App\Models\PayrollTtumSalaryReport;
use App\Models\TaxSlabSetting;
use App\Models\Account;
use App\Models\CurrencySetting;
use App\Models\Emp13thCheque;
use App\Models\PayrollHead;
use App\Models\PayrollSalaryHead;
use App\Models\PayrollSalary;
use App\Models\Employee;
use App\Models\PayrollTaxLog;
use App\Models\PayrollTtumReport;
use App\Models\Reimbursement;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

trait PayrollTraits
{
    public function saveTtumData($data = [])
    {
        $ttumMonth = $data['ttum_month'];
        $branchId = $data['branch_id'];
        $accountId = $data['account_id'];

        $ttum = PayrollTtumReport::updateOrCreate([
            'branch_id' => $branchId,
            'ttum_month' => $ttumMonth,
        ], [
            'branch_id' => $branchId,
            'ttum_month' => $ttumMonth,
        ]);
        $data['transaction_amount'] = $data['transaction_amount'] ?? 0;
        $data['payroll_ttum_report_id'] = $ttum->id;
        if (isset($data['is_13th_cheque_account']) && $data['is_13th_cheque_account'] == 1) {

        $ttumExist = PayrollTtumSalaryReport::where('ttum_month', $ttumMonth)->where('account_id', $accountId)->where('is_13th_cheque_account', 1)->where('branch_id', $branchId)->first();
        }
        else{
            $ttumExist = PayrollTtumSalaryReport::where('ttum_month', $ttumMonth)->where('account_id', $accountId)->where('is_13th_cheque_account', 0)->where('branch_id', $branchId)->first();
 
        }
        if (!empty($ttumExist)) {
            $data['transaction_amount'] = $data['transaction_amount'] + $ttumExist->transaction_amount;
        }

        Log::info("transaction_amount" . $data['transaction_amount']);
        $account = Account::find($data['account_id']);
        //    return  $account->name;
        $data['transaction_details'] = $account->name . " for " . date('M-Y', strtotime($ttumMonth . '-20'));
        if (isset($data['is_13th_cheque_account']) && $data['is_13th_cheque_account'] == 1) {
            $data['transaction_details'] = "13 Cheque Of " . $account->name . " for " . date('M-Y', strtotime($ttumMonth . '-20'));
        }

        return PayrollTtumSalaryReport::updateOrCreate(['id' => $ttumExist?->id ?? NULL], $data);
    }


    public function createTTum($salaryId)
    {
        $salary = PayrollSalary::find($salaryId);
        $accounts = Account::where('branch_id', $salary->branch_id)->getList()->get();
        $emp = Employee::where('user_id', $salary->user_id)->first();
        if (!empty($emp)) {
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

                        $othersArrearsAmount = PayrollSalaryHead::where('payroll_salary_id', $salary->id)->whereHas('payroll_head', function ($q) {
                            $q->where('slug', 'others_arrears');
                        })->value('value');
                        $leaveEnCashAmount = $salary->leave_encashment_amount  * $currencyValue;
                        $amount = $basic + $allowanceAmoumt  + $othersArrearsAmount + $leaveEnCashAmount;
                        break;
                    case "overtime":
                        $overTimeAmoumt = PayrollSalaryHead::where('payroll_salary_id', $salary->id)->whereHas('payroll_head', function ($q) {
                            $q->where('slug', 'over_time');
                        })->value('value');
                        $amount = $overTimeAmoumt;
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
                    case "tds_staff":
                        $amount = 0;
                        if ($emp->employment_type == "expatriate") {
                            $amount = ($salary->tax_amount_in_pula);
                        }
                        break;
                    case "inter_branch_account":
                        $amount = 0;
                        if ($emp->employment_type == "expatriate") {
                            $amount = ($salary->tax_amount_in_pula);
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
                $data = ['ttum_month' => $salary->pay_for_month_year, 'account_id' => $account->id, 'transaction_amount' => number_format($amount, 2, ".", ""), 'transaction_type' => ($account->is_credit == 1 ? "credit" : "debit"), 'transaction_currency' => 'BWP', 'branch_id' => $salary->branch_id, 'payroll_salary_id' => $salary->id];
                $saveOfficeTTUM  = $this->saveTtumData($data);
                Log::info("Personal_account_id" . json_encode($saveOfficeTTUM));
            }
            $reimbursementAccount = Account::where('account_type', 'reimbursement')->getList()->get();
            Log::info("reimbursementAccount" . json_encode($reimbursementAccount));
            foreach ($reimbursementAccount as $keyR => $accountR) {
                $accountName = $accountR->slug;
                $amount = 0;
                $isAmountAdd = 1;
                $reimbursementAmount = 0;
                $startDate = date("Y-m-20", strtotime("-1 month"));
                $endDate = date("Y-m-20");
                $employmentType = $emp->employment_type;
                $multipleValue = 1;
                if ($employmentType == "expatriate") {
                    $currencySeeting = CurrencySetting::where('currency_name_from', 'usd')->where('currency_name_to', 'pula')->where('status', 'active')->first();
                    $multipleValue = $currencySeeting->currency_amount_to;
                }
                $reimbursement = Reimbursement::whereHas('reimbursementype', function ($q) use ($accountName) {
                    $q->where('slug', $accountName);
                })->where('user_id', $emp->user_id)->whereBetween('claim_date', array($startDate, $endDate))
                    ->where('status', 'approved')->where('reimbursement_for', 1)
                    ->first();
                Log::info("reimbursement" . ($reimbursement));
                Log::info("startDate" . ($startDate));
                Log::info("endDate" . ($endDate));
                Log::info("reimbursement accountName" . ($accountName));
                if ($reimbursement) {
                    if ($reimbursement->reimbursement_currency == "usd") {
                        $reimbursementAmount = $reimbursementAmount + $reimbursement->reimbursement_amount * $multipleValue;
                    } else {
                        $reimbursementAmount = $reimbursementAmount + $reimbursement->reimbursement_amount;
                    }
                    Log::info("reimbursement amout" . ($reimbursementAmount));
                    $amount = $reimbursementAmount;
                    $data = ['ttum_month' => $salary->pay_for_month_year, 'account_id' => $accountR->id, 'transaction_amount' => number_format($amount, 2, ".", ""), 'transaction_type' => ($account->is_credit == 1 ? "credit" : "debit"), 'transaction_currency' => 'BWP', 'branch_id' => $salary->branch_id, 'payroll_salary_id' => $salary->id];
                    $saveOfficeTTUM  = $this->saveTtumData($data);
                }
            }
            /**
             * 13th cheque Account which is applicable for number
             */
            $salaryMonth = $salary->pay_for_month_year;
            $novmonth = date('Y') . "-11";
            if ($salaryMonth == $novmonth) {
                $emp13ChequeAccounts = Account::whereIn('slug', ['salaries', 'income_tax'])->where('branch_id', $salary->branch_id)->getList()->get();
                $financial_year = getFinancialYear();
                $emp13ChequeData = Emp13thCheque::where('user_id', $salary->user_id)->where('branch_id', $salary->branch_id)->where('financial_year', $financial_year)->first();
                if(!empty($emp13ChequeData))
                {
                    foreach ($emp13ChequeAccounts as $key => $account13) {
                        $accountName = $account13->slug;
                        $amount = 0;
                        $isAmountAdd = 1;
                        switch ($accountName) {
                            case "salaries":
                                $amount = $emp13ChequeData->average_amount;
                                break;
                            case "income_tax":
                                $amount = $emp13ChequeData->total_i_tax_amount;
                                break;
                        }
                        $data = ['ttum_month' => $salary->pay_for_month_year, 'account_id' => $account13->id, 'transaction_amount' => number_format($amount, 2, ".", ""), 'transaction_type' => ($account13->is_credit == 1 ? "credit" : "debit"), 'transaction_currency' => 'BWP', 'branch_id' => $account13->branch_id, 'payroll_salary_id' => $account13->id, 'is_13th_cheque_account' => 1];
                        $saveOfficeTTUM  = $this->saveTtumData($data);
                    }
                }
            }


            /**
             * Create TTUM for Employee Account
             */
            $empName = $emp->user->name;
            $empAccount = $this->getEmpAccount($empName, $emp->bank_account_number);
            $netTakeAmountInPula = $salary->net_take_home_in_pula;
            $data = ['ttum_month' => $salary->pay_for_month_year, 'account_id' => $empAccount->id, 'transaction_amount' => number_format($netTakeAmountInPula, 2, ".", ""), 'transaction_type' => ($empAccount->is_credit == 1 ? "credit" : "debit"), 'transaction_currency' => 'BWP', 'branch_id' => $salary->branch_id, 'payroll_salary_id' => $salary->id];
            $saveEmpTTUM  =  $this->saveTtumData($data);
            /**
             * Create 13 cheque TTUM for Employee Account
             */
            if ($salaryMonth == $novmonth) {
                if(!empty($emp13ChequeData))
                {
                $emp13ChequePayment = $emp13ChequeData->net_payable_amount;
                $data = ['ttum_month' => $salary->pay_for_month_year, 'account_id' => $empAccount->id, 'transaction_amount' => number_format($emp13ChequePayment, 2, ".", ""), 'transaction_type' => ($empAccount->is_credit == 1 ? "credit" : "debit"), 'transaction_currency' => 'BWP', 'branch_id' => $salary->branch_id, 'payroll_salary_id' => $salary->id, 'is_13th_cheque_account' => 1];
                $saveEmpTTUM  =  $this->saveTtumData($data);
                }
            }
        }
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
        $extraAmount = 0;
        $noOfJoiningDays = $data['no_of_joining_days'] ?? 180;
        $totalMonthlySalary = $data['total_monthly_salary'] ?? 0;
        // echo $taxSlab;
        if ($empType == "expatriate") {
            $monthly_salary = $taxableAmount; // Taxable monthly salary in Pula
            // return $monthly_salary;
            if ($noOfJoiningDays <= 180) {
                $annual_salary = $monthly_salary * 12; // Calculate annual taxable salary
                $tax_threshold = 129150; // Threshold for tax calculation
                $base_tax = 15450; // Fixed tax on the threshold
                // $tax_rate = 25 / 75; // Tax rate on the balance salary

                // Calculate excess over the tax threshold
                $balanceSalary = $annual_salary - $tax_threshold;
                // echo $balanceSalary."balance salary";
                // echo $annual_salary."balance salary";
                // echo $tax_threshold."tax threshold";
                // If annual salary is less than the threshold, no excess or balance salary
                if ($balanceSalary < 0) {
                    $balanceSalary = 0;
                    $tax_on_balance_salary = 0;
                } else {
                    // Calculate tax on balance salary
                    $tax_on_balance_salary = ($balanceSalary * 25) / 75;
                }
                // Calculate total annual tax
                $yearlyTaxAmount = $base_tax + $tax_on_balance_salary;

                // Calculate monthly tax payable
                $taxAmount = 44;
            } else {
                // Define the variables
                $annual_salary = $monthly_salary * 12; // Calculate annual taxable salary
                $tax_threshold = 142950; // Threshold for tax calculation
                $base_tax = 13050; // Fixed tax on the threshold
                $tax_rate = 25 / 75; // Tax rate on the balance salary

                // Calculate excess over the tax threshold
                $balanceSalary = $annual_salary - $tax_threshold;
                // echo $balanceSalary."balance salary";
                // echo $annual_salary."annual salary";
                // echo $tax_threshold."tax threshold";
                // If annual salary is less than the threshold, no excess or balance salary
                if ($balanceSalary < 0) {
                    $balanceSalary = 0;
                    $tax_on_balance_salary = 0;
                } else {
                    // Calculate tax on balance salary
                    $tax_on_balance_salary = ($balanceSalary * 25) / 75;
                }

                // Calculate total annual tax
                $yearlyTaxAmount = $base_tax + $tax_on_balance_salary;

                // Calculate monthly tax payable
                $taxAmount = $yearlyTaxAmount / 12;
            }
            $monthly_taxable_amount = $taxableAmount;
            // $taxSlab = TaxSlabSetting::where('from', '<=', $taxableAmount)->where('to', '>=', $taxableAmount)->where('status', 'active')->first();
            // $extraAmount = ($taxableAmount - $taxSlab->from);
            // $yearlyTaxAmount =  ($taxSlab->additional_ibo_amount + (($extraAmount * $taxSlab->ibo_tax_per) / 100));
            // $taxAmount = ($yearlyTaxAmount) / 12;
        } else {
            $taxSlab = TaxSlabSetting::where('from', '<=', $taxableAmount)->where('to', '>=', $taxableAmount)->where('status', 'active')->first();
            $extraAmount = (($taxableAmount - $taxSlab->from));
            $yearlyTaxAmount =  ($taxSlab->additional_local_amount  + (($extraAmount * $taxSlab->local_tax_per) / 100));
            $taxAmount = ($yearlyTaxAmount) / 12;
            $monthly_salary = $taxableAmount / 12;
            $monthly_taxable_amount = $taxableAmount / 12;
        }
        return ["tax_amount" => round($taxAmount, 3), 'extraAmount' => $extraAmount, 'yearlyTaxAmount' => $monthly_salary, 'monthly_taxable_amount' => $monthly_taxable_amount, 'taxable_amount' => $taxableAmount];
    }
    public function bankContributionOfPf($emp)
    {
        $latestSalary = $emp->getLatestSalary();
        $inrBasicAmount = $latestSalary->basic_salary_for_india;
        $pfContibutionForBank = 10;
        if ($latestSalary->salary_type == "nps") {
            $daPer = getSeetingValue()->da_per;
            $inrBasicAmount = $latestSalary->basic_salary_for_india  +  ((($inrBasicAmount / 100)) * $daPer);
            $pfContibutionForBank = 14;
        }
        $usdToInrAmount = getCurrencyValue("usd", "inr");
        $providentFound = ((($inrBasicAmount / 100)) * $pfContibutionForBank);
        $providentFound = $providentFound / number_format($usdToInrAmount, 3, '.', "");
        return  number_format($providentFound, 2, '.', "");
    }
}
