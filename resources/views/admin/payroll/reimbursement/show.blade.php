<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="user_id">Employee :- </label>
            <label for="">{{ $data->user->name }}
            </label>

        </div>
    </div>
    <div class="mb-2 col-sm-6">
        <div class="form-group">
            <label for="type_id">Reimbursement Type :- </label>
            <label for="">{{ $data->reimbursementype->type }}</label>

        </div>
    </div>
    <div class="mb-2 col-sm-6">
        <label for="expenses_currency">Expense Currency :- </label>
        <label for="">{{getCurrencyIcon($data->currency_name_from)}}</label>

    </div>
    <div class="mb-2 col-sm-6">
        <div class="form-group">
            <label for="expenses_amount">Expense Amount :- </label>
            <label for="expenses_amount">{{$data->expenses_amount}}</label>
        </div>
    </div>
    <div class="mb-2 col-sm-6">
        <div class="form-group">
            <label for="claim_date">Claim date :- </label>
            <label for="claim_date">{{date('d-m-Y', strtotime($data->claim_date))}}</label>
        </div>
    </div>
    <div class="mb-2 col-sm-6">
        <div class="form-group">
            <label for="claim_from_month">Claim For Period From Month :- </label>
            <label for="claim_from_month">{{ $data->claim_from_month }}</label>


        </div>
    </div>
    <div class="mb-2 col-sm-6">
        <div class="form-group">
            <label for="claim_to_month">Claim For Period To Month :- </label>
            <label for="claim_to_month">{{ $data->claim_to_month }} </label>
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
            @endif        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="status">Status :- </label>
            <label for="status">{{ucfirst($data->status)}}</label>
        </div>
    </div>
    <div class="mb-2 col-sm-6">
        <label for="reimbursement_currency">Reimbursement Currency :- </label>
        <label for="">{{getCurrencyIcon($data->currency_name_from)}}</label>
    </div>
    <div class="mb-2 col-sm-6">
        <div class="form-group">
            <label for="reimbursement_amount">Reimbursement Amount :- </label>
            <label for="reimbursement_amount">{{$data->reimbursement_amount}}</label>
        </div>
    </div>
    <div class="mb-2 col-sm-12">
        <div class="form-group">
            <label for="reimbursement_reason">Reimbursement Reason :- </label>
            <label  for="reimbursement_reason">{{$data->reimbursement_reason}}</label>

        </div>
    </div>
    <div class="mb-2 col-sm-12">
        <div class="form-group">
            <label for="reimbursement_notes">Reimbursement notes :- </label>
            <label  for="reimbursement_notes">{{$data->reimbursement_notes}}</label>

        </div>
    </div>
</div>
