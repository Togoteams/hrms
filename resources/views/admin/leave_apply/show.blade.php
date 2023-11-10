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
            <label for="leave_type_id"> {{ $data->leave_type->name }}</label>
        </div>
    </div>

    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label for="leave_type_id">Apply for :- </label>
            <label for="leave_type_id"> {{ $data->leave_applies_for }}</label>
        </div>
    </div>

    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label for="start_date">start_date</label>
            <label for="start_date">{{ date('d-m-Y', strtotime($data->start_date)) }}</label>
        </div>
    </div>
    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label for="end_date">end_date</label>
            <label for="end_date">{{ date('d-m-Y', strtotime($data->end_date)) }}</label>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <label for="approved_at">Approved date :- </label>
            @if(!empty($data->approved_at) && $data->approved_at != '1970-01-01')
                <label for="approved_at">{{ date('d-m-Y', strtotime($data->approved_at)) }}</label>
            @else
                <label for="approved_at">N/A</label>
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

    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label for="doc">Required Document</label>
            <label>

                @if ($data->doc != '')
                    <iframe class="img-fluid" src="{{ asset('upload/leave_doc/' . $data->doc) }}"
                        frameborder="1"></iframe>
                @endif
            </label>
        </div>
    </div>

    <div class="mb-2 col-sm-12">
        <div class="form-group">
            <label for="Reason">leave Reason :- </label>
            <label for="Reason">{{ $data->leave_reason }}</label>
        </div>
    </div>

    <div class="mb-2 col-sm-12">
        <div class="form-group">
            <label for="remark">remark</label>
            <label for="remark">{{ $data->remark }}</label>
        </div>
    </div>
</div>
<hr>
