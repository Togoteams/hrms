<div class="row">
    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label for="emp_name">Employee name :- </label>
            <label for="emp_name"> {{ $data->user->name }}</label>
        </div>
    </div>

    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label for="emp_name">EC Number :- </label>
            <label for="emp_name"> {{ $data->user->employee->ec_number }}</label>
        </div>
    </div>  

    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label for="leave_type_id">Leave Types :- </label>
            <label for="leave_type_id"> {{ $data->leave_settings->name }}</label>
        </div>
    </div>

    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label for="leave_type_id">Apply for :- </label>
            <label for="leave_type_id"> {{ $data->available_leave_for_encashment }}</label>
        </div>
    </div>

    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label for="leave_apply_date">Apply Date :- </label>
            <label for="leave_apply_date">{{ date('d-m-Y', strtotime($data->requested_at)) }}</label>
        </div>
    </div>
   

    <div class="col-sm-4">
        <div class="form-group">
            <label for="approval_at">Approved date :- </label>
            @if(!empty($data->approval_at) && $data->approval_at != '1970-01-01')
                <label for="approval_at">{{ date('d-m-Y', strtotime($data->approval_at)) }}</label>
            @else
                <label for="approval_at">N/A</label>
            @endif
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label for="rejected_at">Rejected date :- </label>
            @if(!empty($data->rejected_at) && $data->rejected_at != '1970-01-01')
                <label for="rejected_at">{{ date('d-m-Y', strtotime($data->rejected_at)) }}</label>
            @else
                <label for="rejected_at">N/A</label>
            @endif
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label for="status">Status :- </label>
            <label for="status">{{ucfirst($data->status)}}</label>
        </div>
    </div>
    <div class="mb-2 col-sm-12">
        <div class="form-group">
            <label for="remark">Description :- </label>
            <label for="remark">{{ $data->description }}</label>
        </div>
    </div>
</div>
<hr>
