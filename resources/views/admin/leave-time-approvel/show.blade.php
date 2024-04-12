<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="user_id">Employee :- </label>
            <label for="">{{ $data->user->name }} ({{ $data->user->employee->ec_number }})
            </label>

        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label for="leave_type_id">Leave Type :-</label>
            <label for="leave_type_id">{{$data->leaveSetting->name }}</label>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label for="start_date">From date :- </label>
            <label for="start_date">{{date('d-m-Y', strtotime($data->start_date))}}</label>

        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="end_date">To date :- </label>
            <label for="end_date">{{ date('d-m-Y', strtotime($data->end_date)) }} </label>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="approved_at">Approved date :- </label>
            @if(!empty($data->approved_at) && $data->approved_at != '1970-01-01')
            <label for="approved_at">{{ date('d-m-Y', strtotime($data->approved_at)) }}</label>
            @else
                <label for="approved_at">N/A</label>
            @endif        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="rejected_at">Rejected date :- </label>
            @if(!empty($data->rejected_at) && $data->rejected_at != '1970-01-01')
            <label for="rejected_at">{{ date('d-m-Y', strtotime($data->rejected_at)) }}</label>
            @else
                <label for="rejected_at">N/A</label>
            @endif
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="status">Status :- </label>
            <label for="status">{{ucfirst($data->status)}}</label>
        </div>
    </div>
    <div class="mb-2 col-sm-6">
        <div class="form-group">
            <label for="document">Required Document :- </label>
            <label for="document">
                @if ($data->document != '')
                    <iframe class="img-fluid" src="{{ asset('assets/leave_document/' . $data->document) }}"
                        frameborder="1"></iframe>
                @endif
            </label>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="document">Document Download :- </label>
            <label for="document">
            @if($data)
            <a href="{{ asset('assets/leave_document/') . '/' . $data->document }}" download>Download</a>
            @else
                No Document Available
            @endif
        </label>
         </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="reason">Reason :- </label>
            <label for="reason">{{ $data->reason }}</label>
        </div>
    </div>

    <div class="mb-12 col-sm-12">
        <div class="form-group">
            <label for="description" class="required">Description :- </label>
            <label for="description" class="required">{{ $data->description }}</label>
        </div>
    </div>

</div>
