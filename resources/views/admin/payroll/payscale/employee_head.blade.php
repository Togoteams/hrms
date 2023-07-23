<div class="row">

    <div class="col-sm-4 mb-2">
        <div class="form-group">
            <label for="basic">basic</label>
            <input required id="basic" placeholder="Enter correct basic   " type="text" name="basic"
                class="form-control form-control-sm ">
        </div>
    </div>

    @foreach ($emp_head as $head)
        @php
            if (isset($data->payroll_payscale_id)) {
               $head_data= App\Models\PayrollPayscaleHead::where('payroll_payscale_id', $head->id)
                    ->where('payroll_payscale_id', $data->payroll_payscale_id)
                    ->first();
                    dd($head_data);
            }


        @endphp
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label class="required" for="{{ $head->name }}">{{ $head->name }}</label>
                <input required id="{{ $head->name }}"
                    placeholder="{{ $head->placeholder ?? 'Enter' . $head->name . 'of' . $page . '' }}" type="text"
                    name="{{ strtolower($head->name) }}" value="{{ $head_data->value ?? ''}}" class="form-control form-control-sm ">
            </div>
        </div>
    @endforeach

    <div class="col-sm-4 mb-2">
        <div class="form-group">
            <label for="fixed_deductions">fixed_deductions</label>
            <input required id="fixed_deductions" placeholder="Enter correct fixed_deductions   " type="text"
                name="fixed_deductions" class="form-control form-control-sm ">
        </div>
    </div>

    <div class="col-sm-4 mb-2">
        <div class="form-group">
            <label for="other_deductions">other_deductions</label>
            <input required id="other_deductions" placeholder="Enter correct other_deductions   " type="text"
                name="other_deductions" class="form-control form-control-sm ">
        </div>
    </div>
    <div class="col-sm-4 mb-2">
        <div class="form-group">
            <label for="net_take_home">net_take_home</label>
            <input required id="net_take_home" placeholder="Enter correct net_take_home   " type="text"
                name="net_take_home" class="form-control form-control-sm ">
        </div>
    </div>
    <div class="col-sm-4 mb-2">
        <div class="form-group">
            <label for="ctc">ctc</label>
            <input required id="ctc" placeholder="Enter correct ctc   " type="text" name="ctc"
                class="form-control form-control-sm ">
        </div>
    </div>
    <div class="col-sm-4 mb-2">
        <div class="form-group">
            <label for="total_employer_contribution">total_employer_contribution</label>
            <input required id="total_employer_contribution" placeholder="Enter correct total_employer_contribution   "
                type="text" name="total_employer_contribution" class="form-control form-control-sm ">
        </div>
    </div>
    <div class="col-sm-4 mb-2">
        <div class="form-group">
            <label for="total_deduction">total_deduction</label>
            <input required id="total_deduction" placeholder="Enter correct total_deduction   " type="text"
                name="total_deduction" class="form-control form-control-sm ">
        </div>
    </div>
    <div class="col-sm-4 mb-2">
        <div class="form-group">
            <label for="gross_earning">gross_earning</label>
            <input required id="gross_earning" placeholder="Enter correct gross_earning   " type="text"
                name="gross_earning" class="form-control form-control-sm ">
        </div>
    </div>
</div>


<div class="text-center ">
    <button onclick="ajaxCall('form_data','','POST')" type="button" class="btn btn-white">Update
        {{ $page }}</button>
</div>
