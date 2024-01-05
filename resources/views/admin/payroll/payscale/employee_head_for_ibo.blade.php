<div class="row">

    <div class="mb-2 col-sm-4">
        <input id="employment_type" placeholder="Enter correct employment_type" type="hidden" value="{{ $emp->employment_type ?? '' }}" name="employment_type">
        <div class="form-group">
            <label for="basic">Basic ({{"In USD"}})</label>
            <input onkeyup="amount_cal()" value="{{$empSalary->basic_salary}}" readonly onblur="taxCalCalculation()" required id="basic" placeholder="Enter correct Basic" type="text" name="basic"  class="form-control form-control-sm">
            <input  value="{{$usdToPulaAmount}}"  id="usdToPulaAmount" type="hidden" name="usdToPulaAmount"  class="form-control form-control-sm">
            <input  value="{{$usdToInrAmount}}"  id="usdToInrAmount" type="hidden" name="usdToInrAmount"  class="form-control form-control-sm">
        </div>
    </div>
</div>
@php
    $grossEarning = $empSalary->basic_salary;
    $totalDeduction = 0;
    // $pulaInsertionArr = ['education_allowance','other_deductions'];
    $usdInsertionArr =['house_up_keep_allow','entertainment_expenses','provident_fund','recovery_for_car'];

    $readonlyArr = ['bomaid','pension_own','pension_bank','union_fee','tax','over_time','provident_fund'];
    $fixedHeadsArr = ['bomaid','over_time'];
    $inrCurrencyHead = ['provident_fund'];
    $pulaCurrencyHead = ['provident_fund'];
    $pulaInsertionArr =['other_deductions'];
    $inrInsertionArr =['education_allowance'];
@endphp
<div class="row">
    <div class="col-md-12">
        <h4>Earning</h4>
        @php
        $readonlyArr = ['bomaid','pension','union_fee','tax','over_time'];
        $fixedHeadsArr = ['bomaid','over_time'];
        @endphp
    </div>
    @foreach ($emp_head as $head)
    @php
    if (isset($data->user_id)) {
    $head_data = App\Models\PayrollPayscaleHead::where('payroll_payscale_id', $data->id)
    ->where('payroll_head_id', $head->id)
    ->first();
    }
    @endphp
    @if($head->head_type=="income")
    @php
        $payscaleAmount = getHeadValue($emp,$head->slug,"",$empSalary->basic_salary);
        $grossEarning = $grossEarning + $payscaleAmount;
    @endphp
    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label class="required" for="{{ $head->slug }}">{{ $head->name }} @if(in_array($head->slug,$pulaInsertionArr)) ({{"In PULA"}}) @endif @if(in_array($head->slug,$usdInsertionArr)) ({{"In USD"}}) @endif  @if(in_array($head->slug,$inrInsertionArr)) ({{"In INR"}}) @endif </label>
            <input onkeyup="amount_cal()" @if(in_array($head->slug,$readonlyArr)) readonly @endif onblur="taxCalCalculation(this)" required id="{{ $head->slug }}" placeholder="{{ $head->placeholder ?? 'Enter' . $head->name . 'of' . $page . '' }}" type="text" name="{{ strtolower($head->slug) }}" value="{{$payscaleAmount}}" class="form-control form-control-sm {{$head->head_type}}">
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
    @php
        $payscaleDeductionAmount = getHeadValue($emp,$head->slug,"payscale",$empSalary->basic_salary);
        $totalDeduction = $totalDeduction + $payscaleDeductionAmount;
    @endphp
    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label class="required" for="{{ $head->slug }}">{{ $head->name }} @if(in_array($head->slug,$pulaInsertionArr)) ({{"In PULA"}}) @endif  @if(in_array($head->slug,$usdInsertionArr)) ({{"In USD"}}) @endif  @if(in_array($head->slug,$inrInsertionArr)) ({{"In INR"}}) @endif</label>
            <input onkeyup="amount_cal()" @if(in_array($head->slug,$readonlyArr)) readonly @endif value="{{$payscaleDeductionAmount}}" required id="{{ $head->slug }}" placeholder="{{ $head->placeholder ?? 'Enter' . $head->name . 'of' . $page . '' }}" type="text" name="{{ strtolower($head->slug) }}"     class="form-control form-control-sm {{$head->head_type}}">
        </div>
    </div>
    @endif
    @endforeach

</div>
<div class="row">
    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label for="gross_earning">gross_earning ({{"In USD"}}) </label>
            <input required id="gross_earning" readonly placeholder="Enter correct Gross Earning   " type="text" value="{{ number_format($grossEarning,2,'.',"") }}" name="gross_earning" class="form-control form-control-sm ">
        </div>
    </div>
    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label for="total_deduction">total_deduction ({{"In USD"}})</label>
            <input required id="total_deduction" readonly placeholder="Enter correct Total Deduction   " type="text" value="{{ number_format($totalDeduction,2,'.',"") }}" name="total_deduction" class="form-control form-control-sm ">
        </div>
    </div>

    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label for="net_take_home">net_take_home ({{"In USD"}})</label>
            <input required id="net_take_home" readonly placeholder="Enter correct Net Take Home" type="text" onkeyup="amount_cal()" value="{{ number_format(($grossEarning -  $totalDeduction),2,'.',"") }}" name="net_take_home" class="form-control form-control-sm ">
        </div>
    </div>
</div>
</div>

@if (isset($edit))
<div class="text-center ">
    <button onclick="ajaxCall('form_edit','','POST')" type="button" class="btn btn-white">Update
        {{ $page }}</button>
</div>
@else
<div class="text-center ">
    <button onclick="ajaxCall('form_data','','POST')" type="button" class="btn btn-white">Create
        {{ $page }}</button>
</div>
@endif