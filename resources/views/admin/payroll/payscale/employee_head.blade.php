<div class="row">

    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label for="basic">basic</label>
            <input onkeyup="amount_cal(this)" required id="basic" placeholder="Enter correct basic  " type="text" name="basic"
                value="{{ $data->basic ?? '' }}" class="form-control form-control-sm ">
        </div>
    </div>
    <input id="employment_type"  placeholder="Enter correct employment_type" type="hidden"
    value="{{ $emp->employment_type ?? '' }}" name="employment_type">
    @foreach ($emp_head as $head)
        @php
            if (isset($data->user_id)) {
                $head_data = App\Models\PayrollPayscaleHead::where('payroll_payscale_id', $data->id)
                    ->where('payroll_head_id', $head->id)
                    ->first();
            }
            
        @endphp
        <div class="mb-2 col-sm-4">
            <div class="form-group">
                <label class="required" for="{{ $head->name }}">{{ $head->name }}</label>
                <input onkeyup="amount_cal(this)" required id="{{ $head->slug }}"
                    placeholder="{{ $head->placeholder ?? 'Enter' . $head->name . 'of' . $page . '' }}" type="text"
                    name="{{ strtolower($head->name) }}" value="{{ $head_data->value ?? '' }}"
                    class="form-control form-control-sm {{$head->head_type}}">
            </div>
        </div>
    @endforeach

    {{-- <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label for="fixed_deductions">fixed_deductions</label>
            <input onkeyup="amount_cal(this)" required id="fixed_deductions" placeholder="Enter correct fixed_deductions   " type="text"
                value="{{ $data->fixed_deductions ?? '' }}" name="fixed_deductions"
                class="form-control form-control-sm ">
        </div>
    </div> --}}

    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label for="other_deductions">other_deductions</label>
            <input onkeyup="amount_cal(this)" required id="other_deductions" placeholder="Enter correct other_deductions   " type="text"
                value="{{ $data->other_deductions ?? '' }}" name="other_deductions"
                class="form-control form-control-sm ">
        </div>
    </div>
    
    {{-- <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label for="ctc">ctc</label>
            <input required id="ctc" placeholder="Enter correct ctc" type="text" name="ctc"
         value="{{ $data->ctc ?? '' }}" class="form-control form-control-sm ">
        </div>
    </div> --}}
    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label for="gross_earning">gross_earning</label>
            <input required id="gross_earning" placeholder="Enter correct gross_earning   " type="text"
                value="{{ $data->gross_earning ?? '' }}" name="gross_earning" class="form-control form-control-sm ">
        </div>
    </div>
    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label for="total_deduction">total_deduction</label>
            <input required id="total_deduction" placeholder="Enter correct total_deduction   " type="text"
                value="{{ $data->total_deduction ?? '' }}" name="total_deduction"
                class="form-control form-control-sm ">
        </div>
    </div>
   
    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label for="net_take_home">net_take_home</label>
            <input required id="net_take_home" placeholder="Enter correct net_take_home   " type="text"
            onkeyup="amount_cal(this)" value="{{ $data->net_take_home ?? '' }}" name="net_take_home" class="form-control form-control-sm ">
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
