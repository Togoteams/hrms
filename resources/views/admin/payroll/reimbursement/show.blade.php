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
        <div class="form-group">
            <label for="type_id">Reimbursement For :- </label>
            <label for="">{{ $data->reimbursement_for_name}}</label>

        </div>
    </div>
   
    <div class="mb-2 col-sm-6">
        <div class="form-group">
            <label for="expenses_amount">Expense Amount :- </label>
            <label for="expenses_amount"> {{getCurrencyIcon($data->currency_name_from)}} {{$data->expenses_amount}}</label>
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
            <label for="claim_from_month">Claim Month  of Finacial Year:- </label>
            <label for="claim_from_month">{{$data->financial_year}} From {{ getMonthName($data->claim_from_month) }} To  {{ getMonthName($data->claim_to_month) }} </label>
        </div>
    </div>
    <div class="mb-2 col-sm-6">
        <div class="form-group">
            <label for="reimbursement_notes">Reimbursement notes :- </label>
            <label  for="reimbursement_notes">{{$data->reimbursement_notes}}</label>

        </div>
    </div>
    @if ($data->document_file != '')
    <div class="mb-2 col-sm-4">
        <div class="">
            <label>Required Document</label>
            <label>
                <iframe class="img-fluid" src="{{ asset('upload/document_file/' . $data->document_file) }}"
                    frameborder="1"></iframe>
            </label>
        </div>
    </div>
@endif
    <div class="col-sm-6">
        <div class="form-group">
            <label for="status">Status :- </label>
            <label for="status">{{ucfirst($data->status)}}</label>
        </div>
    </div>
  
    @if ($data->status == 'approved')
    <div class="col-sm-6">
        <div class="form-group">
            <label for="approved_at">Approved date :- </label>
            @if(!empty($data->approved_at) && $data->approved_at != '1970-01-01')
            <label for="approved_at">{{ date('d-m-Y', strtotime($data->approved_at)) }}</label>
            @else
                <label for="approved_at">N/A</label>
            @endif
        </div>
    </div>
    @elseif($data->status == 'rejected')
        <div class="col-sm-6">
            <div class="form-group">
                <label for="rejected_at">Rejected date :- </label>
                @if(!empty($data->rejected_at) && $data->rejected_at != '1970-01-01')
                <label for="rejected_at">{{ date('d-m-Y', strtotime($data->rejected_at)) }}</label>
                @else
                    <label for="rejected_at">N/A</label>
                @endif        </div>
        </div>
    @endif
    
    
   
    <div class="mb-2 col-sm-6">
        <div class="form-group">
            <label for="reimbursement_amount">Reimbursement Amount :- </label>
            <label for="reimbursement_amount">{{getCurrencyIcon($data->reimbursement_currency)}} {{$data->reimbursement_amount}}</label>
        </div>
    </div>
    <div class="mb-2 col-sm-12">
        <div class="form-group">
            <label for="reimbursement_reason">Approval Reason :- </label>
            <label  for="reimbursement_reason">{{$data->reimbursement_reason}}</label>

        </div>
    </div>
    
</div>
