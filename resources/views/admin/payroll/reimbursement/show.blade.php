<div class="row">
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

            {{-- <select name="claim_to_month" id="claim_to_month" class="form-control" required >
                <option value="">Select To Month</option>
                <option value="1" {{$reimbursement->claim_to_month == 1 ? 'selected' : ''}}>January</option>
                <option value="2" {{$reimbursement->claim_to_month == 2 ? 'selected' : ''}}>February</option>
                <option value="3" {{$reimbursement->claim_to_month == 3 ? 'selected' : ''}}>March</option>
                <option value="4" {{$reimbursement->claim_to_month == 4 ? 'selected' : ''}}>April</option>
                <option value="5" {{$reimbursement->claim_to_month == 5 ? 'selected' : ''}}>May</option>
                <option value="6" {{$reimbursement->claim_to_month == 6 ? 'selected' : ''}}>June</option>
                <option value="7" {{$reimbursement->claim_to_month == 7 ? 'selected' : ''}}>July</option>
                <option value="8" {{$reimbursement->claim_to_month == 8 ? 'selected' : ''}}>August</option>
                <option value="9" {{$reimbursement->claim_to_month == 9 ? 'selected' : ''}}>September</option>
                <option value="10" {{$reimbursement->claim_to_month == 10 ? 'selected' : ''}}>October</option>
                <option value="11" {{$reimbursement->claim_to_month == 11 ? 'selected' : ''}}>November</option>
                <option value="12" {{$reimbursement->claim_to_month == 12 ? 'selected' : ''}}>December</option>
            </select> --}}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="approved_at">Approved date :- </label>
            <label for="approved_at">{{ date('d-m-Y', strtotime($data->approved_at))}}</label>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="rejected_at">Rejected date :- </label>
            <label for="rejected_at">{{ date('d-m-Y', strtotime($data->rejected_at)) }}</label>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="status">Status :- </label>
            <label for="status">{{ucfirst($data->status)}}</label>
        </div>
    </div>
    <div class="mb-2 col-sm-12">
        <div class="form-group">
            <label for="reimbursement_notes">Reimbursement notes :- </label>
            <label  for="reimbursement_notes">{{$data->reimbursement_notes}}</label>

        </div>
    </div>
</div>
