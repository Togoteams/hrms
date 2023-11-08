<div class="row">

    <div class="mb-2 col-sm-4">
        <input id="employment_type" placeholder="Enter correct employment_type" type="hidden" value="{{ $emp->employment_type ?? '' }}" name="employment_type">
        <div class="form-group">
            <label for="basic">basic</label>
            <input onkeyup="amount_cal(this)" value="{{$emp->basic_salary}}" onblur="taxCalCalculation()" required id="basic" placeholder="Enter correct basic  " type="text" name="basic" value="{{ $data->basic ?? '' }}" class="form-control form-control-sm ">
        </div>
    </div>
</div>
@php
    $grossEarning =$emp->basic_salary;
    $totalDeduction =0;
@endphp
<div class="row">
    <div class="col-md-12">
        <h4>Earning</h4>
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
        $payscaleAmount = getHeadValue($emp,$head->slug);
        $grossEarning = $grossEarning + $payscaleAmount;
    @endphp
    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label class="required" for="{{ $head->slug }}">{{ $head->name }}</label>
            <input onkeyup="amount_cal(this)" onblur="taxCalCalculation(this)" required id="{{ $head->slug }}" placeholder="{{ $head->placeholder ?? 'Enter' . $head->name . 'of' . $page . '' }}" type="text" name="{{ strtolower($head->slug) }}" value="{{$payscaleAmount}}" class="form-control form-control-sm {{$head->head_type}}">
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
        $payscaleDeductionAmount = getHeadValue($emp,$head->slug);
        $totalDeduction = $totalDeduction + $payscaleDeductionAmount;
    @endphp
    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label class="required" for="{{ $head->slug }}">{{ $head->name }}</label>
            <input onkeyup="amount_cal(this)" value="{{$payscaleDeductionAmount}}" required id="{{ $head->slug }}" placeholder="{{ $head->placeholder ?? 'Enter' . $head->name . 'of' . $page . '' }}" type="text" name="{{ strtolower($head->slug) }}"      value="{{ $head_data->value ?? '' }}" class="form-control form-control-sm {{$head->head_type}}">
        </div>
    </div>
    @endif
    @endforeach

</div>
<div class="row">
    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label for="gross_earning">gross_earning</label>
            <input required id="gross_earning" placeholder="Enter correct Gross Earning   " type="text" value="{{ $data->gross_earning ?? $grossEarning }}" name="gross_earning" class="form-control form-control-sm ">
        </div>
    </div>
    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label for="total_deduction">total_deduction</label>
            <input required id="total_deduction" placeholder="Enter correct Total Deduction   " type="text" value="{{ $data->total_deduction ?? $totalDeduction }}" name="total_deduction" class="form-control form-control-sm ">
        </div>
    </div>

    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label for="net_take_home">net_take_home</label>
            <input required id="net_take_home" placeholder="Enter correct Net Take Home" type="text" onkeyup="amount_cal(this)" value="{{ $data->net_take_home ?? ($grossEarning -  $totalDeduction) }}" name="net_take_home" class="form-control form-control-sm ">
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