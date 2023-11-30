<div class="row">
   
    <div class="col-sm-3">
        <div class="form-group">
            <input id="employment_type" placeholder="Enter correct employment_type" type="hidden" value="{{ $emp->employment_type ?? '' }}" name="employment_type">
            <label for="basic">Basic</label>
            @php
            $basic = round(($data->basic / $totalMonthDays) * $noOfPayableDays);
            @endphp
            <input  value="{{$pulaToUSDAmount}}" readonly  id="pulaToUSDAmount" type="hidden" name="pulaToUSDAmount"  class="form-control form-control-sm">
            <input  value="{{$inrToUSDAmount}}" readonly  id="inrToUSDAmount" type="hidden" name="inrToUSDAmount"  class="form-control form-control-sm">
            <input readonly onkeyup="amount_cal(this)" onblur="taxCalCalculation()" required id="basic" placeholder="Enter correct basic " type="text" name="basic" value="{{ $basic ?? '' }}" class="form-control form-control-sm ">
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label for="total_working_days">Total Working Days</label>
            <input readonly required max="2" name="total_working_days"   type="text"  value="{{ $totalMonthDays ?? 0 }}" class="form-control form-control-sm">
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label for="annual_balanced_leave">Total Balanced Leave</label>
            
            <input readonly  required max="3"  name="annual_balanced_leave"  type="text"  value="{{ $totalBalancedLeave ?? 0 }}" class="form-control form-control-sm ">
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label for="basic">No. Of Persent Days</label>
            
            <input readonly onkeyup="amount_cal(this)" name="no_of_persent_days" onblur="taxCalCalculation()" required max="2"   type="number"  value="{{ $presentDay ?? 0 }}" class="form-control form-control-sm ">
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label for="no_of_payable_days">No. of Payable days</label>
            
            <input readonly  required max="2"  name="no_of_payable_days"  type="number"   value="{{ $noOfPayableDays ?? 0 }}" class="form-control form-control-sm ">
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label for="no_availed_leave">No. Availed Leave :</label>
            
            <input readonly  required max="2"  name="no_availed_leave"  type="number" value="{{$noOfAvailedLeaves ?? 0}}"  class="form-control form-control-sm ">
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label for="no_availed_leave">No. Loss Of Pay Leave :</label>
            
            <input readonly  required max="2"  name="total_loss_of_pay"  type="number" value="{{$totalLosOfPayLeave ?? 0}}"  class="form-control form-control-sm ">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h4>Earning</h4>
    </div>
    @php
    $readonlyArr = ['bomaid','pension','union_fee','tax','over_time','provident_fund'];
    $fixedHeadsArr = ['bomaid','over_time'];
    $inrCurrencyHead = ['provident_fund'];
    $pulaCurrencyHead = ['provident_fund'];
    $pulaInsertionArr =['other_deductions'];
    $inrInsertionArr =['education_allowance'];
    @endphp
    @foreach ($emp_head as $head)
    @php
    if (isset($data->user_id)) {
    $head_data = App\Models\PayrollPayscaleHead::where('payroll_payscale_id', $data->id)
    ->where('payroll_head_id', $head->id)
    ->first();
    }

    @endphp
    @if($head->head_type=="income")
    <div class="col-sm-3">
        <div class="form-group">
            <label class="required" for="{{ $head->slug }}">{{ $head->name }} @if(in_array($head->slug,$pulaInsertionArr)) ({{"In PULA"}}) @endif  @if(in_array($head->slug,$inrInsertionArr)) ({{"In INR"}}) @endif</label>
            @php
            if(!empty($head_data))
            {
                if(in_array($head->slug,$fixedHeadsArr))
                {
                    $value = round($head_data->value); 
                }else {
                    $value = round(($head_data->value / $totalMonthDays) * $noOfPayableDays);  
                }
            }else {
                $value = 0;
            }
            @endphp
            <input @if(in_array($head->slug,$readonlyArr)) readonly @endif onkeyup="amount_cal(this)" required id="{{ $head->slug }}" placeholder="{{ $head->placeholder ?? 'Enter' . $head->name . 'of' . $page . '' }}" type="text" name="{{ strtolower($head->slug) }}"  value="{{getHeadValue($emp,$head->slug,'salary',$basic, $value,$salary_month)}}" class="form-control form-control-sm {{$head->head_type}}">
        </div>
    </div>
    @endif
    @endforeach
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
    @if($head->head_type=="deduction")
    <div class="col-sm-3">
        <div class="form-group">
            <label class="required" for="{{ $head->slug }}">{{ $head->name }} @if(in_array($head->slug,$pulaInsertionArr)) ({{"In PULA"}}) @endif </label>
            @php  
            if(in_array($head->slug,$fixedHeadsArr))
            {
                $value = round($head_data?->value); 
            }else {
                $value = round(($head_data?->value / $totalMonthDays) * $noOfPayableDays);  
            }  
            @endphp
            <input @if(in_array($head->slug,$readonlyArr)) readonly @endif onkeyup="amount_cal(this)" required id="{{ $head->slug }}" placeholder="{{ $head->placeholder ?? 'Enter' . $head->name . 'of' . $page . '' }}" type="text" name="{{ strtolower($head->slug) }}" value="{{getHeadValue($emp,$head->slug,'salary',$basic, $value,$salary_month)}}" class="form-control form-control-sm {{$head->head_type}}">
        </div>
    </div>
    
   
    @endif
    @endforeach
</div>


<div class="row">
    <div class="col-sm-3">
        <div class="form-group">
            <label for="gross_earning">Gross Earning</label>
            <input required id="gross_earning" readonly placeholder="Enter correct Gross Earning" type="text" value="{{ $data->gross_earning ?? '' }}" name="gross_earning" class="form-control form-control-sm ">
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label for="total_deduction">Total Deduction</label>
            <input required id="total_deduction" readonly placeholder="Enter correct Total Deduction" type="text" value="{{ $data->total_deduction ?? '' }}" name="total_deduction" class="form-control form-control-sm ">
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label for="net_take_home">Net Take Home</label>
            <input required id="net_take_home"  readonly placeholder="Enter correct Net Take Home" type="text" onkeyup="amount_cal(this)" value="{{ $data->net_take_home ?? '' }}" name="net_take_home" class="form-control form-control-sm ">
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
      $(document).ready(function() {
        taxCalCalculation("e");
    });
</script>