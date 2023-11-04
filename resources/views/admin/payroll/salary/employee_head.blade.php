<div class="row">
   
    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <input id="employment_type" placeholder="Enter correct employment_type" type="hidden" value="{{ $emp->employment_type ?? '' }}" name="employment_type">
            <label for="basic">Basic</label>
            @php
            $basic = round(($data->basic / $totalMonthDays) * $presentDay);
            @endphp
            <input readonly onkeyup="amount_cal(this)" onblur="taxCalCalculation()" required id="basic" placeholder="Enter correct basic " type="text" name="basic" value="{{ $basic ?? '' }}" class="form-control form-control-sm ">
        </div>
    </div>
    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label for="total_working_days">Total Working Days</label>
            <input readonly required max="2" name="total_working_days"   type="text"  value="{{ $totalMonthDays ?? 0 }}" class="form-control form-control-sm">
        </div>
    </div>
    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label for="annual_balanced_leave">Total Balanced Leave</label>
            
            <input readonly  required max="3"  name="annual_balanced_leave"  type="text"  value="{{ $totalBalancedLeave ?? 0 }}" class="form-control form-control-sm ">
        </div>
    </div>
    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label for="basic">No. Of Persent Days</label>
            
            <input readonly onkeyup="amount_cal(this)" name="no_of_persent_days" onblur="taxCalCalculation()" required max="2"   type="number"  value="{{ $presentDay ?? 0 }}" class="form-control form-control-sm ">
        </div>
    </div>
    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label for="no_of_payable_days">No. of Payable days</label>
            
            <input readonly  required max="2"  name="no_of_payable_days"  type="number"   value="{{ $noOfPayableDays ?? 0 }}" class="form-control form-control-sm ">
        </div>
    </div>
    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label for="no_availed_leave">No. Availed Leave :</label>
            
            <input readonly  required max="2"  name="no_availed_leave"  type="number" value="{{$noOfAvailedLeaves ?? 0}}"  class="form-control form-control-sm ">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h4>Earning</h4>
    </div>
    @php
    $readonlyArr = ['bomaid','pension','union_fee','tax'];
    $fixedHeadsArr = ['bomaid','over_time'];
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
    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label class="required" for="{{ $head->slug }}">{{ $head->name }}</label>
            @php
            if(!empty($head_data))
            {
                if(in_array($head->slug,$fixedHeadsArr))
                {
                    $value = round($head_data->value); 
                }else {
                    $value = round(($head_data->value / $totalMonthDays) * $presentDay);  
                }
            }else {
                $value = 0;
            }
            @endphp
            <input @if(in_array($head->slug,$readonlyArr)) readonly @endif onkeyup="amount_cal(this)" required id="{{ $head->slug }}" placeholder="{{ $head->placeholder ?? 'Enter' . $head->name . 'of' . $page . '' }}" type="text" name="{{ strtolower($head->slug) }}"  value="{{getHeadValue($emp,$head->slug,'salary',$basic, $value)}} " class="form-control form-control-sm {{$head->head_type}}">
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
    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label class="required" for="{{ $head->slug }}">{{ $head->name }}</label>
            @php  
            if(in_array($head->slug,$fixedHeadsArr))
                {
                    $value = round($head_data?->value); 
                }else {
                    $value = round(($head_data?->value / $totalMonthDays) * $presentDay);  
                }  
            @endphp
            <input @if(in_array($head->slug,$readonlyArr)) readonly @endif onkeyup="amount_cal(this)" required id="{{ $head->slug }}" placeholder="{{ $head->placeholder ?? 'Enter' . $head->name . 'of' . $page . '' }}" type="text" name="{{ strtolower($head->slug) }}" value="{{ $value ?? '' }}" class="form-control form-control-sm {{$head->head_type}}">
        </div>
    </div>
    @endif
    @endforeach
</div>


<div class="row">
    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label for="gross_earning">gross_earning</label>
            <input required id="gross_earning" placeholder="Enter correct gross_earning   " type="text" value="{{ $data->gross_earning ?? '' }}" name="gross_earning" class="form-control form-control-sm ">
        </div>
    </div>
    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label for="total_deduction">total_deduction</label>
            <input required id="total_deduction" placeholder="Enter correct total_deduction   " type="text" value="{{ $data->total_deduction ?? '' }}" name="total_deduction" class="form-control form-control-sm ">
        </div>
    </div>
    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label for="net_take_home">net_take_home</label>
            <input required id="net_take_home" placeholder="Enter correct net_take_home   " type="text" onkeyup="amount_cal(this)" value="{{ $data->net_take_home ?? '' }}" name="net_take_home" class="form-control form-control-sm ">
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