<div class="row">
    <div class="col-sm-3">
        <div class="form-group">
            <input id="employment_type" placeholder="Enter correct employment_type" type="hidden"
                value="{{ $emp->employment_type ?? '' }}" name="employment_type">
            <label for="basic">Basic ({{ 'In USD' }})</label>
            @php
                $basic = round(($data->basic / $totalMonthDays) * $noOfPayableDays);
                $perDaysAmount = round($data->basic / $totalMonthDays);
                $totalEnCashAmount = $perDaysAmount * $noOfEncashLeave;
            @endphp
            <input value="{{ $usdToPulaAmount }}" readonly id="usdToPulaAmount" type="hidden" name="usdToPulaAmount"
                class="form-control form-control-sm">
            <input value="{{ $usdToInrAmount }}" readonly id="usdToInrAmount" type="hidden" name="usdToInrAmount"
                class="form-control form-control-sm">
            <input value="{{ $pulaToInr }}" readonly id="pulaToInr" type="hidden" name="pulaToInr"
                class="form-control form-control-sm">
            <input value="{{ $totalEnCashAmount }}" readonly id="leave_encashment_amount" type="hidden"
                class="form-control form-control-sm">
            <input value="{{ $emp13thChequeAmount }}" readonly id="emp_13_cheque_amount" type="hidden"
                class="form-control form-control-sm">
       
            <input  readonly id="taxable_amount_in_pula" name="taxable_amount_in_pula" type="hidden"
                class="form-control form-control-sm">
            <input readonly  id="tax_amount_in_pula" name="tax_amount_in_pula" type="hidden"
                class="form-control form-control-sm">
            <input readonly onkeyup="amount_cal(this)" onblur="taxCalCalculation()" required id="basic"
                placeholder="Enter correct basic " type="number" name="basic" value="{{ $basic ?? '' }}"
                class="form-control form-control-sm ">
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label for="total_working_days">Total Working Days</label>
            <input readonly required max="2" name="total_working_days" type="number"
                value="{{ $totalMonthDays ?? 0 }}" class="form-control form-control-sm">
        </div>
    </div>
    {{-- <div class="col-sm-3">
        <div class="form-group">
            <label for="annual_balanced_leave">Total Balanced Leave</label>

            <input readonly required max="3" name="annual_balanced_leave" type="number"
                value="{{ $totalBalancedLeave ?? 0 }}" class="form-control form-control-sm ">
        </div>
    </div> --}}
    <div class="col-sm-3">
        <div class="form-group">
            <label for="basic">No. Of Persent Days</label>

            <input readonly onkeyup="amount_cal(this)" name="no_of_persent_days" onblur="taxCalCalculation()" required
                max="2" type="number" value="{{ $presentDay ?? 0 }}" class="form-control form-control-sm ">
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label for="no_of_payable_days">No. of Payable days</label>

            <input readonly required max="2" name="no_of_payable_days" type="number"
                value="{{ $noOfPayableDays ?? 0 }}" class="form-control form-control-sm ">
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label for="no_availed_leave">No. Availed Leave :</label>

            <input readonly required max="2" name="no_availed_leave" type="number"
                value="{{ $noOfAvailedLeaves ?? 0 }}" class="form-control form-control-sm ">
        </div>
    </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label for="leave_encashment_days">Leave Encashment Days</label>
                <input readonly required max="2" name="leave_encashment_days" type="number"
                    value="{{ $noOfEncashLeave ?? 0 }}" class="form-control form-control-sm">
            </div>
        </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label for="no_availed_leave">No. Loss Of Pay Leave :</label>

            <input readonly required max="2" name="total_loss_of_pay" type="number"
                value="{{ $totalLosOfPayLeave ?? 0 }}" class="form-control form-control-sm ">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h4>Earning</h4>
    </div>
    @php
        $readonlyArr = ['bomaid', 'pension_own', 'reimbursement','pension_bank','house_up_keep_allow', 'union_fee', 'tax', 'over_time', 'provident_fund','personal_loan','car_loan','mortgage_loan','salary_advance'];
        $fixedHeadsArr = ['bomaid', 'over_time'];
        $inrCurrencyHead = ['provident_fund'];
        $pulaCurrencyHead = ['provident_fund'];
        $pulaInsertionArr = ['other_deductions','personal_loan','car_loan','mortgage_loan','salary_advance','reimbursement'];
        $usdInsertionArr = ['house_up_keep_allow', 'entertainment_expenses', 'provident_fund', 'recovery_for_car','others_arrears'];
        $inrInsertionArr = ['education_allowance'];
    @endphp
    @foreach ($emp_head as $head)
        @php
            if (isset($data->user_id)) {
                $head_data = App\Models\PayrollPayscaleHead::where('payroll_payscale_id', $data->id)
                    ->where('payroll_head_id', $head->id)
                    ->first();
            }

        @endphp
        @if ($head->head_type == 'income')
            <div class="col-sm-3">
                <div class="form-group">
                    <label class="required" for="{{ $head->slug }}">{{ $head->name }} @if (in_array($head->slug, $pulaInsertionArr))
                            ({{ 'In PULA' }})
                            @endif @if (in_array($head->slug, $usdInsertionArr))
                                ({{ 'In USD' }})
                                @endif @if (in_array($head->slug, $inrInsertionArr))
                                    ({{ 'In INR' }})
                                @endif
                    </label>
                    @php
                        if (!empty($head_data)) {
                            if (in_array($head->slug, $fixedHeadsArr)) {
                                $value = round($head_data->value);
                            } else {
                                $value = round(($head_data->value / $totalMonthDays) * $noOfPayableDays);
                            }
                        } else {
                            $value = 0;
                        }
                    @endphp
                    @if (strtolower($head->slug) == 'education_allowance')
                        <input hidden required name="education_allowance_for_ind_in_pula" type="number"
                            value="{{ (getHeadValue($emp, $head->slug, 'salary', $basic, $value, $salary_month) / $usdToInrAmount) * $usdToPulaAmount }}"
                            id="education_allowance_for_ind_in_pula"
                            class="form-control form-control-sm education_allowance_for_ind_in_pula">
                    @endif
                    @if (strtolower($head->slug) == 'reimbursement')
                    <input hidden required name="reimbursement_for_tax" type="number"
                        value="{{ getHeadValue($emp, 'reimbursement_tax', 'salary', $basic, $value, $salary_month) }}"
                        id="reimbursement_for_tax"
                        class="form-control form-control-sm reimbursement_for_tax">
                   @endif
                    <input @if (in_array($head->slug, $readonlyArr)) readonly @endif onkeyup="amount_cal(this)" required
                        id="{{ $head->slug }}"
                        placeholder="{{ $head->placeholder ?? 'Enter' . $head->name . 'of' . $page . '' }}"
                        type="number" name="{{ strtolower($head->slug) }}"
                        @if (strtolower($head->slug) == 'others_arrears') value="0"
                        @else
                        value="{{ getHeadValue($emp, $head->slug, 'salary', $basic, $value, $salary_month) }}" @endif
                        class="form-control form-control-sm {{ $head->head_type }}">
                </div>
            </div>
        @endif
    @endforeach
        <div class="col-sm-3">
            <div class="form-group">
                <label for="leave_encashment_amount">Leave Encashment Amount(In USD)</label>
                <input readonly required name="leave_encashment_amount" type="number"
                    value="{{ $noOfEncashLeave * $perDaysAmount ?? 0 }}"
                    class="form-control form-control-sm leave_encashment_amount">
            </div>
        </div>
    @if ($emp13thChequeAmount)
    <div class="col-sm-3">
        <div class="form-group">
            <label for="emp_13_cheque_amount">13th Cheque (In USD)</label>
            <input readonly required name="emp_13_cheque_amount" type="number"
                value="{{ $emp13thChequeAmount }}"
                class="form-control form-control-sm emp_13_cheque_amount">
        </div>
    </div>
    @endif
</div>
<div class="row">
    <div class="col-md-12">
        <h4>Deduction</h4>
    </div>
    @foreach ($emp_head as $head)
        @php
            if (isset($data->user_id)) {
                $head_data = App\Models\PayrollPayscaleHead::where('payroll_payscale_id', $data->id)
                    ->where('payroll_head_id', $head->id)
                    ->first();
            }

        @endphp
        @if ($head->head_type == 'deduction')
            <div class="col-sm-3">
                <div class="form-group">
                    <label class="required" for="{{ $head->slug }}">{{ $head->name }} @if (in_array($head->slug, $pulaInsertionArr))
                            ({{ 'In PULA' }})
                            @endif @if (in_array($head->slug, $usdInsertionArr))
                                ({{ 'In USD' }})
                            @endif </label>
                    @php
                        if (in_array($head->slug, $fixedHeadsArr)) {
                            $value = round($head_data?->value);
                        } else {
                            $value = round(($head_data?->value / $totalMonthDays) * $noOfPayableDays);
                        }
                    @endphp
                    
                    <input @if (in_array($head->slug, $readonlyArr)) readonly @endif onkeyup="amount_cal(this)" required
                        id="{{ $head->slug }}"
                        placeholder="{{ $head->placeholder ?? 'Enter' . $head->name . 'of' . $page . '' }}"
                        type="number" name="{{ strtolower($head->slug) }}"
                        value="{{ getHeadValue($emp, $head->slug, 'salary', $basic, $value, $salary_month) }}"
                        class="form-control form-control-sm {{ $head->head_type }}">
                </div>
            </div>
        @endif
    @endforeach
</div>


<div class="row">
    <div class="col-sm-3">
        <div class="form-group">
            <label for="gross_earning">Gross Earning ({{ 'In USD' }})</label>
            <input required id="gross_earning" readonly placeholder="Enter correct Gross Earning" type="number"
                value="{{ $data->gross_earning ?? '' }}" name="gross_earning" class="form-control form-control-sm ">
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label for="total_deduction">Total Deduction ({{ 'In USD' }})</label>
            <input required id="total_deduction" readonly placeholder="Enter correct Total Deduction" type="number"
                value="{{ $data->total_deduction ?? '' }}" name="total_deduction"
                class="form-control form-control-sm ">
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label for="net_take_home">Net Take Home ({{ 'In USD' }})</label>
            <input required id="net_take_home" readonly placeholder="Enter correct Net Take Home" type="number"
                onkeyup="amount_cal(this)" value="{{ $data->net_take_home ?? '' }}" name="net_take_home"
                class="form-control form-control-sm ">
        </div>
    </div>
</div>


@if (isset($edit))
    <div class="mt-1 text-center ">
        <button onclick="ajaxCall('form_edit','','POST')" type="button" class="btn btn-white btn-sm">Update
            {{ $page }}</button>
    </div>
@else
    <div class="mt-1 text-center ">
        <button onclick="ajaxCall('form_data','','POST')" type="button" class="btn btn-white btn-sm">Create
            {{ $page }}</button>
    </div>
@endif
<script>
 
</script>
